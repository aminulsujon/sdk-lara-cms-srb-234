<?php
$menus = [];
$i = 1;
foreach($tags as $tag){
    if(empty($tag->parent)){
    $menus[$tag->id]['id']= $tag->id;
    $menus[$tag->id]['title']= $tag->title;
    $menus[$tag->id]['linkto']= $tag->linkto;
    $menus[$tag->id]['linkUrl']= $tag->linkUrl;
    $menus[$tag->id]['status']= $tag->status;
    $menus[$tag->id]['sequence']= $tag->sequence;
    }else{
    $child[$tag->parent][$i]['id'] = $tag->id;
    $child[$tag->parent][$i]['title'] = $tag->title;
    $child[$tag->parent][$i]['linkto'] = $tag->linkto;
    $child[$tag->parent][$i]['linkUrl'] = $tag->linkUrl;
    $child[$tag->parent][$i]['status'] = $tag->status;
    $child[$tag->parent][$i]['sequence'] = $tag->sequence;
    $i++;
    }
}
// dd($menus);
?>
<div class="header-bottom header-sticky">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12 col-md-12 header-flex">
               
                <!-- Main-menu -->
                <div class="main-menu d-none d-md-block">
                    <nav>                  
                        <ul id="navigation">    
                            <li><a href="{{ $websettings['cms_url'] }}latest">সর্বশেষ</a></li>
                            @foreach ($menus as $key => $value)
                                <li>
                                <a href="{{ $value['linkto'] }}">{{ $value['title'] }}</a>
                                @if(!empty($child[$key]))
                                    <ul class="submenu">
                                    @foreach ($child[$key] as $ke => $val)
                                    <li><a href="{{ $val['linkto'] }}">{{ $val['title'] }}</a></li>
                                    @endforeach
                                    </ul>
                                @endif
                                </li>
                            @endforeach
                            <li class="d-block d-md-none">
                                @include($websettings['cms_layout'].'.com_social')
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>             
    
            <!-- Mobile Menu -->
            <div class="col-12">
                <div class="mobile_menu d-block d-md-none"></div>
            </div>
        </div>
    </div>
</div>