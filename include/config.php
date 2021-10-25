<?php 

$dbserver ="localhost";
$user = "root";
$password = "";
$dbname = "library_management";


    try{
        $conn = mysqli_connect($dbserver,$user,$password,"$dbname");
        
    }catch(mysqli_sql_exception $e)
    {
        die('Could not Connect My Sql:');
        echo "You are not connected".$e;
    
    }


?>