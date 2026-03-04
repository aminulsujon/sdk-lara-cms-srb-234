<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Landing;

use Auth;

class LandingController extends Controller
{
    public function getEditPagelinkId($pageLink){
        $result = Landing::where('pageLink', $pageLink)->first();
        return $result->id;
    }
    /**
     * Check is is the slug exitst on landing 
     */
    public function checkExistsPagelink($pageLink){
        $result = Landing::where('pageLink', $pageLink)->first();
        if (!empty($result->id)) {
            return $result->id;
        }else{
            return 0;
        }
    }

    public function addNextLanding($landingType,$statusCode,$pageLink,$nextpageLink = null){
       // dd($pageLink);
        $result = Landing::where('pageLink', $pageLink)->first();
        //dd($result);
        $result->nextpagelink =  $nextpageLink;
        $result->statuscode = $statusCode;
        $result->update();
        return true;
    }

    public function updateLanding($landingType,$statusCode,$pageLink){
       // dd($pageLink);
        $result = Landing::where('pageLink', $pageLink)->first();
     //   dd($result);
        $result->statuscode = $statusCode;
        $result->update();
        return true;
    }

    

    /**
     * Custom function to generate a new landing page
     * return 1:exists 2:saved 3:false
     */
    public function generateLanding($landingType,$statusCode,$pageLink,$nextpageLink = null){
        // dd($landingType,$statusCode,$pageLink,$nextpageLink);
        if (Landing::where('pageLink', $pageLink)->exists()) {
            return 1;
        }
        $data = new Landing;
        $data->linktype = $landingType;$data->pagelink = $pageLink;$data->nextpagelink = $nextpageLink;$data->statuscode = $statusCode;
        if($data->save()){
            return 2;
        }
        return 3;
    }
    
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
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $landing = landing::findOrfail($id);
        return view('admin.landing.edit',compact('landing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

      //  dd($request->all());
        // $landing= landing::findOrfail($id);
        // $landing->user_id = Auth::user()->id;
        // $landing->name = $request->name;
        // $landing->slug = $request->slug;
        // $landing->status = $request->status;    
           
        // if($landing->update()){
        //     $upload = Upload::where('landing_id',$landing->id)->first();
        //    // dd($upload);
        //     $upload->user_id= $landing->user_id;
        //     $upload->name=  $request->upload_name;
        //     $upload->url=  $request->url;
        //     $upload->status= $landing->status;
        //     $upload->update();
        //     return redirect('admin/slider');
        // }
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
