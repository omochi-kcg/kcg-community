<?php
/** test
 * [Job] git Webhooks Auto Deployment PHP Sample Script
 *
 * PHP script to work with webhook to deploy your git repo
 * Read https://github.com/katzueno/git-Webhooks-Auto-Deploy-PHP-Script for the detail
 *
 * @access public
 * @author Katz Ueno <katzueno.com>
 * @copyright Katz Ueno
 * @category Deployment
 * @version 4.0.1
 */

namespace App\Library;

use Exception;
use Illuminate\Support\Facades\Artisan;

class Deploy {

    /**
    * A callback function to call after the deploy has finished.
    *
    * @var callback
    */
    public $post_deploy;

    /**
    * The name of the file that will be used for logging deployments. Set to
    * FALSE to disable logging.
    *
    * @var string
    */
    private $_log = 'deploy.log';

    /**
    * The timestamp format used for logging.
    *
    * @link    http://www.php.net/manual/en/function.date.php
    * @var     string
    */
    private $_date_format = 'Y-m-d H:i:sP';

    /**
    * The path to git
    *
    * @var string
    */
    private $_git_bin_path = 'git';

    /**
    * The directory where your git repository is located, can be
    * a relative or absolute path from this PHP script on server.
    *
    * @var string
    */
    private $_directory;

    /**
    * The directory where your git work directory is located, can be
    * a relative or absolute path from this PHP script on server.
    *
    * @var string
    */
    private $_work_dir;

    /**
     * Determine if it will execute to git checkout to work directory,
     * or git pull.
     *
     * @var boolean
     */
    private $_topull = false;

    /**
    * Sets up defaults.
    *
    * @param  array   $option       Information about the deployment
    */
    public function __construct($options = array())
    {

        $available_options = array('directory', 'work_dir', 'log', 'date_format', 'branch', 'remote', 'syncSubmodule', 'reset', 'git_bin_path', 'composer_bin_path');

        foreach ($options as $option => $value){
            if (in_array($option, $available_options)) {
                $this->{'_'.$option} = $value;
                if (($option == 'directory') || ($option == 'work_dir' && $value)) {
                    // Determine the directory path
                    $this->{'_'.$option} = realpath($value).DIRECTORY_SEPARATOR;
                }
            }
        }

        $this->_topull = false;
        if (empty($this->_work_dir) || ($this->_work_dir == $this->_directory)) {
            $this->_work_dir = $this->_directory;
            $this->_directory = $this->_directory . '.git';
            $this->_topull = true;
        }

        $this->log('Attempting deployment...');
        $this->log('Git Directory:' . $this->_directory);
        $this->log('Work Directory:' . $this->_work_dir);
    }

    /**
    * Writes a message to the log file.
    *
    * @param  string  $message  The message to write
    * @param  string  $type     The type of log message (e.g. INFO, DEBUG, ERROR, etc.)
    */
    public function log($message, $type = 'INFO')
    {
        if ($this->_log) {
            // Set the name of the log file
            $filename = $this->_log;

            if ( ! file_exists($filename)) {
                // Create the log file
                file_put_contents($filename, '');

                // Allow anyone to write to log files
                chmod($filename, 0666);
            }

            // Write the message into the log file
            // Format: time --- type: message
            file_put_contents($filename, date($this->_date_format).' --- '.$type.': '.$message.PHP_EOL, FILE_APPEND);
        }
    }

    /**
    * Executes the necessary commands to deploy the website.
    */
    public function execute()
    {
        try {
            // Git Submodule - Measure the execution time
            $strtedAt = microtime(true);

            //Bring down Laravel during deploy
            $this->log('Bringing down Laravel... ');
            Artisan::call('down');

            // Discard any changes to tracked files since our last deploy
            if ($this->_reset) {
                exec($this->_git_bin_path . ' --git-dir=' . $this->_directory . ' --work-tree=' . $this->_work_dir . ' reset --hard HEAD 2>&1', $output);
                if (is_array($output)) {
                    $output = implode(' ', $output);
                }
                $this->log('Reseting repository... '.$output);
            }

            // Update the local repository
            exec($this->_git_bin_path . ' --git-dir=' . $this->_directory . ' --work-tree=' . $this->_work_dir . ' fetch', $output, $return_var);
            if ($return_var === 0) {
                $this->log('Fetching changes... '.implode(' ', $output));
            } else {
                throw new Exception(implode(' ', $output));
            }

            // Checking out to web directory
            if ($this->_topull) {
                exec('cd ' . $this->_directory . ' && GIT_WORK_TREE=' . $this->_work_dir . ' ' . $this->_git_bin_path . ' pull 2>&1', $output, $return_var);
                if ($return_var === 0) {
                    $this->log('Pulling changes to directory... ' . implode(' ', $output));
                } else {
                    throw new Exception(implode(' ', $output));
                }
            } else {
                exec('cd ' . $this->_directory . ' && GIT_WORK_TREE=' . $this->_work_dir . ' ' . $this->_git_bin_path . ' checkout -f', $output, $return_var);
                if ($return_var === 0) {
                    $this->log('Checking out changes to www directory... ' . implode(' ', $output));
                } else {
                    throw new Exception(implode(' ', $output));
                }

            }

            if ($this->_syncSubmodule) {
                // Wait 2 seconds if main git pull takes less than 2 seconds.
                $endedAt = microtime(true);
                $mDuration = $endedAt - $strtedAt;
                if ($mDuration < 2) {
                    $this->log('Waiting for 2 seconds to execute git submodule update.');
                    sleep(2);
                }
                // Update the submodule
                $output = '';
                exec($this->_git_bin_path . ' --git-dir=' . $this->_directory . ' --work-tree=' . $this->_work_dir . ' submodule update --init --recursive --remote', $output);
                if (is_array($output)) {
                    $output = implode(' ', $output);
                }
                $this->log('Updating submodules...'.$output);
            }

            if (is_callable($this->post_deploy)) {
                call_user_func($this->post_deploy, $this->_data);
            }

            $this->log('Running composer...');
            exec($this->_composer_bin_path . ' --working-dir=' . $this->_directory . ' install --no-interaction --prefer-dist --optimize-autoloader --no-dev');

            //Run database migrations
            $this->log('Running composer...');
            Artisan::call('migrate', '--force');

            //Clear caches
            $this->log('Clear caches...');
            Artisan::call('cache:clear');

            //Clear expired password reset tokens
            $this->log('Clear expired password reset tokens...');
            Artisan::call('auth:clear-resets');

            //Clear the route cache
            $this->log('Clear the route cache...');
            Artisan::call('route:cache');

            //Clear the config cache
            $this->log('Clear the config cache...');
            Artisan::call('config:cache');

            //Clear the view cache
            $this->log('Clear the view cache...');
            Artisan::call('view:cache');

            //Bring Laravel back up
            $this->log('Bring Laravel back up...');
            Artisan::call('up');

            $this->log('Deployment successful.');
        } catch (Exception $e) {
            $this->log($e, 'ERROR');
        }
    }
}
