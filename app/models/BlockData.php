<?php

class BlockData extends Eloquent {

  protected $table = 'block_data';

  public function block()
  {
    return $this->belongsTo('Block');
  }

}