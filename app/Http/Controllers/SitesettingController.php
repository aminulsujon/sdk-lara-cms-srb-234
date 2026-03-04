<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sitesetting;

class SitesettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sitesettings = Sitesetting::get();
        return view('admin.sitesetting',compact('sitesettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        $siteoption = new Siteoption;
        $siteoption->okey = $request->okey;
        $siteoption->ovalue = $request->ovalue;
        $siteoption->save();
        return redirect('admin/siteoption');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $siteoption = Siteoption::findOrfail($id);
        $siteoption->ovalue = $request->ovalue;
        $siteoption->update();
        return redirect('admin/siteoption');
    }
}
