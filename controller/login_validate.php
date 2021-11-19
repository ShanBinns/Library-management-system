<?php
    require_once "../include/config.php";
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
        header("location: ../HSaddbook.php");
        exit;
    }


    $email = $password = "";
    $emailErr = $passwordErr = "";
    $loginErr = "Incorrect Password or Username";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $email_error = "Please enter a Valid Email Address";
            }
        
            if(strlen($password) <6){
                $passwordErr = "Password must be minimum of 6 characters";
            }
        
        
        if(empty($emailErr) && empty($passwordErr) ){
            $result = mysqli_query($conn, "SELECT * FROM librarian WHERE email = '". $email. "' and password = '". md5($password). "'");

            if(!empty($result)){
                if($row = mysqli_fetch_array($result)){
                    session_start();
                    $_SESSION['userid'] = $row['libid'];
                    $_SESSION['username'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['type'] = $row['type'];
                    $_SESSION['password'] = $row['password'];
                    header("location: ../dashboard.php");
                }else{
                    session_start();
                    $_SESSION['emailErr'] =$emailErr ;
                    $_SESSION['passwordErr'] = $passwordErr  ;
                    $_SESSION['loginErr'] = $loginErr;
                    header("Location: ../login.php");
                }
            }
            
        }
        else{
            session_start();
            $_SESSION['emailErr'] =$emailErr ;
            $_SESSION['passwordErr'] = $passwordErr  ;
            $_SESSION['loginErr'] = $loginErr;
            header("Location: ../login.php");
        }
    }

}

?>