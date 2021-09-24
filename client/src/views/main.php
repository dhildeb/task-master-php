<?php 
include 'header.php';
require '../../vendor/autoload.php';
$listsController = new ListsController();
$lists = $listsController->getLists();

if(isset($_POST['listMaker'])){
  $listsController->createList();
  header('location: ../public/index.php');
}

if(isset($_POST['deleteList'])){
  $listsController->deleteList($_POST['id']);
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
                <div class='card-body'>

 

                </div>
              </div>
            </div>";
      }
    ?>

  </div>
</div>

<?php 

include 'footer.php';