<?php

namespace Admin;

class ContentController extends \BaseController {

  public function getNew(\ContentType $contentType)
  {
    return \View::make('admin.content.getNew')
      ->with('contentType', $contentType)
    ;
  }

  public function postNew(\Content $content=null)
  {
    if ($content === null) {
      $content = new \Content;
      \ContentType::findOrFail(\Input::get('contentType.id'))->content()->save($content);
    }

    if ($regionId=\Input::get('addBlock')) {
      return \Redirect::route('admin_choose_block', [$content->id, $regionId]);
    }
  }

  public function getChooseBlock(\Content $content, \Region $region)
  {
    return \View::make('admin.content.getChooseBlock')
      ->with('content', $content)
      ->with('region', $region)
      ->with('blocks', \Block::all())
    ;
  }

  public function postChooseBlock(\Content $content, \Region $region)
  {
    $blockData = new BlockData();
    $blockData->content_id = $content->id;
    $blockData->region_id = $region->id;
    $blockData->block_id = \Input::get('blockId');
    $blockData->save();

    return \Redirect::route('admin_show_content', $content->id);
  }

  public function getShow(\Content $content)
  {
    return \View::make('admin.content.getNew')
      ->with('contentType', $content->contentType)
      ->with('content', $content)
    ;
  }

}