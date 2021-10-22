<?php
    $callNumber = 0;
    $isbn = $callNumber = $subjectArea = $copies = "";
    $invalidErr = "Please fill in a valid value for all fields";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["isbn"])){
            $isbnErrStyle = "border:  1px solid #F08080;";
        }else{           
            $isbn = test_input($_POST["isbn"]);
            if (!preg_match("/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/",$isbn)) {
                $isbnErrStyle = "border:  1px solid #F08080;";
                $isbnErr = " Please enter in ISBN-13 or ISBN-10 format";
            }
        }

        if(empty($_POST["callNumber"])){
            $callNumStyle = "border:  1px solid #F08080;";
        }else{           
            $callNumber = test_input($_POST["callNumber"]);
            if (!preg_match("/^[a-zA-Z0-9. ]*$/",$callNumber)) {
                $callNumStyle = "border:  1px solid #F08080;";
                $callNumberErr = "Only letters, period and white space allowed";
            }
        }

        if(empty($_POST["subjectArea"])){
            $subAreaStyle = "border:  1px solid #F08080;";
        }else{           
            $subjectArea = test_input($_POST["subjectArea"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$subjectArea)) {
                $subAreaStyle = "border:  1px solid #F08080;";
                $subAreaErr = "Only letters and white space allowed";
            }
        }

        if(empty($_POST["copies"])){
            $copyErrStyle = "border:  1px solid #F08080;"; 
        }else{
            $copies = test_input($_POST["copies"]);
            if (!preg_match("/^[0-9]$/",$copies) && ($copies<1 || $copies >200) ) {
                $copyErrStyle = "border:  1px solid #F08080;";
                $copyErr = "Enter any number of books between 1 and 200";
                }
            }

            if(empty($isbnErrStyle) && empty($callNumStyle) && empty($subAreaStyle)&& empty($copyErrStyle)){
                session_start();
                $_SESSION['isbn'] =$_POST['isbn'];  
                $_SESSION['callNumber'] =$_POST['callNumber'];
                $_SESSION['subjectArea'] =$_POST['subjectArea'];
                $_SESSION['copies'] =$_POST['copies'];
                header("Location: ../submission.php");                        
            }
            else{
                session_start();

                setcookie('isbn',$isbn,time()+(60*60*7),"/");
                setcookie('callNumber',$callNumber,time()+(60*60*7),"/");
                setcookie('subjectArea',$subjectArea,time()+(60*60*7),"/");
                setcookie('copies',$copies,time()+(60*60*7),"/");

                $_SESSION['callNumberErr'] = $callNumberErr;
                $_SESSION['subAreaErr'] = $subAreaErr;
                $_SESSION['isbnErr'] = $isbnErr ;
                $_SESSION['copyErr'] = $copyErr;
                $_SESSION['copyErrStyle'] = $copyErrStyle;
                $_SESSION['subAreaStyle'] = $subAreaStyle;
                $_SESSION['isbnErrStyle'] = $isbnErrStyle;
                $_SESSION['callNumStyle'] = $callNumStyle;
                $_SESSION['invalidErr'] = $invalidErr;
                header("Location: ../HSaddbook2.php");
            }
        }
    
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>