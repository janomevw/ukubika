<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftReportItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'shift_report_id',
        'width',
        'thickness',
        'input_weight',
        'output_weight',
        'grade',
        'production_order',
    ];

    public function shift_report(){
        return $this->belongsTo(ShiftReport::class, 'id');
    }

    public function department(){
        return $this->belongsTo(Departments::class, 'id');
    }
}
