<?php
/*
* @Created by: DUYNX
* @Author    : duynx@peacesoft.net / nguyenduypt86@gmail.com
* @Date      : 08/2019
* @Version   : 1.0
*/
$namespace = '\App\Modules\Statics\Controllers';

Route::group(['middleware' => ['web'], 'prefix' => '/', 'namespace' => $namespace], function(){

    Route::get('403', array('as' => 'page.403','uses' => 'BaseStaticsController@page403'));
    Route::get('404', array('as' => 'page.404','uses' => 'BaseStaticsController@page404'));

    Route::get('/', array('as' => 'SIndex','uses' => 'StaticsController@index'));

    Route::match(['GET','POST'],'lien-he.html', array('as' => 'site.pageContact','uses' =>'StaticsController@pageContact'));
    Route::post('lien-he', array('as' => 'site.pageContactPost','uses' =>'StaticsController@pageContactPost'));
    Route::post('dang-ky-khoa-hoc', array('as' => 'site.pageTrainingPost','uses' =>'StaticsController@pageTrainingPost'));
    Route::post('dang-ky-lay-info', array('as' => 'site.noteTrainingPost','uses' =>'StaticsController@noteTrainingPost'));

    Route::get('{name}-{id}.html',array('as' => 'site.actionRouter','uses' =>'StaticsController@actionRouter', 'permission_name'=>'Tin tức đại lý'))->where('name', '[A-Z0-9a-z)_\-]+')->where('id', '[0-9]+');
    Route::get('tin-tuc/{name}-{id}.html',array('as' => 'site.detailStatics','uses' =>'StaticsController@detailStatics', 'permission_name'=>'Chi tiết tin tức'))->where('name', '[A-Z0-9a-z_\-]+')->where('id', '[0-9]+');
    Route::get('dao-tao/{name}-{id}.html',array('as' => 'site.detailNews','uses' =>'StaticsController@detailNews', 'permission_name'=>'Chi tiết đào tạo'))->where('name', '[A-Z0-9a-z_\-]+')->where('id', '[0-9]+');
});