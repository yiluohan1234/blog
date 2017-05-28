<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*Route::group(['middleware'=>['web']], function () {
    Route::get('/',function(){
    	return view('welcome');
    });
    Route::any('admin/login','Admin\LoginController@login');
    Route::get('admin/code','Admin\LoginController@code');
    
	Route::get('admin/add','Admin\IndexController@add');

});*/

Route::get('/','Home\IndexController@index');
Route::get('/category/{cate_id}','Home\IndexController@cate');
Route::get('/article/{art_id}','Home\IndexController@article');
Route::get('/achieve/{time}','Home\IndexController@achieve');
Route::any('admin/login','Admin\LoginController@login');
Route::get('admin/code','Admin\LoginController@code');
Route::get('/search',['uses' => 'Home\IndexController@Search','as' => 'search']);

Route::get('admin/add','Admin\IndexController@add');


Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function () {
  
    Route::get('/','IndexController@index');
	Route::get('info','IndexController@info');
	Route::any('pass','IndexController@pass');
	Route::any('quit','LoginController@quit'); 

    //后天分类
    Route::resource('category','CategoryController');
    Route::post('cate/changeorder','CategoryController@changeorder');
    //后天文章
    Route::resource('article','ArticleController');
    //图片上传
    Route::any('upload','CommonController@upload');
    //友情链接
    Route::resource('links','LinksController');
    Route::post('links/changeorder','LinksController@changeorder');
    //自定义导航
    Route::resource('navs','NavsController');
    Route::post('navs/changeorder','NavsController@changeorder');
    //网站配置
    Route::get('config/putfile', 'ConfigController@putFile');
    Route::post('config/changecontent','ConfigController@changeContent');
    Route::post('config/changeorder','ConfigController@changeorder');
    Route::resource('config','ConfigController');
});
