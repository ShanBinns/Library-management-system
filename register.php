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
    <title>Registration</title>
    <style>
        .error {color: #FF0000;}
    </style>
</head> 
<body>
        <div class="login-design container">                 
            <div class="login-form container">                
                <form method="post" action="controller/register_validate.php">
                    <h1><strong>SHS Library Management System</strong><img src="img/book.png" alt="" class="logo"> </h1>
                    <h3> Welcome! Please fill this form to create an account.</h3>
            
                    <!--Error shown if username or password is entered incorrectly-->
                    <?php 
                        if(!empty($_SESSION['loginErr'])){
                            echo '<div class="error">' . $_SESSION['loginErr'] . '</div>'.'<br>';
                            unset($_SESSION['loginErr']);
                        }        
                    ?>
                    
                    <fieldset>
                        <!--username-->
                        <label for="username" class="username" value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];} else {echo "";} ?>"><strong>Username: <span class="error">*</span></strong></label>
                        <span class="error">
                        <?php 
                            if(!empty( $_SESSION['usernameErr'])){
                                echo  $_SESSION['usernameErr'];
                                unset($_SESSION['usernameErr']);
                            }        
                        ?>
                        </span>
                        <input type="text" name="username" required>

                        <!--email-->
                        <label for="email" class="email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];} else {echo "";} ?>"><strong>Email Address: <span class="error">*</span></strong></label>
                        <span class="error">
                        <?php 
                            if(!empty( $_SESSION['emailErr'])){
                                echo  $_SESSION['emailErr'];
                                unset($_SESSION['emailErr']);
                            }        
                        ?>
                        </span>
                        <input type="text" name="email" required>

                        
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
                        <input type="password" name="password"  required>

                        <!--Re-Password-->
                        <label for="password" class="re_password"><strong>Confirm Password: <span class="error">*</span></strong></label>
                        <span class="error">
                        <?php 
                            if(!empty($_SESSION['re_passwordErr'])){
                                echo  $_SESSION['re_passwordErr'];
                                unset($_SESSION['re_passwordErr']);
                            }        
                        ?>
                        </span>
                        <input type="password" name="re_password"  required>
                    </fieldset>


                    <fieldset>
                    <button type=""class="btn-submit" name="submit">Register</button><br>
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                    </fieldset>
                    <fieldset class="other-actions">
                    <p>Already have an account? <a href="login.php">Login here</a>.</p>
                    </fieldset>
                </form>
            </div>
        </div>  
        <div class="HSfooter">
        <p>© Copyright 2021 Sana High School. Design by <strong>Shanique</strong></p>
        </div>     
</body>
</html>