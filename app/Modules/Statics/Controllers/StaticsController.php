<?php
/*
* @Created by: DUYNX
* @Author    : nguyenduypt86@gmail.com
* @Date      : 06/2016
* @Version   : 1.0
*/
namespace App\Modules\Statics\Controllers;

use App\Library\PHPDev\FuncLib;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\ValidForm;
use App\Modules\Models\Banner;
use App\Modules\Models\Contact;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\SEOMeta;
use App\Library\PHPDev\ThumbImg;
use App\Library\PHPDev\Utility;
use App\Modules\Models\Info;
use App\Library\PHPDev\Pagging;
use App\Modules\Models\Category;
use App\Modules\Models\Orders;
use App\Modules\Models\Statics;
use App\Modules\Models\Training;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class StaticsController extends BaseStaticsController{

    public function __construct(){
        parent::__construct();
    }

    public function index(){

        Loader::loadJS('libs/owl.carousel/owl.carousel.min.js', CGlobal::$postEnd);
        Loader::loadCSS('libs/owl.carousel/owl.carousel.min.css', CGlobal::$postHead);

        $meta_title = $meta_keywords = $meta_description = $meta_img = '';
        $arrMeta = Info::getItemByKeyword('SITE_SEO_HOME');
        if(!empty($arrMeta)){
            $meta_title = $arrMeta->meta_title;
            $meta_keywords = $arrMeta->meta_keywords;
            $meta_description = $arrMeta->meta_description;
            $meta_img = $arrMeta->info_img;
            if($meta_img != ''){
                $meta_img = ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $arrMeta->info_id, $arrMeta->info_img, 550, 0, '', true, true);
            }
        }
        SEOMeta::init($meta_img, $meta_title, $meta_keywords, $meta_description);

        $text_1 = self::viewShareVal('TEXT_1');
        $arr_text_2 = Info::getItemByKeyword('TEXT_2');
        $text_3 = self::viewShareVal('TEXT_3');
        $text_3_1 = self::viewShareVal('TEXT_3_1');
        $text_4 = self::viewShareVal('TEXT_4');

        //Chia se cua hoc vien
        $cat_1 = (int)strip_tags(self::viewShareVal('CAT_ID_1'));
        $data_cat_1 = [];
        if($cat_1 > 0){
            $data_search_1['statics_catid'] = $cat_1;
            $data_search_1['statics_order_no'] = 'asc';
            $data_cat_1 = Statics::getFocus($data_search_1, $limit=9);
        }

        $text_5 = self::viewShareVal('TEXT_5');


        //Phuong phap giang day khac biet...
        $cat_2 = (int)strip_tags(self::viewShareVal('CAT_ID_2'));
        $data_cat_2 = [];
        if($cat_2 > 0){
            $data_search_2['statics_catid'] = $cat_2;
            $data_search_2['statics_order_no'] = 'asc';
            $data_cat_2 = Statics::getFocus($data_search_2, $limit=3);
        }

        $text_6 = self::viewShareVal('TEXT_6');
        $text_7 = self::viewShareVal('TEXT_7');
        $text_8 = self::viewShareVal('TEXT_8');

        //Viện Phong Thủy Hoàng Gia Việt Nam luôn là địa chỉ tin cậy về đào tạo Phong Thủy và dịch lý
        $cat_3 = (int)strip_tags(self::viewShareVal('CAT_ID_3'));
        $data_cat_3 = [];
        if($cat_3 > 0){
            $data_search_3['statics_catid'] = $cat_3;
            $data_search_3['statics_order_no'] = 'asc';
            $data_cat_3 = Statics::getFocus($data_search_3, $limit=3);
        }


        $text_9 = self::viewShareVal('TEXT_9');

        //Khoa hoc noi bat
        $dataSearchTraining['statics_order_no'] = 'asc';
        $dataTrainingHot = Training::getFocus($dataSearchTraining, $limit=8);

        //Cat hoat dong cua lop
        $text_10 = self::viewShareVal('TEXT_10');
        $cat_4 = (int)strip_tags(self::viewShareVal('CAT_ID_4'));
        $data_cat_4 = [];
        if($cat_4 > 0){
            $data_search_4['statics_catid'] = $cat_4;
            $data_search_4['statics_order_no'] = 'asc';
            $data_cat_4 = Statics::getFocus($data_search_4, $limit=3);
        }

        //Kien thuc chia se moi ngay
        $text_11 = self::viewShareVal('TEXT_11');
        $cat_5 = (int)strip_tags(self::viewShareVal('CAT_ID_5'));
        $data_cat_5 = [];
        if($data_cat_5 > 0){
            $data_search_5['statics_catid'] = $cat_5;
            $data_search_5['statics_order_no'] = 'asc';
            $data_cat_5 = Statics::getFocus($data_search_5, $limit=3);
        }


        //Logo partners
        $searchPartners['banner_status'] = CGlobal::status_show;
        $searchPartners['banner_type'] = 3;
        $searchPartners['field_get'] = 'banner_id,banner_title,banner_title_show,banner_image,banner_link,banner_is_target,banner_is_rel,banner_is_run_time,banner_start_time,banner_end_time';
        $dataPartners = Banner::getBannerSite($searchPartners, $limit=50, 'partners');
        $dataPartners = FuncLib::checkBannerShow($dataPartners);


        $text_12 = self::viewShareVal('TEXT_12');
        $text_13 = self::viewShareVal('TEXT_13');
        $text_14 = self::viewShareVal('TEXT_14');

        $messages = Utility::messages('messages');

        return view('Statics::content.index', [
            'messages'=>$messages,
            'text_1'=>$text_1,
            'arr_text_2'=>$arr_text_2,
            'text_3'=>$text_3,
            'text_3_1'=>$text_3_1,
            'text_4'=>$text_4,
            'data_cat_1'=>$data_cat_1,
            'text_5'=>$text_5,
            'data_cat_2'=>$data_cat_2,
            'text_6'=>$text_6,
            'text_7'=>$text_7,
            'text_8'=>$text_8,
            'data_cat_3'=>$data_cat_3,
            'text_9'=>$text_9,
            'dataTrainingHot'=>$dataTrainingHot,
            'text_10'=>$text_10,
            'data_cat_4'=>$data_cat_4,
            'text_11'=>$text_11,
            'data_cat_5'=>$data_cat_5,
            'dataPartners'=>$dataPartners,
            'text_12'=>$text_12,
            'text_13'=>$text_13,
            'text_14'=>$text_14,
        ]);
    }

    public function actionRouter($catname, $catid){
        if($catid > 0 && $catname != ''){
            $arrCat = Category::getById($catid);
            if($arrCat != null){
                $type_keyword = $arrCat->category_type_keyword;
                if($type_keyword == 'group_static'){
                    return self::pageStatic($catname, $catid);
                }
                if($type_keyword == 'group_news'){
                    return self::pageNews($catname, $catid);
                }
            }else{
                return Redirect::route('page.404');
            }
        }else{
            return Redirect::route('page.404');
        }
    }

    public function pageStatic($catname, $catid){

        //Config Page
        $pageNo = (int) Request::get('page', 1);
        $pageScroll = CGlobal::num_scroll_page;
        $limit = CGlobal::num_record_per_page_news;
        $offset = ($pageNo - 1) * $limit;
        $search = $data = $dataCate = array();
        $total = 0;
        $paging = '';
        if($catid > 0){
            $search['statics_cat_alias'] = $catname;
            $search['statics_catid'] = $catid;
            $search['statics_status'] = CGlobal::status_show;
            $search['field_get'] = 'statics_id,statics_catid,statics_cat_name,statics_cat_alias,statics_title,statics_intro,statics_content,statics_image,statics_created';
            $data = Statics::searchByCondition($search, $limit, $offset, $total);
            $paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';
            $dataCate = Category::getById($catid);
        }
        if(isset($dataCate->category_id)){
            $meta_title = $dataCate->meta_title;
            $meta_keywords = $dataCate->meta_keywords;
            $meta_description = $dataCate->meta_description;
            SEOMeta::init('', $meta_title, $meta_keywords, $meta_description);
        }

        /*
        $searchHotNews['field_get'] = 'statics_id,statics_catid,statics_cat_name,statics_cat_alias,statics_title,statics_intro,statics_content,statics_image,statics_created';
        $arrNewsFocus = Statics::getFocus($searchHotNews, 10);
        */

        return view('Statics::content.pageStatics', [
            'data'=>$data,
            'dataCate'=>$dataCate,
            'paging'=>$paging,
            //'arrNewsFocus'=>$arrNewsFocus,
        ]);
    }
    public function detailStatics($name='', $id=0){
        $data = $dataSame = $dataCate = array();
        if($id > 0){
            $data = Statics::getById($id);
            if(!isset($data->statics_id)){
                return Redirect::route('page.404');
            }
            $dataCate = Category::getById($data->statics_catid);
        }

        //Meta title
        if(isset($data->statics_id)){
            $meta_title = $data->meta_title;
            $meta_keywords = $data->meta_keywords;
            $meta_description = $data->meta_description;
            $meta_img = $data->statics_image;
            if($meta_img != ''){
                $meta_img = ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $data->statics_id, $data->statics_image, 550, 0, '', true, true);
            }
            SEOMeta::init($meta_img, $meta_title , $meta_keywords, $meta_description);

            //Update View Num
            $dataUpdate['statics_view_num'] = (int)$data->statics_view_num + 1;
            Statics::updateData($id, $dataUpdate);

            $searchSame['field_get'] = 'statics_id,statics_catid,statics_cat_name,statics_cat_alias,statics_title,statics_intro,statics_content,statics_image,statics_created';
            $dataSame = Statics::getSameData($id, $data->statics_catid,$limit=10, $searchSame);
        }
        /*
        $searchHotNews['field_get'] = 'statics_id,statics_catid,statics_cat_name,statics_cat_alias,statics_title,statics_intro,statics_content,statics_image,statics_created';
        $arrNewsFocus = Statics::getFocus($searchHotNews, 10);
        */
        return view('Statics::content.pageStaticsDetail', [
            'id'=>$id,
            'data'=>$data,
            'dataSame'=>$dataSame,
            //'arrNewsFocus'=>$arrNewsFocus,
            'dataCate'=>$dataCate,
        ]);
    }

    public function pageNews($catname, $catid){

        //Config Page
        $pageNo = (int) Request::get('page', 1);
        $pageScroll = CGlobal::num_scroll_page;
        $limit = CGlobal::num_record_per_page_news;
        $offset = ($pageNo - 1) * $limit;
        $search = $data = $dataCate = array();
        $total = 0;
        $paging = '';
        if($catid > 0){
            $search['statics_cat_alias'] = $catname;
            $search['statics_catid'] = $catid;
            $search['statics_status'] = CGlobal::status_show;
            $search['field_get'] = '';
            $data = Training::searchByCondition($search, $limit, $offset, $total);
            $paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';
            $dataCate = Category::getById($catid);
        }
        if(isset($dataCate->category_id)){
            $meta_title = $dataCate->meta_title;
            $meta_keywords = $dataCate->meta_keywords;
            $meta_description = $dataCate->meta_description;
            SEOMeta::init('', $meta_title, $meta_keywords, $meta_description);
        }

        $text_15 = self::viewShareVal('TEXT_15');
        $text_16 = self::viewShareVal('TEXT_16');
        $text_17 = self::viewShareVal('TEXT_17');

        $searchHotNews['field_get'] = 'statics_id,statics_catid,statics_cat_name,statics_cat_alias,statics_title,statics_intro,statics_content,statics_image,statics_created';
        $arrNewsFocus = Statics::getFocus($searchHotNews, 5);

        $dataSearchTraining['statics_order_no'] = 'asc';
        $dataTrainingHot = Training::getFocus($dataSearchTraining, $limit=20);

        $textLinkFanpage = strip_tags(self::viewShareVal('LINK_FANPATE'));

        return view('Statics::content.pageNews', [
            'data'=>$data,
            'dataCate'=>$dataCate,
            'paging'=>$paging,
            'text_15'=>$text_15,
            'text_16'=>$text_16,
            'arrNewsFocus'=>$arrNewsFocus,
            'dataTrainingHot'=>$dataTrainingHot,
            'textLinkFanpage'=>$textLinkFanpage,
            'text_17'=>$text_17,
        ]);
    }
    public function detailNews($name='', $id=0){
        $data = $dataSame = $dataCate = array();
        if($id > 0){
            $data = Training::getById($id);
            if(!isset($data->statics_id)){
                return Redirect::route('page.404');
            }
            $dataCate = Category::getById($data->statics_catid);
        }

        //Meta title
        if(isset($data->statics_id)){
            $meta_title = $data->meta_title;
            $meta_keywords = $data->meta_keywords;
            $meta_description = $data->meta_description;
            $meta_img = $data->statics_image;
            if($meta_img != ''){
                $meta_img = ThumbImg::thumbBaseNormal(CGlobal::FOLDER_STATICS, $data->statics_id, $data->statics_image, 550, 0, '', true, true);
            }
            SEOMeta::init($meta_img, $meta_title, $meta_keywords, $meta_description);

            //Update View Num
            $dataUpdate['statics_view_num'] = (int)$data->statics_view_num + 1;
            Training::updateData($id, $dataUpdate);
        }

        $text_15 = self::viewShareVal('TEXT_15');
        $text_16 = self::viewShareVal('TEXT_16');
        $text_17 = self::viewShareVal('TEXT_17');

        $dataSearchTraining['statics_order_no'] = 'asc';
        $dataTrainingHot = Training::getFocus($dataSearchTraining, $limit=20);

        $searchHotNews['field_get'] = 'statics_id,statics_catid,statics_cat_name,statics_cat_alias,statics_title,statics_intro,statics_content,statics_image,statics_created';
        $arrNewsFocus = Statics::getFocus($searchHotNews, 20);

        $textLinkFanpage = strip_tags(self::viewShareVal('LINK_FANPATE'));

        return view('Statics::content.pageNewsDetail', [
            'id'=>$id,
            'data'=>$data,
            'dataSame'=>$dataSame,
            'arrNewsFocus'=>$arrNewsFocus,
            'dataCate'=>$dataCate,
            'text_15'=>$text_15,
            'text_16'=>$text_16,
            'dataTrainingHot'=>$dataTrainingHot,
            'textLinkFanpage'=>$textLinkFanpage,
            'text_17'=>$text_17,
        ]);
    }

    public function pageContact(){

        $arrContact = Info::getItemByKeyword('SITE_SEO_CONTACT');
        $arrJoin = Info::getItemByKeyword('SITE_JOIN');
        $messages = Utility::messages('messages');

        if(isset($arrContact->info_id)){
            $meta_title = $arrContact->meta_title;
            $meta_keywords = $arrContact->meta_keywords;
            $meta_description = $arrContact->meta_description;
            $meta_img = $arrContact->info_img;
            if($meta_img != ''){
                $meta_img = ThumbImg::thumbBaseNormal(CGlobal::FOLDER_INFO, $arrContact->info_id, $arrContact->info_img, 550, 0, '', true, true);
            }
            SEOMeta::init($meta_img, $meta_title, $meta_keywords, $meta_description);
        }

        if(!empty($_POST)){
            $contact_name = addslashes(Request::get('txtName', ''));
            $contact_title = addslashes(Request::get('txtTitle', ''));
            $contact_phone = addslashes(Request::get('txtMobile', ''));
            $contact_email = addslashes(Request::get('txtMail', ''));
            $contact_address = addslashes(Request::get('txtAddress', ''));
            $contact_content = addslashes(Request::get('txtMessage', ''));
            $contact_created = time();
            $check_mail = ValidForm::checkRegexEmail($contact_email);

            if($contact_title != '' && $contact_email !='' && $check_mail){
                $dataInput = array(
                    'contact_title'=>$contact_name.' : '.$contact_title,
                    'contact_phone'=>$contact_phone,
                    'contact_email'=>$contact_email,
                    'contact_address'=>$contact_address,
                    'contact_content'=>$contact_content,
                    'contact_created'=>$contact_created,
                    'contact_type'=>CGlobal::status_int_1,
                    'contact_status'=>0
                );
                $query = Contact::addData($dataInput);
                if($query > 0){
                    Utility::messages('messages', 'Cảm ơn bạn đã gửi thông tin liên hệ. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!');
                    return Redirect::route('site.pageContact');
                }
            }
        }
        return view('Statics::content.pageContact',[
            'arrContact'=>$arrContact,
            'arrJoin'=>$arrJoin,
            'messages'=>$messages
        ]);
    }
    public function pageContactPost(){
        if(!empty($_POST)){
            $contact_name = addslashes(Request::get('txtName', ''));
            $contact_title = addslashes(Request::get('txtTitle', ''));
            $contact_phone = addslashes(Request::get('txtMobile', ''));
            $contact_email = addslashes(Request::get('txtMail', ''));
            $contact_address = addslashes(Request::get('txtAddress', ''));
            $contact_content = addslashes(Request::get('txtMessage', ''));
            $contact_created = time();

            $check_mail = ValidForm::checkRegexEmail($contact_email);

            if($contact_title != '' && $contact_email !='' && $check_mail){
                $dataInput = array(
                    'contact_title'=>$contact_name.' : '.$contact_title,
                    'contact_phone'=>$contact_phone,
                    'contact_email'=>$contact_email,
                    'contact_address'=>$contact_address,
                    'contact_content'=>$contact_content,
                    'contact_created'=>$contact_created,
                    'contact_type'=>CGlobal::status_int_1,
                    'contact_status'=>0
                );
                $query = Contact::addData($dataInput);
                if($query > 0){
                    Utility::messages('messages', 'Cảm ơn bạn đã gửi thông tin liên hệ. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!');
                    return Redirect::route('SIndex');
                }
            }
        }

        Utility::messages('messages', 'Thông tin liên hệ chưa đúng. bạn vui lòng nhập lại!', 'error');
        return Redirect::route('SIndex');
    }
    public function pageTrainingPost(){
        if(!empty($_POST)){
            $contact_news_id = (int)Request::get('txtNewsId', 0);
            $contact_name = addslashes(Request::get('txtName', ''));
            $contact_title = addslashes(Request::get('txtTitle', ''));
            $contact_phone = addslashes(Request::get('txtMobile', ''));
            $contact_email = addslashes(Request::get('txtMail', ''));
            $contact_address = addslashes(Request::get('txtAddress', ''));
            $contact_content = addslashes(Request::get('txtMessage', ''));
            $contact_created = time();

            $check_mail = ValidForm::checkRegexEmail($contact_email);

            if($contact_title != '' && $contact_email !='' && $check_mail){
                if($contact_news_id > 0){
                    $objNews = Training::getById($contact_news_id);
                    if(isset($objNews->statics_id)){
                        $contact_content .= '<br> Học viên đăng ký khóa học' . addslashes($objNews->statics_title);
                    }
                }

                $dataInput = array(
                    'contact_title'=>$contact_name.' : '.$contact_title,
                    'contact_phone'=>$contact_phone,
                    'contact_email'=>$contact_email,
                    'contact_address'=>$contact_address,
                    'contact_content'=>$contact_content,
                    'contact_created'=>$contact_created,
                    'contact_type'=>CGlobal::status_int_2,
                    'contact_status'=>0
                );
                $query = Contact::addData($dataInput);
                if($query > 0){
                    Utility::messages('messages', 'Cảm ơn bạn đã đăng ký khóa học. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!');
                    return Redirect::route('SIndex');
                }
            }
        }

        Utility::messages('messages', 'Thông tin đăng ký khóa học chưa đúng. bạn vui lòng nhập lại!', 'error');
        return Redirect::route('SIndex');
    }
    public function noteTrainingPost(){
        if(!empty($_POST)){
            $data = $_POST;
            foreach($data as $key=>$val){
                $data[$key] = addslashes($val);
                if(isset($data['_token'])){
                    unset($data['_token']);
                }
            }
            $data['status'] = CGlobal::status_int_0;
            $data['created'] = time();
            $query = Orders::addData($data);
            if($query > 0){
                Utility::messages('messages', 'Cảm ơn bạn đã gửi thông tin. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất!');
                return Redirect::route('SIndex');
            }
        }
        return Redirect::route('SIndex');
    }
}