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
<div class="content2">
    <div class="container">
        <div class="row">
            <p class="duongdan"><a href="#">Trang chủ</a> / <a href="#">An thai</a> / <a href="#">An thai như nào cho đúng ? </a></p>
            <div class="col-md-8">
                <h4 class="title">
                    Cách tính giới tính thai sinh
                </h4>
                <p class="date">07/09/2020</p>
                <p class="strong">numerating objects: 40, done.
                                        Counting objects: 100% (40/40), done.
                                        Delta compression</p>
                <p class="text">numerating objects: 40, done.
                                        Counting objects: 100% (40/40), done.
                                        Delta compression</p>
                <img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/anh_bai_viet.png" class="anh-bai-viet" />
                <p class="text">numerating objects: 40, done.
                                        Counting objects: 100% (40/40), done.
                                        Delta compression</p>
                <p class="text">Sau khi giao bài tập cho học viên, giáo viên sẽ theo dõi quá trình nộp và thời gian nộp bài tập của học viên để có cái nhìn tổng quát hơn về tình hình học tập của lớp.
Tại giao diện chính của lớp học, bạn nhấn chọn nút menu ở góc trên bên trái của màn hình (kí hiệu 3 dòng ngang), một menu xuất hiện, bạn lựa chọn như hình sau:</p>
            </div>
            <div class="col-md-4">
                <div class="video">
                <iframe width="349" height="217" src="https://www.youtube.com/embed/RoTvidpL1gM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="xemthem">
                    <h4 class="title">XEM THÊM</h4>
                    <ul>
                        <li>Bài thuốc tự nhiên giúp an thai hiệu quả , cả mẹ và bé khỏe manh</li>
                        <li>Bài thuốc tự nhiên giúp an thai hiệu quả , cả mẹ và bé khỏe manh</li>
                    </ul>
                </div>
                <div class="noi-bat">
                    <h4 class="title">BÀI ĐỌC NHIỀU NHẤT</h4>
                    <ul>
                        <li>
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/anhsp1.png" />
                                </div>
                                <div class="col-md-7">
                                    <h4 class="title">Cách tính giới tình thai nhi</h4>
                                    <p class="date">07/09/2020</p>
                                    <p class="title">numerating objects: 40, done.
                                        Counting objects: 100% (40/40), done.
                                        Delta compression
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/anhsp1.png" />
                                </div>
                                <div class="col-md-7">
                                    <h4 class="title">Cách tính giới tình thai nhi</h4>
                                    <p class="date">07/09/2020</p>
                                    <p class="title">numerating objects: 40, done.
                                        Counting objects: 100% (40/40), done.
                                        Delta compression
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/anhsp1.png" />
                                </div>
                                <div class="col-md-7">
                                    <h4 class="title">Cách tính giới tình thai nhi</h4>
                                    <p class="date">07/09/2020</p>
                                    <p class="title">numerating objects: 40, done.
                                        Counting objects: 100% (40/40), done.
                                        Delta compression
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/anhsp1.png" />
                                </div>
                                <div class="col-md-7">
                                    <h4 class="title">Cách tính giới tình thai nhi</h4>
                                    <p class="date">07/09/2020</p>
                                    <p class="title">numerating objects: 40, done.
                                        Counting objects: 100% (40/40), done.
                                        Delta compression
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/anhsp1.png" />
                                </div>
                                <div class="col-md-7">
                                    <h4 class="title">Cách tính giới tình thai nhi</h4>
                                    <p class="date">07/09/2020</p>
                                    <p class="title">numerating objects: 40, done.
                                        Counting objects: 100% (40/40), done.
                                        Delta compression
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="ask">
                    <h4>HỎI CHUYÊN GIA</h4>
                    <p>Họ và tên * </p>
                    <input type="text" />
                    <p>Điện thoại *</p>
                    <input type="text" />
                    <p>Triệu chứng * </p>
                    <textarea name="" id="" cols="43%" rows="10"></textarea>
                    <button>Gửi liên hệ</button>
                </div>
                <div class="kn">
                    <p>KẾT NỐI VỚI CHÚNG TÔI</p>
                    <img src="http://localhost:8888/khangmaunhi.vn/public/assets/frontend/img/nhataitro.png" />
                </div>
            </div>
        </div>
    </div>
</div>
@stop