<?php 
    session_start();
    require_once "../include/config.php";
    
    
    //Validates Patron ID that was entered from bookdetails.php form and sends info to issuebook.php in session  
    $patronId = $usernotfound = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['submit'])){
            $id = $_SESSION['id'];
            
        $patronId = mysqli_real_escape_string($conn, $_POST['patronId']);
        if (!preg_match("/^[0-9]$/",$patronId)) {
            $usernotfound = "The patron's card ID is a number. Please try again!";
        }
        
        if(empty($usernotfound)){
            $result = mysqli_query($conn, "SELECT * FROM librarycard WHERE cardid = '". $patronId."'");
            if(!empty($result)){
                if($row = mysqli_fetch_array($result)){
                    
                    $_SESSION['cardid'] = $row['cardid'];
                    $_SESSION['bookid'];
                    header("location: ../issuebooks.php");
                }else{
                    $_SESSION['usernotfound'] = $usernotfound ;
                    header("Location: ../bookDetails.php?id=".$id);
                }
            }
        }
        else{
            $_SESSION['usernotfound'] = $usernotfound ;
            header("Location: ../bookDetails.php?id=".$id);
        }
    }


    //If the remove button is pushed on the pending table
    if(isset($_POST['delete'])){
        //This functins is to be fixed. It is currently only deleting the last in array 
        $proid = $_POST['id'];
        echo $proid;

        $sql = "DELETE FROM processbook WHERE processid = '".$proid."'";
        if(mysqli_query($conn, $sql))
        {
            $_SESSION['statusmessage'] = "Record Successfully Deleted";
            header("Location: ../issuebooks.php");
        }
        else{
            $_SESSION['statusmessage'] = "Error! Record Could not be Deleted. Try again later!";
        }
    }

    //If the process button is pushed on the pending table get book and patron data and store data in borrowed book page
    if(isset($_POST['process'])){
        $proid = $_POST['id'];
        
        $sql = "SELECT * FROM processbook WHERE processid = '".$proid."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $cardid = $row['cardid'];
                $isbn = $row['isbn'];
            }
        }
        else{
            $_SESSION['statusmessage'] = "Error! Record Could not be Processed. Try again later!";
            header("Location: ../issuebooks.php");
        }

        //Stores the book details into the borrowed book table, removes it from pending table and decrements the quantity available. Also inserts the data into return books table. Leaving return date empty.
        $libid = $_SESSION['userid'];
        $date = date('m/d/Y');
        $status = "pending";

        $query = "INSERT INTO borrowbook(cardid, isbn, libid, bdate) VALUES ('". $cardid ."', '". $isbn ."','". $libid ."','". $date ."')";
        
        $queryTwo = mysqli_query($conn, "INSERT INTO returnbook(cardid, isbn, libid,status) VALUES ('". $cardid ."', '". $isbn ."','". $libid ."','". $status ."')");

        $delQuery = mysqli_query($conn, "DELETE FROM processbook WHERE processid = '".$proid."'");
        $decreaseQuery = mysqli_query($conn, "UPDATE book SET quantity=quantity-1 WHERE isbn = '".$isbn."'");
                    
        if(mysqli_query($conn, $query))
        {
            $_SESSION['statusmessage'] = "Book Successfully Issued to Patron Cart";
            header("Location: ../issuebooks.php");
            exit();
        }else{
            $_SESSION['statusmessage'] = "Record Could not be Processed. Please try again later!";
            header("Location: ../issuebooks.php");
        }
        mysqli_close($conn);       

    }

    //If user clicks return book button, the return date is added to the returnbook database and the book status changes to returned
    if(isset($_POST['return'])){
        $date = date('m/d/Y');
        $status = "returned";
        $issueid = $statusmessage = "";
        
        $issueid = mysqli_real_escape_string($conn, $_POST['issueid']);
        if (!preg_match("/^[0-9]$/",$issueid)) {
            $statusmessage = "Please enter a valid issue number from the table below!";
        }

        $sql = "SELECT * FROM borrowbook WHERE issueid = '". $issueid."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $cardid = $row['cardid'];
                $isbn = $row['isbn'];
            }
        }
        else{
            $_SESSION['statusmessage'] = $statusmessage ;
            header("Location: ../issuebooks.php");
        }


        //Updating returned table and update book quantity 
        $queryTwo =  mysqli_query($conn, "UPDATE returnbook SET 
                                        rdate =  '".$date."', status =  '".$status."'
                                        WHERE cardid = '".$cardid."' AND isbn = '".$isbn."'");
        
        $increaseQuery = mysqli_query($conn, "UPDATE book SET quantity=quantity+1 WHERE isbn = '".$isbn."'");

        if(mysqli_query($conn, $queryTwo))
        {
            $_SESSION['statusmessage'] = "Book Successfully Issued to Patron Cart";
            header("Location: ../issuebooks.php");
            exit();
        }else{

            header("Location: ../issuebooks.php");
        }
        mysqli_close($conn);       
                                
    }

}

?>