<?php 
    session_start();
    include 'include/header-sidenav.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <style>
        .error {color: #FF0000;}
    </style>
    <title>Management</title>
</head>
<body>
<div class="main-body">
        <div class="grid-container">
            <div class="section-heading">
                <h3><i class="fas fa-plus-circle"></i> Add a book</h3>
            </div>
            <div class="section-content">
                
                <div class="form1">                    
                    <form method="post" action="controller/HSaddbook_validate2.php">
                        <h2>Enter the book details in the form below</h2>

                        <!--Progress Bar-->
                        <div class="container-progressbar">
                            <div class="progressbar">
                                <div class="progress-line"></div>
                                <div class=" circle active">Step 1</div>
                                <div class=" circle active">Step 2</div>
                                <div class=" circle">Completed</div>
                            </div>
                        </div>

                        <?php 
                            if(!empty($_SESSION['invalidErr'])){
                                echo '<div class="error">' . $_SESSION['invalidErr'] . '</div>';
                                unset($_SESSION['invalidErr']);
                            }        
                        ?>
                        <fieldset>
                            <br><label><span class="error">*</span>ISBN (ISBN-13/ISBN-10 format):</label>  
                            <span class="error">
                            <?php 
                                if(!empty( $_SESSION['isbnErr'])){ 
                                    echo  $_SESSION['isbnErr']; unset($_SESSION['isbnErr']); }        
                            ?>
                            </span>
                            <input type="text" name="isbn"
                            value="<?php if(isset($_COOKIE['isbn'])){echo $_COOKIE['isbn'];} else {echo "";} ?>"  
                            style="<?php if(!empty( $_SESSION['isbnErrStyle'])){echo $_SESSION['isbnErrStyle'];} unset($_SESSION['isbnErrStyle']);?>" placeholder="e.g. 978-3-16-148410-0">
                            
                                                        
                        
                            <label><span class="error">*</span>Call Number:</label>  
                            <span class="error">
                            <?php 
                                if(!empty( $_SESSION['callNumberErr'])){ 
                                    echo  $_SESSION['callNumberErr']; unset($_SESSION['callNumberErr']); }        
                            ?>
                            </span>

                            <input type="text" name="callNumber" 
                            value="<?php if(isset($_COOKIE['callNumber'])){echo $_COOKIE['callNumber'];} else {echo "";} ?>"
                            style="<?php if(!empty( $_SESSION['callNumStyle'])){echo $_SESSION['callNumStyle'];} unset($_SESSION['callNumStyle']);?>" placeholder="e.g. ML410.B1.M67 2000">
                            
                                                            
                        
                            <label><span class="error">*</span>Subject Area:</label>  
                            <span class="error">
                                <?php 
                                    if(!empty( $_SESSION['subAreaErr'])){ 
                                        echo  $_SESSION['subAreaErr']; unset($_SESSION['subAreaErr']); }        
                                ?>
                            </span>

                            <input type="text" name="subjectArea" 
                            value="<?php if(isset($_COOKIE['subjectArea'])){echo $_COOKIE['subjectArea'];} else {echo "";}?>"
                            style="<?php if(!empty( $_SESSION['subAreaStyle'])){echo $_SESSION['subAreaStyle'];} unset($_SESSION['subAreaStyle']); ?>" placeholder="e.g. History" >
                            
            
                            <label><span class="error">*</span>Number of Copies:</label>  
                            <input type="number" name="copies"  
                            value="<?php if(isset($_COOKIE['copies'])){echo $_COOKIE['copies'];} else {echo "";}?>"
                            style="<?php if(!empty( $_SESSION['copyErrStyle'])){echo $_SESSION['copyErrStyle'];} unset($_SESSION['copyErrStyle']);?>"  placeholder="e.g. 2">
                                <?php 
                                    if(!empty( $_SESSION['copyErr'])){ 
                                        echo  $_SESSION['copyErr']; unset($_SESSION['copyErr']); }        
                                ?>
                            </span>
                            
                        </fieldset>
                            
                        <fieldset>
                            <button class="next-btn" type="submit" name="submit"><span>Submit</span></button>
                        </fieldset>                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
</body>
</html>