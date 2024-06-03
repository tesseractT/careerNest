<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Artisan;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ClearDatabaseController extends Controller
{
    function index(): View
    {
        return view('admin.clear-db.index');
    }

    function clear(): Response
    {
        try {
            //Wipe all data from the database
            Artisan::call('migrate:fresh');

            //Seed the database with records
            Artisan::call('db:seed', ['--class' => 'AdminSeeder']);
            Artisan::call('db:seed', ['--class' => 'SiteSettingSeeder']);
            Artisan::call('db:seed', ['--class' => 'MenuSeeder']);
            Artisan::call('db:seed', ['--class' => 'PaymentSettingSeeder']);

            //Delete all files from the uploads folder
            $this->deleteFiles();

            return response(['message' => 'Database cleared successfully'], 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function deleteFiles(): void
    {
        $path = public_path('uploads');
        $allFiles = File::allFiles($path);

        foreach ($allFiles as $file) {
            $filename = $file->getFilename();

            File::delete($filename);
        }
    }
}
