<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Comments extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'content'];

    public function ArticleModel(){
        return $this->belongsTo(ArticleModel::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

     public static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new LatestScope);
        static::creating(function (Comments $comment) {

            Cache::forget('blog-post-{$comment->article_model_id}');

        });

    }

}
