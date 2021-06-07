<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'content'];

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function (ArticleModel $articleModel) {
            $articleModel->comments()->delete();
        });

        static::restoring(function (ArticleModel $articleModel) {
            $articleModel->comments->restore();
        });

        

    }
}
