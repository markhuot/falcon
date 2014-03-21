<?php

namespace Admin;

class ContentTypeController extends \BaseController {

  public function getNew()
  {
    return \View::make('admin.content-type.getNew');
  }

  public function postNew(\ContentType $contentType=null)
  {
    if ($contentType === null) {
      $contentType = new \ContentType;
    }

    $contentType->fill(\Input::get('contentType'));
    $contentType->save();

    return \Redirect::route('admin_show_content_type', $contentType->id);
  }

  public function getShow(\ContentType $contentType)
  {
    return \View::make('admin.content-type.getShow')
      ->with('contentType', $contentType)
      ->with('regions', \Region::all())
    ;
  }

  public function postAddRegion(\ContentType $contentType)
  {
    $contentType->regions()->attach(\Region::findOrFail(\Input::get('addRegionId')));

    return \Redirect::route('admin_show_content_type', $contentType->id);
  }

}