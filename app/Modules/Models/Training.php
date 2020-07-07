<?php
/*
* @Created by: DUYNX
* @Author    : nguyenduypt86@gmail.com
* @Date      : 06/2016
* @Version   : 1.0
*/
namespace App\Modules\Models;

use App\Library\PHPDev\CDatabase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Library\PHPDev\CGlobal;
use App\Library\PHPDev\Memcache;
use App\Library\PHPDev\Utility;
use PDOException;

class Training extends Model {
    
    protected $table = CDatabase::training;
    protected $primaryKey = 'statics_id';
    public  $timestamps = false;

    protected $fillable = array(
	    		'statics_id', 'statics_catid', 'statics_cat_name', 'statics_cat_alias', 'statics_title', 'statics_intro', 'statics_content', 'statics_view_num
	    		
	    		',
				'statics_image', 'statics_image_other', 'statics_created', 'statics_order_no', 'statics_focus', 'statics_status',
				'statics_num', 'statics_price_normal', 'statics_price_discount', 'statics_time', 'statics_date_start', 'statics_address', 'statics_teacher', 'statics_note', 'statics_note_2', 'meta_title', 'meta_keywords', 'meta_description');

    public static function searchByCondition($dataSearch=array(), $limit=0, $offset=0, &$total){
    	try{
    	  
    		$query = Training::where('statics_id','>',0);
    	  
    		if (isset($dataSearch['statics_title']) && $dataSearch['statics_title'] != '') {
    			$query->where('statics_title','LIKE', '%' . $dataSearch['statics_title'] . '%');
    		}
    		if (isset($dataSearch['statics_status']) && $dataSearch['statics_status'] != -1) {
    			$query->where('statics_status', $dataSearch['statics_status']);
    		}
    	  	
    		if(isset($dataSearch['statics_catid']) && $dataSearch['statics_catid'] != -1){
    			$catid = $dataSearch['statics_catid'];
    			$arrCat = array($catid);
    			Category::makeListCatId($catid, 0, $arrCat);
    			if(is_array($arrCat) && !empty($arrCat)){
    				$query->whereIn('statics_catid', $arrCat);
    			}
    		}
    		
    		$total = $query->count(['statics_id']);
    		$query->orderBy('statics_id', 'desc');
    
    		$fields = (isset($dataSearch['field_get']) && trim($dataSearch['field_get']) != '') ? explode(',',trim($dataSearch['field_get'])): array();
    		if(!empty($fields)){
    			$result = $query->take($limit)->skip($offset)->get($fields);
    		}else{
    			$result = $query->take($limit)->skip($offset)->get();
    		}
    		return $result;
    
    	}catch (PDOException $e){
    		throw new PDOException();
    	}
    }
     
    public static function getById($id=0){
    	$result = (Memcache::CACHE_ON) ? Cache::get(Memcache::CACHE_TRAINING_ID.$id) : array();
    	try {
    		if(empty($result)){
    			$result = Training::where('statics_id', $id)->first();
    			if($result && Memcache::CACHE_ON){
    				Cache::put(Memcache::CACHE_TRAINING_ID.$id, $result, Memcache::CACHE_TIME_TO_LIVE_ONE_MONTH);
    			}
    		}
    	} catch (PDOException $e) {
    		throw new PDOException();
    	}
    	
    	return $result;	
    }
     
    public static function updateData($id=0, $dataInput=array()){
    	try {
    		DB::connection()->getPdo()->beginTransaction();
    		$data = Training::getById($id);
    		if($id > 0 && !empty($dataInput)){
    			$data->update($dataInput);
    			if(isset($data->statics_id) && $data->statics_id > 0){
    				self::removeCacheId($data->statics_id);
    			}
    		}
    		DB::connection()->getPdo()->commit();
    		return true;
    	} catch (PDOException $e) {
    		DB::connection()->getPdo()->rollBack();
    		throw new PDOException();
    	}
    }
     
    public static function addData($dataInput=array()){
    	try {
    		DB::connection()->getPdo()->beginTransaction();
    		$data = new Training();
    		if (is_array($dataInput) && count($dataInput) > 0) {
    			foreach ($dataInput as $k => $v) {
    				$data->$k = $v;
    			}
    		}
    		if ($data->save()) {
    			DB::connection()->getPdo()->commit();
    			if($data->statics_id && Memcache::CACHE_ON){
					Training::removeCacheId($data->statics_id);
    			}
    			return $data->statics_id;
    		}
    		DB::connection()->getPdo()->commit();
    		return false;
    	} catch (PDOException $e) {
    		DB::connection()->getPdo()->rollBack();
    		throw new PDOException();
    	}
    }
    
    public static function saveData($id=0, $data=array()){
    	$data_post = array();
    	if(!empty($data)){
    		foreach($data as $key=>$val){
    			$data_post[$key] = $val['value'];
    		}
    	}
    	if($id > 0){
			Training::updateData($id, $data_post);
    		Utility::messages('messages', 'Cập nhật thành công!');
    	}else{
			Training::addData($data_post);
    		Utility::messages('messages', 'Thêm mới thành công!');
    	}
    
    }
    
    public static function deleteId($id=0){
    	try {
    		DB::connection()->getPdo()->beginTransaction();
    		$data = Training::find($id);
    		if($data != null){

				//Remove Img
				$statics_image_other = ($data->statics_image_other != '') ? unserialize($data->statics_image_other) : array();
				if(is_array($statics_image_other) && !empty($statics_image_other)){
					$path = Config::get('config.DIR_ROOT').'uploads/'.CGlobal::FOLDER_TRAINING.'/'.$id;
					foreach($statics_image_other as $v){
						if(is_file($path.'/'.$v)){
							@unlink($path.'/'.$v);
						}
					}
					if(is_dir($path)) {
						@rmdir($path);
					}
				}
				//End Remove Img
				$data->delete();
    			if(isset($data->statics_id) && $data->statics_id > 0){
    				self::removeCacheId($data->statics_id);
    			}
    			DB::connection()->getPdo()->commit();
    		}
    		return true;
    	} catch (PDOException $e) {
    		DB::connection()->getPdo()->rollBack();
    		throw new PDOException();
    	}
    }
    
    public static function removeCacheId($id=0){
    	if($id>0){
    		Cache::forget(Memcache::CACHE_TRAINING_ID.$id);
    	}
    }

    public static function searchByConditionCatid($catid=0, $limit=0, $dataSearch=array()){
    	$result = (Memcache::CACHE_ON) ? Cache::get(Memcache::CACHE_STATICS_CAT_ID.$catid) : array();
    	try{
    		if(empty($result)){
    			$query = Training::where('statics_id','>',0);
				$query->where('statics_status','=',CGlobal::status_show);
    			if($catid != -1){
    				$arrCat = array($catid);
    				Category::makeListCatId($catid, 0, $arrCat);
    				if(is_array($arrCat) && !empty($arrCat)){
    					$query->whereIn('statics_catid', $arrCat);
    				}
    			}
    			$query->orderBy('statics_order_no', 'asc');
    			 
    			if($limit > 0){
    				$query->take($limit);
    			}
				$fields = (isset($dataSearch['field_get']) && trim($dataSearch['field_get']) != '') ? explode(',',trim($dataSearch['field_get'])): array();
				if(!empty($fields)){
					$result = $query->take($limit)->get($fields);
				}else{
					$result = $query->take($limit)->get();
				}

    			if($result && Memcache::CACHE_ON){
    				Cache::put(Memcache::CACHE_STATICS_CAT_ID.$catid, $result, Memcache::CACHE_TIME_TO_LIVE_ONE_MONTH);
    			}
    		}
    		return $result;
    	}catch (PDOException $e){
    		throw new PDOException();
    	}
    }

	public static function getFocus($dataSearch=array(), $limit=10){
		$result = array();
		try{
			if($limit > 0){
				$query = Training::where('statics_id','>', 0);
				$query->where('statics_focus', CGlobal::status_show);
				$query->where('statics_status', CGlobal::status_show);

				if(isset($dataSearch['statics_catid']) && $dataSearch['statics_catid'] != 0){
					$query->where('statics_catid', $dataSearch['statics_catid']);
				}

				if(isset($dataSearch['statics_order_no']) && $dataSearch['statics_order_no'] == 'asc'){
					$query->orderBy('statics_order_no', 'asc');
				}else{
					$query->orderBy('statics_id', 'desc');
				}

				$fields = (isset($dataSearch['field_get']) && trim($dataSearch['field_get']) != '') ? explode(',',trim($dataSearch['field_get'])): array();
				if(!empty($fields)){
					$result = $query->take($limit)->get($fields);
				}else{
					$result = $query->take($limit)->get();
				}
			}

		}catch (PDOException $e){
			throw new PDOException();
		}
		return $result;
	}
}
