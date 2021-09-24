<?php
require '../../vendor/autoload.php';
include_once '../../client/util/logger.php';

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
  
  public function getLists(){
    $query = new MongoDB\Driver\Query([]);
    $lists = $this->db->executeQuery('classroom.lists', $query);

    return $lists;
  }

  public function deleteList($id){
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['id'=>$id], ['limit' => 1]);
    $this->db->executeBulkWrite('classroom.lists', $bulk);
    return 'deleted';
  }
}
  /* CRUD METHODS REVIEW

// update
// multi if false will only update one, upsert if true will create if not there
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->update(['id' => 112],
['$set' => ["Firstname" => $firstname]],
['multi' => false, 'upsert' => false])

*/