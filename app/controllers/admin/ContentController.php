<?php

namespace Admin;

use BaseController;
use BlockData;
use Content;
use ContentType;
use Input;
use Redirect;
use Region;
use Session;
use View;

class ContentController extends BaseController {

  public function getList(\ContentType $contentType=null)
  {
    $content = @$contentType->content ?: \Content::all();

    return View::make('admin.content.getList')
      ->with('content', $content)
      ->with('contentTypes', ContentType::all())
    ;
  }

  public function getNew(ContentType $contentType)
  {
    return View::make('admin.content.getNew')
      ->with('contentType', $contentType)
    ;
  }

  public function postNew(Content $content=null)
  {
    if ($content === null) {
      $content = new Content;
      ContentType::findOrFail(Input::get('contentType.id'))->content()->save($content);
    }

    if ($data=Input::get('blockData')) {
      foreach ($data as $blockId => $blockValues) {
        $blockData = BlockData::findOrFail($blockId);
        foreach ($blockValues as $blockKey => $blockValue) {
          $blockData->{$blockKey} = $blockValue;
        }
        $blockData->save();
      }
    }

    if ($regionId=Input::get('addBlock')) {
      return Redirect::route('admin_choose_block', [$content->id, $regionId]);
    }

    if ($blockDataId=Input::get('removeBlockData')) {
      BlockData::findOrFail($blockDataId)->delete();
      return Redirect::route('admin_show_content', $content->id);
    }

    return Redirect::route('admin_show_content', $content->id)
      ->with('X-Paged-Replace', 'true')
      ->with('successMessage', 'Woo!')
    ;
  }

  public function getChooseBlock(Content $content, Region $region)
  {
    return View::make('admin.content.getChooseBlock')
      ->with('content', $content)
      ->with('region', $region)
      ->with('blocks', \Block::all())
    ;
  }

  public function postChooseBlock(Content $content, Region $region)
  {
    $blockData = new BlockData();
    $blockData->content_id = $content->id;
    $blockData->region_id = $region->id;
    $blockData->block_id = Input::get('blockId');
    $blockData->save();

    return Redirect::route('admin_show_content', $content->id);
  }

  public function getShow(Content $content)
  {
    return View::make('admin.content.getNew')
      ->with('contentType', $content->contentType)
      ->with('content', $content)
    ;
  }

}