<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class ArticleModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'content', 'user_id'];

    public function comments()
    {
        return $this->hasMany(Comments::class)->latest();

    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

     public function articleModel()
    {
        return $this->belongsTo(ArticleModel::class);
    }

    public function tags(){
        return $this->belongsToMany(Tags::class)->withTimestamps();
    }

    public function scopeLatest(Builder $query){
        return $query->orderBy(static::CREATED_AT,'desc');
    }

    // most commented pots
    public function scopeMostCommented(Builder $query){
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public static function boot()
    {
        static::addGlobalScope(new DeletedAdminScope);

        parent::boot();
        static::deleting(function (ArticleModel $articleModel) {
            $articleModel->comments()->delete();
            $articleModel->image()->delete();
        });

        static::updating(function(ArticleModel $articleModel){
            Cache::forget("blog-post-{$articleModel->id}");
        });

        static::restoring(function (ArticleModel $articleModel) {
            $articleModel->comments->restore();
        });



    }
}
