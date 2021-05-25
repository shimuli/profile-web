<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    protected $fillable =['title', 'content'];

   public function comments(){
        return $this->hasMany(Comments::class);
    }
}
