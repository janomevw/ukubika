<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ShiftReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'report_date',
        'report_shift',
        'user_id',
        'input_weight',
        'output_weight',
        'coil_ends_weight',
        'safety',
        'quality',
        'other'
    ];

    public function foreman()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shift_report_lines()
    {
        return $this->hasMany(ShiftReportItem::class, 'shift_report_id');
    }

    public function delays()
    {
        return $this->hasMany(Delay::class, 'report_date', 'report_date')->where('delays.shift', '=', $this->report_shift);
    }
}
