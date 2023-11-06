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
    public function backup()
    {
        $databaseName = config('database.connections.mysql.database');
        $backupFileName = $databaseName . '_' . date('Y-m-d_His') . '.sql';
        $backupPath = storage_path('app/backups/' . $backupFileName);
        
        $command = "mysqldump --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " " . $databaseName . " > " . $backupPath;
        exec($command);
        
        return response()->file($backupPath);
    }
    
    



}
