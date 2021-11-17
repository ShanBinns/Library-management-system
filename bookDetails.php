<?php 
    session_start();
    include 'include/header-sidenav.php'; 
    require_once "include/config.php";

    //Gets id from table view
    $id = $_GET['id'];

    //Gets info from the database  book table
    $sql = "SELECT * FROM book WHERE id = '".$id."' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $isbn = $row['isbn'];
            $title = $row['title'];
            $author = $row['author'];
            $year = $row['year'];
            $bookcover = $row['bookcover'];
            $callNo = $row['callNo'];
            $subjectarea = $row['subjectarea'];
            $quantity = $row['quantity'];
        }
    } 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    

    <title>Submission</title>
</head>
<body> 
    <div class="main-body">
        <div class="grid-container">
            <div class="section-heading">
            
            </div>
            <div class="section-content">
                <h2>Preview and Issue Books</h2><br>

                <!-- Search Modal -->
                <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                                <h1>Please enter the patron card ID</h1>
                                <form class="navbar-form " role="search">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Issue Book to Patron</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--End of Modal-->
                
                    <!--Card-->
                    <div class="card">
                        <span class="zoom"><img src="img/<?php echo $bookcover;?>" alt="" height="70%" width="50%"> </span>

                        <h1><?php echo $title ;?></h1>
                        <p class="author"><?php echo $author ;?></p>
                        <p>Book Information</p>

                        <p>
                            Year: <?php echo $year;?>  <br>
                            ISBN: <?php echo $isbn ;?> <br>
                            Subject Area: <?php echo $subjectarea ;?> <br>
                            Call Number:  <?php echo $callNo ;?> <br>
                            Copies: <?php echo $quantity ;?> <br>
                        </p>
                        <br>
                        <p><button type="button" data-toggle="modal" data-target="#searchModal" >Click to Issue Book to Patron</button></p>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>