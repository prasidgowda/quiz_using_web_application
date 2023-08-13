<?php
include 'database.php';
//select all the questions from the database;
$query= "SELECT * FROM questions";
$totalquestions=mysqli_num_rows(mysqli_query($connection,$query));//returns the number of rows after executing the query


?>

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
            <p>PHP Quizer</p>
        </div>
    </header>
    <main>
        <div class="container " id="instruction">
            <h1>Test Your Knowledge</h1>
            <p>This is a mcq type Quizer</p>
            <ul>
                <!-- Number of questions will be fetched from database -->
                <li><strong>Number of Questions:</strong><?php echo $totalquestions; ?></li>
                <!-- strong tag makes the word to be bold /important -->
                <li><strong>Type:</strong>Multiple Choice</li>
                <li><strong>Estimated Time:</strong><?php  echo $totalquestions*1.5 ;?></li> 
                <!-- 1.5min for each question -->
            </ul>
             <a href="question.php?n=1 " class=start>Start Quiz</a>
             <!-- n=1 parameter passes to the question.php -->
             <!-- when n=1  , question 1 is fetched from database-->
        </div>
    </main>
</body>
</html>