<?php
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\ThumbImg;
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
                <li class="active">
                    <h2>Liên hệ</h2>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="line">
            <div class="row">
                <div class="line postViewHead mgt25">
                    <div class="box-title-step cat-center">
                        <h1>
                            Liên hệ
                        </h1>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 c-box-intro">
                    @if(isset($arrJoin->info_id))
                        {!! stripcslashes($arrJoin->info_content) !!}
                    @endif
                </div>
                @if(isset($messages) && $messages != '')
                    {!! $messages !!}
                @endif
                <div class="mgt15">
                    <div class="col-lg-6 col-md-6 col-sm-6 animated fadeInLeft">
                        <div class="tile-box-head">{{CGlobal::nameSite}} Được Hỗ Trợ Quý Khách</div>
                        <form id="formSendContact" method="POST" class="formSendContact" name="txtForm">
                            <div class="form-group">
                                <label class="control-label">Họ và tên<span>(*)</span></label>
                                <input id="txtName" name="txtName" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email<span>(*)</span></label>
                                <input id="txtMail" name="txtMail" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tiêu đề<span></span></label>
                                <input id="txtTitle" name="txtTitle" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Thông điệp<span></span></label>
                                <textarea id="txtMessage" name="txtMessage" class="form-control" rows="3"></textarea>
                            </div>
                            {!! csrf_field() !!}
                            <button type="submit" id="submitContact" class="btn btn-primary">Gửi đi</button>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 animated fadeInRight">
                        <div class="tile-box-head">Địa chỉ và sơ đồ đường đi</div>
                        @if(isset($arrContact->info_id))
                            <div class="address-contact">
                                {!! stripcslashes($arrContact->info_content) !!}
                            </div>
                            <div class="address-contact">
                                @if($arrContact->info_img == '')
                                    <img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $arrContact->info_id, $arrContact->info_img, 800, 0, '', true, true)}}"/>
                                @else
                                    <script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry&key=AIzaSyA-WIHdfuGBuWUCglOx2-yUB9oU_0498PU&language=vi"></script>
                                    {!! Loader::loadJS('libs/map/maps.js', CGlobal::$postEnd) !!}
                                    <div id="mapCanvas" style="width:100%; height:365px; overflow: hidden; border-radius:3px;"></div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop