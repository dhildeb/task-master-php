<?php
console_log('models');
class ListSheet
{

  private $id;
  private $name;
  private $color;
  
  function __construct($newName = "", $newColor = "")
  {
    $this->id = uniqid();
    $this->name = $newName;
    $this->color = $newColor;
  }
}