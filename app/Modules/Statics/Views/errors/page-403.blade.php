<?php
use App\Library\PHPDev\FuncLib;
?>
@extends('Statics::layout.html')
@section('header')
    @include('Statics::block.header')
@stop
@section('footer')
    @include('Statics::block.footer')
@stop
@section('content')
    <div class="wrap-page">
        <div class="line">
            <div class="page-access">
                <div class="wrap-page-access">
                    <div class="box-page-access">
                        <div class="page-access-left">
                            <div class="title-access">403</div>
                        </div>
                        <div class="page-access-right">
                            <img src="{{FuncLib::getBaseUrl()}}assets/frontend/img/access.png" alt="" title="">
                            <div class="desc-access">{{$txt403}}</div>
                            <div class="link-access"><a href="{{FuncLib::getBaseUrl()}}">Trở về trang chủ</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop