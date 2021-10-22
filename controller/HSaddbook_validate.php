<?php
    if(isset($_POST['submit'])){
        $_SESSION['username'] =$_POST['username'];  
    }
    
    $year = 0;
    $title = $author = $image= "";
    $invalidErr = "Please fill in a valid value for all required fields.";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["title"])){
            $titleErrStyle = "border:  1px solid #F08080;";
        }else{           
            $title = test_input($_POST["title"]);   
            if (!preg_match("/^[0-9a-zA-Z-?:;@$()!'-' ]*$/",$title)) {
                $titleErrStyle = "border:  1px solid #F08080;";
                $titleErr = "Please enter a valid book name";
            }
        }

        if(empty($_POST["author"])){
            $authorErrStyle = "border:  1px solid #F08080;"; 
        }else{
            $author = test_input($_POST["author"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$author)) {
                $authorErrStyle = "border:  1px solid #F08080;";
                $authorErr = "Only letters and white space allowed";
            }
        }

        if(empty($_POST["year"])){
            $yearErrStyle = "border:  1px solid #F08080;"; 
        }else{
            $year = test_input($_POST["year"]);
            if (!preg_match("/^[0-9]{4}$/",$year)) {
                $yearErrStyle = "border:  1px solid #F08080;";
                $yearErr = "Only 4 digit numbers";
            }
            if(($year<1000) || ($year >2050)){
                $yearErrStyle = "border:  1px solid #F08080;";
                $yearErr = "Please enter a valid date";
            }
        }

        if(empty($_POST["image"])){
            $imageErrStyle = "border:  1px solid #F08080;"; 
            $imageErr= "A cover image is required";
        }else{
            $image = test_input($_POST["image"]);
        }


        if(empty($titleErrStyle) && empty($authorErrStyle) && empty($yearErrStyle)&& empty($imageErrStyle)){
            session_start();
            $_SESSION['title'] =$_POST['title'];  
            $_SESSION['author'] =$_POST['author'];
            $_SESSION['year'] =$_POST['year'];
            $_SESSION['image'] =$_POST['image'];
            header("Location: ../HSaddbook2.php");                        
        }
        else{
            session_start();

            setcookie('title',$title,time()+(60*60*7),"/");
            setcookie('author',$author,time()+(60*60*7),"/");
            setcookie('year',$year,time()+(60*60*7),"/");
            setcookie('image',$image,time()+(60*60*7),"/");
            
            $_SESSION['titleErr'] = $titleErr ;
            $_SESSION['authorErr'] = $authorErr;
            $_SESSION['yearErr'] = $yearErr ;
            $_SESSION['imageErr'] = $imageErr;
            $_SESSION['titleErrStyle'] = $titleErrStyle;
            $_SESSION['authorErrStyle'] = $authorErrStyle;
            $_SESSION['yearErrStyle'] = $yearErrStyle;
            $_SESSION['imageErrStyle'] = $imageErrStyle;
            $_SESSION['invalidErr'] = $invalidErr;
            header("Location: ../HSaddbook.php");
        }
    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>