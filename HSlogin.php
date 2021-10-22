<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <title>Login</title>
    <style>
        .error {color: #FF0000;}
    </style>
</head> 
<body>
        <div class="page-design container">                 
            <div class="login-form container">                
                <form method="post" action="controller/login_validate.php">
                    <h1><strong>SHS Library Management System</strong><img src="img/book.png" alt="" class="logo"> </h1>
            
                    <!--Error shown if username or password is entered incorrectly-->
                    <p><span class="error">* required field</span></p>
                    <?php 
                        if(!empty($_SESSION['loginErr'])){
                            echo '<div class="error">' . $_SESSION['loginErr'] . '</div>';
                            unset($_SESSION['loginErr']);
                        }        
                    ?>
                    
                    <fieldset>
                        `<!--username-->
                        <label for="username" class="username" value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];} else {echo "";} ?>"><strong>Username: <span class="error">*</span></strong></label>
                        <span class="error">
                        <?php 
                            if(!empty( $_SESSION['usernameErr'])){
                                echo  $_SESSION['usernameErr'];
                                unset($_SESSION['usernameErr']);
                            }        
                        ?>
                        </span>
                        <input type="text" name="username" placeholder= "HSadmin">

                        
                        <!--password-->
                        <label for="password" class="password"><strong>Password: <span class="error">*</span></strong></label>
                        <span class="error">
                        <?php 
                            if(!empty($_SESSION['passwordErr'])){
                                echo  $_SESSION['passwordErr'];
                                unset($_SESSION['passwordErr']);
                            }        
                        ?>
                        </span>
                        <input type="password" name="password" placeholder="HSpages123">
                    </fieldset>

                    <fieldset>
                    <button type="submit"class="btn-submit" name="login">Submit</button><br>
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                    </fieldset>
                </form>
            </div>
        </div>  
        <div class="HSfooter">
        <p>© Copyright 2021 Sana High School. Design by <strong>Shanique</strong></p>
        </div>     
</body>
</html>