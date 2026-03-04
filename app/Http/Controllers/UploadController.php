<?php

namespace App\Http\Controllers;
use App\Models\Upload;
use Illuminate\Http\Request;
use Auth;
use App\Models\Siteoption;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function index()
    {
        $websettings = $this->getWebSettings();
        $uploads = Upload::orderBy('id','desc')->paginate(20);
        return view('admin.upload.index',compact('uploads','websettings'));
    }
    
    public function search(Request $request)
    {
        $searchTerm = $request->name;
        $websettings = $this->getWebSettings();
        $uploads = Upload::where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('file', 'LIKE', "%{$searchTerm}%") 
                    ->orWhere('caption', 'LIKE', "%{$searchTerm}%") 
                    ->orderBy('id','desc')
                    ->paginate(20);
        return view('admin.upload.search',compact('uploads','websettings'));
    }

   /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $image = $request->file('file');
        if(!empty($image))
        {
            Upload::createSingleUpload($image);
        }
        return redirect('admin/upload');
    }

    // this function will be added to helper
    public function getWebSettings(){
        $siteoptions = Siteoption::select('okey','ovalue')->get()->toArray();
        $websettings = [];
        foreach($siteoptions as $key => $value){
            $websettings[$value['okey']] = $value['ovalue'];
        }
        return $websettings;
    }
    
    // this function will be added to helper
    public static function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}