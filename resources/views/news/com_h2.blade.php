<div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center">
                            

                            <div class="col-md-12">
                              <div class="row">
                                @if(!empty($spotlight) && count($spotlight->contents) > 0)
                                
                                  @foreach($spotlight->contents->take(4) as $content)
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