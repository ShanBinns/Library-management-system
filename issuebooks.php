<?php 
    session_start();
    require_once "include/config.php";
    include 'include/header-sidenav.php'; 

    //This info should collect from the  database borrow book table

    $sql = "SELECT * FROM book";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $book_list[] = $row;
        }
    } 
    $conn->close();

    //Borrow - click the action tab of the viewbooks page to make someone borrow a book. This button will cause the book to be added to the borrow database table and the count of the book table to decrease. Send user to Issued books table. And to return a book, go to the Issued book page and select returned button, that will do the opposite of what is above and place returned in another row.
    //BorrowBook: (cardID, ISBN, libID, Date)
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