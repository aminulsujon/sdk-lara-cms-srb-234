<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landecial extends Model
{
    use HasFactory;
    protected $fillable = ['contents','status'];

    public function _generateLanding(){
        dd('ok');
    }
}
