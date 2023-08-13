<?php
  session_start();
  include 'database.php';
  // Select all the questions from the database
  $query = "SELECT * FROM questions";
  $totalquestions = mysqli_num_rows(mysqli_query($connection, $query));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Quizer</title>
    <link rel="stylesheet" href="quiz.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script> 
        $(document).ready(function(){
            $(".scoreboard").hide(); // Hide the score initially

            $("#viewScoreBtn").click(function(){
                $(".scoreboard").show(); // Show the score
            });

            $("#hideScoreBtn").click(function(){
                $(".scoreboard").hide(); // Hide the score
            });
        });
    </script> 
</head>
<body>
    <header>
        <div class="container">
            <p>PHP Quizer</p>
        </div>
    </header>

    <main>
        <div class="container">
            <h2>Your Result</h2>
            <p>Congratulations.... You have completed this test successfully...!!</p>
            <button id="viewScoreBtn">View Score</button>
            <button id="hideScoreBtn">Hide Score</button>
            <div class="scoreboard">
                <p>Your <strong>Score</strong> is <?php echo $_SESSION['score']; ?> Out of <?php echo $totalquestions ; ?> </p>
                <?php
               $scr= $_SESSION['score']; 
               $tot=$totalquestions;
               $grade=($scr/$tot)*100;

               if($grade>=80){
                echo  " wah...🙌🙌 Genius    😍";
               }
               else if($grade<80 && $grade>=60){
                echo "WAhhh.... Superb.....🤩";
               }
               else if($grade<60 && $grade>=40){
                echo "OOO....NOT BAD...!!🤞🤞";
               }
               else if($grade<40){
                echo "OOOPPPSSS...!!!  Need To Improve  ...🙃🫠🫠";
               }
               
            ?>
            </div>
            <?php unset($_SESSION['score']); ?>

           
        </div>
    </main>
</body>
</html>