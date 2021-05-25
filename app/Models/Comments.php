<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function ArticleModel(){
        return $this->belongsTo(ArticleModel::class);
    }
}
