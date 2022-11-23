<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Random extends Model
{
    use HasFactory;
    protected $fillable = ['values', 'flag'];
    
    public function breakdowns()
    {
        return $this->hasMany(Breakdowns::class, 'random_id');
    }
}
