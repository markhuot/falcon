<?php

namespace Admin;

class RegionController extends \BaseController {

  public function getNew()
  {
    return \View::make('admin.region.getNew');
  }

  public function postNew(\Region $region=null)
  {
    if ($region == null) {
      $region = new \Region;
    }

    $region->fill(\Input::get('region'));
    $region->save();

    if (\Input::get('add')) {
      $field = new \Field;
      $field->block_id = $region->id;
      $field->fill(\Input::get('new_field'));
      $field->save();
    }

    return \Redirect::route('admin_show_region', $region->id);
  }

  public function getShow(\Region $region)
  {
    return \View::make('admin.region.getNew')
      ->with('region', $region)
    ;
  }

}