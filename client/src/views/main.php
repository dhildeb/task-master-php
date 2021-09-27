<?php 
include 'header.php';
require '../../vendor/autoload.php';

$listsController = new ListsController();
$tasksController = new TasksController();
$lists = $listsController->getLists();
$tasks = $tasksController->getTasks();

if(isset($_POST['listMaker'])){
  $listsController->createList();
  header('location: ../public/index.php');
}
if(isset($_POST['deleteList'])){
  $listId = htmlspecialchars($_POST['id'] ?? '', ENT_QUOTES);
  $listsController->deleteList($listId);
  header('location: ../public/index.php');
}
if(isset($_POST['createTask'])){
  $tasksController->createTask();
  header('location: ../public/index.php');
}
if(isset($_POST['id'])){
  $tasksController->updateTask();
  header('location: ../public/index.php');
}

if(isset($_POST['deleteTask'])){
  $taskId = htmlspecialchars($_POST['taskId'] ?? '', ENT_QUOTES);
  $tasksController->deleteTask($taskId);
  header('location: ../public/index.php');
}
?>

<div class="container">

  <div class="row align-content-center justify-content-around p-5">

    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#listModal'>
      Launch demo modal
    </button>
    <h1 class="col-12 text-center mb-5">Welcome to Task-Master!</h1>
    <?php 
      foreach($lists as $list){
      echo "<div class='col-md-4 col-sm-6 mb-3'>
              <div class='card'>
                <div class='card-header d-flex justify-content-between' style='background-color: $list->color;";
                    if(get_brightness($list->color) < 130){
                      echo "color: white";
                    }
                echo  "'>
                  <p>$list->name</p> 
                  <form action='' method='post' onsubmit='notify()'>
                    <input type='hidden' name='id' value='$list->id'>
                    <input class='text-white btn btn-danger' type='submit' name='deleteList' title='delete list' value='X'>
                  </form>
                </div>
                <div class='card-body'>";

                  foreach($tasks as $task){
                    if($task->listId === $list->id){
                      echo "
                      <div class='d-flex justify-content-between'>
                        <form method='post'>
                          <input type='checkbox' "; echo $task->completed ? 'checked' : '';
                          echo " name='check' onchange='submit()'>
                          <input type='hidden' name='id' value='$task->id'>
                        </form>
                        <p class='ml-3'>$task->body</p>
                        
                          <form action='' method='post'>
                            <input type='hidden' name='taskId' value='$task->id'>
                            <input type='submit' class='text-danger btn btn-white' title='delete task' name='deleteTask' value='X'>
                          </form>
                        </div>
                      ";
                    }
                  }

                  echo "
                  <form action='' method='post' class='input-group my-3'>
                    <input class='form-control' name='body' type='text' placeholder='task...'>
                    <input type='hidden' name='listId' value='$list->id'>
                  <input class='btn btn-primary input-group-append' type='submit' value='create' name='createTask' id='createList'>
                  </form>
                </div>
              </div>
            </div>";
      }
    ?>


  </div>
</div>
<?php 

include 'footer.php';