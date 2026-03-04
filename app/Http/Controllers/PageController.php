<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Upload;
use App\Models\User;
use App\Models\Tag;
use Auth;

class PageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function comments()
    {
        $contents = Content::where('content_type' , 'page' )->with('upload','Tag','Comment')->orderBy('id','desc')->paginate();
        // dd($contents);
        return view('admin.page.index',compact('contents'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = Content::where('content_type' , 'page' )->with('upload')->orderBy('id','desc')->paginate();
        // $contents = Content::where('content_type' , 'page' )->with('upload','Tag','Comment')->orderBy('id','desc')->paginate();
        // dd($contents);
        return view('admin.page.index',compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()    
    {
        $tags = Tag::where('tag_type',4)->where('status',1)->get();
        $tags_category = Tag::where('tag_type',3)->where('status',1)->get();
        // dd($tags_category );
        return view('admin.page.create',compact('tags','tags_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $image = $request->file('file');
        // dd($request);
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $content = new Content;
        $content->content_type = 'page';
        $content->user_id = Auth::user()->id;
        $content->name = $request->name;
        $content->slug = $request->slug;

        $html = $request->details;
        $cleanHtml = preg_replace('/\s*contenteditable\s*=\s*["\']?true["\']?/i', '', $html);
        $cleanHtml = preg_replace('/\s*contenteditable\s*=\s*["\']?false["\']?/i', '', $cleanHtml);
        
        $content->details=  $cleanHtml;

        $content->meta_heading = $request->meta_heading;
        $content->meta_title = $request->meta_title;
        $content->meta_keywords = $request->meta_keywords;
        $content->meta_description = $request->meta_description;
        $content->meta_robots = $request->meta_robots;
        $content->meta_canonical = $request->meta_canonical;
        $content->meta_image = $request->meta_image;
        $content->status = $request->status;    

        if($request->status == 1){$statusCode = 200;}else{$statusCode = 404;}
        //generate a new pagelink
        $result = (new LandingController)->generateLanding('page',$statusCode,$request->slug);
        if($result == 2){ 
            if($content->save()){
                if(!empty($request->file['item'])){
                    Upload::createSingleUpload($request->file,$content->id);
                }
                if(!empty($request->tag)){
                    Tag::saveAssociatedTags($request->tag,$content->id);
                }
                return redirect('admin/page');
            }
            return redirect('admin/page');
        }
        return redirect('admin/page');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tags = Tag::where('tag_type',4)->get();
        $tags_category = Tag::where('tag_type',3)->get();
        $content = Content::with('upload','Tag')->find($id);
        // dd($content);
        return view('admin.page.show',compact('content','tags','tags_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $tgs = Tag::where('tag_type',4)->get();
        // $tags_category = Tag::where('tag_type',3)->get();
        $content = Content::with('upload')->find($id);
        // dd($content);
        return view('admin.page.edit',compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // if(!empty($request->files)){
        //     dd('Requested Dataa:'.$request);
        // }
        // dd($request);
        
        $content= Content::findOrfail($id);
        $content->user_id = Auth::user()->id;
        $content->name = $request->name;
        $content->slug = $request->slug;
        $html = $request->details;
        $cleanHtml = preg_replace('/\s*contenteditable\s*=\s*["\']?true["\']?/i', '', $html);
        $cleanHtml = preg_replace('/\s*contenteditable\s*=\s*["\']?false["\']?/i', '', $cleanHtml);
        $content->details=  $cleanHtml;
        $content->status = $request->status;
        $content->meta_heading = $request->meta_heading;
        $content->meta_title = $request->meta_title;
        $content->meta_keywords = $request->meta_keywords;
        $content->meta_description = $request->meta_description;
        $content->meta_robots = $request->meta_robots;
        $content->meta_canonical = $request->meta_canonical;
        $content->meta_image = $request->meta_image; 
        if($request->status == 1){$statusCode = 200;}else{$statusCode = 404;} 
        if($content->save()){
            if($request->slug != $request->oldslug){
                $result = (new LandingController)->generateLanding('page',$statusCode,$request->slug);
                $result_new = (new LandingController)->addNextLanding('page',301,$request->oldslug,$request->slug);
            }
            else{
                $result = (new LandingController)->updateLanding('page',$statusCode,$request->slug);
            }
            // remove current image if requested
            if(!empty($request->image_remove_id)){
                // Upload::update()
                // $upload = Upload::findOrfail($request->image_remove_id);
                // $upload->content_id = null;
                // $upload->status = 4;
                // $upload->save();
                // return true;
                // Upload::unsetImageFromContent($request->image_remove_id);

                Upload::where('id', '=', $request->image_remove_id)->update(['status' => 4,'content_id' => 0]);
            }

            // upload new image
            if(!empty($request->files)){
                // dd($request->files);
                foreach($request->files as $file){
                    // dd($file[0]);
                    Upload::createSingleUpload($file[0],$content->id);
                }
                
            }
            // remove associated tags
            if(!empty($request->removeTag)){
                // dd($request->removeTag);
                Tag::removeAssociatedTags($request->removeTag,$content->id);
            }
            // save associated tags
            if(!empty($request->tag)){
                Tag::saveAssociatedTags($request->tag,$content->id);
            }

            return redirect('admin/page');
        }
        return redirect('admin/page');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $content= Content::findOrfail($id);
        $content->status = 3;
        $content->update();    
        return redirect()->back();
    }
}
