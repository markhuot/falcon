<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

  Route::get('/', function() { return Redirect::route('admin_list_content'); });

  Route::get('content-type', ['as' => 'admin_list_content_types', 'uses' => 'ContentTypeController@getList']);
  Route::get('content-type/new', ['as' => 'admin_new_content_type', 'uses' => 'ContentTypeController@getNew']);
  Route::post('content-type/{contentType?}', ['as' => 'admin_post_content_type', 'uses' => 'ContentTypeController@postNew']);
  Route::post('content-type/{contentType}/add-region', ['as' => 'admin_post_add_region_to_content_type', 'uses' => 'ContentTypeController@postAddRegion']);
  Route::get('content-type/{contentType}', ['as' => 'admin_show_content_type', 'uses' => 'ContentTypeController@getShow']);

  Route::get('region/new', ['as' => 'admin_new_region', 'uses' => 'RegionController@getNew']);
  Route::post('region/{region?}', ['as' => 'admin_post_region', 'uses' => 'RegionController@postNew']);
  Route::get('region/{region}', ['as' => 'admin_show_region', 'uses' => 'RegionController@getShow']);

  Route::get('block/new', ['as' => 'admin_new_block', 'uses' => 'BlockController@getNew']);
  Route::post('block/{block?}', ['as' => 'admin_post_block', 'uses' => 'BlockController@postNew']);
  Route::get('block/{block}', ['as' => 'admin_show_block', 'uses' => 'BlockController@getShow']);

  Route::get('content', ['as' => 'admin_list_content', 'uses' => 'ContentController@getList']);
  Route::get('content/new/{contentType}', ['as' => 'admin_new_content', 'uses' => 'ContentController@getNew']);
  Route::get('content/{content}', ['as' => 'admin_show_content', 'uses' => 'ContentController@getShow']);
  Route::post('content/{content?}', ['as' => 'admin_post_content', 'uses' => 'ContentController@postNew']);
  Route::get('content/{content}/add-block/{region}', ['as' => 'admin_choose_block', 'uses' => 'ContentController@getChooseBlock']);
  Route::post('content/{content}/add-block/{region}', ['as' => 'admin_post_choose_block', 'uses' => 'ContentController@postChooseBlock']);

});

Route::group(['prefix' => 'api'], function() {



});

Route::bind('contentType', function($contentTypeId) { return ContentType::findOrFail($contentTypeId); });
Route::bind('region', function($regionId) { return Region::findOrFail($regionId); });
Route::bind('block', function($blockId) { return Block::findOrFail($blockId); });
Route::bind('content', function($contentId) { return Content::findOrFail($contentId); });
Route::bind('region', function($regionId) { return Region::findOrFail($regionId); });