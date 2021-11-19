<?php 
    session_start();
    require_once "include/config.php";
    include 'include/header-sidenav.php'; 
    
    /*If sessions are not empty then use the IDs retrieve additional information
    Uses this information to populate pending process table. Update processbook database table. */
    $current_date = date('m/d/Y');
    if(!empty($_SESSION['cardid'])  && !empty($_SESSION['bookid'])){
        $cardid = $_SESSION['cardid'];
        $bookid = $_SESSION['bookid'];
        
        $sqlBook = "SELECT * FROM book WHERE id = '".$bookid."' ";
        $sqlPatron = "SELECT * FROM librarycard WHERE cardid = '".$cardid."' ";
        $resultBook = $conn->query($sqlBook);

        if ($resultBook->num_rows > 0) {
            while($row = $resultBook->fetch_assoc()) {
                $id = $row['id'];
                $isbn = $row['isbn'];
            }
        }

        $resultPatron = $conn->query($sqlPatron);

        if ($resultPatron->num_rows > 0) {
            while($row = $resultPatron->fetch_assoc()) {
                $cid = $row['cardid'];
            }

        } 

        //save book isbn and date to database, then store data into an array
        $QueryInsert = "INSERT INTO processbook (isbn,date,cardid) VALUES ('". $isbn ."', '". $current_date ."','". $cid ."')";
        if(mysqli_query($conn, $QueryInsert))
        {
        }else{
        
        }

        unset($_SESSION['cardid']);
        unset($_SESSION['bookid']);
    }

    //Gets data from processbook table
    $getPendingQuery = "SELECT * FROM processbook";
        $pendingResult = $conn->query($getPendingQuery);

        if ($pendingResult->num_rows > 0) {
            while($row = $pendingResult->fetch_assoc()) {
                $books_pending[] = $row;
            }
        } 


    //Gets info from the database borrow book table
    $sql = "SELECT * FROM book";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
    } 

    //This query inner joins the borrowed and returned book tables to use the issued books
    $queryTwo = "SELECT b.*, r.* FROM borrowbook b, returnbook r
                WHERE b.isbn=r.isbn ORDER BY status";
    $innerjoinResult = $conn->query($queryTwo);

    if ($innerjoinResult->num_rows > 0) {
        while($row = $innerjoinResult->fetch_assoc()) {
            $join_books[] = $row;
        }
    } 
    $conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    

    <title>Manage Books</title>
</head>
<body> 
    <div class="main-body">
        <div class="grid-container">
            <div class="section-heading">
                <h3><i class="fas fa-asterisk"></i> Log Borrowed and Returned Books</h3>
            </div>

            <!--Status message - Shows where action was successful or failed-->
            <?php 
                if(!empty($_SESSION['statusmessage'])){
                    echo '<div class="error">' . $_SESSION['statusmessage'] . '</div>';
                    unset($_SESSION['statusmessage']);
                }        
            ?>

            <!--Table for pending books-->
            <div class="section-content">
            
            <h2>The borrow request below are pending</h2>
                <div class="table-view-books">
                <div class="pending">
                <form method="post" action="controller/issue_controller.php" >
                    <table>
                        <tr>
                            <th>Patron Card Id </th>
                            <th>ISBN </th>
                            <th>Request Date </th>
                            <th>Action
                            <button type="button" class="btn btn-warning px-3"  data-toggle="tooltip" data-placement="top" title="Click to process or reject borrow request">
                            <i class="far fa-question-circle"></i></button>

                            </th>
                        </tr>
                        <tbody>
                        <?php  if(empty($books_pending)):?>     
                            <tr>
                                <td colspan="5" style="text-align:center;">There are no pending requests to process</td>
                            </tr>  
                        <?php  else:?> 
                        <?php  foreach ($books_pending as $pending): ?> 
                        <tr>                            
                            <td class="cardid"><?=$pending['cardid']?> </td>
                            <td class="isbn"><?=$pending['isbn']?> </td>
                            <td class="date"><?=$pending['date']?> </td>
                            <input type="hidden"  name="id" value="<?=$pending['processid']?>"/>
                            
                            <td class="action">   

                                <button  name="process"> <i class="fas fa-check-square btn-process "></i>
                                </button>
                                
                                <button  name="delete"> <i class="fas fa-trash-alt btn-delete"></i>
                                </button>
                                
                                
                            </td>                   
                        </tr>

                        <?php  endforeach;?>
                        <?php  endif;?> 

                    </tbody>
                </table>
            </form>
        </div>
    </div>
        <!--End of pending book table-->

        
        
        <!--Table for Issued books--> 
        <br><br><div class="section-content">

            <h2>Below is the list of Issued books</h2>
                <div class="table-view-books">
                    <!--Return book button-->
                <button class="return-button"  data-toggle="modal" data-target="#searchModal">Click to return a book</button>

                <form action="controller/issue_controller.php" method="post">
                    <table>
                        <tr>
                        <th>Patron Card ID</th>
                            <th>Librarian ID</th>
                            <th>IBSN</th>
                            <th>Borrowed Date</th>
                            <th>Returned Date</th>
                            <th>Issue ID</th>
                            <th>Status</th> 
                        </tr>
                        <tbody>
                        <?php  if(empty($join_books)):?>     
                            <tr>
                                <td colspan="5" style="text-align:center;">There are no issued books in the library</td>
                            </tr>  
                        <?php  else:?> 
                        <?php  foreach ($join_books as $joinedBooks): ?> 
                        <tr>
                        <td class="cardid"><?=$joinedBooks['cardid']?> </td>
                            <td class="libid"><?=$joinedBooks['libid']?> </td>
                            <td class="isbn"><?=$joinedBooks['isbn']?> </td>
                            <td class="borrow-date"><?=$joinedBooks['bdate']?> </td>
                            <td class="return-date"><?=$joinedBooks['rdate']?> </td>
                            <td class="return-date"><?=$joinedBooks['issueid']?> </td>

                            <td class="status ">    
                                <?php  if($joinedBooks['status'] == "pending"):?>
                                    <button class="btn-borrowed">Borrowed</button>
                                <?php  endif;?> 
                                <?php  if($joinedBooks['status'] == "returned"):?>
                                    <button class="btn-returned">Returned</button>
                                <?php  endif;?> 
                            </td>            

                        </tr>
                        <?php  endforeach;?>
                        <?php  endif;?> 

                    </tbody>
                
                </table>
            </form>
        </div>

        <!-- Search Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">Return a Book to Library
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                                <h1>Please enter the Issue ID</h1>
                                <form class="navbar-form "  method="post" action="controller/issue_controller.php">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="issueid" placeholder="Enter ID here">
                                    </div>
                                    <button type="submit" name="return" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End of Modal-->






                        <br><br><br><br><br><br><br>
        <!--Old Table-->
            <div class="section-content">

            <h2>Below is the list of books</h2>
                <div class="table-view-books">
                <form action="borrow.php?page=borrow" method="post">
                    <table>
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Year</th>                
                            <th>Subject</th>
                            <th>Copies</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                        <?php  if(empty($book_list)):?>     
                            <tr>
                                <td colspan="5" style="text-align:center;">There are no books in the library</td>
                            </tr>  
                        <?php  else:?> 
                        <?php  foreach ($book_list as $list): ?> 
                        <tr>
                            <td class="img">                            
                                <img src="img/<?=$list['bookcover']?>" width="50" height="50" alt="<?=$list['title']?>">  
                                <br>

                                <a href="HSviewbooks.php?page=view&remove=<?=$product['id']?>" class="remove">Click for preview</a>                                
                            </td>
                            <td>
                            <?=$list['title']?>
                            
                            </td>
                            <td class="Author"><?=$list['author']?> </td>
                            <td class="Year"><?=$list['year']?> </td>
                            <td class="subjectArea"><?=$list['subjectarea']?> </td>
                            <td class="quantity"><?=$list['quantity']?> </td>

                            <td class="action">    
                                <a href="edit"> <i class="fas fa-edit"></i></a>
                                <a href="remove">   <i class="fas fa-trash-alt"></i></a>
                                <button>Add to patron cart</button>
                                <br>
                        <!--    <a href="cart.php?page=cart&remove=<?=$product['id']?>" class="remove">Remove</a>  -->
                            </td>                   
                        </tr>

                        <?php  endforeach;?>
                        <?php  endif;?> 

                    </tbody>
                
                </table>
            </form>
        </div>

        </div>
    </div>
    </div>

</body>
</html>