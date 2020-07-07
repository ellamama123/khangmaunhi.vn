<?php
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\ThumbImg;
use App\Library\PHPDev\Utility;
?>
@extends('Statics::layout.html')
@section('header')
    @include('Statics::block.header')
@stop
@section('footer')
    @include('Statics::block.footer')
@stop
@section('content')
<div class="bd-bottom">
    <div class="line bgebebeb">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="{{FuncLib::getBaseUrl()}}">Trang chủ</a>
                </li>
                @if(isset($dataCate->category_id))
                <li class="active">{{$dataCate->category_title}}</li>
                @endif
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="line">
            <div class="row">
                <div class="line postViewHead mgt25">
                    <div class="box-title-step cat-center">
                        <h1>
                            <a title="{{$dataCate->category_title}}" href="{{FuncLib::buildLinkCategory($dataCate->category_id, $dataCate->category_title)}}">{{$dataCate->category_title}}</a>
                        </h1>
                    </div>
                </div>
                <div class="line mgt20 listPostNews">
                    @if($data->count() > 1)
                        @foreach($data as $item)
                        <div class="col-lg-4 col-md-4 col-sm-12 item-post-cols">
                            <div class="item">
                                <a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">
                                    <div class="thumbI">
                                        @if($item->statics_image != '')
                                            <img alt="{{$item->statics_title}}" src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 600, 600, '', true, true)}}">
                                        @endif
                                    </div>
                                    <h3 class="titlex">{{stripcslashes($item->statics_title)}}</h3>
                                    <div class="line">
                                        <div class="item-date0">{{date('d-m-Y', $item->statics_created)}}</div>
                                        <div class="item-view0">606 Lượt xem</div>
                                    </div>
                                    <div class="overx">
                                        {{Utility::cutWord(stripcslashes(strip_tags($item->statics_intro)), 30)}}
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        <div class="show-box-paging">{!! $paging !!}</div>
                    @else
                        <div class="col-lg-12">
                            @foreach($data as $k=>$item)
                                <div class="intro-view">
                                    {!!stripslashes($item['statics_intro'])!!}
                                </div>
                                <div class="content-view">
                                    {!!stripslashes($item['statics_content'])!!}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop