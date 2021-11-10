<?php
require_once "include/config.php";

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

        // Update Buttons
        $updateButton = "<button class='btn btn-sm btn-info updateBook' data-id='".$row['id']."' data-toggle='modal' data-target='#updateModal' >Update</button>";

        // Delete Button
        $deleteButton = "<button class='btn btn-sm btn-danger deleteBook' data-id='".$row['id']."'>Delete</button>";

        //Issue Button
        $issueButton = "<button class='btn btn-sm btn-warning issueBook' data-id='".$row['id']."'>Issue</button>";
        
        $action = $updateButton." ".$deleteButton." ".$issueButton;

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

// Update book
if($request == 3){
    $id = 0;

    if(isset($_POST['id'])){
        $id = mysqli_escape_string($conn,$_POST['id']);
    }

    $record = mysqli_query($conn,"SELECT id FROM book WHERE id=".$id);
    if(mysqli_num_rows($record) > 0){

        $title = mysqli_escape_string($conn,trim($_POST['title']));
        $author = mysqli_escape_string($conn,trim($_POST['author']));
        $year = mysqli_escape_string($conn,trim($_POST['year']));
        $bookcover = mysqli_escape_string($conn,trim($_POST['bookcover']));
        $quantity = mysqli_escape_string($conn,trim($_POST['quantity']));

        
        if($title != '' && $author != '' && $year != '' && $bookcover != '' & $quantity != '' ){

            mysqli_query($conn,"UPDATE book SET title='".$title."',author='".$author."',year='".$year."',bookcover='".$bookcover."',quantity='".$quantity."' WHERE id=".$id);

            echo json_encode( array("status" => 1,"message" => "Record updated.") );
            exit;
        }else{
            echo json_encode( array("status" => 0,"message" => "Please fill all fields.") );
            exit;
        }
        
    }else{
        echo json_encode( array("status" => 0,"message" => "Invalid id.") );
        exit;
    }
}

// Delete book
if($request == 4){
    $id = 0;

    if(isset($_POST['id'])){
        $id = mysqli_escape_string($conn,$_POST['id']);
    }

    $record = mysqli_query($conn,"SELECT id FROM book WHERE id=".$id);
    if(mysqli_num_rows($record) > 0){

        mysqli_query($conn,"DELETE FROM book WHERE id=".$id);

        echo 1;
        exit;
    }else{
        echo 0;
        exit;
    }
}