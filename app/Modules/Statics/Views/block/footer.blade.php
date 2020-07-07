<?php
use App\Library\PHPDev\ThumbImg;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
?>
<div id="footer">
    <div class="line">
        <div class="boxLinkFooter">
            <div class="container">
                <div class="col-lg-5 col-md-5 col-sm-4 address logoF">
                    {!! $textaddress !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 address">
                    {!! $textLink !!}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 address ext">
                    {!! $textRight !!}
                </div>
            </div>
        </div>
    </div>
</div>
<span id="back-top"></span>
@if(isset($dataBannerSliderLeft) && sizeof($dataBannerSliderLeft) > 0)
    <div id="divAdRight"  class="imgSliderPage" style="DISPLAY: none; POSITION: absolute; margin-top: 50px">
        <div class="ads">
            @foreach($dataBannerSliderLeft as $item)
                <a {{$item['target']}} {{$item['rel']}} href="@if($item['banner_link'] != '') {{$item['banner_link']}} @else javascript:void(0) @endif" title="{{$item['banner_title_show']}}">
                    <img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_BANNER, $item['banner_id'], $item['banner_image'], 150, 0, '', true, true, false)}}" alt="{{$item['banner_title_show']}}" width="150px" />
                </a>
            @endforeach
        </div>
    </div>
@endif
@if(isset($dataBannerSliderRight) && sizeof($dataBannerSliderRight) > 0)
    <div id="divAdLeft" class="imgSliderPage" style="DISPLAY: none; POSITION: absolute; margin-top: 50px">
        <div class="ads">
            @foreach($dataBannerSliderRight as $item)
                <a {{$item['target']}} {{$item['rel']}} href="@if($item['banner_link'] != '') {{$item['banner_link']}} @else javascript:void(0) @endif" title="{{$item['banner_title_show']}}">
                    <img src="{{ThumbImg::thumbBaseNormal(CGlobal::FOLDER_BANNER, $item['banner_id'], $item['banner_image'], 150, 0, '', true, true, false)}}" alt="{{$item['banner_title_show']}}" width="150px"/>
                </a>
            @endforeach
        </div>
    </div>
@endif
@if((isset($dataBannerSliderLeft) && sizeof($dataBannerSliderLeft) > 0) && (isset($dataBannerSliderRight) && sizeof($dataBannerSliderRight) > 0))
    <script>
        function FloatTopDiv(){startLX=((document.body.clientWidth-MainContentW)/2)-LeftBannerW-LeftAdjust,startLY=TopAdjust+120;startRX=((document.body.clientWidth-MainContentW)/2)+MainContentW+RightAdjust,startRY=TopAdjust+120;var d=document;function ml(id){var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];el.sP=function(x,y){this.style.left=x+'px';this.style.top=y+'px'};el.x=startRX;el.y=startRY;return el}
            function m2(id){var e2=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];e2.sP=function(x,y){this.style.left=x+'px';this.style.top=y+'px'};e2.x=startLX;e2.y=startLY;return e2}
            window.stayTopLeft=function(){if(document.documentElement&&document.documentElement.scrollTop)
                var pY=document.documentElement.scrollTop;else if(document.body)
                var pY=document.body.scrollTop;if(document.body.scrollTop>80){startLY=3;startRY=3}else{startLY=TopAdjust;startRY=TopAdjust};ftlObj.y+=(pY+startRY-ftlObj.y)/15;ftlObj.sP(ftlObj.x,ftlObj.y);ftlObj2.y+=(pY+startLY-ftlObj2.y)/15;ftlObj2.sP(ftlObj2.x,ftlObj2.y);setTimeout("stayTopLeft()",1)}
            ftlObj=ml("divAdRight");ftlObj2=m2("divAdLeft");stayTopLeft()}
        function ShowAdDiv(){var objAdDivRight=document.getElementById("divAdRight");var objAdDivLeft=document.getElementById("divAdLeft");if(document.body.clientWidth<1065){objAdDivRight.style.display="none";objAdDivLeft.style.display="none"}else{objAdDivRight.style.display="block";objAdDivLeft.style.display="block";FloatTopDiv()}}
        document.write("<script type='text/javascript' language='javascript'>MainContentW = 1050;LeftBannerW = 150;RightBannerW = 130;LeftAdjust = 15;RightAdjust = 15;TopAdjust = 80;ShowAdDiv();window.onresize=ShowAdDiv;<\/script>");
    </script>
@endif
