<?php 
include 'database.php';
if(isset($_POST['submit']))  //if form is submitted
{
    //capture and store the que number, que name, correct choice in respective variables 
    $questionnumber=$_POST['questionnumber'];
    $questiontext=$_POST['questiontext'];
    $correctchoice=$_POST['correctchoice']; //correct opt number

    //Choice array
    $choice= array();  // creating an array named choice
    //choices are stored in this array
    $choice[1]=$_POST['choice1'];//index can be start from 0 also
    $choice[2]=$_POST['choice2'];
    $choice[3]=$_POST['choice3'];
    $choice[4]=$_POST['choice4'];

    //First query for Questions table
    $query="INSERT INTO QUESTIONS(";
    $query.="questionnumber,questiontext)";
    $query.="VALUES (";
    $query.="'{$questionnumber}','{$questiontext}' ";
    $query.=")";
    
    $result=mysqli_query($connection,$query);//query runs using this (mysqli_query) function and 
                                              //result is stored in result

   //Validate First Query
   if($result){
    foreach($choice as $option => $value) {
        if($value!=""){
            if($correctchoice == $option){
                $iscorrect=1;
            }
            else{
                $iscorrect=0;
            }

    //Second Query for Options table
    $query="INSERT INTO options (";
    $query.="questionnumber,iscorrect,coption)";
    $query.="VALUES (";
    $query.="'{$questionnumber}','{$iscorrect}','{$value}')";

    $insert_row=mysqli_query($connection,$query); //result is stored in variable 'insert_row'
    //Validate Insertion of Choices
    if($insert_row){
        continue;//continue if $insert_row is true (exists)
    }
    else{
        die("2nd Query for Choices could not be executed");
    }
        }
    }
    $message="Question has been added Successfully..!!";
   }
}
//Query to fetch the question number from database
$query="SELECT * FROM questions";
$questions=mysqli_query($connection,$query); //result of this query is stored in variable
$total=mysqli_num_rows($questions);
$next=$total+1;

?>



<!-- Its a form which adds the question to database -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Quizer</title>
    <link rel="stylesheet" href="quiz.css">
    
</head>
<body>
    <header>
        <div class="container">
            <p style="text-align:center">PHP Quizer</p>
        </div>
    </header>
    <main>
        <div class="container">
            <h1>Add  a Question</h1>
            <?php if(isset($message)){
                echo "<h3>". $message . "</h3>";
            }//if everything runs correctly , this will be displayed
            ?>
            <form method="POST" action="add.php">
                <p>
                    <label >Question Number:</label>
                    <input type="number" name="questionnumber" value="<?php echo $next; ?>" id="qn"></input>
                </p>
                <p>
                    <label >Question Text:</label>
                    <input type="text" name="questiontext" id="qt"></input>
                </p>
                <p>
                    <label >Choice 1:</label>
                    <input type="text" name="choice1" id="c1"></input>
                </p>
                <p>
                    <label >Choice 2:</label>
                    <input type="text" name="choice2" id="c2"></input>
                </p>
                <p>
                    <label >Choice 3:</label>
                    <input type="text" name="choice3" id="c3"></input>
                </p>
                <p>
                    <label >Choice 4:</label>
                    <input type="text" name="choice4" id="c4"></input>
                </p>
                <p>
                    <label >Correct Option Number</label>
                    <input type="number" name="correctchoice" id="cc"></input>
                </p>
                <input type="submit" name="submit" value="submit" id="sbmtBtn"></input>
            </form>
        </div>
    </main>
    
</body>
</html>