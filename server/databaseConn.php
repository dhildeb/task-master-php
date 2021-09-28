<?php
require '../../vendor/autoload.php';

class DBfunctions{

  private $db;
  
  function __construct(){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
    $this->db = new MongoDB\Driver\Manager($_SERVER['CONNECTION_STRING']);
    console_log("Database successfully connected!");
  }
  
  
  public function createList($newList){
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($newList);
    $this->db->executeBulkWrite('classroom.lists', $bulk);
    return "success";
  }

  public function createTask($newTask){
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($newTask);
    $this->db->executeBulkWrite('classroom.tasks', $bulk);
    return "success";
  }
  
  public function getLists(){
    $query = new MongoDB\Driver\Query([]);
    $lists = $this->db->executeQuery('classroom.lists', $query);

    return $lists;
  }

  public function getTasks(){
    $query = new MongoDB\Driver\Query([]);
    $cursor = $this->db->executeQuery('classroom.tasks', $query);
    $tasks = $cursor->toArray();
    return $tasks;
  }

  public function deleteList($id){
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk2 = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['id'=>$id], ['limit' => 1]);
    $this->db->executeBulkWrite('classroom.lists', $bulk);
    // cascade delete
    $bulk2->delete(['listId'=>$id]);
    $this->db->executeBulkWrite('classroom.tasks', $bulk2);
    return 'deleted';
  }

  public function deleteTask($id){
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['id'=>$id], ['limit' => 1]);
    $this->db->executeBulkWrite('classroom.tasks', $bulk);
    return 'deleted';
  }
  
  public function updateTask($id, $completed){
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(['id' => $id],
    ['$set' => ["completed" => $completed]],
    ['multi' => false, 'upsert' => false]);
    $this->db->executeBulkWrite('classroom.tasks', $bulk);
    return 'updated';
  }

}