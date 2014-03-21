<?php

class Content extends Eloquent {

  public function contentType()
  {
    return $this->belongsTo('ContentType');
  }

}