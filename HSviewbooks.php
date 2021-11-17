<?php 
    session_start();
    require_once "include/config.php";
    include 'include/header-sidenav.php'; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
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

            <!--Update Book Modal-->
            <div id="updateModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Book Details</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" >Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter title" required>            
                            </div>
                            <div class="form-group">
                                <label for="author" >Author</label>    
                                <input type="text" class="form-control" id="author"  placeholder="Enter Author">                          
                            </div>        
                            <div class="form-group">
                                <label for="year" >Year</label>    
                                <input type="text" class="form-control" id="year"  placeholder="Enter Year">                          
                            </div>
                            <div class="form-group">
                                <label for="bookcover" >Cover</label>    
                                <input type="text" class="form-control" id="bookcover"  placeholder="Enter cover">                          
                            </div>
                            <div class="form-group">
                                <label for="quantity" >Quantity</label>    
                                <input type="text" class="form-control" id="quantity"  placeholder="Enter Quantity">                          
                            </div>

                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="txt_bookid" value="0">
                            <button type="button" class="btn btn-success btn-sm" id="btn_save">Save</button>
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            <!--End of Update Book Modal-->



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
                    'url':'ajaxfile.php'
                },
                'columns': [
                    { data: 'bookcover',render: function (data, type, row, meta) {
                        return '<img src="img/' + data + '" height="60" width="60"/>';} },
                        { data: 'title' },
                    { data: 'author' },
                    { data: 'year' },
                    { data: 'subjectarea' },
                    { data: 'quantity' },
                    { data: 'action' },
                ]
            });


            // Update record
            $('#bookTable').on('click','.updateBook',function(){
                var id = $(this).data('id');

                $('#txt_bookid').val(id);

                $.ajax({
                    url: 'ajaxfile.php',
                    type: 'post',
                    data: {request: 2, id: id},
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 1){

                            $('#title').val(response.data.title);
                            $('#author').val(response.data.author);
                            $('#year').val(response.data.year);
                            $('#bookcover').val(response.data.bookcover);
                            $('#quantity').val(response.data.quantity);
                            
                            bookDataTable.ajax.reload();
                        }else{
                            alert("Invalid id.");
                        }
                    }
                });

            });


            // Save book 
            $('#btn_save').click(function(){
                var id = $('#txt_bookid').val();

                var title = $('#title').val().trim();
                var author = $('#author').val().trim();
                var year = $('#year').val().trim();
                var bookcover = $('#bookcover').val().trim();
                var quantity = $('#quantity').val().trim();

                if(title != '' && author != '' && year != '' && bookcover != '' && quantity != ''){

                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {request: 3, id: id, title: title, author: author, year: year, bookcover: bookcover, quantity: quantity},
                        dataType: 'json',
                        success: function(response){
                            if(response.status == 1){
                                alert(response.message);

                                $('#title','#author','#year','#bookcover','#quantity').val('');
                                $('#txt_bookid').val(0);

                                bookDataTable.ajax.reload();

                                $('#updateModal').modal('toggle');
                            }else{
                                alert(response.message);
                            }
                        }
                    });

                }else{
                    alert('Please fill all fields.');
                }
            });


            // Delete record
            $('#bookTable').on('click','.deleteBook',function(){
                var id = $(this).data('id');

                var deleteConfirm = confirm("Are you sure?");
                if (deleteConfirm == true) {
                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {request: 4, id: id},
                        success: function(response){

                            if(response == 1){
                                alert("Record deleted.");

                                bookDataTable.ajax.reload();
                            }else{
                                alert("Invalid id.");
                            }
                            
                        }
                    });
                } 
                
            });   


             // Issue record
            $('#bookTable').on('click','.issueBook',function(){
                var id = $(this).data('id');

                $('#txt_bookid').val(id);
                
                $.ajax({
                    url: 'ajaxfile.php',
                    type: 'post',
                    data: {request: 2, id: id},
                    success: function(data){
                        alert(id);  //To be removed
                        //Redirects to details page and send id in url
                        window.location.href = 'bookDetails.php?id='+id;

                        //Change submission to book.php Send id to it. use Id to get data from database
                        //press check out book, opens a little window to enter the patron Id
                        //if in database, add info to borrow book list
                    }
                });

            });
            
        });

        
    </script>

    <?php 
        
    ?>



</body>
</html>