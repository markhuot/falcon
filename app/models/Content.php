<?php

class Content extends Eloquent {

  public function contentType()
  {
    return $this->belongsTo('ContentType');
  }

  public function blockData()
  {
    return $this->hasMany('BlockData');
  }

  public function blockDataIn(\Region $region=null)
  {
    return BlockData::where('content_id', '=', $this->id)
      ->where('region_id', '=', $region->id)
      ->get()
    ;
  }

}