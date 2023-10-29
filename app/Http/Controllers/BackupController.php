<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\Tasks\Backup\BackupJob;

class BackupController extends Controller
{
    public function index()
    {
        return view('admin.settings.backup.index');
    }
    public function backup(Request $request)
    {
        // Define the backup file name
        $backupFileName = 'backupdata_' . date('Y_m_d_His') . '.sql';

        // Define the path to mysqldump executable (use Laravel database configuration)
        $mysqlDumpPath = 'C:\xampp\mysql\bin\mysqldump.exe'; // Replace with your actual path
        $databaseConfig = config('database.connections.mysql');

        // Build the mysqldump command
        $command = "{$mysqlDumpPath} --user={$databaseConfig['username']} --host={$databaseConfig['host']} {$databaseConfig['database']} > " . storage_path('app/backup/') . $backupFileName;

        // Debugging: Dump the command to the Laravel log
        Log::info('Mysqldump command: ' . $command);

        // Execute the mysqldump command
        exec($command, $output, $returnCode);

        // Debugging: Dump the output and return code to the Laravel log
        Log::info('Mysqldump output: ' . implode("\n", $output));
        Log::info('Mysqldump return code: ' . $returnCode);

        if ($returnCode === 0) {
            // Backup completed successfully, create a response for download
            $backupFilePath = storage_path('app/backup/') . $backupFileName;
            if (file_exists($backupFilePath)) {
                $response = new Response(file_get_contents($backupFilePath), 200);
                $response->header('Content-Type', 'application/sql');
                $response->header('Content-Disposition', 'attachment; filename=' . $backupFileName);

                // Log the backup event
                Log::info('Manual backup completed successfully: ' . $backupFileName);

                // Delete the backup file after it's sent to the user
                unlink($backupFilePath);

                return $response;
            } else {
                Log::error('Manual backup file not found: ' . $backupFileName);
                return redirect()->back()->with('error', 'Manual backup failed. Backup file not found.');
            }
        } else {
            // Log and handle errors
            $errorOutput = implode("\n", $output);
            Log::error('Manual backup failed: ' . $errorOutput);

            return redirect()->back()->with('error', 'Manual backup failed. See logs for details.');
        }
    }




}
