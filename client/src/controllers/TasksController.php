<?php

require '../../vendor/autoload.php';

class TasksController{

  private $db;

  function __construct(){
  $this->db = new DBfunctions();
  }

  public function createTask(){
    $body = htmlspecialchars($_POST["body"]?? '', ENT_QUOTES);
    $listId = htmlspecialchars($_POST["listId"]?? '', ENT_QUOTES);
    $id = uniqid();
  
    $newTask = ["body" => $body, "listId" => $listId, "id" => $id, "completed" => false];
    $Task = $this->db->createTask($newTask);
    return $Task;
  }

  public function getTasks(){
    return $this->db->getTasks();
  }
  
  function updateTask(){
    $completed = isset($_POST['check']);
    $id = htmlspecialchars($_POST["id"]?? '', ENT_QUOTES);
    return $this->db->updateTask($id, $completed);
  }

  function deleteTask($id){
   return $this->db->deleteTask($id);
  }
}