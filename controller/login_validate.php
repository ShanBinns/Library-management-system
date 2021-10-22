<?php
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
        header("location: ../HSaddbook.php");
        exit;
    }


    $username = $password = "";
    $usernameErr = $passwordErr = $loginErr ="";
    $loginErr = "Incorrect Password or Username";

    if(isset($_POST['login'])){
        if(empty($_POST["username"])){
            $usernameErr = "Username is required";
        }else{
            $username = test_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
                $usernameErr = "Only letters and white space allowed";
            }
        }

        if(empty($_POST["password"])){
            $passwordErr = "Password is required";
        }else{
            $password = test_input($_POST["password"]);
        }

        
        
        if(empty($usernameErr) && empty($passwordErr)){
            if(($username=='HSadmin') && ($password =='HSpages123') ){
                if(isset($_POST['remember'])){                       //Setting cookies
                    setcookie('username',$username, time()+(60*60*7),"/");                        
                }

                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username; 
                header("Location: ../HSaddbook.php");
            }
            else{
                session_start();
                $_SESSION['loginErr'] = $loginErr;   
                header("Location: ../HSlogin.php");
            }
        }
        else{
            session_start();
            //Sending error messages back through sessions
            $_SESSION['usernameErr'] =$usernameErr ;
            $_SESSION['passwordErr'] = $passwordErr  ;
            $_SESSION['loginErr'] = $loginErr;
            header("Location: ../HSlogin.php");
        }
    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>