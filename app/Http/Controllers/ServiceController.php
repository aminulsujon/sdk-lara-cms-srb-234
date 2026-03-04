<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Upload;
use Auth; 

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = Content::where('content_type' , 'service' )->where('status','!=',5)->with('upload')->get();
        // dd($contents);
        return view('admin.service.index',compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //    dd($request->all());
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $content = new Content;
        $content->content_type = 'service';
        $content->user_id = Auth::user()->id;
        $content->name = $request->name;
        $content->slug = $request->slug;
        $html = $request->details;
        $cleanHtml = preg_replace('/\s*contenteditable\s*=\s*["\']?true["\']?/i', '', $html);
        $cleanHtml = preg_replace('/\s*contenteditable\s*=\s*["\']?false["\']?/i', '', $cleanHtml);
        $content->details=  $cleanHtml;
        $content->summary =  $request->summary;
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
        $result = (new LandingController)->generateLanding('service',$statusCode,$request->slug);
        if($result == 2){ 
            if($content->save()){
                if(!empty($request->file['item'])){
                    Upload::createSingleUpload($request->file,$content->id);
                }
                if(!empty($request->tag)){
                    Tag::saveAssociatedTags($request->tag,$content->id);
                }
                return redirect('admin/service');
            }
            return redirect('admin/service');
        }
        return redirect('admin/service');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $content= Content::where('id',$id)->with('upload')->first();
      //  dd($content);
        return view('admin.service.edit',compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    //    dd($request->all());
        $content= Content::findOrfail($id);
        $content->content_type = 'service';
        $content->user_id = Auth::user()->id;
        $content->name = $request->name;
        $content->slug = $request->slug;
        $content->summary = $request->summary;
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
        // $image = $request->photo;      
        // Upload::createSingleUpload($image,$content->id);
        
        // generate a new pagelink
        // $result = (new LandingController)->generateLanding('page',200,$content->slug);

        if($content->save()){  
            if($request->slug != $request->oldslug){
                $result = (new LandingController)->generateLanding('service',$statusCode,$request->slug);
                $result_new = (new LandingController)->addNextLanding('service',301,$request->oldslug,$request->slug);
            }
            else{
                $result = (new LandingController)->updateLanding('service',$statusCode,$request->slug);
            }
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
        }
       
       return redirect('admin/service');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $content= Content::findOrfail($id);
        $content->status = 5;
        $content->update();    
        return redirect()->back();
    }
}
