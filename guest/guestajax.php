<?php
require_once "../include/config.php";
session_start();

$request = 1;
if(isset($_POST['request'])){
    $request = $_POST['request'];
}



if($request == 1){
    $draw = $_POST['draw'];
    $row = $_POST['start'];
    $rowperpage = $_POST['length'];
    $columnIndex = $_POST['order'][0]['column']; 
    $columnName = $_POST['columns'][$columnIndex]['data']; 
    $columnSortOrder = $_POST['order'][0]['dir']; 

    $searchValue = mysqli_escape_string($conn,$_POST['search']['value']); 

    $searchQuery = " ";
    if($searchValue != ''){
    $searchQuery .= " and (title like '%".$searchValue."%' or 
    year like '%".$searchValue."%' or 
    subjectarea like'%".$searchValue."%' 
    or 
    author like'%".$searchValue."%' ) ";
    }

    
    $sel = mysqli_query($conn,"select count(*) as allcount from book");
    $records = mysqli_fetch_assoc($sel);
    $totalRecords = $records['allcount'];

    $sel = mysqli_query($conn,"select count(*) as allcount from book WHERE 1 ".$searchQuery);
    $records = mysqli_fetch_assoc($sel);
    $totalRecordwithFilter = $records['allcount'];

   $bookQuery = "select * from book WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    $bookRecords = mysqli_query($conn, $bookQuery);
    $data = array();

    while ($row = mysqli_fetch_assoc($bookRecords)) {

        
        
        $issueButton = "<button class='btn btn-sm btn-warning issueBook' data-id='".$row['id']."'>Preview Book</button>";
        
        $action = $issueButton;

        $data[] = array(
            "bookcover"=>$row['bookcover'],
    		"title"=>$row['title'],
    	    "author"=>$row['author'],
            "year"=>$row['year'],
    		"subjectarea"=>$row['subjectarea'],
    		"quantity"=>$row['quantity'],
            "action" => $action
            );
    }

    # Response
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
    );

    echo json_encode($response);
    exit;
}

// Fetch book details
if($request == 2){
    $id = 0;

    if(isset($_POST['id'])){
        $id = mysqli_escape_string($conn,$_POST['id']);
    }

    $record = mysqli_query($conn,"SELECT * FROM book WHERE id=".$id);

    $response = array();

    if(mysqli_num_rows($record) > 0){
        $row = mysqli_fetch_assoc($record);
        $response = array(
            "bookcover"=>$row['bookcover'],
    		"title"=>$row['title'],
    	    "author"=>$row['author'],
            "year"=>$row['year'],
    		"subjectarea"=>$row['subjectarea'],
    		"quantity"=>$row['quantity'],
        );

        echo json_encode( array("status" => 1,"data" => $response) );
        exit;
    }else{
        echo json_encode( array("status" => 0) );
        exit;
    }
}
