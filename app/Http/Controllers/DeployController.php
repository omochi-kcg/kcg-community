<?php

namespace App\Http\Controllers;

use App\Library\Deploy;
use Illuminate\Http\Request;

class DeployController extends Controller
{
    public function index(Request $request)
    {

        $signature = hash_hmac('sha1', file_get_contents('php://input'), config('deploy.secret_key'));
        $required_headers = array(
            'REQUEST_METHOD' => 'POST',
            'HTTP_X_GITHUB_EVENT' => 'push',
            'HTTP_USER_AGENT' => 'GitHub-Hookshot/*',
            'HTTP_X_HUB_SIGNATURE' => 'sha1=' . $signature,
        );
        var_dump($required_headers);

        /**
         * Main Section: No need to modify below this line
         */
        if ($_GET['key'] === config('deploy.secret_key'))  {
            $deploy = new Deploy(config('deploy.options'));
            $deploy->execute();
            /*
            $deploy->post_deploy = function() use ($deploy) {
            // hit the wp-admin page to update any db changes
            exec('curl http://example.com/wp-admin/upgrade.php?step=upgrade_db');
            $deploy->log('Updating wordpress database... ');
            };
            */
        }
    }
}
