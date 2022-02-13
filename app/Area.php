<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function article(){
        return $this->belongsToMany(Article::class,'article_areas','article_id','area_id');
    }
}
