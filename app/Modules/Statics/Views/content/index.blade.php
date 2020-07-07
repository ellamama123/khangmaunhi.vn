<?php
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ThumbImg;
?>
@extends('Statics::layout.html')
@section('header')
	@include('Statics::block.header')
@stop
@section('footer')
	@include('Statics::block.footer')
@stop
@section('content')
<div class="line bgIndex">
	<div class="container">
		{!! isset($messages) && ($messages != '') ? $messages : '' !!}
		<div class="txtIndex2 bgTextIndex2">
			<div class="container">
				<div class="col-lg-4 col-md-4 col-sm-4 imgTxtIndex2">
					<div class="thumb">
						@if($arr_text_2->info_img != '')
							<img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $arr_text_2->info_id, $arr_text_2->info_img, 800, 229, '', true, true)}}">
						@endif
					</div>
					<div class="nameTxtIndex2">
						{!! isset($text_1) ? $text_1 : '' !!}
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 txtTxtIndex2">
					{!! isset($arr_text_2->info_content) ? stripcslashes($arr_text_2->info_content) : '' !!}
				</div>
			</div>
		</div>

		<div class="txtIndex3 ">
			<div class="txtIndexImg3">
				{!! isset($text_3) ? $text_3 : '' !!}
			</div>
			<div class="txtIndexImg4">
				{!! isset($text_3_1) ? $text_3_1 : '' !!}
			</div>
		</div>

		<div class="txtIndex4">{!! isset($text_4) ? $text_4 : '' !!}</div>
		<div class="arrItemInCatIndex1">
			@if(isset($data_cat_1) && !empty($data_cat_1))
				<div id="post-swipe-reviews" class="swiper-wrapper owl_pages owl-carousel owl-theme">
					@foreach($data_cat_1 as $item)
						<div class="client-item">
							<div class="itemInCatIndex1">
								<div class="wrappthumb">
									<div class="thumb">
										@if($item->statics_image != '')
											<img alt="{{$item->statics_title}}" src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 800, 0, '', true, true)}}">
										@endif
									</div>
								</div>
								<div class="titleItemIndex">{{stripcslashes($item->statics_title)}}</div>
								<div class="introItemIndex">{!! stripcslashes($item->statics_intro) !!}</div>
								<div class="contentItemIndex">{{Utility::cutWord(stripcslashes(strip_tags($item->statics_content)), 50)}}</div>
							</div>
						</div>
					@endforeach
				</div>
				<script>$(function(){SITE.postSwipeReviews();})</script>
			@endif
		</div>

		<div class="txtIndex4">{!! isset($text_5) ? $text_5 : '' !!}</div>
		<div class="arrItemInCatIndex2">
			<div class="row">
				@if(isset($data_cat_2) && !empty($data_cat_2))
					@foreach($data_cat_2 as $key=>$item)
					<div @if($key < 2) class="col-lg-6 col-md-6 col-sm-6" @else class="col-lg-12 col-md-12 col-sm-12" @endif>
						<div class="itemInCatIndex2 @if($key > 1) mgb80 @endif">
							<div class="wrapptext"><div class="text">{{$key+1}}</div></div>
							<div class="titleItemIndex">{{stripcslashes($item->statics_title)}}</div>
							<div class="contentItemIndex">{!! stripcslashes($item->statics_content) !!}</div>
						</div>
					</div>
					@endforeach
				@endif
			</div>
		</div>

		<div class="txtIndex8">{!! isset($text_6) ? $text_6 : '' !!}</div>
		<div class="box-btn-txtIndex4">
			<div class="ic-arrow"><img src="{{FuncLib::getBaseUrl()}}assets/frontend/img/arrow-reg.png" alt=""></div>
			<div class="box-reg-click-book btn-box-reg-click-book">ĐĂNG KÝ TƯ VẤN MIỄN PHÍ</div>
		</div>

		<div class="txtIndex4">{!! isset($text_7) ? $text_7 : '' !!}</div>
		<div class="khoaHocNoiBat">
			<div class="row">
				@if(isset($dataTrainingHot) && !empty($dataTrainingHot))
					@foreach($dataTrainingHot as $item)
					<div class="col-lg-3 col-md-3 col-sm-3">
						<div class="exthome">
							<div class="box-video-img-show">
								@if($item->statics_image != '')
									<a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailNews($item->statics_id, $item->statics_title)}}">
										<img alt="{{$item->statics_title}}" src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_TRAINING, $item->statics_id, $item->statics_image, 800, 0, '', true, true)}}">
									</a>
								@endif
							</div>
						</div>
						<div class="indexContentkhoaHocNoiBat">
							<div class="title-video-hot"><a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailNews($item->statics_id, $item->statics_title)}}">{{stripcslashes($item->statics_title)}}</a></div>
							<div class="intro-video-hot">
								{{Utility::cutWord(stripcslashes(strip_tags($item->statics_intro)), 50)}}
							</div>
						</div>
						<div class="boxPriceKhoaHocNoiBat">
							@if($item->statics_price_normal > 0)
							<span class="price-normal">{{FuncLib::numberFormat($item->statics_price_normal)}}đ</span>
							@endif
							@if($item->statics_price_discount > 0)
							<span class="price-discount">{{FuncLib::numberFormat($item->statics_price_discount)}}đ</span>
							@endif
						</div>
					</div>
					@endforeach
				@endif
			</div>
		</div>

		<div class="txtIndex4">{!! isset($text_8) ? $text_8 : '' !!}</div>
		<div class="arrVideoHot">
			<div class="row">
				@if(isset($data_cat_3) && !empty($data_cat_3))
					@foreach($data_cat_3 as $key=>$item)
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="loadVideo exthome">
							<div class="box-video-img-show">
								@if($item->statics_image != '')
									<a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">
										<img alt="{{$item->statics_title}}" src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 800, 0, '', true, true)}}">
									</a>
								@endif
							</div>
						</div>
						<div class="indexContentVideoHot">
							<a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">
								<div class="title-video-hot">{{stripcslashes($item->statics_title)}}</div>
							</a>
							<div class="intro-video-hot">{!! stripcslashes($item->statics_intro) !!}</div>
						</div>
					</div>
					@endforeach
				@endif
			</div>
		</div>

		<div class="wrapText21">
			<div class="txtIndex21">{!! isset($text_9) ? $text_9 : '' !!}</div>
		</div>
		<div class="box-btn-txtIndex4">
			<div class="ic-arrow"><img src="{{FuncLib::getBaseUrl()}}assets/frontend/img/arrow-reg.png" alt=""></div>
			<div class="box-reg-click-book btn-box-reg-click-book">ĐĂNG KÝ TƯ VẤN MIỄN PHÍ</div>
		</div>

		<div class="txtIndex4">{!! isset($text_10) ? $text_10 : '' !!}</div>
		<div class="line mgt20 listPostNews">
			<div class="row">
				@if(isset($data_cat_4) && !empty($data_cat_4))
					@foreach($data_cat_4 as $key=>$item)
					<div class="col-lg-4 col-md-4 col-sm-4 item-post-cols">
						<div class="item">
							<a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">
								<div class="thumbI">
									@if($item->statics_image != '')
										<img alt="{{$item->statics_title}}" src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 800, 0, '', true, true)}}">
									@endif
									<div class="hover-rollover">
										<div class="hover-rollover-content">
											<a class="hover-rollover-link" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}"><i class="fa fa-link"></i></a>
											<h4 class="hover-rollover-title"><a href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">{{stripcslashes($item->statics_title)}}</a></h4>
											<div class="hover-rollover-categories">{{Utility::cutWord(stripcslashes(strip_tags($item->statics_intro)), 50)}}</div>
										</div>
									</div>
								</div>
								<a href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}"><h3 class="titlex">{{stripcslashes($item->statics_title)}}</h3></a>
							</a>
						</div>
					</div>
					@endforeach
				@endif
			</div>
		</div>

		<div class="txtIndex4">{!! isset($text_11) ? $text_11 : '' !!}</div>
		<div class="arrVideoHot ext">
			<div class="row">
				@if(isset($data_cat_5) && !empty($data_cat_5))
					@foreach($data_cat_5 as $key=>$item)
						@if($key == 0)
						<div class="col-lg-6 col-md-6 col-sm-6 mb boxVideo animated fadeInDown">
							<div class="loadVideo exthome lage">
								<div class="box-video-img-show clickViewVideo">
									@if($item->statics_image != '')
										<a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">
											<img alt="{{$item->statics_title}}" src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 800, 0, '', true, true)}}">
										</a>
									@endif
									<span class="icon-video-play"></span>
								</div>
								<a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">
									<div class="title-video-hot title-video-hot-lage">{{stripcslashes($item->statics_title)}}</div>
								</a>
							</div>
						</div>
						@endif
					@endforeach

					<div class="col-lg-6 col-md-6 col-sm-6 mb boxVideo animated fadeInRight">
						<div class="row">
							<div class="boxSubVideo">
								@foreach($data_cat_5 as $key=>$item)
									@if($key > 0)
									<div class="itemSubVideo">
										<div class="col-xs-5">
											<div class="row">
												<div class="thumbVideoSub">
													@if($item->statics_image != '')
														<a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">
															<img alt="{{$item->statics_title}}" src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $item->statics_id, $item->statics_image, 800, 0, '', true, true)}}">
														</a>
													@endif
												</div>
											</div>
										</div>
										<div class="col-xs-7">
											<a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">
												<div class="itemTitleSubVideo">{{stripcslashes($item->statics_title)}}</div>
											</a>
											<div class="itemIntroSubVideo">{{Utility::cutWord(stripcslashes(strip_tags($item->statics_intro)), 50)}}</div>
										</div>
									</div>
									@endif
								@endforeach
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
	@if(isset($dataPartners) && !empty($dataPartners))
		<div class="boxCustomerHome">
			<div class="title-heading-customer-center">
				Khách hàng đối tác<br><span></span>
			</div>
			<div class="content-customer-center">
				<div class="container">
					<ul>
						@foreach($dataPartners as $item)
							<li>
								<a {{$item['target']}} {{$item['rel']}} href="@if($item['banner_link'] != '') {{$item['banner_link']}} @else javascript:void(0) @endif" title="{{$item['banner_title_show']}}">
									<img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_BANNER, $item['banner_id'], $item['banner_image'], 1600, 0, '', true, true, false)}}" alt="{{$item['banner_title_show']}}" />
								</a>
							</li>
						@endforeach

					</ul>
				</div>
			</div>
		</div>
	@endif
	<div class="boxRegisterHome">
		<div class="title-heading-register-center">{!! isset($text_12) ? $text_12 : '' !!}</div>
		<div class="intro-heading-register-center">{!! isset($text_13) ? $text_13 : '' !!}</div>
		<div class="intro-heading-register">
			<form id="formSendContact" method="POST" class="formSendContact box-form-register" name="txtForm" action="{{URL::route('site.pageContactPost')}}">
				<div>
					<label>Tên của bạn (bắt buộc)
						<br>
						<input type="text" id="txtName" name="txtName" class="item-form-control">
					</label>
				</div>
				<div>
					<label>Địa chỉ Email
						<br>
						<input type="text" id="txtMail" name="txtMail" class="item-form-control">
					</label>
				</div>
				<div>
					<label>Tiêu đề:
						<br>
						<input type="text" name="txtTitle" class="item-form-control">
					</label>
				</div>
				<div>
					<label>Thông điệp
						<br>
						<textarea id="txtMessage" name="txtMessage" cols="40" rows="10" class="item-form-control"></textarea>
					</label>
				</div>
				<div>
					<input type="submit" value="Gửi đi" id="submitContact" class="item-btn-submit">
					{!! csrf_field() !!}
				</div>
			</form>
			<div class="box-column-note">
				{!! isset($text_14) ? $text_14 : '' !!}
			</div>
		</div>
	</div>
</div>
@include('Statics::content.component.popup-support')
<script>$(document).ready(function($){SITE.btnClickSupport();});</script>
@stop