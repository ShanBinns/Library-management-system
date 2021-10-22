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
                    <form method="post" action="controller/HSaddbook_validate.php">
                    <h2>Enter the book details in the form below</h2>

                    <!--Progress Bar-->
                    <div class="container-progressbar">
                        <div class="progressbar">
                            <div class="progress-line"></div>
                            <div class=" circle active">Step 1</div>
                            <div class=" circle">Step 2</div>
                            <div class=" circle">Completed</div>
                        </div>
                    </div>
                    
                    <?php 
                        if(!empty($_SESSION['invalidErr'])){
                            echo '<div class="error">' . $_SESSION['invalidErr'] . '</div> <br>';
                            unset($_SESSION['invalidErr']);
                        }        
                    ?>

                    <!--Table Details-->
                    <fieldset>
                    <label><span class="error">*</span>Title:</label>    
                        <span class="error">
                            <?php 
                                if(!empty( $_SESSION['titleErr'])){
                                    echo  $_SESSION['titleErr']; unset($_SESSION['titleErr']);
                                }        
                            ?>
                        </span>        

                        <input type="text" name="title"  
                        value="<?php if(isset($_COOKIE['title'])){echo $_COOKIE['title'];} else {echo "";} ?>"
                        style="<?php if(!empty( $_SESSION['titleErrStyle'])){echo $_SESSION['titleErrStyle'];} unset($_SESSION['titleErrStyle']);?>">

                        <!--Author-->
                        <label><span class="error">*</span>Author:</label>
                            <span class="error">
                                <?php 
                                    if(!empty( $_SESSION['authorErr'])){
                                        echo  $_SESSION['authorErr'];  unset($_SESSION['authorErr']);
                                    }        
                                ?>
                            </span>
                        
                        <input type="text" name="author" 
                        value="<?php if(isset($_COOKIE['author'])){echo $_COOKIE['author'];} else {echo "";} ?>"
                        style="<?php if(!empty( $_SESSION['authorErrStyle'])){
                            echo  $_SESSION['authorErrStyle']; unset($_SESSION['authorErrStyle']);} ?>" >

                        <!--year-->
                        <label><span class="error">*</span>Year Published:</label> 
                        <span class="error">
                            <?php 
                                if(!empty( $_SESSION['yearErr'])){
                                    echo  $_SESSION['yearErr'];   unset($_SESSION['yearErr']);
                                }        
                            ?>
                        </span>
                            
                        <input type="number" name="year" 
                        value="<?php if(isset($_COOKIE['year'])){echo $_COOKIE['year'];} else {echo "";} ?>"
                        style="<?php  if(!empty( $_SESSION['yearErrStyle'])){echo $_SESSION['yearErrStyle']; unset($_SESSION['yearErrStyle']);}?>" placeholder="e.g. 1994" >
                                
                        <!--Cover-->
                        <label><span class="error">*</span>Book Cover(image):</label>      
                        <input type="file" id="image" name="image" accept="image/*" 
                        value="<?php if(isset($_COOKIE['image'])){echo $_COOKIE['image'];} else {echo "";} ?>"
                        style="<?php if(!empty( $_SESSION['imageErrStyle'])){echo $_SESSION['imageErrStyle']; unset($_SESSION['imageErrStyle']);} ?>" >

                        <span class="error">
                            <?php 
                                if(!empty( $_SESSION['imageErr'])){
                                    echo  $_SESSION['imageErr'];  unset($_SESSION['imageErr']);
                                }        
                            ?>
                        </span>   

                    </fieldset>
                    <fieldset>
                        <button class="next-btn" type="submit" name="next"><span>Next</span></button>
                    </fieldset>                                
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>