<?php
session_start();
include("../connection.php");
if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}

if(isset($_POST['next_q'])){
    $quiz = $_POST['quiz'];
    $h_number = $_POST['h_number'];
    $next = $h_number+1;
    
    //total
    $sel = "SELECT * FROM php_question";
    $r = $con->query($sel);
    $total = mysqli_num_rows($r);

    //get correct choice
    $sele = "SELECT * FROM php_choice WHERE q_id='$h_number' and true_ans=1";
    $r = $con->query($sele);
    $row = mysqli_fetch_array($r);
    $correct_choice = $row['true_ans'];

    //compare
    if($quiz == $correct_choice){
        $_SESSION['score'] ++;
    }


//final
    if($h_number == $total){
        header("location:phpfinal.php");
        exit();
    }else{
        header("location:phpquiz.php?q_id=$next");
    }

}
?>
<?php

if(isset($_POST['start_a'])){
   unset($_SESSION['score']);
header("location:phpquiz.php?q_id=1");
}

if(isset($_POST['home'])){
  unset($_SESSION['score']);
header("location:../index.php");
}
?>
