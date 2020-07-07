<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\ThumbImg;
?>
<div id="header">
    @if(isset($dataBannerHead) && !empty($dataBannerHead))
        <div class="banner-head">
            <div class="container">
                @foreach($dataBannerHead as $item)
                    <a {{$item['target']}} {{$item['rel']}} href="@if($item['banner_link'] != '') {{$item['banner_link']}} @else javascript:void(0) @endif" title="{{$item['banner_title_show']}}">
                        <img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_BANNER, $item['banner_id'], $item['banner_image'], 1600, 0, '', true, true, false)}}" alt="{{$item['banner_title_show']}}" />
                    </a>
                @endforeach
            </div>
        </div>
    @endif
    <div class="logo">
        <a href="{{FuncLib::getBaseUrl()}}">
            <img src="{{FuncLib::getBaseUrl()}}assets/frontend/img/logoF.png">
        </a>
    </div>
    <button type="button" class="mbButtonMenu navbar-toggle pull-right">
        <i class="fa fa-bars fa-2x"></i>
    </button>
</div>
<div id="menu">
    <div class="container">
        <div class="menuTop">
            <ul class="list-menu">
                @if(isset($arrCategory) && !empty($arrCategory))
                    @foreach($arrCategory as $cat)
                        @if($cat->category_menu == CGlobal::status_show && $cat->category_parent_id == 0)
                            <?php $i=0 ?>
                            @foreach($arrCategory as $sub)
                                @if($sub->category_menu == CGlobal::status_show && $sub->category_parent_id == $cat->category_id)
                                    <?php $i++; ?>
                                @endif
                            @endforeach
                            <li>
                                <a @if($i > 0) @endif title="{{$cat->category_title}}" href="@if($cat->category_link_replace != ''){{$cat->category_link_replace}}@else{{FuncLib::buildLinkCategory($cat->category_id, $cat->category_title)}}@endif">
                                    {{$cat->category_title}}
                                </a>
                                @if($i > 0)
                                    <ul class="menu-sub">
                                        @foreach($arrCategory as $sub)
                                            @if($sub->category_menu == CGlobal::status_show && $sub->category_parent_id == $cat->category_id)
                                                <li>
                                                    <a title="{{$sub->category_title}}" href="@if($sub->category_link_replace != ''){{$sub->category_link_replace}}@else{{FuncLib::buildLinkCategory($sub->category_id, $sub->category_title)}}@endif">
                                                        {{stripcslashes($sub->category_title)}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
            <button type="button" class="mbButtonMenuL navbar-toggle pull-right">
                <span class="fa-4x">×</span>
            </button>
        </div>
    </div>
</div>