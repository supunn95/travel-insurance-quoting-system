<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'quotations';

    protected $fillable = [
        'destination_id',
        'start_date',
        'end_date',
        'total_travelers',
        'total_price'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function coverageOptions()
    {
        return $this->belongsToMany(CoverageOption::class)->withTimestamps();
    }
}
