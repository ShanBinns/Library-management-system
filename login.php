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
        <div class="login-design container">                 
            <div class="login-form container">                
                <form method="post" action="controller/login_validate.php">
                    <h1><strong>SHS Library Management System</strong><img src="img/book.png" alt="" class="logo"> </h1>
                    <h3> Welcome Back! Log into your account.</h3>
            
                    <!--Error shown if username or password is entered incorrectly-->
                    <?php 
                        if(!empty($_SESSION['loginErr'])){
                            echo '<div class="error">' . $_SESSION['loginErr'] . '</div>';
                            unset($_SESSION['loginErr']);
                        }        
                    ?>
                    
                    <fieldset>
                        <!--email-->
                        <label for="email" class="email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];} else {echo "";} ?>"><strong>Email: <span class="error">*</span></strong></label>
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
                        <input type="password" name="password" required>
                    </fieldset>


                    <fieldset>
                    <button type="submit"class="btn-submit" name="submit">Login</button><br>
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                    </fieldset>

                    <fieldset class="other-actions">
                        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                        <p>Forgot your password? <a href="passwordReset.php">Click to reset password</a>.</p>
                        <p>Go back to Home <a href="index.php">Click Here</a>.</p>
                    </fieldset>
                </form>
            </div>
        </div>  
        <div class="HSfooter">
        <p>© Copyright 2021 Sana High School. Design by <strong>Shanique</strong></p>
        </div>     
</body>
</html>