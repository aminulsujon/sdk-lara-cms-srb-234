<div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo py-4-">
                                    <a href="{{ $websettings['cms_url'] }}"><img src="images/logo.jpg" alt="logo" width="71">
                                      <span class="d-none">{{ $websettings['cms_sitename'] }}</span>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-3">

                            </div>

                            <div class="col-md-6">
                              <div class="row">
                                @if(!empty($spotlight) && count($spotlight->contents) > 0)
                                
                                  @foreach($spotlight->contents->take(2) as $content)
                                    <div class="col-6">
                                      <div class="media">
                                        <a href="{{ $content->slug }}">
                                          @foreach ($content->upload as $item)  
                                            <img class="float-start" width="70" src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                                            @break
                                          @endforeach
                                        </a>
                                        <div class="media-body" style="margin-left: 10px">
                                          <a class="sp" href="{{ $content->slug }}">{{$content->name }}</a>
                                        </div>
                                      </div>
                                    </div>
                                  @endforeach
                                @else
                                @if(!empty($websettings['cms_ads_status']))
                                  @include('blog.ads.header')
                                @endif
                                @endif
                              </div>
                            </div>

                        </div>
                   </div>
                </div>