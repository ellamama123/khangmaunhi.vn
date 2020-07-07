<?php
/*
* @Created by: DUYNX
* @Author    : nguyenduypt86@gmail.com
* @Date      : 06/2016
* @Version   : 1.0
*/
namespace App\Modules\Admin\Controllers;

use App\Library\PHPDev\CDate;
use App\Modules\Models\Training;
use App\Modules\Models\Type;
use App\Modules\Models\Category;
use App\Modules\Models\Trash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ValidForm;
use App\Library\PHPDev\ThumbImg;

class TrainingController extends BaseAdminController{

	private $arrStatus = array(-1 => 'Chọn', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
	private $arrFocus = array(-1 => 'Chọn', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
	private $arrCate = array(-1=>'Chọn danh mục cha');
	private $strCategoryProduct = '';
	private $error = '';
	public function __construct(){
		parent::__construct();
		Loader::loadJS('backend/js/admin.js', CGlobal::$postEnd);
		Loader::loadCSS('libs/upload/cssUpload.css', CGlobal::$postHead);
		Loader::loadJS('libs/upload/jquery.uploadfile.js', CGlobal::$postEnd);
		Loader::loadJS('backend/js/upload-admin.js', CGlobal::$postEnd);
		Loader::loadJS('libs/dragsort/jquery.dragsort.js', CGlobal::$postHead);
		Loader::loadCSS('libs/jAlert/jquery.alerts.css', CGlobal::$postHead);
		Loader::loadJS('libs/jAlert/jquery.alerts.js', CGlobal::$postEnd);

		Loader::loadCSS('libs/datetimepicker/datetimepicker.css', CGlobal::$postHead);
		Loader::loadJS('libs/datetimepicker/jquery.datetimepicker.js', CGlobal::$postEnd);
		Loader::loadJS('libs/number/autoNumeric.js', CGlobal::$postHead);

		$typeId = Type::getIdByKeyword('group_news');
		$this->arrCate = CategoryController::getArrCategory($typeId);
	}
	public function listView(){

		//Config Page
		$pageNo = (int) Request::get('page', 1);
		$pageScroll = CGlobal::num_scroll_page;
		$limit = CGlobal::num_record_per_page;
		$offset = ($pageNo - 1) * $limit;
		$search = $data = array();
		$total = 0;
		
		$search['statics_catid'] = (int)Request::get('statics_catid', -1);
		$search['statics_title'] = addslashes(Request::get('statics_title', ''));
		$search['statics_status'] = (int)Request::get('statics_status', -1);
		$search['statics_focus'] = (int)Request::get('statics_focus', -1);
		$search['submit'] = (int)Request::get('submit', 0);
		$search['field_get'] = '';
		
		$dataSearch = Training::searchByCondition($search, $limit, $offset, $total);
		$paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';
		
		$optionStatus = Utility::getOption($this->arrStatus, $search['statics_status']);
		$optionFocus = Utility::getOption($this->arrFocus, $search['statics_focus']);

		$messages = Utility::messages('messages');
		$typeId = Type::getIdByKeyword('group_news');
		$this->strCategoryProduct = CategoryController::createOptionCategory($typeId, isset($search['statics_catid']) ? $search['statics_catid'] : 0);

		return view('Admin::training.list',[
					'data'=>$dataSearch,
					'total'=>$total,
					'paging'=>$paging,
					'arrStatus'=>$this->arrStatus,
					'optionStatus'=>$optionStatus,
					'optionFocus'=>$optionFocus,
					'arrCate'=>$this->arrCate,
					'strCategoryProduct'=>$this->strCategoryProduct,
					'search'=>$search,
					'messages'=>$messages,
				]);
	}
	public function getItem($id=0){

		Loader::loadJS('libs/ckeditor/ckeditor.js', CGlobal::$postHead);

		$data = array();
        $statics_image = '';
        $statics_image_other = array();

		if($id > 0) {
			$data = Training::getById($id);
			if($data != null){
				if($data->statics_image_other != ''){
					$staticsImageOther = unserialize($data->statics_image_other);
					if(!empty($staticsImageOther)){
						foreach($staticsImageOther as $k=>$v){
							$url_thumb = ThumbImg::thumbBaseNormal(CGlobal::FOLDER_TRAINING, $id, $v, 400, 400, '', true, true);
							$statics_image_other[] = array('img_other'=>$v,'src_img_other'=>$url_thumb);
						}
					}
				}
				//Main Img
				$statics_image = trim($data->statics_image);
			}
		}

		$optionStatus = Utility::getOption($this->arrStatus, isset($data['statics_status'])? $data['statics_status'] : CGlobal::status_show);
		$optionFocus = Utility::getOption($this->arrFocus, isset($data['statics_focus'])? $data['statics_focus'] : CGlobal::status_hide);
		$typeId = Type::getIdByKeyword('group_news');
		$this->strCategoryProduct = CategoryController::createOptionCategory($typeId, isset($data['statics_catid'])? $data['statics_catid'] : 0);

		return view('Admin::training.add',[
					'id'=>$id,
					'data'=>$data,
					'optionStatus'=>$optionStatus,
					'optionFocus'=>$optionFocus,
					'news_image'=>$statics_image,
					'news_image_other'=>$statics_image_other,
					'optionCategoryProduct'=>$this->strCategoryProduct,
					'error'=>$this->error,
				]);

	}
	public function postItem($id=0){

		Loader::loadJS('libs/ckeditor/ckeditor.js', CGlobal::$postHead);

		$id_hiden = (int)Request::get('id_hiden', 0);
		$data = array();
		
		$dataSave = array(
				'statics_title'=>array('value'=>addslashes(Request::get('statics_title')), 'require'=>1, 'messages'=>'Tiêu đề không được trống!'),
				'statics_catid'=>array('value'=>(int)(Request::get('statics_catid')),'require'=>0),
				'statics_intro'=>array('value'=>addslashes(Request::get('statics_intro')),'require'=>0),
				'statics_content'=>array('value'=>addslashes(Request::get('statics_content')),'require'=>0),
				'statics_order_no'=>array('value'=>(int)addslashes(Request::get('statics_order_no')),'require'=>0),
				'statics_created'=>array('value'=>time()),
				'statics_status'=>array('value'=>(int)Request::get('statics_status', -1),'require'=>0),
				'statics_focus'=>array('value'=>(int)Request::get('statics_focus', -1),'require'=>0),

				'statics_num'=>array('value'=>(int)Request::get('statics_num', 0),'require'=>0),
				'statics_price_discount'=>array('value'=>(int)Request::get('statics_price_discount', 0),'require'=>0),
				'statics_price_normal'=>array('value'=>(int)Request::get('statics_price_normal', 0),'require'=>0),
				'statics_time'=>array('value'=>Request::get('statics_time', ''),'require'=>0),
				'statics_date_start'=>array('value'=>Request::get('statics_date_start', ''),'require'=>0),
				'statics_address'=>array('value'=>Request::get('statics_address', ''),'require'=>0),
				'statics_teacher'=>array('value'=>Request::get('statics_teacher', ''),'require'=>0),
				'statics_note'=>array('value'=>Request::get('statics_note', ''),'require'=>0),
				'statics_note_2'=>array('value'=>Request::get('statics_note_2', ''),'require'=>0),

				'meta_title'=>array('value'=>addslashes(Request::get('meta_title')),'require'=>0),
				'meta_keywords'=>array('value'=>addslashes(Request::get('meta_keywords')),'require'=>0),
				'meta_description'=>array('value'=>addslashes(Request::get('meta_description')),'require'=>0),
		);
		
		//get statics_cat_name, statics_cat_alias
		if(isset($dataSave['statics_catid']['value']) && $dataSave['statics_catid']['value'] > 0){
			$arrCat = Category::getById($dataSave['statics_catid']['value']);
			if($arrCat != null){
				$dataSave['statics_cat_name']['value'] = $arrCat->category_title;
				$dataSave['statics_cat_alias']['value'] = $arrCat->category_title_alias;
			}
		}

		if(isset($dataSave['statics_date_start']['value']) && $dataSave['statics_date_start']['value'] != ''){
			$dataSave['statics_date_start']['value'] = CDate::convertDate($dataSave['statics_date_start']['value']);
		}

		$amount_discount = trim(Request::get('statics_price_discount', 0));
		$dataSave['statics_price_discount']['value'] = ($amount_discount != '') ? (int)str_replace('.', '', $amount_discount) : 0;
		$amount = trim(Request::get('statics_price_normal', 0));
		$dataSave['statics_price_normal']['value'] = ($amount != '') ? (int)str_replace('.', '', $amount) : 0;

        //Main Img
        $image_primary = addslashes(Request::get('image_primary', ''));
        //Other Img
        $arrInputImgOther = array();
        $getImgOther = Request::get('img_other',array());
        if(!empty($getImgOther)){
            foreach($getImgOther as $k=>$val){
                if($val !=''){
                    $arrInputImgOther[] = $val;
                }
            }
        }
        if (!empty($arrInputImgOther) && count($arrInputImgOther) > 0) {
            $dataSave['statics_image']['value'] = ($image_primary != '') ? $image_primary : $arrInputImgOther[0];
            $dataSave['statics_image_other']['value'] = serialize($arrInputImgOther);
        }

		if($id > 0){
			unset($dataSave['statics_created']);
		}
		
		$this->error = ValidForm::validInputData($dataSave);
		if($this->error == ''){
			$id = ($id == 0) ? $id_hiden : $id;
			Training::saveData($id, $dataSave);
			return Redirect::route('admin.training');
		}else{
			foreach($dataSave as $key=>$val){
				$data[$key] = $val['value'];
			}
		}
		
		$optionStatus = Utility::getOption($this->arrStatus, isset($data['statics_status'])? $data['statics_status'] : -1);
		$optionFocus = Utility::getOption($this->arrFocus, isset($data['statics_focus'])? $data['statics_focus'] : CGlobal::status_hide);
		$typeId = Type::getIdByKeyword('group_news');
		$this->strCategoryProduct = CategoryController::createOptionCategory($typeId, isset($data['statics_catid'])? $data['statics_catid'] : 0);

		return view('Admin::training.add',[
					'id'=>$id,
					'data'=>$data,
					'optionStatus'=>$optionStatus,
					'optionFocus'=>$optionFocus,
                    'news_image'=>$image_primary,
                    'news_image_other'=>$arrInputImgOther,
					'optionCategoryProduct'=>$this->strCategoryProduct,
					'error'=>$this->error,
				]);
	}
	public function delete(){

		$listId = Request::get('checkItem', array());
		$token = Request::get('_token', '');
		if(Session::token() === $token){
			if(!empty($listId) && is_array($listId)){
				foreach($listId as $id){
					Trash::addItem($id, 'Training', CGlobal::FOLDER_TRAINING, 'statics_id', 'statics_title', 'statics_image', 'statics_image_other');
					Training::deleteId($id);
				}
				Utility::messages('messages', 'Xóa thành công!', 'success');
			}
		}
		return Redirect::route('admin.training');
	}
}