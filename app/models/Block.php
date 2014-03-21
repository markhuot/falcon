<?php

class Block extends Eloquent {

  protected $fillable = [
    'name',
    'slug',
  ];

  public function fields()
  {
    return $this->hasMany('Field');
  }

}