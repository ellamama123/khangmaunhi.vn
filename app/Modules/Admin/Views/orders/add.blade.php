<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\ThumbImg;
?>
@extends('Admin::layout.html')
@section('header')
    @include('Admin::block.header')
@stop
@section('left')
    @include('Admin::block.left')
@stop
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="{{URL::route('admin.dashboard')}}">Trang chủ</a>
                </li>
                <li class="active">@if($id==0)Thêm mới @else Sửa @endif thông khách hàng</li>
            </ul>
        </div>
        <div class="page-content">
            <div class="col-xs-12">
                <div class="row">
                    @if(isset($error) && $error != '')
                        <div class="alert-admin alert alert-danger">{!! $error !!}</div>
                    @endif
                    <form class="form-horizontal paddingTop30" name="txtForm" action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-12">
                                <div class="nav-tabs-horizontal nav-tabs-inverse" data-plugin="tabs">
                                    <ul class="nav nav-tabs nav-tabs-solid" role="tablist">
                                        <li class="nav-item active" role="presentation">
                                            <a class="nav-link active" data-toggle="tab" href="#tabNoiDung"
                                               aria-controls="tabNoiDung" role="tab">
                                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                Nội dung
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-10">
                                        <div class="tab-pane panelDetail active" id="tabNoiDung" role="tabpanel">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Tên<span>*</span></label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control input-sm" name="name" value="@if(isset($data['name'])){{$data['name']}}@endif">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Điện thoại</label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control input-sm" name="phone" @if(isset($data['phone']))value="{{$data['phone']}}" @endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nơi sinh tại</label>
                                                    <div class="controls">
                                                        <select class="form-control input-sm" name="address">
                                                            {!! $optionAddress !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Giờ sinh</label>
                                                    <div class="controls">
                                                        <select class="form-control input-sm" name="time">
                                                            {!! $optionTime !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label"><b>Ngày sinh theo Dương Lịch</b></label>
                                                    <div class="controls">
                                                        Ngày
                                                        <select class="form-control input-sm" name="day">
                                                            @for($i=1; $i<=31; $i++)
                                                                <option @if(isset($data['day']) && $data['day'] == $i) selected @endif value="{{$i}}">{{sprintf("%02d", $i)}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="controls">
                                                        Tháng
                                                        <select class="form-control input-sm" name="month">
                                                            @for($i=1; $i<=12; $i++)
                                                                <option @if(isset($data['month']) && $data['month'] == $i) selected @endif value="{{$i}}">{{sprintf("%02d", $i)}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="controls">
                                                        Năm
                                                        <select class="form-control input-sm" name="year">
                                                            @for($i=2028; $i>=1940; $i--)
                                                                <option  @if(isset($data['year']) && $data['year'] == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label"><b>Ngày sinh theo Âm Lịch</b></label>
                                                    <div class="controls">
                                                        Ngày
                                                        <select class="form-control input-sm" name="day_am">
                                                            @for($i=1; $i<=31; $i++)
                                                                <option @if(isset($data['day_am']) && $data['day_am'] == $i) selected @endif value="{{$i}}">{{sprintf("%02d", $i)}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="controls">
                                                        Tháng
                                                        <select class="form-control input-sm" name="month_am">
                                                            @for($i=1; $i<=12; $i++)
                                                                <option @if(isset($data['month_am']) && $data['month_am'] == $i) selected @endif value="{{$i}}">{{sprintf("%02d", $i)}}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="controls">
                                                        Năm
                                                        <select class="form-control input-sm" name="year_am">
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 1) selected @endif value="1">Giáp Tý</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 2) selected @endif value="2">Bính Tý</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 3) selected @endif value="3">Mậu Tý</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 4) selected @endif value="4">Canh Tý</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 5) selected @endif value="5">Nhâm Tý</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 6) selected @endif value="6">Ất Sửu</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 7) selected @endif value="7">Đinh Sửu</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 8) selected @endif value="8">Kỷ Sửu</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 9) selected @endif value="9">Tân Sửu</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 10) selected @endif value="10">Quý Sửu</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 11) selected @endif value="11">Bính Dần</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 12) selected @endif value="12">Mậu Dần</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 13) selected @endif value="13">Canh Dần</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 14) selected @endif value="14">Nhâm Dần</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 15) selected @endif value="15">Giáp Dần</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 16) selected @endif value="16">Đinh Mẹo</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 17) selected @endif value="17">Kỷ Mẹo</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 18) selected @endif value="18">Tân Mẹo</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 19) selected @endif value="19">Quý Mẹo</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 20) selected @endif value="20">Ất Mẹo</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 21) selected @endif value="21">Mậu Thìn</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 22) selected @endif value="22">Nhâm Thìn</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 23) selected @endif value="23">Giáp Thìn</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 24) selected @endif value="24">Canh Thìn</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 25) selected @endif value="25">Bính Thìn</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 26) selected @endif value="26">Kỷ Tỵ</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 27) selected @endif value="27">Tân Tỵ</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 28) selected @endif value="28">Quý Tỵ</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 29) selected @endif value="29">Ất Tỵ</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 30) selected @endif value="30">Đinh Tỵ</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 31) selected @endif value="31">Canh Ngọ</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 32) selected @endif value="32">Nhâm Ngọ</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 33) selected @endif value="33">Giáp Ngọ</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 34) selected @endif value="34">Bính Ngọ</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 45) selected @endif value="35">Mậu Ngọ</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 36) selected @endif value="36">Tân Mùi</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 37) selected @endif value="37">Quý Mùi</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 38) selected @endif value="38">Ất Mùi</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 39) selected @endif value="39">Đinh Mùi</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 40) selected @endif value="40">Kỷ Mùi</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 41) selected @endif value="41">Nhâm Thân</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 42) selected @endif value="42">Giáp Thân</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 43) selected @endif value="43">Bính Thân</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 44) selected @endif value="44">Mậu Thân</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 45) selected @endif value="45">Canh Thân</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 46) selected @endif value="46">Quý Dậu</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 47) selected @endif value="47">Ất Dậu</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 48) selected @endif value="48">Đinh Dậu</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 49) selected @endif value="49">Kỷ Dậu</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 50) selected @endif value="50">Tân Dậu</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 51) selected @endif value="51">Giáp Tuất</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 52) selected @endif value="52">Bính Tuất</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 53) selected @endif value="53">Mậu Tuất</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 54) selected @endif value="54">Canh Tuất</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 55) selected @endif value="55">Nhâm Tuất</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 56) selected @endif value="56">Ất Hợi</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 57) selected @endif value="57">Đinh Hợi</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 58) selected @endif value="58">Kỷ Hợi</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 59) selected @endif value="59">Tân Hợi</option>
                                                            <option @if(isset($data['year_am']) && $data['year_am'] == 60) selected @endif value="60">Quý Hợi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Giới tính</label>
                                                    <div class="controls">
                                                        <select class="form-control input-sm" name="sex">
                                                            {!! $optionSex !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Trạng thái</label>
                                                    <div class="controls">
                                                        <select class="form-control input-sm" name="status">
                                                            {!! $optionStatus !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer clearfix">
                                        <div class="form-inline float-right">
                                            <div class="form-row">
                                                {!! csrf_field() !!}
                                                <input type="hidden" id="id_hiden" name="id_hiden" value="{{$id}}"/>
                                                <button type="submit" name="txtSubmit" id="buttonSubmit" class="btn btn-primary btn-sm">Lưu lại</button>
                                                <button type="reset" class="btn btn-sm">Bỏ qua</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
