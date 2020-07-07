<?php
use App\Library\PHPDev\ThumbImg;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\Loader;
Loader::loadJS('libs/calendar/amlich-hnd.js', CGlobal::$postHead);
?>
<div class="boxCalendars">
    <script type="text/javascript">function viewSelectedMonth(){setOutputSize("small");var s = printSelectedMonth();document.open();document.writeln(s);document.close();}viewSelectedMonth();</script>
</div>

@if(isset($dataTrainingHot) && !empty($dataTrainingHot))
    <div class="boxNewsHot listTraining">
        <div class="title-bank-ext">DỊCH VỤ</div>
        <ul>
            @foreach($dataTrainingHot as $k=>$item)
                <li>
                    <h3 class="hot-post-title">
                        <a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailNews($item->statics_id, $item->statics_title)}}">{{$item->statics_title}}</a>
                    </h3>
                </li>
            @endforeach
        </ul>
    </div>
@endif

@if(isset($arrNewsFocus) && !empty($arrNewsFocus))
    <div class="boxNewsHot listNewsHots">
        <div class="title-bank-ext">BÀI VIẾT HAY</div>
        <ul>
            @foreach($arrNewsFocus as $k=>$item)
                <li>
                    <h3 class="hot-post-title">
                        <a title="{{$item->statics_title}}" href="{{FuncLib::buildLinkDetailStatic($item->statics_id, $item->statics_title)}}">{{$item->statics_title}}</a>
                    </h3>
                </li>
            @endforeach
        </ul>
    </div>
@endif
