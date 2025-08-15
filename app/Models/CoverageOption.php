<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoverageOption extends Model
{
    protected $table = 'coverage_options';

    protected $fillable = ['name', 'price'];

    public function quotations()
    {
        return $this->belongsToMany(Quotation::class)->withTimestamps();
    }
}
