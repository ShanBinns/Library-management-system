<?php 
    session_start();
    require_once "../include/config.php";
    include '../include/header-sidenav.php'; 

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="../css/styles.css?v=<?php echo time(); ?>">
    <link href='DataTables/datatables.min.css' rel='stylesheet' type='text/css'>
    <script src="jquery-3.5.1.min.js"></script>
    <script src="DataTables/datatables.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <title>View Books Records</title>
</head>
<body> 
    <div class="main-body">
        <div class="grid-container">
            <div class="section-heading">
                <h3><i class="fas fa-eye"></i> View Books</h3>
            </div>
            <div class="section-content">

                <h2>Below is the list of books in the library</h2><br>
                <p>Search records by title, year, Subject or author. Click the header of a column to sort table.</p>

            <div class="container">
            <!-- View Book Table -->
            <table id='bookTable' class='display dataTable' width='100%'>
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year</th>                
                        <th>Subject</th>
                        <th>Copies</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
            </table>

        </div>

        </div>
    </div>
</div>

<script>
        $(document).ready(function(){
            var bookDataTable = $('#bookTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'guestajax.php'
                },
                'columns': [
                    { data: 'bookcover',render: function (data, type, row, meta) {
                        return '<img src="../img/' + data + '" height="60" width="60"/>';} },
                        { data: 'title' },
                    { data: 'author' },
                    { data: 'year' },
                    { data: 'subjectarea' },
                    { data: 'quantity' },
                    { data: 'action' },
                ]
            });


             // Issue record
            $('#bookTable').on('click','.issueBook',function(){
                var id = $(this).data('id');

                $('#txt_bookid').val(id);
                
                $.ajax({
                    url: 'guestajax.php',
                    type: 'post',
                    data: {request: 2, id: id},
                    success: function(data){
                        window.location.href = 'guestbookdetails.php?id='+id;

                        
                    }
                });

            });
            
        });

        
    </script>

    <?php 
        
    ?>



</body>
</html>