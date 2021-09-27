<?php

require '../../vendor/autoload.php';

class ListsController{

  private $db;

  function __construct(){
  $this->db = new DBfunctions();
  }

  
  public function createList(){
    $listName = htmlspecialchars($_POST["listName"] ?? '', ENT_QUOTES);
    $listColor = htmlspecialchars($_POST["listColor"] ?? '', ENT_QUOTES);
    $id = uniqid();
  
    $newList = ["name" => $listName, "color" => $listColor, "id" => $id];
    $list = $this->db->createList($newList);

    return $list;
  }

  public function getLists(){
    return $this->db->getLists();
  }
  
  function deleteList($id){
   return $this->db->deleteList($id);
  }
}