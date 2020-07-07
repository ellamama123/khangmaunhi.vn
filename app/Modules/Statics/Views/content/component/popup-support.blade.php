<?php
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\FuncLib;
?>
<div class="sys-popup-support content-popup-show popup-buy-card fade" style="display:none">
    <div class="modal-dialog modal-dialog-popup">
        <div class="modal-content bgIndex">
            <div class="modal-title-classic">ĐĂNG KÝ TƯ VẤN MIỄN PHÍ <span class="btn-close" data-dismiss="modal">X</span></div>
            <div class="content-popup-body">
                <div class="views-section-cards">
                    <div class="contentSupport">
                        <form id="formSendContact" method="POST" class="formSendContact box-form-register" name="txtForm" action="{{URL::route('site.pageContactPost')}}">
                            <div>
                                <label>Tên của bạn(bắt buộc)
                                    <br>
                                    <input type="text" name="txtName" class="item-form-control txtName">
                                </label>
                            </div>
                            <div>
                                <label>Số điện thoại(bắt buộc)
                                    <br>
                                    <input type="text" name="txtMobile" class="item-form-control txtMobile">
                                </label>
                            </div>
                            <div>
                                <label>Địa chỉ Email
                                    <br>
                                    <input type="text" name="txtMail" class="item-form-control txtMail">
                                </label>
                            </div>
                            <div>
                                <label>Tiêu đề:
                                    <br>
                                    <input type="text" name="txtTitle" class="item-form-control" txtTitle>
                                </label>
                            </div>
                            <div>
                                <input type="submit" value="Gửi đi" class="submitContact" class="item-btn-submit">
                                {!! csrf_field() !!}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
