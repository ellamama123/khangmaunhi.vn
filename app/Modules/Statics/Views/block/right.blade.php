<?php
use App\Library\PHPDev\ThumbImg;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\Loader;

if(isset($data)){
    if(isset($data[0])){
        $data = $data[0];
    }
}

?>
@if(isset($data->statics_note))
<div class="post-meta">
    <div class="course-meta">
        <span>{{stripcslashes($data->statics_note)}}</span>
    </div>
</div>
@endif

@if(isset($text_15) && $text_15 != '')
    <div class="card-title">
        <div class="title-bank">Tài khoản thanh toán</div>
        <div class="bg-defaut">{!! $text_15 !!}</div>
    </div>
@endif

@if(isset($textLinkFanpage) && $textLinkFanpage != '')
    <div class="line">
        <div id="fb-root"></div>
        <script async defer src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2&appId=685975718241032&autoLogAppEvents=1"></script>
        <div id="fb-root"></div>
        <div class="fb-page" data-width="240" data-href="{{$textLinkFanpage}}" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="{{$textLinkFanpage}}" class="fb-xfbml-parse-ignore"><a href="{{$textLinkFanpage}}">Phong Thủy Nguyễn Hoàng</a></blockquote></div>
    </div>
@endif
