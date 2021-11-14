<?php

namespace App\Strategies;

use Spatie\Backup\Tasks\Cleanup\CleanupStrategy;
use Spatie\Backup\BackupDestination\BackupCollection;

class CustomStrategy extends CleanupStrategy
{
    public function deleteOldBackups(BackupCollection $backups)
    {
        // Don't ever delete the newest backup.
        $backups->shift();

        $allowed = 9;

        for ($i=0; $i < count($backups); $i++) {
            if ($i >= $allowed) {
                $backups[$i]->delete();
            }
        }
    }
}
