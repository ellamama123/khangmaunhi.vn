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


        $messages = Utility::messages('messages');

        return view('Statics::content.index', [
            'messages'=>$messages,
        ]);
    }
}