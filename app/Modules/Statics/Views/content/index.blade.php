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
<div class="content1">
	<div class="anhbia">
		<img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/bn_02.png" />
	</div>
	<div class="container">
		<div class="gt">
			<div class="row">
				<div class="col-md-7">
					<h3 class="title">VÌ SAO KHANG MẪU NHI GIÚP HỖ TRỢ AN THAI HIỆU QUẢ?</h3>
					<p class="text">numerating objects: 40, done.Counting objects: 100% (40/40), done. Delta compression</p>
					<p class="text">numerating objects: 40, done.Counting objects: 100% (40/40), done. Delta compression</p>
				</div>
				<div class="col-md-5">
					<img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/H_PNG000.png" alt="">
				</div>
			</div>
		</div>
		<div class="chuyen-gia">
			<h3 class="title">CHUYÊN GIA NÓI GÌ VỀ SẢN PHẨM</h3>
			<div class="row">
				<div class="col-md-4">
					<img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/chuyen-gia.png" />
					<p class="name">Bác sĩ Nguyễn Lan Anh</p>
					<p class="quote">abc def ghijklmn on pq qladf jwnf klsw</p>
				</div>
				<div class="col-md-4">
					<img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/chuyen-gia.png" />
					<p class="name">Bác sĩ Nguyễn Lan Anh</p>
					<p class="quote">abc def ghijklmn on pq qladf jwnf klsw</p>
				</div>
				<div class="col-md-4">
					<img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/chuyen-gia.png" />
					<p class="name">Bác sĩ Nguyễn Lan Anh</p>
					<p class="quote">abc def ghijklmn on pq qladf jwnf klsw</p>
				</div>
			</div>
		</div>
		<div class="khach-hang">
			<h3 class="title">KHÁCH HÀNG NÓI GÌ VỀ SẢN PHẨM</h3>
			<div class="row">
				<div class="col-md-4">
					<iframe width="349" height="219" src="https://www.youtube.com/embed/RoTvidpL1gM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<p>skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp</p>
				</div>
				<div class="col-md-4">
					<iframe width="349" height="219" src="https://www.youtube.com/embed/RoTvidpL1gM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<p>skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp</p>
				</div>
				<div class="col-md-4">
					<iframe width="349" height="219" src="https://www.youtube.com/embed/RoTvidpL1gM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<p>skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp</p>
				</div>
			</div>
		</div>
	</div>
	<div class="gioithieu" >
		<img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/anhgt.png"  width="100%" alt="">
	</div>
	<div class="container">
		<div class="dang-ky">
			<div class="row">
				<div class="col-md-8">
					<h5>ĐĂNG KÝ GẶP DƯỢC SĨ</h5>
					<div class="row">
						<div class="col-md-6">
							<p>Họ và tên *</p>
							<input type="text" />
						</div>
						<div class="col-md-6">
							<p>Điện thoại*</p>
							<input type="text" />
						</div>
						<div class="col-md-12">
							<p>Triệu chứng *</p>
							<textarea name="" id="" cols="94%" rows="10"></textarea>
						</div>
						<div class="col-md-12">
							<button>Gửi liên hệ</button>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<h5>TIN MỚI</h5>
					<ul>
						<li>
							<p class="title">Bà bầu nên kiêng gì</p>
							<p class="date">07/09/2018</p>
							<p class="text">skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp</p>
						</li>
						<li>
							<p class="title">Bà bầu nên kiêng gì</p>
							<p class="date">07/09/2018</p>
							<p class="text">skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp</p>
						</li>
						<li>
							<p class="title">Bà bầu nên kiêng gì</p>
							<p class="date">07/09/2018</p>
							<p class="text">skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp skd kdskd skdsd skdsdsdk sdsdkdsjkdsd sdjsdsdk skdskd sálp</p>
						</li>
					</ul>

				</div>
			</div>
		</div>

	</div>
</div>
@stop