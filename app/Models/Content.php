<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Str;

class Content extends Model
{
  use HasFactory;
  protected $fillable = ['user_id','name','subtitle','slug','meta_title','meta_keywords','meta_des','canonical_url','details','summary','publisher','note','in_listed','content_index','barcode','view','status','seq','seqc'];

  protected $appends = ['details_preview'];

  public function getDetailsPrevAttribute()
  {
      return Str::limit(strip_tags($this->details), 200);
  }

  public function details(): Attribute
  {
      return Attribute::make(
          set: fn ($value) => str_replace('input', '', $value),
      );
  }
  public function upload(){
    return $this->hasMany('App\Models\Upload', 'content_id');
  }
  
  // public function comment(){
  //   return $this->hasMany('App\Models\Comment', 'content_id');
  // }

  public function content_employee(){
    return $this->hasMany('App\Models\ContentEmployee', 'content_id');
  }
  public function content_tag(){
    return $this->hasMany('App\Models\ContentTag', 'content_id');
  }

  public function tags(){
    return $this->belongsToMany(Tag::class);
  }
  

  public function employee()
  {
      return $this->belongsToMany(Employee::class, 'content_employee');
  }
  public function member()
  {
      return $this->belongsTo(Member::class);
  }

  /**
     * Get all of the content's comments.
     */
    // public function comments()
    // {
    //     return $this->morphMany(Comment::class, 'commentable');
    // }
    public function comments()
    {
        return $this->morphMany('Comment', 'commentable');
    }

    // results in a "problem", se examples below
    public function active_comments() {
      return $this->comments()->where('status','=', 1);
    }

    public function getLatest(){
      return Content::where('content_type','news')
        ->where('status',1)
        ->with(['upload' => function($echo) {
              $echo->where('status', '=', 1);
          }])
        ->take(10)
        ->orderBy('id','DESC')
        ->get();
    }

    public function getViewed(){
      return Content::where('content_type','news')
        ->where('status',1)
        ->with(['upload' => function($echo) {
              $echo->where('status', '=', 1);
          }])
        ->take(10)
        ->orderBy('view','DESC')
        ->get();
    }

    public function getQueryContents($echo){
      // dd($echo);
      $echo = $echo;
      $data = Content::where('content_type','news')
        ->where('status',1)
        ->where(function($echo) {
          $echo->where('name','like','%'.$echo.'%');
        })
        ->with(['upload' => function($echo) {
              $echo->where('status', '=', 1);
          }])
        ->take(10)
        ->orderBy('id','DESC')
        ->get();
      return $data;
    }

    public function getHomeVideos(){
      return Content::where('content_type','news')
        ->where('status',1)
        ->where('youtubevideo','!=','')
        ->with(['upload' => function($echo) {
              $echo->where('status', '=', 1);
          }])
        ->take(5)
        ->orderBy('id','DESC')
        ->get();
    }
}