<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;
use Auth;

class TagController extends Controller
{

    public function findByTitle($search){
        $tags = Tag::select('title','id')->where('tag_type',4)->where('title', 'like', "%{$search}%")->get();
        return response()->json($tags);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tags = Tag::whereNull('parent_id')
        //     ->with('children')
        //     ->get();

        // $tags = Tag::whereNull('parent')
        //     ->with('children')
        //     ->whereIn('tag_type', array(1, 2, 3, 4))
        //     ->orderBy('sequence','ASC')
        //     ->orderBy('id','DESC')
        //     ->paginate(20);

        $tags = Tag::whereNull('parent')
            ->with('children')
            ->get();
        // dd($tags);
        return view('admin.tag.index',compact('tags'));
    }

    public function create(Request $request)
    {
        $tagtype = $request->query('type');
        //dd($tagtype);

        $tags = Tag::where('tag_type',$tagtype)->get()->toArray();
        // dd($tags);
        return view('admin.tag.create',compact('tags','tagtype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $tag = new Tag;
         $landing_type = 'tag';
        // $tag->tag_type = 'menu';
        $tag->user_id = Auth::user()->id;
        if(!empty($request->parent)){
            $tag->parent = $request->parent;
        }else{
            $tag->parent = 0;
        }
        
        $tag->title = $request->title;
        $tag->slug = $request->slug;
        $tag->tag_type = $request->tag_type;
        $tag->linkto = $request->linkto;
        $tag->linkUrl = $request->linkUrl;
        $tag->background = $request->background;
        $tag->color = $request->color;
        $tag->sequencelead = $request->sequencelead;
        
        if(!empty($request->sequence)){
            $tag->sequence = $request->sequence;
        }else{
            $tag->sequence = NULL; 
        }
        
        $tag->status = $request->status;
        if($request->tag_type == 8){
            $landing_type = 'area';
        }
        if($request->tag_type == 6){
            $landing_type = 'reporter';
        }
        $result = (new LandingController)->generateLanding($landing_type,200,$tag->slug);
        if($result == 2){
            $tag->save();
            return redirect('admin/tag/'.$request->tag_type);
        }
        

        return redirect('admin/tag/'.$request->tag_type);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag = Tag::findOrfail($id);
        $tags = Tag::where('tag_type',$tag['tag_type'])->get()->toArray();
        return view('admin.tag.edit',compact('tag','tags'));
    }

    public function update(Request $request, $id)
    {
        
        $tag = Tag::findOrfail($id);
        $tag->title = $request->title;
        $tag->slug = $request->slug ?? $tag->slug;
        // $tag->tag_type = $request->tag_type;
        $tag->linkto = $request->linkto;
        $tag->linkUrl = $request->linkUrl;
        if(!empty($request->parent)){
            $tag->parent = $request->parent;
        }else{
            $tag->parent = 0;
        }
        if(!empty($request->sequence)){
            $tag->sequence = $request->sequence;
        }else{
            $tag->sequence = 100; 
        }
        $tag->background = $request->background;
        $tag->color = $request->color;
        $tag->sequencelead = $request->sequencelead;
        $tag->status = $request->status;
        // dd($request);
        if($request->slug != $request->oldslug){
            //slug has been changed
            //step1-generate new pagelink
            if($request->status == 1){$statusCode = 200;}else{$statusCode = 404;}
            $result = (new LandingController)->generateLanding('tag',$statusCode,$request->slug);
            //step2-add a redirection to new slug
            $result_new = (new LandingController)->addNextLanding('tag',301,$request->oldslug,$request->slug);
            // $tag->save();
        }
        $tag->save();
        // dd($request);
        return redirect('admin/tag/'.$request->tag_type);
    }

    public function show($tagtype)
    {
        // $tags = Tag::whereIn('tag_type', array(1, 2, 3,4))->orderBy('sequence','ASC')->orderBy('id','DESC')->paginate(20);
        if($tagtype == 8){
            $tags = Tag::where('tag_type', $tagtype)->orderBy('sequence','ASC')->orderBy('id','DESC')->paginate(500);
        }else{
            $tags = Tag::where('tag_type', $tagtype)->orderBy('sequence','ASC')->orderBy('id','DESC')->paginate(20);
        }
        
        return view('admin.tag.index',compact('tags','tagtype'));
    }

    public function rundown(){
        $tags = Tag::where('slug','top')->orderBy('sequence','ASC')->orderBy('id','DESC')->paginate(20);
        return view('admin.tag.rundown',compact('tags'));
    }
}
