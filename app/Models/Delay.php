<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delay extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'delay_start',
        'delay_end',
        'report_date',
        'shift',
        'duration',
        'department_id',
        'type',
        'reason',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
