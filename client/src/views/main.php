<?php 
include 'header.php';
require '../../vendor/autoload.php';

$listsController = new ListsController();
$tasksController = new TasksController();
$lists = $listsController->getLists();
$tasks = $tasksController->getTasks();
$activeList;

if(isset($_POST['listMaker'])){
  $listsController->createList();
  header('location: ../public/index.php');
}
if(isset($_POST['deleteList'])){
  console_log($_POST);
  $listId = htmlspecialchars($_POST['id'] ?? '', ENT_QUOTES);
  // $listsController->deleteList($listId);
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

    <h1 class="col-12 text-center mb-5">Welcome to Task-Master!</h1>
    <?php 
      foreach($lists as $list){
      echo "<div class='col-md-4 col-sm-6 mb-3'>
              <div class='card' onclick='openModal(`$list->id`)'>
                <div class='card-header d-flex justify-content-between' style='background-color: $list->color;";
                    if(get_brightness($list->color) < 130){
                      echo "color: white";
                    }
                echo  "'>
                  <p>$list->name</p> 
                  <form action='' method='post' id='deleteList'>
                    <input type='hidden' name='id' value='$list->id'>
                    <button class='text-white btn btn-danger' name='deleteList' title='delete list' onclick='notify()'>X</button>
                  </form>
                </div>
                <div class='card-body list-h' style='max-height:175px; overflow:hidden'>";
                    
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
                          // CREATE LIST FORM
                  echo "
                  <form action='' method='post' class='input-group my-3'>
                    <input class='form-control' name='body' type='text' placeholder='task...'>
                    <input type='hidden' name='listId' value='$list->id'>
                  <input class='btn btn-primary input-group-append' type='submit' value='create' name='createTask' id='createList'>
                  </form>
                </div>
              </div>
            </div>";
                    // LIST MODAL
            echo " <div class='modal fade' id='$list->id' tabindex='-1' role='dialog' aria-labelledby='$list->id' aria-hidden='true'>
             <div class='modal-dialog' role='document'>
               <div class='modal-content'>
                 <div class='modal-header'>
                   <h5 class='modal-title' id='$list->id'>Modal title</h5>
                   <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                     <span aria-hidden='true'>&times;</span>
                   </button>
                 </div>
                 <div class='modal-body'>";
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
                      ";
                      echo "
                      <form action='' method='post'>
                      <input type='hidden' name='taskId' value='$task->id'>
                      <input type='submit' class='text-danger btn btn-white' title='delete task' name='deleteTask' value='X'>
                      </form>
                      </div>";
                    }
                  }
                  echo "
                 </div>
                 <div class='modal-footer'>
                 <form action='' method='post' class='input-group my-3'>
                 <input class='form-control' name='body' type='text' placeholder='task...'>
                 <input type='hidden' name='listId' value='$list->id'>
               <input class='btn btn-primary input-group-append' type='submit' value='create' name='createTask' id='createList'>
               </form>
                 </div>
               </div>
             </div>
           </div>";
      }

    ?>


  </div>
</div>
<script> 
// import axios from 'axios'
const url = ''
function openModal(listId){
  console.log(listId)
   $('#'+listId).modal('toggle')
   } 
   function notify(){
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
      )
      const form = document.getElementById("deleteList")
      console.log(form)
      form.method = 'post'
      form.submit()
  }
})
}
   </script>
<?php 

include 'footer.php';