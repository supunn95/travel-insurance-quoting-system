<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoverageOption extends Model
{
    use HasFactory;
    protected $table = 'coverage_options';

    protected $fillable = ['name', 'price'];

    public function quotations()
    {
        return $this->belongsToMany(Quotation::class)->withTimestamps();
    }
}
