<?php
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
	// 自动跳转
	Route::get('', function () {
		return redirect(route('admin.index'));
	});
	// 登录
	Route::get('login', 'LoginController@index')->name('login_page');
	Route::post('login', 'LoginController@login')->name('login');
	Route::get('logout', 'LoginController@logout')->name('logout');
	// 登录后
	Route::group(['middleware' => ['admin_login']], function () {
		// 后台首页
		Route::get('index', 'AdminController@index')->name('index');
		// 管理员账户模块
		Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
			Route::match(['get', 'post'], 'changeinfo', 'AdminController@changeInfo')->name('change_info');
		});
		// 活动室
		Route::group(['prefix' => 'room', 'as' => 'room.'], function () {
			Route::get('index', 'RoomController@index')->name('index');
			Route::match(['get', 'post'], 'add', 'RoomController@add')->name('add');
		});
	});
});

// 主页
Route::get('/', function () {
	return view('welcome');
});