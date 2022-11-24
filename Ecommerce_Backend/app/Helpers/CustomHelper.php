<?php
if(!function_exists('udump')){
    function udump($arr=[]){
      echo "<pre>";
      print_r($arr);
      echo "</pre>";
    }
}

?>