<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrimony extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fund_id',
        'date',
        'value'
    ];

    public function fund() {
        return $this->belongsTo(Fund::class);
    }
}
