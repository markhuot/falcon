<?php

class Region extends Eloquent {

  protected $fillable = [
    'name',
    'slug',
  ];

  public function blocks()
  {
    return $this->hasMany('Block');
  }

}