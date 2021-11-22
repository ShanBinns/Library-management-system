<?php 
    session_start();
    require_once "include/config.php";
    include 'include/header-sidenav.php'; 

    $librarianid = $_SESSION['userid'];
    

    //Gets info from the database borrow book table
    $sql = "SELECT * FROM librarian WHERE libid = '".$librarianid."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $libid = $row['libid'];
            $name = $row['name'];
            $email = $row['email'];
            $type = $row['type'];
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
                <h3><i class="fas fa-asterisk"></i>My Profile</h3>
            </div>

            <!--Status message - Shows where action was successful or failed-->
            <?php 
                if(!empty($_SESSION['statusmessage'])){
                    echo '<div class="error">' . $_SESSION['statusmessage'] . '</div>';
                    unset($_SESSION['statusmessage']);
                }        
            ?>

            
            <div class="profile">
                <div class="profile-image"><img src="img/avatar.png" alt="avatar" class="avatar"></div>
            </div>
            <div class="profile-contents">
                    <div class="profile-name"><h2><?php echo $name?></h2></div>
                    </div>

                    <ion-content class="padding">
                    <div class="list card">
                        <div class="item">USER ID: <?php echo $libid?></div>
                        <div class="item">NAME: <?php echo $name?></div>
                        <div class="item"> EMAIL: <?php echo $email?></div>
                        <div class="item"> ROLE: <?php echo $type?></div>
                    </div>
                    </ion-content>

                    <button type="submit" class="profile-btn" data-toggle="modal" data-target="#updateModal"><span>Edit Profile Details</span></button> 
                

        
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
                            <div class="form-group">
                                <label for="author" ><i class="fas fa-lock prefix grey-text"></i> Password</label>    
                                <input type="text" class="form-control" name="password"  placeholder="Enter password" required>                          
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

                            <button type="submit" name="edit-profile" value="<?php echo $libid?>" class="btn btn-success">Save</button>

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