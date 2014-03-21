<?php

class ContentType extends Eloquent {

  protected $fillable = [
    'name',
    'slug',
  ];

  public function regions()
  {
    return $this->belongsToMany('Region');
  }

  public function content()
  {
    return $this->hasMany('Content');
  }

}