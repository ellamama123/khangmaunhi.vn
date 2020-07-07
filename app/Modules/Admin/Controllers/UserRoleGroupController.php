<?php
/*
* @Created by: DUYNX
* @Author    : duynx@peacesoft.net / nguyenduypt86@gmail.com
* @Date      : 08/2019
* @Version   : 1.0
*/
namespace App\Modules\Admin\Controllers;

use App\Modules\Models\UserRole;
use App\Modules\Models\UserRoleGroup;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Modules\Models\Trash;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\Utility;
use App\Library\PHPDev\ValidForm;

class UserRoleGroupController extends BaseAdminController{

	private $arrStatus = array(-1 => 'Chọn trạng thái', CGlobal::status_hide => 'Ẩn', CGlobal::status_show => 'Hiện');
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

		$search['group_role_title'] = addslashes(Request::get('group_role_title', ''));
		$search['group_role_status'] = (int)Request::get('group_role_status', -1);
		$search['submit'] = (int)Request::get('submit', 0);
		$search['field_get'] = '';

		$dataSearch = UserRoleGroup::searchByCondition($search, $limit, $offset, $total);
		$paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';

		$optionStatus = Utility::getOption($this->arrStatus, $search['group_role_status']);
		$messages = Utility::messages('messages');

        return view('Admin::userRoleGroup.list',[
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

		$data = array();
		$data['strPermission'] = array();

		$group_role_list = [];
		if($id > 0) {
			$data = UserRoleGroup::getById($id);
			$group_role_list = (isset($data->group_role_list) && $data->group_role_list != '') ? explode(',', $data->group_role_list) : [];

		}
		$dataSearch['field_get'] = 'role_id,role_title';
		$listRole = UserRole::getAllRole($dataSearch);
		$arrRole = Utility::arrByField($listRole, 'role_title', 'role_id');

		$optionStatus = Utility::getOption($this->arrStatus, isset($data->group_role_status) ? $data->group_role_status : CGlobal::status_show);

        return view('Admin::userRoleGroup.add',[
                    'id'=>$id,
                    'data'=>$data,
                    'arrRole'=>$arrRole,
                    'group_role_list'=>$group_role_list,
                    'optionStatus'=>$optionStatus,
                    'arrStatus'=>$this->arrStatus,
                    'error'=>$this->error,
                ]);
	}
	public function postItem($id=0){

		$id_hiden = (int)Request::get('id_hiden', 0);
		$data = array();

		$dataSave = array(
				'group_role_title'=>array('value'=>addslashes(Request::get('group_role_title')), 'require'=>1, 'messages'=>'Tên không được trống!'),
				'group_role_list'=>array('value'=>Request::get('group_role_list', []),'require'=>0),
				'group_role_order_no'=>array('value'=>(int)Request::get('group_role_order_no', 0),'require'=>0),
				'group_role_status'=>array('value'=>(int)Request::get('group_role_status', -1),'require'=>0),
		);

		$this->error = ValidForm::validInputData($dataSave);
		$checkExists = UserRoleGroup::checkRoleExists($dataSave['group_role_title']['value'], $id);
		if(!empty($checkExists) > 0){
			$this->error .= 'Nhóm ' . $dataSave['group_role_title']['value'] . ' đã tồn tại.<br/>';
		}

		if(isset($dataSave['group_role_list'])){
			if(!empty($dataSave['group_role_list'])){
				$dataSave['group_role_list']['value'] = implode(',', $dataSave['group_role_list']['value']);
			}else{
				$dataSave['group_role_list']['value'] = '';
			}
		}
		$group_role_list = [];
		if($id > 0){
			$data = UserRoleGroup::getById($id);
			$group_role_list = (isset($data->group_role_list) && $data->group_role_list != '') ? explode(',', $data->group_role_list) : [];
		}

		if($this->error == ''){
			$id = ($id == 0) ? $id_hiden : $id;
			UserRoleGroup::saveData($id, $dataSave);
			return Redirect::route('admin.roleGroup');
		}else{
			foreach($dataSave as $key=>$val){
				$data[$key] = $val['value'];
			}
		}

		$dataSearch['field_get'] = 'role_id,role_title';
		$listRole = UserRole::getAllRole($dataSearch);
		$arrRole = Utility::arrByField($listRole, 'role_title', 'role_id');

		$optionStatus = Utility::getOption($this->arrStatus, isset($data['group_role_status'])? $data['group_role_status'] : -1);

        return view('Admin::userRoleGroup.add',[
                    'id'=>$id,
                    'data'=>$data,
                    'arrRole'=>$arrRole,
                    'group_role_list'=>$group_role_list,
                    'optionStatus'=>$optionStatus,
                    'arrStatus'=>$this->arrStatus,
                    'error'=>$this->error,
                ]);
	}
	public function delete(){

		$listId = Request::get('checkItem', array());
		$token = Request::get('_token', '');

		if(Session::token() === $token){
			if(!empty($listId) && is_array($listId)){
				foreach($listId as $id){
					Trash::addItem($id, 'UserRole', '', 'role_id', 'group_role_title', '', '');
					UserRoleGroup::deleteId($id);
				}
				Utility::messages('messages', 'Xóa thành công!', 'success');
			}
		}
		return Redirect::route('admin.roleGroup');
	}
}