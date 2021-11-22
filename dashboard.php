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

    <title>Dashboard</title>
</head>
<body> 
    <div class="main-body">
        <div class="grid-container">
            
            <div class="section-content">
                <div class="dashboard-title">
                    <h2>Welcome to the Sana High School Libaray Management System Dashboard</h2>
                    <p>Use the menu to the left or the quick access links below to nagivate</p>
                </div>
                
                <div class="dash-container1"> 
                    <div class="card">
                        <div class="dash-card1">
                            <h5 class="card-title">Books Borrowed</h5>
                            <p class="card-text">10</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="dash-card2">
                            <h5 class="card-title"> Book Rental</h5>
                            <p class="card-text"><i class="fas fa-asterisk"></i></p>
                            <button class="dash" onclick="location.href='issuebooks.php'"><i class="fas fa-share"></i></button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="dash-card3">
                            <h5 class="card-title">Manage Accounts</h5>
                            <p class="card-text"><i class="fas fa-users-cog"></i></p>
                            <button class="dash" onclick="location.href='account.php'"><i class="fas fa-share"></i></button>
                        </div>
                    </div>
                </div>
            

                <div class="dash-container2"> 
                    <div class="card">
                        <div class="dash-card1">
                            <h5 class="card-title">Total Books</h5>
                            <p class="card-text">50</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="dash-card2">
                            <h5 class="card-title">Add Books</h5>
                            <p class="card-text"><i class="fas fa-plus-circle"></i></p>
                            <button class="dash" onclick="location.href='HSaddbook.php'"><i class="fas fa-share"></i></button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="dash-card3">
                            <h5 class="card-title">My Profile</h5>
                            <p class="card-text"><i class="fas fa-exchange-alt"></i></p>
                            <button class="dash" onclick="location.href='profile.php'"><i class="fas fa-share"></i></button>
                        </div>
                    </div>
                </div>

                <div class="dash-container3"> 
                    <div class="card">
                        <div class="dash-card1">
                            <h5 class="card-title"  onclick="location.href='issuebooks.php'">Books Returned</h5>
                            <p class="card-text">5</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="dash-card2">
                            <h5 class="card-title">View Books</h5>
                            <p class="card-text"><i class="fas fa-eye"></i></p>
                            <button class="dash" onclick="location.href='HSviewbooks.php'"><i class="fas fa-share"></i></button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="dash-card3">
                            <h5 class="card-title">Search Patron Records</h5>
                            <p class="card-text"><i class="fas fa-search"></i></p>
                            <button class="dash" onclick="location.href='patrons.php'"><i class="fas fa-share"></i></button>
                        </div>
                </div>
            </div>
            

        </div>
    </div>

</body>
</html>