<?php
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\ThumbImg;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\Loader;
?>
@extends('Statics::layout.html')
@section('header')
    @include('Statics::block.header')
@stop
@section('footer')
    @include('Statics::block.footer')
@stop
@section('content')
<div class="bd-bottom viewPost">
    <div class="line bgebebeb">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="{{FuncLib::getBaseUrl()}}">Trang chủ</a>
                </li>
                @if(isset($dataCate->category_id))
                <li class="active">
                    <h2><a title="{{$dataCate->category_title}}" href="{{FuncLib::buildLinkCategory($dataCate->category_id, $dataCate->category_title)}}">{{$dataCate->category_title}}</a></h2>
                </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="line">
                <div class="container">
                    @if(CGlobal::is_dev == 0)
                        <div class="social-share-view">
                            <div class="div-share">
                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s); js.id = id;
                                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));</script>
                                <div class="fb-like" data-href="{{FuncLib::buildLinkDetailNews($data->news_id, $data->news_title)}}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                            </div>
                            <div class="div-share google">
                                <script src="https://apis.google.com/js/platform.js" async defer></script>
                                <g:plus action="share" annotation="bubble"></g:plus>
                                <div class="g-plusone" data-size="medium"></div>
                            </div>
                        </div>
                    @endif
                    <div class="date">
                        Ngày {{date('d-m-Y H:i ', $data->statics_created)}}
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 pull-right">
                <h1 class="title-view">{{stripcslashes($data->statics_title)}}</h1>
                <div class="line">
                    @if($data->statics_intro != '')
                    <div class="line intro-view">
                        {!! stripcslashes($data->statics_intro) !!}
                    </div>
                    @endif
                    <div class="line content-view">
                        {!! stripcslashes($data->statics_content) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-10">
                        <div class="title-same">CÁC TIN KHÁC</div>
                        <div class="line mgt15 mgbt10 listPostNews">
                            <div class="row">
                                @foreach($dataSame as $k=>$item)
                                    <div class="col-lg-6 col-md-6 col-sm-12 item-post-news">
                                        <a class="iThumbPost" title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">
                                            @if($item->statics_image != '')
                                                <img alt="{{$item->statics_title}}" src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 600, 600, '', true, true)}}">
                                            @endif
                                        </a>
                                        <h3>
                                            <a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">{{$item->statics_title}}</a>
                                        </h3>
                                        <p class="time">{{date('d-m-Y', $item->statics_created)}}</p>
                                        <p class="mbHidden">
                                            {{Utility::cutWord(stripcslashes(strip_tags($item->statics_intro)), 15)}}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 pull-left extSiteBars">
                <?php $new_word = (isset($data->statics_word) && $data->statics_word != '') ? json_decode($data->statics_word, true) : []; ?>
                @if(!empty($new_word))
                <div id="sidebarExtLink">
                    <div class="sidebar">
                        <div class="widget">
                            <div class="widget-title">Nội dung bài viết</div>
                            <ul>
                                @foreach($new_word as $link)
                                    @if(isset($link['attime']) && isset($link['word']))
                                        <li><a href="#{{$link['attime']}}">{{$link['word']}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <?php Loader::loadJS('libs/stickySidebar/sticky-sidebar.js', CGlobal::$postHead);?>
                <script>
                    var lk = new StickySidebar('#sidebarExtLink', {topSpacing: 20, bottomSpacing: 20, containerSelector: '.container', innerWrapperSelector: '.sidebar__inner'});
                </script>
                @endif
            </div>
        </div>
    </div>
</div>
@stop
