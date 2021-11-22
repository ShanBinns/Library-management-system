<?php
    session_start();
    require_once "../include/config.php";
    ($_SESSION['type']);


    if($_SERVER["REQUEST_METHOD"]=="POST"){

        //Update account
        if(isset($_POST['librarianid'])){
            $libid =  $_POST['librarianid'];
            $name =  $_POST['name'];
            $email =  $_POST['email'];
            $type =  $_POST['type'];

        $query =  "UPDATE librarian SET name =  '".$name."', email =  '".$email."',type =  '".$type."'
                                        WHERE libid = '".$libid."' ";
        
                    
        if(mysqli_query($conn, $query))
        {
            $_SESSION['statusmessage'] = "User Account updated sucessfully";
            header("Location: ../account.php");
            exit();
        }else{
            $_SESSION['statusmessage'] = "Record Could not be Processed. Please try again later!";
            header("Location: ../account.php");
        }
        mysqli_close($conn);   
        }

         //If the remove button is pushed on the pending table
        if(isset($_POST['delete'])){
            $librarianid =  $_POST['delete'];

            $sql = "DELETE FROM librarian WHERE libid = '".$librarianid."'";
            if(mysqli_query($conn, $sql))
            {
                $_SESSION['statusmessage'] = "Record Successfully Deleted";
                header("Location: ../account.php");
            }
            else{
                $_SESSION['statusmessage'] = "Error! Record Could not be Deleted. Try again later!";
            }
        }

        //Admin option to add new user
        if(isset($_POST['adduser'])){

            $nameErr = $emailErr = $passwordErr ="";

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $type = $_POST['type'];

            if (!preg_match("/^[a-zA-Z ]+$/",$name)){
                $nameErr ="Username must contain only letters and space";
            }
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $emailErr = "Please enter a Valid Email Address";
            }
            if(strlen($password) <6){
                $passwordErr = "Password must be minimum of 6 characters";
            }

            if(empty($nameErr) && empty($emailErr) && empty($passwordErr)){

                $sql = "INSERT INTO librarian (name, email, type, password) VALUES ('". $name ."', '". $email ."','". $type ."','". md5($password) ."')";
                
                if(mysqli_query($conn, $sql))
                {
                    $statusmessage = "User added successfully";
                    $_SESSION['statusmessage'] = $statusmessage;
                    header("Location: ../account.php");
                    exit();
                }else{
                    $statusmessage = "Unable to add user, please try again later";
                    $_SESSION['statusmessage'] = $statusmessage;
                    header("Location: ../account.php");
                }
                
            
            }
            else{
                $_SESSION['nameErr'] =$nameErr ;
                $_SESSION['emailErr'] =$emailErr ;
                $_SESSION['passwordErr'] = $passwordErr  ;
                $statusmessage = "Unable to add user, please try again later";
                $_SESSION['statusmessage'] = $statusmessage;
                header("Location: ../account.php");
            }
            mysqli_close($conn);
        }

        //Librarian edit profile
        if(isset($_POST['edit-profile'])){
            $libid =  $_POST['edit-profile'];
            echo $libid;

            $nameErr = $emailErr = $passwordErr ="";

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $type = $_POST['type'];

            if (!preg_match("/^[a-zA-Z ]+$/",$name)){
                $nameErr ="Username must contain only letters and space";
            }
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $emailErr = "Please enter a Valid Email Address";
            }
            if(strlen($password) <6){
                $passwordErr = "Password must be minimum of 6 characters";
            }

            if(empty($nameErr) && empty($emailErr) && empty($passwordErr)){


                $query =  "UPDATE librarian SET name =  '".$name."', email =  '".$email."',type =  '".$type."',password =  '".md5($password)."' WHERE libid = '".$libid."' ";
                
                if(mysqli_query($conn, $query))
                {
                    $statusmessage = "Profile updated successfully";
                    $_SESSION['statusmessage'] = $statusmessage;
                    header("Location: ../profile.php");
                    exit();
                }else{
                    $statusmessage = "Unable to update user, please try again later";
                    $_SESSION['statusmessage'] = $statusmessage;
                    header("Location: ../profile.php");
                }
                
            
            }
            else{
                $_SESSION['nameErr'] =$nameErr ;
                $_SESSION['emailErr'] =$emailErr ;
                $_SESSION['passwordErr'] = $passwordErr  ;
                $statusmessage = "Unable to add user, please try again later";
                $_SESSION['statusmessage'] = $statusmessage;
                header("Location: ../account.php");
            }
            mysqli_close($conn);
        }

    }


    
?>
