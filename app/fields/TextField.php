<?php

class TextField {

  protected $name;

  public function __construct($name)
  {
    $this->name = $name;
  }

  public function renderInputField()
  {
    return '<input name="'.$this->name.'" />';
  }

}