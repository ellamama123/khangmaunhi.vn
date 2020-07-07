<?php
/*
* @Created by: DUYNX
* @Author    : duynx@peacesoft.net / nguyenduypt86@gmail.com
* @Date      : 08/2019
* @Version   : 1.0
*/
namespace App\Modules\Admin\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\Modules\Models\Trash;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Loader;
use App\Library\PHPDev\Pagging;
use App\Library\PHPDev\Utility;

class TrashController extends BaseAdminController{

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
		
		$search['trash_title'] = addslashes(Request::get('trash_title', ''));
		$search['field_get'] = 'trash_id,trash_obj_id,trash_title,trash_class,trash_folder,trash_created';
		
		$dataSearch = Trash::searchByCondition($search, $limit, $offset, $total);
		$paging = $total > 0 ? Pagging::getPager($pageScroll, $pageNo, $total, $limit, $search) : '';
		
		$messages = Utility::messages('messages');

        return view('Admin::trash.list',[
                    'data'=>$dataSearch,
                    'total'=>$total,
                    'paging'=>$paging,
                    'search'=>$search,
                    'messages'=>$messages,
                ]);
	}
	public function getItem($id=0){

		$data = array();
		$arrField = array();
		if($id > 0) {
			$data = Trash::getById($id);
			$class = $data->trash_class;
			$_class =  "App\Modules\Models\\".$class;
			$ObjClass = new $_class();
			$arrField = $ObjClass->getFillable();
		}
        return view('Admin::trash.add',[
                    'id'=>$id,
                    'data'=>$data,
                    'arrField'=>$arrField,
                    'error'=>$this->error,
                ]);

	}
	
	public function delete(){

		$listId = Request::get('checkItem', array());
		$token = Request::get('_token', '');
		if(Session::token() === $token){
			if(!empty($listId) && is_array($listId)){
				foreach($listId as $id){
					Trash::deleteId($id);
				}
				Utility::messages('messages', 'Xóa thành công!', 'success');
			}
		}
		return Redirect::route('admin.trash');
	}
	public function restore(){

		$listId = Request::get('checkItem', array());
		$token = Request::get('_token', '');
		if(Session::token() === $token){
			if(!empty($listId) && is_array($listId)){
				foreach($listId as $id){
					Trash::restoreItem($id);
					Trash::deleteId($id);
				}
				Utility::messages('messages', 'Khôi phục thành công!', 'success');
			}
		}
		return Redirect::route('admin.trash');
	}
}