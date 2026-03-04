<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Get districts by division
     */
    public function getDistricts($divisionId)
    {
        try {
            $districts = Tag::where('tag_type', 8)
                ->where('parent', $divisionId)
                ->orderBy('title')
                ->get(['id', 'title', 'slug']);
                
            return response()->json($districts);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
    
    /**
     * Get upazilas by district
     */
    public function getUpazilas($districtId)
    {
        try {
            $upazilas = Tag::where('tag_type', 8)
                ->where('parent', $districtId)
                ->orderBy('title')
                ->get(['id', 'title', 'slug']);
                
            return response()->json($upazilas);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
    
    /**
     * Handle search form submission
     */
    public function _search(Request $request)
    {
        $request->validate([
            'division' => 'required|exists:tags,id',
            'district' => 'required|exists:tags,id',
            'upazila' => 'required|exists:tags,id',
        ]);
        
        // Get the selected area names
        $upazila = Tag::find($request->upazila);
        $district = Tag::find($request->district);
        $division = Tag::find($request->division);
        
        // Your search logic here...
        // Example: redirect to search results page
        return redirect()->route('search.area', [
            'division' => $division->slug,
            'district' => $district->slug,
            'upazila' => $upazila->slug,
        ]);
    }
}