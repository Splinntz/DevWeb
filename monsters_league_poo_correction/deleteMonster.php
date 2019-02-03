<?php
require __DIR__ . '/functions.php';
if ((isset($_POST['deleted_monster']) && !empty($_POST['deleted_monster']))) {
    deleteMonster($_POST['deleted_monster']);
    header('Location: index.php');
    //echo("done");
}
else {
    //echo"fail";
}

?>