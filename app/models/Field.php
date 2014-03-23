<?php

class Field extends Eloquent {

  protected $fillable = [
    'name',
    'slug',
    'type',
  ];

  private $inputObject;

  public static function boot()
  {
    parent::boot();

    static::creating(function($field) {
      Schema::table('block_data', function($table) use ($field) {
        $table->text($field->block->slug.'_'.$field->slug)->nullable();
      });
    });

    static::deleting(function($field) {
      Schema::table('block_data', function($table) use ($field) {
        $table->dropColumn($field->block->slug.'_'.$field->slug);
      });
    });
  }

  public function block()
  {
    return $this->belongsTo('Block');
  }

  public function renderInputFieldFor(BlockData $blockData)
  {
    if ($this->inputObject === null) {
      $typeClass = $this->type;
      $this->inputObject = new $typeClass($this, $blockData);
    }

    return new Twig_Markup($this->inputObject->renderInputField(), 'UTF-8');
  }

}