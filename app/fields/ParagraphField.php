<?php

class ParagraphField {

  protected $name;

  public function __construct($name)
  {
    $this->name = $name;
  }

  public function renderInputField()
  {
    return '<textarea name="'.$this->name.'"></textarea>';
  }

}