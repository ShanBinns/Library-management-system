<?php

    require_once "../include/config.php";

    $username = $email =  $password = $re_password = "";
    $usernameErr = $emailErr = $passwordErr = $re_passwordErr ="";
    $loginErr = "Please fill in all fields with valid information";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['submit'])){
            echo "err";
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $re_password = mysqli_real_escape_string($conn, $_POST['re_password']);

            if (!preg_match("/^[a-zA-Z ]+$/",$username)){
                $usernameErr ="Username must contain only letters and space";
            }
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $emailErr = "Please enter a Valid Email Address";
            }
            if(strlen($password) <6){
                $passwordErr = "Password must be minimum of 6 characters";
            }
            if(strlen($password != $re_password)){
                $re_passwordErr = "Passwords do not match";
            }
            
            
            
            if(empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($re_passwordErr)){

                $sql = "INSERT INTO user (username, email,password) VALUES ('". $username ."', '". $email ."','". md5($password) ."')";
                    
                
                if(mysqli_query($conn, $sql))
                {
                    header("Location: ../HSaddbook.php");
                    exit();
                }else{
                    session_start();
                    $loginErr = "Error with registration, please try again later";
                    $_SESSION['loginErr'] = $loginErr;
                    header("Location: ../register.php");
                }
                mysqli_close($conn);
            
            }
            else{
                session_start();
                $_SESSION['usernameErr'] =$usernameErr ;
                $_SESSION['emailErr'] =$emailErr ;
                $_SESSION['passwordErr'] = $passwordErr  ;
                $_SESSION['re_passwordErr'] = $re_passwordErr;
                $_SESSION['loginErr'] = $loginErr;
                
                header("Location: ../register.php");
            }

            
        }
    }




?>