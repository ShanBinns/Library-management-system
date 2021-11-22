<?php 
    session_start();
    require_once "include/config.php";
    include 'include/header-sidenav.php'; 
    


    //This query inner joins the librarycard, borrowed and returned book tables to use the issued books
    $queryTwo = "SELECT b.*, l.*,r.* 
                FROM borrowbook b, librarycard l,returnbook r
                WHERE b.cardid=l.cardid=r.cardid ";
    $innerjoinResult = $conn->query($queryTwo);

    if ($innerjoinResult->num_rows > 0) {
        while($row = $innerjoinResult->fetch_assoc()) {
            $patron_data[] = $row;
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


    <title>Patron Records</title>
</head>
<body> 
    <div class="main-body">
        <div class="grid-container">
            <div class="section-heading">
                <h3><i class="fas fa-asterisk"></i> Log Borrowed and Returned Books</h3>
            </div>

            <div class="section-content">
            <h2>Below is the list of all Patrons</h2>
                <div class="table-view-books">


                <form action="controller/issue_controller.php" method="post">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Books Borrowed</th>
                            <th>Borrowed Date</th>
                            <th>Returned Date</th>

                        </tr>
                        <tbody>
                        <?php  if(empty($patron_data)):?>     
                            <tr>
                                <td colspan="5" style="text-align:center;">There are no Patron Records in the library</td>
                            </tr>  
                        <?php  else:?> 
                        <?php  foreach ($patron_data as $patron): ?> 
                        <tr>
                            <td class="name"><?=$patron['name']?> </td>
                            <td class="address"><?=$patron['address']?> </td>
                            <td class="contact"><?=$patron['telephone']?> </td>
                            <td class="borrow"><?=$patron['isbn']?> </td>
                            <td class="borrow-date"><?=$patron['bdate']?> </td>
                            <td class="return-date"><?=$patron['rdate']?> </td>
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