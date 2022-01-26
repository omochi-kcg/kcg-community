<?php

namespace App\Http\Controllers;

use App\Library\Deploy;
use Illuminate\Http\Request;

class DeployController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->get('key'))
            return abort(404);

        /**
         * Main Section: No need to modify below this line
         */
        if ($request->get('key') === config('deploy.secret_key'))  {
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
