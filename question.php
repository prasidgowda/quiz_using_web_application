<?php
include 'database.php';
session_start(); 
//multiple times request to database will be generated to fetch question  

//Set Question Number
$number=$_GET['n'];  //if n=1 and 1 is stored in variable number
                     //current question number will be stored in number

//Query to fetch question
$query="SELECT * FROM questions WHERE questionnumber= $number";
// questionnumber from database


//Get The question
$result=mysqli_query($connection,$query);
$question=mysqli_fetch_assoc($result);//this function is used to fetch associative array

//Get Choices
$query="SELECT * FROM options WHERE questionnumber=$number";
$choices=mysqli_query($connection,$query);

//Get Total Questions
$query="SELECT * FROM questions";
$totalquestions=mysqli_num_rows(mysqli_query($connection,$query));

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Quizer</title>
    <link rel="stylesheet" href="quiz.css">
    <style>
        #submitbtn {
            background-color: black;
            color: white;
            padding: 10px 20px;
            font-family: monospace;
            font-size: 20px;
            border: 2px solid aqua;
            border-radius: 30px;
            box-shadow: 0 0 10px aqua ;
            cursor: pointer;
        }

        #submitbtn:hover {
            background-color: white;
            color: black;
        }
       
       input[type="radio"] {
        transform: scale(1.5); /* Increase the scale value to make the radio buttons larger */
        margin-right: 10px; /* Optional: Add some spacing between the radio button and the label */
    }
    .choicess li {
            padding: 5px;
            margin-bottom: 5px;
            cursor: pointer;
        }

        .choicess  li:hover {
            background-color:black;
            color:white;
            font-style: italic;
        }

        .selected {
            color: red;
        }
</style>

        
    </style>
</head>
<body>
    <header>
        <div class="container">
            <p >PHP Quizer</p>
        </div>
    </header>

    <main>
        <div class="container" id="qnnum">
            <!-- Present question and total questions fetched from database -->
            <div class="current">Question <?php echo $number ;?> Of <?php echo $totalquestions ; ?></div>

            <!-- Question fetched from database  -->
            <p class="question"> <?php echo $question['questiontext']; ?></p>
            <form method="POST" action="process.php">
            <ul class="choicess">
                <?php
                    while($row=mysqli_fetch_assoc($choices)){?>
                     <li><input type="radio" name="choice" value="<?php echo $row['id']; ?>"> <?php echo $row['coption'] ; ?></li>
                    <?php } 
                ?>
            </ul>
            <input type="hidden" name="number" value="<?php echo $number; ?>" >
            <!-- Input type hidden will not be displayed on the form but  this input type will be 
                 associate with the form data-->
                 
            <input type="submit" name="submit" value="Submit" id="submitbtn" >
                                    
            </form>
        </div>
    </main>
</body>
</html>