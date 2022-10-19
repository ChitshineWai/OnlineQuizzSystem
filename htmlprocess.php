<?php
include("connection.php");
session_start();
if(!isset($_SESSION['score'])){
$_SESSION['score'] = 0;
}

  
if(isset($_POST['next_q'])){
  $quiz = $_POST['quiz'];
  $h_number = $_POST['h_number'];
  $next = $h_number + 1;
  //total
  $query = "SELECT * FROM html_question";
  $rr = $con->query($query);
  $total = $rr->num_rows;

  // get correct answer
  $selc = "SELECT * FROM html_choice WHERE q_id = $h_number AND true_ans = 1";
  $r = $con->query($selc);
  $row = mysqli_fetch_array($r); 
  $correct_choice = $row['true_ans'];

  //compare
  if($correct_choice == $quiz){
    $_SESSION['score'] ++;
  }

  if($h_number == $total){
    header("location:htmlfinal.php");
    exit();
  }else{
    header("location:htmlquiz.php?q_id=$next");
  }
}

?> 
<?php

if(isset($_POST['start_a'])){
   unset($_SESSION['score']);
header("location:htmlquiz.php?q_id=1");
}

if(isset($_POST['home'])){
  unset($_SESSION['score']);
header("location:index.php");
}

if(isset($_POST['f_answer'])){
  unset($_SESSION['score']);
header("location:htmlanswer.php");
}
?>