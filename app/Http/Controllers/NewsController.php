<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Upload;
use App\Models\User;
use App\Models\Tag;
use Auth;
use Str;
use Illuminate\Support\Facades\File;


class NewsController extends Controller
{
    public function rundown_remove(string $id)
    {
        // $query = Content::query();
        $tag = Tag::where('slug','top')->first();
        if(!empty($tag)){
            $content= Content::findOrfail($id);
            $content->seq = 0; 
            if($content->save()){
                // remove associated

            }
        }
        
        
        
        return redirect('admin/news/rundown');
    }

    public function updateSeq(Request $request)
    {
        // dd($request);
        foreach ($request->items as $item) {
            \DB::table('contents')
                ->where('id', $item['id'])
                ->update(['seq' => $item['seq']]);
        }
        return redirect('admin/news/rundown');
        // return response()->json(['status' => 'success']);
    }

    public function rundown(Request $request)
    {
        $query = Content::query();
        $contents = $query->with('upload')
            ->where('seq','>',0)
            ->orderBy('seq', 'ASC')
            ->orderBy('id', 'DESC')
            ->get();

        $contenttype = 'news';
        return view('admin.news.rundown',compact('contents','contenttype'));
    }


    /**
     * Display a listing of the resource.
     */
    public function comments()
    {
        $contents = Content::where('content_type' , 'home' )->with('upload','Tag','Comment')->orderBy('id','desc')->paginate();
        // dd($contents);
        return view('admin.news.index',compact('contents'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Content::query();

        // Apply search if provided
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('subtitle', 'LIKE', "%{$search}%")
                ->orWhere('slug', 'LIKE', "%{$search}%")
                ->orWhere('summary', 'LIKE', "%{$search}%")
                ->orWhere('note', 'LIKE', "%{$search}%")
                ->orWhere('details', 'LIKE', "%{$search}%");
            });
        }

        // Optional: filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [
                $request->from . ' 00:00:00',
                $request->to . ' 23:59:59'
            ]);
        } elseif ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        } elseif ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }
        
        $query->where('content_type', 'news');       

        // Paginate results
        $contents = $query->with(['upload','tags'])->orderBy('id', 'DESC')->paginate(10)->appends($request->query());;
        $contenttype = 'news';
        // dd($contenttype);
        // $contents = Content::where('content_type' , 'news' )->with('upload')->orderBy('id','desc')->paginate();
        // $contents = Content::where('content_type' , 'home' )->with('upload','Tag','Comment')->orderBy('id','desc')->paginate();
        // dd($contents);
        return view('admin.news.index',compact('contents','contenttype'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)    
    {
        $contenttype = $request->query('type');
        $tags = Tag::where('tag_type',4)->where('status',1)->get();
        $tags_category = Tag::where('tag_type',3)->where('status',1)->get();
        $tags_special = Tag::where('tag_type',5)->where('status',1)->get();
        $tags_reporter = Tag::where('tag_type',6)->where('status',1)->get();
        $tags_events = Tag::where('tag_type',7)->where('status',1)->get();
        $tags_areas = Tag::where('tag_type',8)->where('status',1)->get();
        // dd($tags_category );
        return view('admin.news.create',compact('tags','tags_areas','tags_category','tags_special','tags_reporter','contenttype','tags_events'));
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
        $content->content_type = 'news';
        $content->user_id = Auth::user()->id;
        $content->name = $request->name;
        $slug = Str::slug($request->slug);
        $content->slug = $slug;
        $content->subtitle = $request->subtitle;
        $content->summary = $request->summary;
        $html = $request->details;
        $cleanHtml = preg_replace('/\s*contenteditable\s*=\s*["\']?true["\']?/i', '', $html);
        $cleanHtml = preg_replace('/\s*contenteditable\s*=\s*["\']?false["\']?/i', '', $cleanHtml);
        $content->details=  $cleanHtml;
        $content->youtubevideo = $request->youtubevideo;
        $content->meta_heading = $request->meta_heading;
        $content->meta_title = $request->meta_title;
        $content->meta_keywords = $request->meta_keywords;
        $content->meta_description = $request->meta_description;
        $content->meta_robots = $request->meta_robots;
        $content->meta_canonical = $request->meta_canonical;
        $content->meta_image = $request->meta_image;
        $content->seq = $request->seq;    
        $content->seqc = $request->seqc;    
        $content->status = $request->status;    
        // dd($request);
        if($request->status == 1){$statusCode = 200;}else{$statusCode = 404;}
        //generate a new pagelink
        $result = (new LandingController)->generateLanding('news',$statusCode,$slug);
        if($result == 2){ 
            if($content->save()){
                // upload new image
                if(!empty($request->files)){
                    $i = 0;
                    foreach($request->files as $gfile){
                        foreach($gfile as $key => $value ){
                            Upload::createSingleUpload($request['gfx'][$i],$content->id);
                            $i++;
                        }
                    }
                }
                if(!empty($request->tag)){
                    Tag::saveAssociatedTags($request->tag,$content->id);
                }
                return redirect('admin/news');
            }
            return redirect('admin/news');
        }
        return redirect('admin/news');
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
        return view('admin.news.show',compact('content','tags','tags_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $tgs = Tag::where('tag_type',4)->get();
        $tags_category = Tag::where('tag_type',3)->where('status',1)->get();
        $tags_special = Tag::where('tag_type',5)->where('status',1)->get();
        $tags_reporter = Tag::where('tag_type',6)->where('status',1)->orderBy('title')->get();
        $tags_events = Tag::where('tag_type',7)->where('status',1)->get();
        
        $tags_areas = Tag::where('tag_type',8)->where('status',1)->get();

        $content = Content::with(['upload','tags'])->find($id);
        $contenttype = $content['content_type'];
        return view('admin.news.edit',compact('content','tags_areas','tags_category','tags_special','tags_reporter','contenttype','tags_events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $content_id = '';
        // dd($request);
        $content= Content::findOrfail($id);
        $content->user_id = Auth::user()->id;
        // $content->contenttype = $request->contenttype;
        $content->name = $request->name;
        $slug = Str::slug($request->slug);
        $content->slug = $slug;
        $content->subtitle = $request->subtitle;
        $content->summary = $request->summary;
        $html = $request->details;
        $cleanHtml = preg_replace('/\s*contenteditable\s*=\s*["\']?true["\']?/i', '', $html);
        $cleanHtml = preg_replace('/\s*contenteditable\s*=\s*["\']?false["\']?/i', '', $cleanHtml);
        $content->details=  $cleanHtml;
        $content->seq = $request->seq;
        $content->seqc = $request->seqc;
        $content->youtubevideo = $request->youtubevideo;
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
            if($slug != $request->oldslug){
                $result = (new LandingController)->generateLanding('news',$statusCode,$slug);
                $result_new = (new LandingController)->addNextLanding('news',301,$request->oldslug,$slug);
            }
            else{
                $result = (new LandingController)->updateLanding('news',$statusCode,$slug);
            }

            if(!empty($request->image_remove_id)){
                
                // remove images and records from upload table
                
                $uploads = Upload::whereIn('id', $request->image_remove_id)->get();

                $folders = ['large', 'medium', 'small', 'thumb'];

                foreach ($uploads as $upload) {
                    foreach ($folders as $folder) {
                        $path = public_path("images/uploads/{$folder}/{$upload->file}");

                        if (File::exists($path)) {
                            File::delete($path);
                        }
                    }
                }
                Upload::whereIn('id', $request->image_remove_id)->delete();

            }

            // upload new image
            if(!empty($request->files)){
                $i = 0;
                foreach($request->files as $gfile){
                    foreach($gfile as $key => $value ){
                        Upload::createSingleUpload($request['gfx'][$i],$content->id);
                        $i++;
                    }
                }
            }

            // new tag remover
            if(!empty($request->old_tags)){
                $remove_tags = array_diff($request->old_tags, $request->tag);
            }
            // remove associated tags
            if(!empty($remove_tags)){
                // dd($request->removeTag);
                Tag::removeAssociatedTags($remove_tags,$content->id);
            }
            // save associated tags
            if(!empty($request->tag)){
                Tag::saveAssociatedTags($request->tag,$content->id);
            }

            return redirect('admin/news');
        }
        return redirect('admin/news');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $content= Content::with('upload')->findOrfail($id);
        if($content->status == 4){
            // $content->status = 1;
            // process final delete
            // $content->tags()->detach();
            if(!empty($content->upload) && sizeof($content->upload) > 0){
                // dd($content);
                foreach ($content->upload as $upload) {
                    $path = 'images/uploads/thumb/' . $upload->file;
                    $size_name = ['thumb','small','medium','large'];
                    foreach ($size_name as $size) {
                        $path = 'images/uploads/' . $size . '/' . $upload->file;
                        if (file_exists(public_path($path))) {
                            unlink(public_path($path));
                        }
                    }
                    
                }
            }

            // 2. Delete related uploads rows
            $content->upload()->delete();
            $content->delete();
        }else{
            $content->status = 4;
        }
        $content->update();    
        return redirect()->back();
    }
}
