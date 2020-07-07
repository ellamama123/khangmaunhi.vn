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
                    <li class="active">@if($id==0)Thêm mới @else Sửa @endif bài viết tĩnh</li>
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
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Danh mục</label>
                                                                <div class="controls">
                                                                    <select class="form-control input-sm" name="statics_catid">
                                                                        {!! $optionCategoryProduct !!}
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Tiêu đề<span>*</span></label>
                                                                <div class="controls">
                                                                    <input type="text" class="form-control input-sm" name="statics_title" value="@if(isset($data['statics_title'])){{$data['statics_title']}}@endif">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Ảnh</label>
                                                                <div class="controls">
                                                                    <a href="javascript:;"class="btn btn-primary link-button btn-sm" onclick="UploadAdmin.uploadMultipleImages(6);">Upload ảnh</a>
                                                                    <input name="image_primary" type="hidden" id="image_primary" value="@if(isset($data['statics_image'])){{trim($data['statics_image'])}}@endif">
                                                                </div>
                                                                <!--Hien Thi Anh-->
                                                                <ul id="sys_drag_sort" class="ul_drag_sort">
                                                                    @if(isset($news_image_other))
                                                                        @foreach($news_image_other as $k=>$v)
                                                                            <li id="sys_div_img_other_{{$k}}">
                                                                                <div class="div_img_upload">
                                                                                    <img src="{{$v['src_img_other']}}" height="80">
                                                                                    <input type="hidden" id="sys_img_other_{{$k}}" name="img_other[]" value="{{$v['img_other']}}" class="sys_img_other">
                                                                                    <div class='clear'></div>
                                                                                    <input type="radio" id="checked_image_{{$k}}" name="checked_image" value="{{$k}}"
                                                                                           @if(isset($news_image) && ($news_image == $v['img_other'])) checked="checked" @endif
                                                                                           onclick="UploadAdmin.checkedImage('{{$v['img_other']}}','{{$k}}');">
                                                                                    <label for="checked_image_{{$k}}" style='font-weight:normal'>Ảnh đại diện</label>
                                                                                    <br/>
                                                                                    <a href="javascript:void(0);" id="sys_delete_img_other_{{$k}}" onclick="UploadAdmin.removeImage('{{$k}}', '{{$data['statics_id']}}', '{{$v['img_other']}}', '6');">Xóa ảnh</a>
                                                                                    <span style="display: none"><b>{{$k}}</b></span>
                                                                                </div>
                                                                            </li>
                                                                            @if(isset($news_image) && $news_image == $v['img_other'])
                                                                                <input type="hidden" id="sys_key_image_primary" name="sys_key_image_primary" value="{{$k}}">
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <input type="hidden" id="sys_key_image_primary" name="sys_key_image_primary" value="-1">
                                                                    @endif

                                                                </ul>
                                                                <input name="list1SortOrder" id ='list1SortOrder' type="hidden" />
                                                                <!--Hien Thi Anh-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="control-label"><span class="click-add-attime">Click để thêm ExtLink</span></label>
                                                        <div class="arrAttime">
                                                            <?php $new_word = (isset($data->statics_word) && $data->statics_word != '') ? json_decode($data->statics_word, true) : []; ?>
                                                            @if(!empty($new_word))
                                                                @foreach($new_word as $v)
                                                                    <div class="row itemAttime">
                                                                        <div class="col-md-5">
                                                                            <span class="lb">Ext Link</span>
                                                                            <input name="attime[]" autocomplete="off" @if(isset($v['attime'])) value="{{$v['attime']}}" @endif class="attime form-control input-sm">
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <span class="lb">Tiêu đề</span>
                                                                            <input name="word[]"  autocomplete="off" @if(isset($v['word'])) value="{{$v['word']}}" @endif class="word form-control input-sm">
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <span class="del-attime" title="Xóa">X</span>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="row itemAttime">
                                                                    <div class="col-md-5">
                                                                        <span class="lb">Ext Link</span>
                                                                        <input name="attime[]" autocomplete="off" class="attime form-control input-sm">
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <span class="lb">Tiêu đề</span>
                                                                        <input name="word[]"  autocomplete="off" class="word form-control input-sm">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <span class="del-attime" title="Xóa">X</span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Mô tả</label>
                                                        <div class="controls">
                                                            <textarea class="form-control input-sm" name="statics_intro">@if(isset($data['statics_intro'])){{stripslashes($data['statics_intro'])}}@endif</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Nội dung</label>
                                                        <div class="controls">
                                                            <button type="button" onclick="UploadAdmin.getInsertImageContent(6, 'open')" class="btn btn-primary btn-sm">Chèn ảnh vào nội dung</button>

                                                            <?php $new_word = (isset($data->statics_word) && $data->statics_word != '') ? json_decode($data->statics_word, true) : []; ?>
                                                            @if(!empty($new_word))
                                                                <button type="button" onclick="UploadAdmin.getInsertExtLinkContent(6, 'open')" class="btn btn-primary btn-sm">Chèn ExtLink</button>
                                                            @endif
                                                        </div>
                                                        <div class="controls">
                                                            <textarea class="form-control input-sm" name="statics_content">@if(isset($data['statics_content'])){{stripslashes($data['statics_content'])}}@endif</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Thứ tự</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control input-sm" name="statics_order_no" value="@if(isset($data['statics_order_no'])){{$data['statics_order_no']}}@endif">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nổi bật</label>
                                                        <div class="controls">
                                                            <select class="form-control input-sm" name="statics_focus">
                                                                {!! $optionFocus !!}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Trạng thái</label>
                                                        <div class="controls">
                                                            <select class="form-control input-sm" name="statics_status">
                                                                {!! $optionStatus !!}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Meta title</label>
                                                        <div class="controls">
                                                            <input type="text" class="form-control input-sm" name="meta_title" value="@if(isset($data['meta_title'])){{$data['meta_title']}}@endif">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Meta keyword</label>
                                                        <div class="controls">
                                                            <textarea class="form-control input-sm" name="meta_keywords">@if(isset($data['meta_keywords'])){{$data['meta_keywords']}}@endif</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Meta description</label>
                                                        <div class="controls">
                                                            <textarea class="form-control input-sm" name="meta_description">@if(isset($data['meta_description'])){{$data['meta_description']}}@endif</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
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
    <!--Popup Upload Img-->
    <div class="modal fade" id="sys_PopupUploadImgOtherPro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Upload ảnh</h4>
                </div>
                <div class="modal-body">
                    <form name="uploadImage" method="post" action="#" enctype="multipart/form-data">
                        <div class="form_group">
                            <div id="sys_show_button_upload">
                                <div id="sys_mulitplefileuploader" class="btn btn-primary">Upload ảnh</div>
                            </div>
                            <div id="status"></div>

                            <div class="clearfix"></div>
                            <div class="clearfix" style='margin: 5px 10px; width:100%;'>
                                <div id="div_image"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Popup Upload Img-->

    <!--Popup chen anh vào noi dung-->
    <div class="modal fade" id="sys_PopupImgOtherInsertContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Click ảnh để chèn vào nội dung</h4>
                </div>
                <div class="modal-body">
                    <form name="uploadImage" method="post" action="#" enctype="multipart/form-data">
                        <div class="form_group">
                            <div class="clearfix"></div>
                            <div class="clearfix" style='margin: 5px 10px; width:100%;'>
                                <div id="div_image" class="float_left"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Popup chen anh vào noi dung-->

    <div class="modal fade" id="sys_PopupImgOtherInsertExtLinkContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Click để chèn ExtLink vào nội dung</h4>
                </div>
                <div class="modal-body extLinkClick">
                    <?php $new_word = (isset($data->statics_word) && $data->statics_word != '') ? json_decode($data->statics_word, true) : []; ?>
                    @if(!empty($new_word))
                        <ul>
                            @foreach($new_word as $link)
                                @if(isset($link['attime']) && isset($link['word']))
                                    <li><h2 class="_extLink" id="{{$link['attime']}}">{{$link['word']}}</h2></li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        CKEDITOR.replace('statics_content');
        //Keo Tha Anh
        jQuery("#sys_drag_sort").dragsort({ dragSelector: "div", dragBetween: true, dragEnd: saveOrder });
        function saveOrder() {
            var data = jQuery("#sys_drag_sort li div span").map(function() { return jQuery(this).children().html(); }).get();
            jQuery("input[name=list1SortOrder]").val(data.join(","));
        };
        //Chen Anh Vao Noi Dung
        function insertImgContent(src){
            CKEDITOR.instances.statics_content.insertHtml('<img src="'+src+'"/>');
        }
        insertExtLinkContent();
        function insertExtLinkContent(){
            $('.extLinkClick ul li').click(function(){
                var text = $(this).html();
                CKEDITOR.instances.statics_content.insertHtml(text);
            });
        }
    </script>
@stop

