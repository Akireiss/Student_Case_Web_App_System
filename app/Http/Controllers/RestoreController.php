<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class RestoreController extends Controller
{
    public function index()
    {
            return view('database.restore');

    }

    public function restore(Request $request)
    {
        // Validate user input
        $request->validate([
            'database_name' => 'required|string',
            'sql_file' => 'required',
        ]);

        $newDatabaseName = $request->input('database_name');
        $sqlFile = $request->file('sql_file');

        // Manually set the database name for this request
        Config::set('database.connections.mysql.database', null);

        // Create a new database
        DB::connection()->statement("CREATE DATABASE IF NOT EXISTS $newDatabaseName");

        // Set the database connection to the new database
        Config::set('database.connections.mysql.database', $newDatabaseName);

        // Switch to the new database connection
        Config::set('database.default', 'mysql');
        DB::purge('mysql');

        // Import data from the SQL file into the new database
        $importCommand = "mysql --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " $newDatabaseName < " . $sqlFile->getPathname();
        shell_exec($importCommand);

        // Check if the new database name exists
        if (!$this->databaseExists($newDatabaseName)) {
            return back()->with('error', 'The specified database does not exist.');
        }

        // Get the content of the .env file
        $envFilePath = base_path('.env');
        $envContent = File::get($envFilePath);

        // Replace the old database name with the new one in the .env file
        $newEnvContent = Str::replaceFirst('DB_DATABASE=' . env('DB_DATABASE'), 'DB_DATABASE=' . $newDatabaseName, $envContent);

        // Write the updated content back to the .env file
        File::put($envFilePath, $newEnvContent);

        try {
            // Attempt to reconnect to the database with the new name
            DB::reconnect();
        } catch (\Exception $e) {
            // Handle the exception, e.g., display an error message
            return back()->with('error', 'Error changing database name: ' . $e->getMessage());
        }

        // Redirect with a success message
        return back()->with('success', 'Database name has been changed.');
    }
private function databaseExists($databaseName)
{
    try {
        // Use a raw SQL query to check if the database exists
        $result = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?", [$databaseName]);

        return count($result) > 0;
    } catch (\Exception $e) {
        return false;
    }
}
}
