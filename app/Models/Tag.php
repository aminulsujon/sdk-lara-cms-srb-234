<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ContentTag;

class Tag extends Model
{
    use HasFactory;
    
    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }
    public function parent()
    {
        return $this->belongsTo(Tag::class, 'parent');
    }

    public function childrens()
    {
        return $this->hasMany(Tag::class, 'parent');
    }

    public function getHierarchyAttribute()
    {
        $levels = [];
        $current = $this;

        while ($current) {
            $levels[] = $current->title;
            $current = $current->parent;
        }

        return implode(' > ', array_reverse($levels));
    }


    // public function grandchildren()
    // {
    //     return $this->children()->with('grandchildren');
    // }

    
    public function getBreaking($take = 15){
        return Tag::where('slug','breaking')
        ->where('status',1)
        ->with(['Contents'=>function($q){
            $q->with([
                'upload' => function($q) {
                    $q->where('status', '=', 1);
                }
            ]);
            $q->where('status', '=', 1);
            $q->limit($take);
            $q->orderBy('id','DESC');
        }])
        ->first();
    }
    
    public function getTops($slug ='top',$take = 11){
        
        $tag = Tag::where('slug',$slug)
        ->select('id','title','slug','tag_type')
        ->where('status',1)
        ->with([
            'Contents'=>function($q) use($take){
                $q->select('id','subtitle','name','slug','summary','seq');
                $q->with([
                    'upload' => function($q) {
                        $q->where('status', '=', 1);
                    }
                ]);
                $q->where('seq','>',0);
                $q->where('status',1);
                $q->limit($take);
                 $q->orderBy('seq','ASC');
                $q->orderBy('id','DESC');
            }
        ])
        ->first();
        // dd( $tag);
        return $tag;
    }

    public function getEvents(){
        return Tag::where('tag_type',7)
        ->where('status',1)
        ->with([
            'Contents'=>function($q){
                $q->with([
                    'upload' => function($q) {
                        $q->where('status', '=', 1);
                    }
                ]);
                $q->where('status',1);
                $q->take(11);
                $q->orderBy('id','DESC');
            }
        ])
        ->first();
    }

    public function getTrending(){
        return Tag::where('slug','trending')
        ->where('status',1)
        ->with(['Contents'=>function($q){
            $q->with([
                'upload' => function($q) {
                    $q->where('status', '=', 1);
                }
            ]);
            $q->where('status',1);
            $q->take(4);
            $q->orderBy('id','DESC');
        }])
        ->first();
    }

    public function getContents($slug, $limit = 10, $page = 1)
    {
        $offset = ($page - 1) * $limit;

        return Tag::where('slug', $slug)
            ->where('status', 1)
            ->with([
                'childrens',
                'Contents' => function ($q) use ($limit, $offset) {
                    $q->where('status', 1)
                    ->with([
                        'upload' => function ($q) {
                            $q->where('status', 1);
                            $q->limit(1);
                        }
                    ])
                    ->orderBy('id', 'DESC')
                    ->skip($offset)   // OFFSET
                    ->take($limit);   // LIMIT
                }
            ])
            ->first();
    }

    
    public function getCats(){
        return Tag::where('tag_type',3)
        ->where('sequencelead','>', 0)
        ->where('status',1)
        ->with(['Contents'=>function($q){
            $q->with([
                'upload' => function($q) {
                    $q->where('status', '=', 1);
                }
            ]);
            $q->where('status',1);
            $q->where('seqc','>',0);
            $q->limit(12);
            $q->orderBy('id','DESC');
        }])
        ->take(20)
        ->orderBy('sequencelead','ASC')
        ->orderBy('id','DESC')
        ->get();
    }

    public static function saveAssociatedTags($tags,$content_id = null){
        foreach($tags as $tag){
            // check existing tag
            $content_tag = ContentTag::where('content_id',$content_id)->where('tag_id',$tag)->get()->first();
            // save new content tag
            if(empty($content_tag->content_id)){
                $contentTag = new ContentTag();
                $contentTag->content_id = $content_id;
                $contentTag->tag_id = $tag;
                $contentTag->save();
            }
        }
        return true;
    }
    public static function removeAssociatedTags($tags,$content_id){
        // dd($tags,$content_id);
        foreach($tags as $tag){
            // dd($tag);
            // check existing tag
            $content_tag = ContentTag::where('content_id',$content_id)->where('tag_id',$tag)->get()->first();
            // dd($content_tag);
            // remove content tag
            if(!empty($content_tag->content_id)){
                ContentTag::where('content_id',$content_id)->where('tag_id',$tag)->delete();
            }
        }
        return true;
    }

    public function getDivisionList(){
       return Tag::select('id', 'title')
        ->where('tag_type', 8)
        ->where('status', 1)
        ->where(function ($q) {
            $q->whereNull('parent')
            ->orWhere('parent', '')
            ->orWhere('parent', 0);
        })
        ->orderBy('id', 'ASC')
        ->get();


    }
    
}
