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
    @if(isset($dataCate->category_id))
        @if($dataCate->category_image != '')
            <div class="banner-cate">
                <div class="container">
                    <img alt="{{$dataCate->category_title}}" src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_CATEGORY, $dataCate->category_id, $dataCate->category_image, 1600, 0, '', true, true)}}">
                </div>
            </div>
        @else
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
        @endif
    @endif
    <div class="container">
        <div class="line">
            @if(isset($dataCate->category_id) && $dataCate->category_image == '' && isset($data) && $data->count() > 1)
                <div class="line postViewHead mgt25">
                    <div class="box-title-step cat-left">
                        <h1>
                            <a title="{{$dataCate->category_title}}" href="{{FuncLib::buildLinkCategory($dataCate->category_id, $dataCate->category_title)}}">{{$dataCate->category_title}}</a>
                        </h1>
                    </div>
                </div>
            @endif
            <div class="line mgt20 viewPostTraining">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        @include('Statics::block.left')
                    </div>
                    <div class="col-md-6 col-sm-12">
                       <div class="row">
                           <div class="panelBox">
                               <div class="training-title-view">
                                   {!!stripslashes($data['statics_title'])!!}
                               </div>

                               @if($data['statics_intro'] != '')
                               <div class="training-intro-view mgt15">
                                   {!!stripslashes($data['statics_intro'])!!}
                               </div>
                               @endif

                               @if($data['statics_content'] != '')
                               <div class="training-title-view mgt15">Mô tả dịch vụ</div>
                               <div class="training-content-view">
                                   {!!stripslashes($data['statics_content'])!!}
                               </div>
                               @endif

                               <div class="boxCenter">
                                   <form  method="POST" name="txtForm" action="{{URL::route('site.noteTrainingPost')}}">
                                       <ul class="middleContent">
                                           <li>
                                               <div>
                                                   Họ tên : <input type="text" name="name" class="name pull-right">
                                               </div>
                                               <div class="line">
                                                   Sinh tại : &nbsp;&nbsp;
                                                   <input class="address" name="address" type="radio" value="1" checked> Đông Dương &nbsp;
                                                   <input class="address" name="address" type="radio" value="0"> Nơi khác
                                               </div>
                                               <div>
                                                   Điện thoại <input class="phone pull-right" name="phone" type="text">
                                               </div>
                                           </li>
                                           <li>
                                               <div>
                                                   Giới tính :
                                                   <input class="sex" name="sex" type="radio" value="1" checked> Nam &nbsp;&nbsp;
                                                   <input class="sex" name="sex" type="radio" value="0"> Nữ
                                               </div>
                                               <div>
                                                   Giờ : &nbsp; &nbsp; &nbsp; &nbsp;
                                                   <select name="time" class="time">
                                                       <option value="1">Tý (23h-1h)</option>
                                                       <option value="2">Sửu (1h-3h)</option>
                                                       <option value="3">Dần (3h-5h)</option>
                                                       <option value="4">Mão (5h-7h)</option>
                                                       <option value="5">Thìn (7h-9h)</option>
                                                       <option value="6">Tỵ (9h-11h)</option>
                                                       <option value="7">Ngọ (11h-13h)</option>
                                                       <option value="8">Mùi (13h-15h)</option>
                                                       <option value="9">Thân (15h-17h)</option>
                                                       <option value="10">Dậu (17h-19h)</option>
                                                       <option value="11">Tuất (19h-21h)</option>
                                                       <option value="12">Hợi (21h-23h)</option>
                                                   </select>
                                               </div>
                                           </li>
                                       </ul>
                                       <br>
                                       <div class="boxData col-lg-12">
                                           <table width="100%" cellpadding="2" border="0">
                                               <tbody>
                                               <tr>
                                                   <td colspan="2">
                                                       <input id="is_calendar" name="is_calendar" type="radio" value="2" checked> Ngày sinh theo <span color="#008af1"><strong>Dương Lịch</strong></span>
                                                   </td>
                                                   <td colspan="2">
                                                       <input id="is_calendar" name="is_calendar" type="radio" value="1"> Ngày sinh theo <span color="#008af1"><strong>Âm Lịch</strong></span>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td width="49" valign="middle" height="25">Ngày : </td>
                                                   <td width="317">
                                                       <select id="day" name="day">
                                                           @for($i=1; $i<=31; $i++)
                                                               <option value="{{$i}}">{{sprintf("%02d", $i)}}</option>
                                                           @endfor
                                                       </select>
                                                   </td>
                                                   <td width="45" valign="middle">Ngày : </td>
                                                   <td width="344">
                                                       <select id="day_am" name="day_am">
                                                           @for($i=1; $i<=31; $i++)
                                                               <option value="{{$i}}">{{sprintf("%02d", $i)}}</option>
                                                           @endfor
                                                       </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td valign="middle" nowrap="nowrap" height="25">Tháng : </td>
                                                   <td>
                                                       <select name="month" id="month">
                                                           @for($i=1; $i<=12; $i++)
                                                               <option value="{{$i}}">{{sprintf("%02d", $i)}}</option>
                                                           @endfor
                                                       </select>
                                                   </td>
                                                   <td valign="middle" nowrap="nowrap">Tháng : </td>
                                                   <td>
                                                       <select name="month_am" id="month_am">
                                                           <option value="1">Giêng</option>
                                                           <option value="2">Hai</option>
                                                           <option value="3">Ba</option>
                                                           <option value="4">Tư</option>
                                                           <option value="5">Năm</option>
                                                           <option value="6">Sáu</option>
                                                           <option value="7">Bảy</option>
                                                           <option value="8">Tám</option>
                                                           <option value="9">Chín</option>
                                                           <option value="10">Mười</option>
                                                           <option value="11">Mười Một</option>
                                                           <option value="12">Chạp</option>
                                                       </select>
                                                   </td>
                                               </tr>
                                               <tr>
                                                   <td valign="middle" height="25">Năm : </td>
                                                   <td>
                                                       <select name="year" id="year">
                                                           @for($i=2028; $i>=1940; $i--)
                                                               <option value="{{$i}}">{{$i}}</option>
                                                           @endfor
                                                       </select>
                                                   <td valign="middle">Năm: </td>
                                                   <td>
                                                       <select name="year_am" id="year_am">
                                                           <option value="1">Giáp Tý</option>
                                                           <option value="2">Bính Tý</option>
                                                           <option value="3">Mậu Tý</option>
                                                           <option value="4">Canh Tý</option>
                                                           <option value="5">Nhâm Tý</option>
                                                           <option value="6">Ất Sửu</option>
                                                           <option value="7">Đinh Sửu</option>
                                                           <option value="8">Kỷ Sửu</option>
                                                           <option value="9">Tân Sửu</option>
                                                           <option value="10">Quý Sửu</option>
                                                           <option value="11">Bính Dần</option>
                                                           <option value="12">Mậu Dần</option>
                                                           <option value="13">Canh Dần</option>
                                                           <option value="14">Nhâm Dần</option>
                                                           <option value="15">Giáp Dần</option>
                                                           <option value="16">Đinh Mẹo</option>
                                                           <option value="17">Kỷ Mẹo</option>
                                                           <option value="18">Tân Mẹo</option>
                                                           <option value="19">Quý Mẹo</option>
                                                           <option value="20">Ất Mẹo</option>
                                                           <option value="21">Mậu Thìn</option>
                                                           <option value="22">Nhâm Thìn</option>
                                                           <option value="23">Giáp Thìn</option>
                                                           <option value="24">Canh Thìn</option>
                                                           <option value="25">Bính Thìn</option>
                                                           <option value="26">Kỷ Tỵ</option>
                                                           <option value="27">Tân Tỵ</option>
                                                           <option value="28">Quý Tỵ</option>
                                                           <option value="29">Ất Tỵ</option>
                                                           <option value="30">Đinh Tỵ</option>
                                                           <option value="31">Canh Ngọ</option>
                                                           <option value="32">Nhâm Ngọ</option>
                                                           <option value="33">Giáp Ngọ</option>
                                                           <option value="34">Bính Ngọ</option>
                                                           <option value="35">Mậu Ngọ</option>
                                                           <option value="36">Tân Mùi</option>
                                                           <option value="37">Quý Mùi</option>
                                                           <option value="38">Ất Mùi</option>
                                                           <option value="39">Đinh Mùi</option>
                                                           <option value="40">Kỷ Mùi</option>
                                                           <option value="41">Nhâm Thân</option>
                                                           <option value="42">Giáp Thân</option>
                                                           <option value="43">Bính Thân</option>
                                                           <option value="44">Mậu Thân</option>
                                                           <option value="45">Canh Thân</option>
                                                           <option value="46">Quý Dậu</option>
                                                           <option value="47">Ất Dậu</option>
                                                           <option value="48">Đinh Dậu</option>
                                                           <option value="49">Kỷ Dậu</option>
                                                           <option value="50">Tân Dậu</option>
                                                           <option value="51">Giáp Tuất</option>
                                                           <option value="52">Bính Tuất</option>
                                                           <option value="53">Mậu Tuất</option>
                                                           <option value="54">Canh Tuất</option>
                                                           <option value="55">Nhâm Tuất</option>
                                                           <option value="56">Ất Hợi</option>
                                                           <option value="57">Đinh Hợi</option>
                                                           <option value="58">Kỷ Hợi</option>
                                                           <option value="59">Tân Hợi</option>
                                                           <option value="60">Quý Hợi</option>
                                                       </select>
                                                   </td>
                                               </tr>
                                               </tbody>
                                           </table>
                                           <div class="line mgt15">
                                               {!! $text_17 !!}
                                           </div>
                                           <div class="text-center mgt15">
                                               <button class="btnSendTrainingNote btn btn-warning btn-sm">OK</button>
                                           </div>
                                       </div>
                                       {!! csrf_field() !!}
                                   </form>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        @include('Statics::block.right')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
