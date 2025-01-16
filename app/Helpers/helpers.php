<?php

use App\Models\ActivityLog;

if (! function_exists('logActivity')) {
    function logActivity($action, $details = null)
{
    ActivityLog::create([
        'user_id' => auth()->id(),
        'action' => $action,
        'details' => $details,
    ]);
}
}