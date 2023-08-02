<?php

namespace App\Models;

use App\Traits\Uuids;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portal extends Model
{
    use HasFactory, Uuids, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logUnguarded()->useLogName('portal')->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
