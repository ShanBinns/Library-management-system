<?php 
    session_start();
    include 'include/header-sidenav.php'; 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <title>View Books</title>
</head>
<body> 
    <div class="main-body">
        <div class="grid-container">
            <div class="section-heading">
                <h3><i class="fas fa-eye"></i> View Books</h3>
            </div>
            <div class="section-content">
                <h2>Below is the list of books</h2>
                <div class="table-view-books">
                    <table>
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Year</th>
                            <th>ISBN</th>
                            <th>Subject Area</th>
                            <th>Call Number</th>
                            <th>Copies</th>
                        </tr>
                        <tr>
                            <td>
                                <span class="zoom"><img src="img/<?php if(!empty( $_SESSION['image'])) echo $_SESSION['image'] ; else {echo "";}?>" alt="" height="100%" width="70%"> </span>
                            </td>
                            <td><?php if(!empty( $_SESSION['title'])) echo $_SESSION['title']; else {echo " ";}?></td>

                            <td><?php if(!empty( $_SESSION['author'])) echo $_SESSION['author']; else {echo "";}?></td>
                            <td><?php if(!empty( $_SESSION['year'])) echo $_SESSION['year']; else {echo "";}?></td>
                            <td><?php if(!empty( $_SESSION['isbn'])) echo $_SESSION['isbn']; else {echo "";}?></td>
                            <td><?php if(!empty( $_SESSION['subjectArea'])) echo $_SESSION['subjectArea']; else {echo "";}?></td>
                            <td><?php if(!empty( $_SESSION['callNumber'])) echo $_SESSION['callNumber']; else {echo "";}?></td>
                            <td><?php if(!empty( $_SESSION['copies'])) echo $_SESSION['copies']; else {echo "";}?></td>
                        </tr>
                        <tr>
                            <td><img src="img/BookTwo.png" height="100%" width="70%"></td>
                            <td>Inquiry Into Physics</td>
                            <td>Donald J. Bord and Vern J. Ostdiek</td>
                            <td>1987</td>
                            <td>78-1133364603</td>
                            <td>Physics</td>
                            <td>ML811.2250.8 1987</td>
                            <td>25</td>
                        </tr>
                        <tr>
                        <td><img src="img/BookOne.png" height="100%" width="70%"></td>
                            <td>How to kill a mockingbird</td>
                            <td>Harper Lee</td>
                            <td>1960</td>
                            <td>978-0-44-631078-9</td>
                            <td>Literature</td>
                            <td>ML410.5550.0 1960</td>
                            <td>4</td>
                        </tr>
                    </table>

                </div>

            </div>
        </div>
    </div>

</body>
</html>