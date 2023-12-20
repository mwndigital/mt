<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;


class DevController extends Controller
{
    public function deployment(Request $request)
    {
        try {
            shell_exec('/usr/local/cpanel/bin/uapi VersionControl update name=mt repository_root=/home/mashtunaberlour/repositories/mt branch=main source_repository=\'{"remote_name":"origin"}\'
        ');
            shell_exec('/usr/local/cpanel/bin/uapi VersionControlDeployment create repository_root=/home/mashtunaberlour/repositories/mt');
            // Artisan::call('optimize:clear');
            // Artisan::call('storage:link');
            echo "done";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
