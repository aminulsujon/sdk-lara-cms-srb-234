<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Landing;
use App\Models\Upload;
use App\Models\Event;

use DB;

class SitemapController extends Controller
{
    public function index(Request $r)
    {
       	$website = '';      
     	$contents = Landing::orderBy('id','desc')
		 ->where('statuscode',200)
		 ->where('pagelink','!=','sitemap.xml')
			->get();
      	return response()->view('sitemap',[
          	'contents' => $contents
      	])->header('Content-Type', 'text/xml');
    }

	public function imagesitemap(Request $r)
    {      
		$website = '';      
		$images = Upload::orderBy('id','desc')->where('status',1)->get();
      	return response()->view('imageSitemap', [
          	'images' => $images,
      	])->header('Content-Type', 'text/xml');
    }

    public function robots()
    {
        return response(view('robots'))->header('Content-Type', 'text/plain');
    }    
}
