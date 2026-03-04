<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Landecial;
use App\Models\Landing;

use Auth;

class LandecialController extends Controller
{
        
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $landings = Landing::orderBy('id','desc')->paginate(50);
        return view('admin.landing.index',compact('landings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.landing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'linktype' => 'required',
            'slug' => 'required',
            'statuscode'=>'required'
        ]);

        $landing = new Landing;
        $landing->linktype = $request->linktype;
        $landing->pagelink = $request->slug;
        $landing->nextpagelink = $request->nextpagelink;
        $landing->statuscode = $request->statuscode;
           
        if($landing->save()){
            // save message
            return redirect('admin/landing');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $content = Landecial::where('landing_slug',$id)->first();
        
        if(empty($content)){
            
            $landing = Landing::where('pagelink',$id)->first();

            $landecial = new Landecial;
            $landecial->landing_id = $landing->id;
            $landecial->landing_slug = $landing->pagelink;
            $landecial->contents = "<!-- contents -->";
            $landecial->status = 1;
            
            if($landecial->save()){
                $content = $landecial;
            }
        }
        return view('admin.landecial.show',compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $landing = Landing::where('pagelink',$id)->first();
        
        $landecial = Landecial::where('landing_slug',$id)->first();

        if(empty($landecial)){
            
            $landing = new Landecial;
            $landing->landing_id = $landing->id;
            $landing->landing_slug = $landing->pagelink;
            $landing->contents = "<!-- contents -->";
            $landing->status = 1;
            
            if($landing->save()){
                return redirect('admin/landing');
            }
        }
        return view('admin.landecial.show',compact('landing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'contents'       => 'required|string',
            'status'         => 'required|boolean',
        ]);

        
    
        $content = Landecial::findOrFail($id);
    
        // dd($content);
        $content->contents     = $request->input('contents');
        $content->status       = $request->input('status');
    
        $content->save();
    
        return redirect()
            ->route('landing.index')
            ->with('success', 'Landing content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    //   //  dd('delete');
    //     $landing= landing::findOrfail($id);
    //     $landing->status = 3;
    //     $landing->update();    
    //     return redirect()->back();
    }
}
