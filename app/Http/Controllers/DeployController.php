<?php

namespace App\Http\Controllers;

use App\Library\Deploy;

class DeployController extends Controller
{
    public function index()
    {

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
