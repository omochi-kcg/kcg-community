<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Deploy
    |--------------------------------------------------------------------------
    |
    | Here are all the settings for the Libary/Deploy.php script.
    |
    */

    'secret_key'        => env('DEPLOY_SECRET_KEY'),
    'options' => [
        'directory'     => '/var/www/kcg-community.hta-global.com/', // Enter your server's git repo location
        'work_dir'      => false,  // Enter your server's work directory. If you don't separate git and work directories, please leave it empty or false.
        'log'           => 'deploy_log_filename.log', // relative or absolute path where you save log file. Set it to false without quotation mark if you don't need to save log file.
        'branch'        => 'master', // Indicate which branch you want to checkout
        'remote'        => 'origin', // Indicate which remote repo you want to fetch
        'date_format'   => 'Y-m-d H:i:sP',  // Indicate date format of your log file
        'syncSubmodule' => false, // If your repo has submodule, set it true. (haven't tested it if this actually works)
        'reset'         => false, // If you want to git reset --hard every time you deploy, please set it true
        'git_bin_path'  => 'git',
    ],
];
