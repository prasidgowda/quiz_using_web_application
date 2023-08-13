<!-- This file is to process the score-->
<?php
  include 'database.php';
?>

<?php
  session_start();
?>

<?php
  //For first question score will not be there
  if(!isset($_SESSION['score'])){
    $_SESSION['score']=0;
  }
  if($_POST){
    //We  also need total questions in this file
    $query="SELECT * FROM questions";
    $totalquestions=mysqli_num_rows(mysqli_query($connection,$query));

    // We need to capture the question number from where form was submitted
    $number=$_POST['number'];

    // Here we are using the selected option by the user
    $selectedchoice=$_POST['choice'];

    //What will be the next question
    $next=$number+1;

    //Determine the correct choice for the current question 
    $query="SELECT * FROM options WHERE questionnumber=$number AND iscorrect=1"; 
    $result=mysqli_query($connection,$query);
    $row=mysqli_fetch_assoc($result);

    $correctchoice= $row['id'];

    //Increase the score if selected choice is correct
    if($selectedchoice==$correctchoice){
        $_SESSION['score']++;
    }
    
    //Redirect to next question or final score page.
    if($number==$totalquestions){
        header("LOCATION: final.php");
    }
    else{
        header("LOCATION:question.php?n=".  $next);
    }
  }
?>