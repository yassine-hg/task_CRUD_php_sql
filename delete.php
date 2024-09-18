<?php

include "db.php";

$pdo = connect();

if(!$pdo){
    echo "error";
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $detetquery = $pdo->prepare("DELETE  FROM personne WHERE id = :id");
    $delete = $detetquery->execute(["id"=>$id]);

    if($delete){
        header('Location: read.php');
        exit;
    }else{
        echo "Error";
    }
}else{
    echo "no ID provide";
}

?>