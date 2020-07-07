<?php
/*
* @Created by: DUYNX
* @Author    : duynx@peacesoft.net / nguyenduypt86@gmail.com
* @Date      : 08/2019
* @Version   : 1.0
*/
namespace App\Modules\Admin\Controllers;

use App\Library\PHPDev\FuncLib;
use App\Modules\Models\Orders;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Modules\Models\Trash;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ValidForm;

class OrdersController extends BaseAdminController{

	private $arrStatus = array(-1 => 'Chọn trạng thái', CGlobal::status_hide => 'Chưa duyệt', CGlobal::status_show => 'Đã duyệt');
	private $arrSex = array(-1 => 'Chọn trạng thái', CGlobal::status_hide => 'Nữ', CGlobal::status_show => 'Nam');
	private $arrAddress= array(-1 => 'Chọn trạng thái', CGlobal::status_hide => 'Nơi khác', CGlobal::status_show => 'Đông dương');
	private $arrCalendar= array(-1 => 'Chọn trạng thái', CGlobal::status_int_2 => 'Lịch dương', CGlobal::status_int_1 => 'Lịch âm');
	private $error = '';
	public function __construct(){
		parent::__construct();
		Loader::loadJS('backend/js/admin.js', CGlobal::$postEnd);

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
		
		$search['name'] = addslashes(Request::get('name', ''));
		$search['phone'] = addslashes(Request::get('phone', ''));
		$search['status'] = (int)Request::get('status', -1);
		$search['submit'] = (int)Request::get('submit', 0);
		$search['field_get'] = '';
		
		$dataSearch = Orders::searchByCondition($search, $limit, $offset, $total);
		$paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';
		
		$optionStatus = Utility::getOption($this->arrStatus, $search['status']);
		$messages = Utility::messages('messages');

		return view('Admin::orders.list',[
					'data'=>$dataSearch,
					'total'=>$total,
					'paging'=>$paging,
					'arrStatus'=>$this->arrStatus,
					'optionStatus'=>$optionStatus,
					'arrSex'=>$this->arrSex,
					'arrAddress'=>$this->arrAddress,
					'arrCalendar'=>$this->arrCalendar,
					'search'=>$search,
					'arrTime'=>CGlobal::$arrTime,
					'messages'=>$messages,
				]);

	}
	public function getItem($id=0){

		$data = array();
		if($id > 0) {
			$data = Orders::getById($id);
		}
		$optionStatus = Utility::getOption($this->arrStatus, isset($data['status'])? $data['status'] : CGlobal::status_hide);
		$optionSex = Utility::getOption($this->arrSex, isset($data['sex'])? $data['sex'] : CGlobal::status_hide);
		$optionAddress = Utility::getOption($this->arrAddress, isset($data['address'])? $data['address'] : CGlobal::status_hide);
		$optionTime = Utility::getOption(CGlobal::$arrTime, isset($data['time'])? $data['time'] : CGlobal::status_show);

		return view('Admin::orders.add',[
					'id'=>$id,
					'data'=>$data,
					'optionStatus'=>$optionStatus,
					'optionSex'=>$optionSex,
					'optionAddress'=>$optionAddress,
					'optionTime'=>$optionTime,
					'arrTime'=>CGlobal::$arrTime,
					'error'=>$this->error,
				]);

	}
	public function postItem($id=0){

		$id_hiden = (int)Request::get('id_hiden', 0);
		$data = array();
		
		$dataSave = array(
				'name'=>array('value'=>addslashes(Request::get('name')), 'require'=>1, 'messages'=>'Tiêu đề không được trống!'),
				'phone'=>array('value'=>addslashes(Request::get('phone')),'require'=>1, 'messages'=>'Điện thoại không được trống!'),
				'sex'=>array('value'=>(int)Request::get('sex', 1),'require'=>0),
				'status'=>array('value'=>(int)Request::get('status', -1),'require'=>0),
				'address'=>array('value'=>(int)Request::get('address', 1),'require'=>0),
				'time'=>array('value'=>(int)Request::get('time', 1),'require'=>0),
				'day'=>array('value'=>(int)Request::get('day', '1'),'require'=>0),
				'month'=>array('value'=>(int)Request::get('month', '1'),'require'=>0),
				'year'=>array('value'=>(int)Request::get('year', date('Y')),'require'=>0),
				'day_am'=>array('value'=>(int)Request::get('day_am', '1'),'require'=>0),
				'month_am'=>array('value'=>(int)Request::get('month_am', '1'),'require'=>0),
				'year_am'=>array('value'=>(int)Request::get('year_am', date('Y')),'require'=>0),
		);
		
		$this->error = ValidForm::validInputData($dataSave);
		if($this->error == ''){
			$id = ($id == 0) ? $id_hiden : $id;
			Orders::saveData($id, $dataSave);
			return Redirect::route('admin.customer');
		}else{
			foreach($dataSave as $key=>$val){
				$data[$key] = $val['value'];
			}
		}

		$optionStatus = Utility::getOption($this->arrStatus, isset($data['status'])? $data['status'] : CGlobal::status_hide);
		$optionSex = Utility::getOption($this->arrSex, isset($data['sex'])? $data['sex'] : CGlobal::status_hide);
		$optionAddress = Utility::getOption($this->arrAddress, isset($data['address'])? $data['address'] : CGlobal::status_hide);
		$optionTime = Utility::getOption(CGlobal::$arrTime, isset($data['time'])? $data['time'] : CGlobal::status_show);

		return view('Admin::orders.add',[
			'id'=>$id,
			'data'=>$data,
			'optionStatus'=>$optionStatus,
			'optionSex'=>$optionSex,
			'optionAddress'=>$optionAddress,
			'optionTime'=>$optionTime,
			'arrTime'=>CGlobal::$arrTime,
			'error'=>$this->error,
		]);
	}
	public function delete(){

		$listId = Request::get('checkItem', array());
		$token = Request::get('_token', '');
		if(Session::token() === $token){
			if(!empty($listId) && is_array($listId)){
				foreach($listId as $id){
					Trash::addItem($id, 'Orders', '', 'id', 'title', '', '');
					Orders::deleteId($id);
				}
				Utility::messages('messages', 'Xóa thành công!', 'success');
			}
		}
		return Redirect::route('admin.customer');
	}
}