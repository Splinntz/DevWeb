<?php
require __DIR__ . '/functions.php';
if ((isset($_POST['name']) && !empty($_POST['name'])) 
&& (isset($_POST['strength']) && !empty($_POST['strength'])) 
&& (isset($_POST['life']) && !empty($_POST['life']))
&& (isset($_POST['type']) && !empty($_POST['type']))) {
    addMonster($_POST['name'],$_POST['strength'],$_POST['life'],$_POST['type']);
    header('Location: index.php');
    //echo ("done");
}
else {
        //echo "fail";
    }
?>