<?php

namespace Admin;

class BlockController extends \BaseController {

  public function getNew()
  {
    return \View::make('admin.block.getNew');
  }

  public function postNew(\Block $block=null)
  {
    if ($block == null) {
      $block = new \Block;
    }

    $block->fill(\Input::get('block'));
    $block->save();

    if (\Input::get('add')) {
      $field = new \Field;
      $field->block_id = $block->id;
      $field->fill(\Input::get('new_field'));
      $field->save();
    }

    return \Redirect::route('admin_show_block', $block->id);
  }

  public function getShow(\Block $block)
  {
    return \View::make('admin.block.getNew')
      ->with('block', $block)
    ;
  }

}