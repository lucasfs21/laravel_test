<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    public function patrimonies() {
        return $this->hasMany(Patrimony::class, 'fund_id', 'id');
    }
}
