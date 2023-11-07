<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\Tasks\Backup\BackupJob;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class BackupController extends Controller
{
    public function index()
    {
        return view('admin.settings.backup.index');
    }
    public function backup()
    {
        $databaseName = config('database.connections.mysql.database');
        $backupFileName = $databaseName . '_' . date('Y-m-d_His') . '.sql';
        $backupPath = storage_path('app/backups/' . $backupFileName);

        $command = "mysqldump --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " " . $databaseName . " > " . $backupPath;
        exec($command);

        if (file_exists($backupPath)) {
            return response()->download($backupPath, $backupFileName, [
                'Content-Type' => 'application/sql',
                'Content-Disposition' => 'attachment; filename="' . $backupFileName . '"',
            ]);
        } else {
            return redirect()->back()->with('error', 'Backup failed.');
        }
    }

    public function restore(Request $request)
    {
        // Validate user input
        $request->validate([
            'new_database_name' => 'required|string',
        ]);

        $newDatabaseName = $request->input('new_database_name');
        $sqlFile = $request->file('sql_file');

        // Check if the new database name already exists
        $existingDatabases = DB::select("SHOW DATABASES");
        $existingDatabaseNames = array_column($existingDatabases, 'Database');

        if (in_array($newDatabaseName, $existingDatabaseNames)) {
            return redirect()->back()->with('error', "Database '$newDatabaseName' already exists.");
        }

        // Create a new database
        DB::statement("CREATE DATABASE IF NOT EXISTS $newDatabaseName");

        // Import data from the SQL file into the new database
        $importCommand = "mysql --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " $newDatabaseName < " . $sqlFile->getPathname();
        shell_exec($importCommand);

        // Redirect with a success message
        return redirect()->back()->with('success', "Database '$newDatabaseName' is created and data is imported.");
    }


    public function changeDatabaseName(Request $request)
    {
        // Validate user input
        $request->validate([
            'new_database_name' => 'required|string',
        ]);

        $newDatabaseName = $request->input('new_database_name');

        // Get the content of the .env file
        $envFilePath = base_path('.env');
        $envContent = File::get($envFilePath);

        // Replace the old database name with the new one in the .env file
        $newEnvContent = Str::replaceFirst('DB_DATABASE=' . env('DB_DATABASE'), 'DB_DATABASE=' . $newDatabaseName, $envContent);

        // Write the updated content back to the .env file
        File::put($envFilePath, $newEnvContent);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Database have been changed');
    }
}
