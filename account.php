<?php 
    session_start();
    require_once "include/config.php";
    include 'include/header-sidenav.php'; 
    

    //Gets info from the database borrow book table
    $sql = "SELECT * FROM librarian";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $userList[] = $row;
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

    

    <title>Manage User Accounts</title>
</head>
<body> 
    <div class="main-body">
        <div class="grid-container">
            <div class="section-heading">
                <h3><i class="fas fa-asterisk"></i>Manage User Account </h3>
            </div>

            <!--Status message - Shows where action was successful or failed-->
            <?php 
                if(!empty($_SESSION['statusmessage'])){
                    echo '<div class="error">' . $_SESSION['statusmessage'] . '</div>';
                    unset($_SESSION['statusmessage']);
                }        
            ?>

        
        <!--Table for Issued books--> 
        <br><br><div class="section-content">

            <h2>Below is the list of all library accounts</h2>

            <!--Add User Table-->
            <button class='btn btn-sm btn-info' data-toggle="modal" data-target="#addModal">Add a New User</button>
                <div class="table-view-books">

                    <table>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>type</th>
                            <th>Action</th> 
                        </tr>
                        <tbody>
                        <?php  if(empty($userList)):?>     
                            <tr>
                                <td colspan="5" style="text-align:center;">There are no user accounts in library</td>
                            </tr>  
                        <?php  else:?> 
                        <?php  foreach ($userList as $users): ?> 
                        <tr>
                            <td class="libid"><?=$users['libid']?> </td>
                            <td class="name"><?=$users['name']?> </td>
                            <td class="email"><?=$users['email']?> </td>
                            <td class="role"><?=$users['type']?> </td>


                            <td class="action ">    
                            <button class='btn btn-sm btn-info' data-toggle="modal" data-target="#updateModal">Update</button>
                            <button class='btn btn-sm btn-danger' data-toggle="modal" data-target="#deleteModal">Delete</button>
                            </td>            

                        </tr>
                        <?php  endforeach;?>
                        <?php  endif;?> 

                    </tbody>
                
                </table>
            
        </div>

        <!--Update User Acount Modal-->
        <div id="updateModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update User Account</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                        <form class="navbar-form "  method="post" action="controller/user_management.php">
                            <div class="form-group">
                                <label for="title" ><i class="fas fa-user prefix grey-text"></i> Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" required>            
                            </div>
                            <div class="form-group">
                                <label for="author" ><i class="fas fa-envelope prefix grey-text"></i> Email</label>    
                                <input type="text" class="form-control" name="email"  placeholder="Enter Email" required>                          
                            </div>     
                            <div class="form-group"> <i class="fas fa-tag prefix grey-text"></i> Role
                                <select required   name="type"  class="text-success form-control input-sm">
                                    <option class="text-success" selected disabled value="">
                                    <h6>-- Select User Type--</h6>
                                    </option>
                                    <option class="text-success text-center" value="librarian">librarian</option>
                                    <option class="text-success text-center" value="administrator">administrator</option>
                                </select>
                            </div>   
                            

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="0">

                            <button type="submit" name="librarianid" value="<?=$users['libid']?>" class="btn btn-success">Save</button>

                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                

                </div>
            </div>
            <!--End of  User Acount Modal-->


            <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">Delete User
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                                <h1 class="text-info text-center" ><i class="fas fa-ban"></i> Click Delete User Account </h1>
                                <form class="navbar-form "  method="post" action="controller/user_management.php">
                                    <div class="form-group">
                                    </div>
                                    <button type="submit" name="delete" value="<?=$users['libid']?>"  class="btn btn-danger">Delete User</button>
                                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End of Modal-->


                <!--Add New User Acount Modal-->
        <div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add User</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                        <form class="navbar-form "  method="post" action="controller/user_management.php">
                            <div class="form-group">
                                <label for="title" ><i class="fas fa-user prefix grey-text"></i> Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" required>            
                            </div>
                            <div class="form-group">
                                <label for="author" ><i class="fas fa-envelope prefix grey-text"></i> Email</label>    
                                <input type="text" class="form-control" name="email"  placeholder="Enter Email" required>                          
                            </div>     
                            <div class="form-group">
                                <label for="author" ><i class="fas fa-lock prefix grey-text"></i> Password</label>    
                                <input type="text" class="form-control" name="password"  placeholder="Use default password = password123" required>                          
                            </div>       
                            
                            <div class="form-group"> <i class="fas fa-tag prefix grey-text"></i>Role
                                <select required   name="type"  class="text-success form-control input-sm">
                                    <option class="text-success" selected disabled value="">
                                    <h6>-- Select User Type--</h6>
                                    </option>
                                    <option class="text-success text-center" value="librarian">librarian</option>
                                    <option class="text-success text-center" value="administrator">administrator</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="0">

                            <button type="submit" name="adduser" class="btn btn-success">Save</button>

                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                

                </div>
            </div>
            <!--End of  User Acount Modal-->

        </div>
    </div>
    </div>

</body>
</html>