<?php 
    session_start();
    include 'include/header-sidenav.php'; 

    

    $title = $_SESSION['title'] ;
    $author = $_SESSION['author'] ; 
    $year = $_SESSION['year'] ; 
    $image = $_SESSION['image'];
    $isbn = $_SESSION['isbn']; 
    $callNumber = $_SESSION['callNumber']; 
    $subjectArea = $_SESSION['subjectArea']; 
    $copies = $_SESSION['copies']; 

    //Save information to File 
    $filename = "books.txt";
    $handle = fopen($filename, "a");  

    $bookinfo = " $image
    $title
    $author
    $year
    $isbn
    $callNumber
    $subjectArea
    $copies
    ";

    if(fwrite($handle, $bookinfo) == TRUE)
    {
        echo " ";
    }else{
        echo "";
        exit;
    } 
    fclose($handle);   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <title>Submission</title>
</head>
<body> 
    <div class="main-body">
        <div class="grid-container">
            <div class="section-heading">
            
            </div>
            <div class="section-content">
                <h2>Your submission has been completed</h2>
                
                <div class="form1">
                    <!--Progress Bar-->
                    <div class="container-progressbar">
                        <div class="progressbar">
                            <div class="progress-line"></div>
                            <div class=" circle active">Step 1</div>
                            <div class=" circle active">Step 2</div>
                            <div class=" circle active">Completed</div>
                        </div>
                    </div>

                    <div class="card">
                        <span class="zoom"><img src="img/<?php echo $_SESSION['image'];?>" alt="" height="70%" width="50%"> </span>

                        <h1><?php echo $_SESSION['title'] ;?></h1>
                        <p class="author"><?php echo $_SESSION['author'] ;?></p>
                        <p>Book Information</p>

                        <p>
                            Year: <?php echo $_SESSION['year'] ;?>  <br>
                            ISBN: <?php echo $_SESSION['isbn'] ;?> <br>
                            Subject Area: <?php echo $_SESSION['subjectArea'] ;?> <br>
                            Call Number:  <?php echo $_SESSION['callNumber'] ;?> <br>
                            Copies: <?php echo $_SESSION['copies'] ;?> <br>
                        </p>
                        <br>
                        <p><button><a href="HSviewbooks.php">View All Books in Library</a></button></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>