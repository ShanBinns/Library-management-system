<?php 

$dbserver ="localhost";
$user = "root";
$password = "";
$dbname = "highschoolbooks_db";


    try{
        $conn = mysqli_connect($dbserver,$user,$password,"$dbname");
        
    }catch(mysqli_sql_exception $e)
    {
        die('Could not Connect My Sql:');
        echo "You are not connected".$e;
    
    }

     //set timezone
    date_default_timezone_set('America/Los_Angeles');

    

?>