<?php
namespace App\Modules\Admin\Controllers;

use App\Library\PHPDev\FuncLib;
use App\Modules\Models\Info;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Modules\Models\Trash;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ValidForm;

class InfoController extends BaseAdminController{

	private $arrStatus = array(-1 => 'Chọn trạng thái', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
	private $error = '';
	public function __construct(){
		parent::__construct();
		Loader::loadJS('backend/js/admin.js', CGlobal::$postEnd);

		Loader::loadCSS('libs/upload/cssUpload.css', CGlobal::$postHead);
		Loader::loadJS('libs/upload/jquery.uploadfile.js', CGlobal::$postEnd);
		Loader::loadJS('backend/js/upload-admin.js', CGlobal::$postEnd);

		Loader::loadCSS('libs/jAlert/jquery.alerts.css', CGlobal::$postHead);
		Loader::loadJS('libs/jAlert/jquery.alerts.js', CGlobal::$postEnd);
	}
	public function listView(){

		//Config Page
		$pageNo = (int) Request::get('page', 1);
		$pageScroll = CGlobal::num_scroll_page;
		$limit = CGlobal::num_record_per_page;
		$offset = ($pageNo - 1) * $limit;
		$search = $data = array();
		$total = 0;

		$search['info_title'] = addslashes(Request::get('info_title', ''));
		$search['info_status'] = (int)Request::get('info_status', -1);
		$search['submit'] = (int)Request::get('submit', 0);
		$search['field_get'] = '';

		$dataSearch = Info::searchByCondition($search, $limit, $offset, $total);
		$paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';

		$optionStatus = Utility::getOption($this->arrStatus, $search['info_status']);
		$messages = Utility::messages('messages');

		return view('Admin::info.list',[
					'data'=>$dataSearch,
					'total'=>$total,
					'paging'=>$paging,
					'arrStatus'=>$this->arrStatus,
					'optionStatus'=>$optionStatus,
					'search'=>$search,
					'messages'=>$messages,
				]);

	}
	public function getItem($id=0){

		Loader::loadJS('libs/ckeditor/ckeditor.js', CGlobal::$postHead);

		$data = array();
		if($id > 0) {
			$data = Info::getById($id);
		}
		$optionStatus = Utility::getOption($this->arrStatus, isset($data['info_status'])? $data['info_status'] : CGlobal::status_show);

		return view('Admin::info.add',[
					'id'=>$id,
					'data'=>$data,
					'optionStatus'=>$optionStatus,
					'error'=>$this->error,
				]);

	}
	public function postItem($id=0){

		Loader::loadJS('libs/ckeditor/ckeditor.js', CGlobal::$postHead);

		$id_hiden = (int)Request::get('id_hiden', 0);
		$data = array();

		$dataSave = array(
				'info_title'=>array('value'=>addslashes(Request::get('info_title')), 'require'=>1, 'messages'=>'Tiêu đề không được trống!'),
				'info_keyword'=>array('value'=>addslashes(Request::get('info_keyword')),'require'=>1, 'messages'=>'Từ khóa không được trống!'),
				'info_intro'=>array('value'=>addslashes(Request::get('info_intro')),'require'=>0),
				'info_content'=>array('value'=>addslashes(Request::get('info_content')),'require'=>0),
				'info_order_no'=>array('value'=>(int)addslashes(Request::get('info_order_no')),'require'=>0),
				'info_created'=>array('value'=>time()),
				'info_status'=>array('value'=>(int)Request::get('info_status', -1),'require'=>0),

				'meta_title'=>array('value'=>addslashes(Request::get('meta_title')),'require'=>0),
				'meta_keywords'=>array('value'=>addslashes(Request::get('meta_keywords')),'require'=>0),
				'meta_description'=>array('value'=>addslashes(Request::get('meta_description')),'require'=>0),
		);

		$this->error = ValidForm::validInputData($dataSave);
		if($this->error == ''){
			$id = ($id == 0) ? $id_hiden : $id;

			if($id > 0){
				unset($dataSave['info_keyword']);
				unset($dataSave['info_created']);
			}

			//So Sanh Anh Cu Va Moi, Neu Khac Nhau thi Xoa Anh Cu Di
			if($id > 0){
				$info_img = trim(addslashes(Request::get('img')));
				$info_img_old = trim(addslashes(Request::get('img_old')));
				if($info_img_old !== '' && $info_img !== '' && strcmp ( $info_img_old , $info_img ) != 0){
					$path = FuncLib::getRootPath().'uploads/'.CGlobal::FOLDER_INFO.'/'.$id;
					if(is_file($path.'/'.$info_img_old)){
						@unlink($path.'/'.$info_img_old);
					}
				}
			}
			Info::saveData($id, $dataSave);
			return Redirect::route('admin.info');
		}else{
			foreach($dataSave as $key=>$val){
				$data[$key] = $val['value'];
			}
		}

		$optionStatus = Utility::getOption($this->arrStatus, isset($data['info_status'])? $data['info_status'] : -1);

		return view('Admin::info.add',[
					'id'=>$id,
					'data'=>$data,
					'optionStatus'=>$optionStatus,
					'error'=>$this->error,
				]);
	}
	public function delete(){

		$listId = Request::get('checkItem', array());
		$token = Request::get('_token', '');
		if(Session::token() === $token){
			if(!empty($listId) && is_array($listId)){
				foreach($listId as $id){
					Trash::addItem($id, 'Info', '', 'info_id', 'info_title', '', '');
					Info::deleteId($id);
				}
				Utility::messages('messages', 'Xóa thành công!', 'success');
			}
		}
		return Redirect::route('admin.info');
	}
}