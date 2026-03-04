<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
    use HasFactory;
    protected $fillable = ['linktype','pagelink','nextpagelink','statuscode'];

    public function generateLanding(){
        dd('ok');
    }
}
