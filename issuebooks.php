<?php 
    session_start();
    require_once "include/config.php";
    include 'include/header-sidenav.php'; 

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
                WHERE b.isbn=r.isbn";
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

    <title>Manage Books</title>
</head>
<body> 
    <div class="main-body">
        <div class="grid-container">
            <div class="section-heading">
                <h3><i class="fas fa-asterisk"></i> Log Borrowed and Returned Books</h3>
            </div>

            <div class="section-content">

            <h2>Below is the list of books</h2>
            

            <!--Add another form section that shows pending here, then add to table below-->
                <div class="table-view-books">
                <form action="borrow.php?page=borrow" method="post">
                    <table>
                        <tr>
                            <th>Patron Card ID</th>
                            <th>Librarian ID</th>
                            <th>IBSN</th>
                            <th>Borrowed Date</th>
                            <th>Returned Date</th>
                            <th>Action</th> <!---borrowed tag or returned tag-->
                        </tr>
                        <tbody>
                            <?php  if(empty($join_books)):?>     
                                <tr>
                                    <td colspan="5" style="text-align:center;">There are no issued books in the library</td>
                                </tr>  
                            <?php  else:?> 
                                
                            <?php  foreach ($join_books as $joinedBooks): ?> 
                            <td class="cardid"><?=$joinedBooks['cardid']?> </td>
                            <td class="libid"><?=$joinedBooks['libid']?> </td>
                            <td class="isbn"><?=$joinedBooks['isbn']?> </td>
                            <td class="borrow-date"><?=$joinedBooks['bdate']?> </td>
                            <td class="return-date"><?=$joinedBooks['rdate']?> </td>

                                <td class="action">    
                                <button class="btn-borrowed">Borrowed</button>
                                <button class="btn-returned" >Returned</button>
                    
                                </td>                   
                            </tr>
                            <?php  endforeach;?>
                            <?php  endif;?> 



                    </tbody>
                
                </table>
            </form>
        </div>






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