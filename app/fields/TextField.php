<?php

class TextField {

  protected $field;
  protected $blockData;
  protected $name;

  public function __construct($field, $blockData)
  {
    $this->field = $field;
    $this->blockData = $blockData;

    $contentId = $blockData->content_id;
    $regionId = $blockData->region_id;
    $blockId = $blockData->block_id;
    $blockName = $blockData->block->slug;
    $fieldName = $field->slug;

    $this->name = "blockData[{$blockData->id}][{$blockName}_{$fieldName}]";
  }

  public function data()
  {
    return $this->blockData->{$this->blockData->block->slug."_".$this->field->slug};
  }

  public function renderInputField()
  {
    return '<input name="'.$this->name.'" value="'.$this->data().'" />';
  }

}