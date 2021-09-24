<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
  integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <title>Task Master PHP</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <form action="." method="post" class="mt-3 mr-3">
            <input type="text" placeholder="List Name..." name="listName">
            <input type="color" name="listColor">
            <button class="btn btn-primary" type="submit" name="listMaker">Create</button>
          </form>
        </ul>
      </div>
    </div>
  </nav>
                 <!-- Modal -->
                 <div class='modal fade' id='listModal' tabindex='-1' role='dialog' aria-labelledby='listModal' aria-hidden='true'>
                  <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='listModal'>Modal title</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>
                        ...
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                        <button type='button' class='btn btn-primary'>Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>