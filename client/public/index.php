<?php
require '../../vendor/autoload.php';


     $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
     if(!$action) {
       $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
       if(!$action) {
         $action = 'home';
       }
     }
     
    switch($action){
      default:
        include '../src/views/main.php';
    }

