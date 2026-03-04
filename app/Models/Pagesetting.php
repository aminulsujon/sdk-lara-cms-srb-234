<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagesetting extends Model
{
    use HasFactory;
    protected $fillable = ["meta_slug","meta_heading","meta_title","meta_keyword","meta_description","page_description","meta_image","meta_robots","meta_canonical"];

}
