<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Welcome;
use App\Models\Content;
use App\Models\Siteoption;
use App\Models\Landing;
use App\Models\Pagesetting;
use App\Models\Employee;
use App\Models\Event;
use App\Models\Member;
use App\Models\Tag;
use App\Models\Landecial;
use App\Models\ContentTag;
use App\Models\ContentEmployee;
use Illuminate\Support\Facades\Artisan;
use DateTime;


class HomeController extends Controller
{

    public function landing($pagelink = null){

        // dd($pagelink);
        $requested = request()->all();
        $websettings = $tags = $breaking = $weeks = $viewed = $latest = $footermenu = $tops = $cats = $features = $services = '';
        // get website global settings
        $websettings = $this->getWebSettings();
        $tags = $this->getWebMenus();
        
        $footermenu = $this->getfooterMenus();
        
        $tagModel = new Tag;

        $contentModel = new Content;
        
        $latest = $contentModel->getLatest();

        $trending = $tagModel->getTrending();

        $spotlight = $tagModel->getTops('spotlight',3);
       
        $pagesetting = $this->getPageSetting($pagelink);
        // home page
        if(empty($pagelink)){
            // dd('here');
            $pagesetting = $this->getPageSetting('index');
            $leadcats = $tagModel->getCats();
            $home_events = $tagModel->getEvents('events');
            $tops = $tagModel->getTops('top',14);
            $weeks = $tagModel->getTops('top-of-week');
            $home_videos = $contentModel->getHomeVideos();
            $home_photos = $tagModel->getTops('photos',5);
            // dd($home_photos);
            $divisions = $tagModel->getDivisionList();
            // dd($divisions);
            return view($websettings['cms_layout'].'.index',
                compact('spotlight','divisions','footermenu','websettings','trending','trending','pagesetting','breaking','tags','tops','weeks','leadcats','latest','viewed','features','home_videos','home_events','home_photos','services')
            );
        }

        // if the link is a date archive
        if($this->isValidDate($pagelink)){
            $created = date('Y-m-d', strtotime($pagelink));
            $contents = Content::where('content_type' , 'news')
                ->where('status', 1)
                ->whereDate('created_at', $created)
                ->with('upload')
                ->orderBy('id','desc')
                ->paginate(20);
            $dated = $pagelink;
            return view($websettings['cms_layout'].'.archive',compact('contents','websettings','trending','pagesetting','breaking','tags','footermenu','latest','viewed','dated'));
        }

        $landing = Landing::where('pagelink',$pagelink)->first();

        // if there is landing, the page exists or created
        if(!empty($landing)){
            
            // if the link has been redirected, redirect the new link
            if(!empty($landing->nextpagelink)){
                // landing page has a redirect or next page link, then redirect to new landing
                return redirect()->action([HomeController::class, 'landing'],$landing->nextpagelink);
            }elseif($landing->statuscode == 200){
                // the page should have a valid response
                // check the link type and set data source
                switch($landing->linktype){
                    case ('area'):
                        $tag = $tagModel->getContents($pagelink,30,1);
                        return view($websettings['cms_layout'].'.area',compact('spotlight','websettings','trending','pagesetting','breaking','tags','tag','footermenu','latest','viewed','services'));
                        break;
                    case ('reporter'):
                        $tag = $tagModel->getContents($pagelink,20,1);
                        return view($websettings['cms_layout'].'.area',compact('spotlight','websettings','trending','pagesetting','breaking','tags','tag','footermenu','latest','viewed','services'));
                        break;
                    case ('tag'):
                        // dd('Tag page coming soon');
                        // $tagModel = new \App\Models\Tag();
                        $tag = $tagModel->getContents($pagelink, 20, 1);
                        $pagesetting = $this->getPageSetting($pagelink);
                        
                        if($pagelink == 'archive'){
                            // Get day, month, year from URL query, fallback to today
                            $day   = request()->query('day', date('d'));
                            $month = request()->query('month', date('m'));
                            $year  = request()->query('year', date('Y'));

                            // Build the date string in Y-m-d format
                            $created = "$year-$month-$day";

                            // Fetch contents for that specific date
                            $contents = Content::where('content_type', 'news')
                                ->where('status', 1)
                                ->whereDate('created_at', $created)
                                ->with('upload')
                                ->orderBy('id', 'desc')
                                ->paginate(20);

                            // Format date for display (optional)
                            $dated = date('d-m-Y', strtotime($created));

                            return view($websettings['cms_layout'].'.archive', compact(
                                'contents', 'websettings', 'trending', 'pagesetting', 
                                'breaking', 'tags', 'tag', 'footermenu', 'latest', 'viewed', 'dated'
                            ));
                        } else {
                            return view($websettings['cms_layout'].'.category', compact(
                                'spotlight','websettings','trending','pagesetting',
                                'breaking','tags','tag','footermenu','latest','viewed','services'
                            ));
                        }
                        break;
                    case ('content'):
                        // play your content logic here
                        $content = Content::where('slug',$pagelink)
                            ->with(['Tags'=>function($q){
                                $q->with([
                                    'Contents' => function($q) {
                                        $q->where('status', '=', 1);
                                    }
                                ]);
                                $q->where('status',1);
                                $q->orderBy('id','ASC');
                            }])
                            ->where('status',1)->first();
                        // dd($content);
                        return view($websettings['cms_layout'].'.content',compact('spotlight','content','websettings','trending','tags','footermenu'));
                        break;
                    case ('page'):
                        $content = Content::where('slug',$pagelink)->where('status',1)->first();
                        return view($websettings['cms_layout'].'.pageDetails',compact('spotlight','content','websettings','trending','tags','footermenu','tags','breaking','latest','viewed','services'));
                        break;
                    
                    case ('news'):
                        $content = Content::where('slug',$pagelink)
                            ->with(['Tags'=>function($q){
                                $q->with([
                                    'Contents' => function($qc) {
                                        $qc->with([
                                            'upload' => function($q) {
                                                $q->where('status', '=', 1);
                                                $q->first();
                                            }
                                        ]);
                                        $qc->where('status', '=', 1);
                                        $qc->orderBy('id', 'DESC');
                                    }
                                ]);
                                $q->where('status',1);
                                $q->orderBy('id','ASC');
                            }])
                            ->where('status',1)->first();
                        
                        if(empty($content)){
                            return back()->with('success', 'Page not found!');
                        }
                        $content['view'] += 1;
                        $content->update();
                        $contents = '';
                        $contents = Content::where('content_type','news')->where('status',1)->with('upload')->orderBy('id','DESC')->whereNotIn('id', [$content->id])->take(4)->get();
                        return view($websettings['cms_layout'].'.details',compact('spotlight','contents','content','websettings','trending','tags','breaking','footermenu','latest','viewed','services'));
                        break;
           
                    case ('landing'):
                        
                        $pagesetting = $this->getPageSetting($pagelink);
                        if($pagelink =='latest'){
                            $contents = $contentModel->getLatest('news');
                            $contents = Content::where('content_type' , 'news')
                                ->where('status', 1)
                                ->with('upload')
                                ->orderBy('id','desc')
                                ->paginate(20);
                            return view($websettings['cms_layout'].'.latest',compact('spotlight','contents','websettings','trending','pagesetting','tags','breaking','footermenu','latest','viewed','services'));
                        }elseif($pagelink =='contact'){
                            $contents = Content::where('content_type' , 'news')->where('status', 1)->with('upload')->orderBy('id','desc')->paginate(12);
                            return view($websettings['cms_layout'].'.contact',compact('spotlight','contents','websettings','trending','pagesetting','tags','breaking','footermenu','latest','viewed','services'));
                        }elseif($pagelink =='news'){
                            $contents = Content::where('content_type' , 'news')->where('status', 1)->with('upload')->orderBy('id','desc')->paginate(12);
                            return view($websettings['cms_layout'].'.allNews',compact('spotlight','contents','websettings','trending','pagesetting','tags','breaking','footermenu','latest','viewed','services'));
                        }elseif($pagelink =='blogs'){
                            $contents = Content::where('content_type' , 'blog')->where('status', 1)->with('upload')->orderBy('id','desc')->paginate(12);
                            return view($websettings['cms_layout'].'.blogs',compact('spotlight','contents','websettings','trending','pagesetting','tags','breaking','footermenu','latest','viewed','services'));
                        }elseif($pagelink =='about'){
                            $contents = Content::where('content_type' , 'about')->where('status', 1)->with('upload')->orderBy('id','desc')->paginate(12);
                            return view($websettings['cms_layout'].'.about',compact('spotlight','contents','websettings','trending','pagesetting','tags','breaking','footermenu','latest','viewed','services'));
                        }elseif($pagelink =='search'){
                            $contents = '';
                            // dd($echo);
                            if(!empty($requested['query'])){
                                $echo = $requested['query'];
                                
                                // find contents
                                $contents = Content::where('content_type','news')
                                    ->where('status',1)
                                    ->where(function ($query) use ($echo) {
                                        $query->where('name','LIKE',"%{$echo}%")
                                              ->orWhere('description','LIKE',"%{$echo}%");
                                    })
                                    ->with(['upload' => function($echo) {
                                        $echo->where('status', '=', 1);
                                    }])
                                    ->take(30)
                                    ->orderBy('id','DESC')
                                    ->get();
                            }
                            return view($websettings['cms_layout'].'.search',compact('spotlight','websettings','trending','tags','breaking','pagesetting','footermenu','latest','viewed','contents'));
                        }
                        elseif($pagelink =='contact'){
                            return view($websettings['cms_layout'].'.contact',compact('spotlight','websettings','trending','tags','breaking','pagesetting','footermenu','latest','viewed','services'));
                        }
                        elseif($pagelink =='sitemap.xml'){
                            $contents = Landing::where('statuscode',200)
                                ->orderBy('id','desc')
                                ->get();
                            // return view('sitemap',compact('spotlight','websettings','trending','tags','breaking','pagesetting','footermenu','latest','contents'));
                            return response()->view('sitemap',[
                                'websettings','trending' => $websettings,
                                'contents' => $contents
                            ])->header('Content-Type', 'text/xml');
                        }
                        elseif($pagelink =='robots.txt'){
                            dd('dynamic robots');
                            $contents = Landing::where('statuscode',200)
                                ->orderBy('id','desc')
                                ->get();
                            // return view('sitemap',compact('spotlight','websettings','trending','tags','breaking','pagesetting','footermenu','latest','contents'));
                            return response()->view('robots',[
                                'websettings','trending' => $websettings,
                                'contents' => $contents
                            ])->header('Content-Type', 'text/txt');
                        }
                        elseif($pagelink =='creatives'){
                            return view($websettings['cms_layout'].'.creatives',compact('spotlight','websettings','trending','pagesetting','tags','breaking','footermenu','latest','viewed','services'));
                        }
                        break;
                    case ('landecial'):
                        $content = Landecial::where('landing_slug',$pagelink)->where('status',1)->first();
                        return view($websettings['cms_layout'].'.layouts.landecial',compact('spotlight','content','websettings','trending','tags','footermenu'));
                        break;
                    
                    default:
                    // play your default logic here
                }
            }
        }else{
            // requested pagelink not found on landing page collection
            // return redirect('/four-zero-four');
        }
    }

    public function categoryContents(Request $request)
    {
        // return $request;
        $slug = $request->input('pagelink');
        $perPage = 10;
        $contents = Content::where('status', 1)
            ->whereHas('tags', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })
            ->orderByDesc('id')
            ->paginate($perPage);
        return view('news.blocks.loadCategoryContents', compact('contents'))->render();
    }

    public function isValidDate($date)
    {
        $d = DateTime::createFromFormat('d-m-Y', $date);
        return $d && $d->format('d-m-Y') === $date;
    }

    public function search(Request $request)
    {
        // dd($request);
        $websettings = $this->getWebSettings();
        $tags = $this->getWebMenus();
        $pagesetting = $this->getPageSetting('search');
        $query = $request->input('q');
        $category = $request->input('category');
        $from = $request->input('from');
        $to = $request->input('to');

        // Example search logic
        $contents = Content::where('name', 'LIKE', "%{$query}%")
            ->where('status',1)
            ->with('upload')
            ->orderBy('id','DESC')
            ->paginate(20)->withQueryString();
        // dd($contents);
        return view('news.search', compact('contents','tags','pagesetting','query', 'category', 'from', 'to','websettings'));
    }

    public function areas(Request $request)
    {
        // dd($request);
        $websettings = $this->getWebSettings();
        $tags = $this->getWebMenus();
        $pagesetting = $this->getPageSetting('areas');
        // $query = $request->input('q');
        // $category = $request->input('category');
        // $from = $request->input('from');
        // $to = $request->input('to');
        $newIds = [
            $request['division'],
            $request['district'],
            $request['upazila'],
        ];
        $taga = Tag::whereIn('id', $newIds)
            ->where('status', 1)
            ->with([
                'Contents' => function ($query) {
                    $query->where('status', 1)
                        ->orderBy('id', 'DESC')
                        ->limit(8)
                        ->with([
                            'upload' => function ($q) {
                                $q->where('status', 1);
                            }
                        ]);
                }
            ])
            ->orderBy('sequencelead', 'ASC')
            ->orderBy('id', 'DESC')
            ->take(16)
            ->get();

        // dd($taga);
        $tagModel = new Tag;
        $divisions = $tagModel->getDivisionList();
        // Example search logic
        // $contents = Content::where('name', 'LIKE', "%{$query}%")
        //     ->where('status',1)
        //     ->with('upload')
        //     ->orderBy('id','DESC')
        //     ->paginate(20)->withQueryString();
        // dd($contents);
        return view('news.area', compact('tags','taga','pagesetting','websettings','divisions'));
    }
    public function areasIndex(Request $request)
    {
        // dump($request);
        $websettings = $this->getWebSettings();
        $tags = $this->getWebMenus();
        $pagesetting = $this->getPageSetting('areas');
        // $query = $request->input('q');
        // $category = $request->input('category');
        // $from = $request->input('from');
        // $to = $request->input('to');
        $taga = Tag::whereIn('id', [120,141,283])
            ->where('status', 1)
            ->with([
                'Contents' => function ($query) {
                    $query->where('status', 1)
                        ->orderBy('id', 'DESC')
                        ->limit(8)
                        ->with([
                            'upload' => function ($q) {
                                $q->where('status', 1);
                            }
                        ]);
                }
            ])
            ->orderBy('sequencelead', 'ASC')
            ->orderBy('id', 'DESC')
            ->take(16)
            ->get();

        // dd($taga);
        $tagModel = new Tag;
        $divisions = $tagModel->getDivisionList();
        // Example search logic
        // $contents = Content::where('name', 'LIKE', "%{$query}%")
        //     ->where('status',1)
        //     ->with('upload')
        //     ->orderBy('id','DESC')
        //     ->paginate(20)->withQueryString();
        // dd($contents);
        return view('news.area', compact('tags','taga','pagesetting','websettings','divisions'));
    }

    // Get divisions (parent_id = null)
    public function getDivisions()
    {
        $divisions = Tag::where('tag_type', 8)
            ->whereNull('parent_id')
            ->orderBy('title')
            ->get(['id', 'title', 'slug']);
            
        return response()->json($divisions);
    }
    
    // Get districts by division
    public function getDistricts($divisionId)
    {
        $districts = Tag::where('tag_type', 8)
            ->where('parent_id', $divisionId)
            ->orderBy('title')
            ->get(['id', 'title', 'slug']);
            
        return response()->json($districts);
    }
    
    // Get upazilas by district
    public function getUpazilas($districtId)
    {
        $upazilas = Tag::where('tag_type', 8)
            ->where('parent_id', $districtId)
            ->orderBy('title')
            ->get(['id', 'title', 'slug']);
            
        return response()->json($upazilas);
    }

    public function getPageSetting($pageSlug = null){
        $pagesetting = Pagesetting::where('meta_slug',$pageSlug)->first();
        return $pagesetting;
    }
    
    public function getWebSettings(){
        $siteoptions = Siteoption::select('okey','ovalue')->get()->toArray();
        $websettings = [];
        foreach($siteoptions as $key => $value){
            $websettings[$value['okey']] = $value['ovalue'];
        }
        return $websettings;
    }
    public function member_login(){
        return view('frontend.member.login');
    }
    public function getWebMenus(){
        $tags = Tag::where('status', 1)
                ->where('tag_type',3)
                ->orderBy('tag_type','ASC')
                ->orderBy('sequence','ASC')
                ->orderBy('id','DESC')
                ->get();
        // dd($tags);    
        return $tags;
    }
    public function getfooterMenus(){
        $footermenu = Tag::where('status', 1)
                ->where('tag_type',2)
                ->orderBy('tag_type','ASC')
                ->orderBy('sequence','ASC')
                ->orderBy('id','DESC')
                ->get();    
        return $footermenu;
    }
}
