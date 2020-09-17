<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // sentence-capitalise different variables
     public function getNameAttribute($desc)
     {
         return ucwords($desc);
     }       

}
