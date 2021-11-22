<!--
    Name: Shanique Binns
    Programme: Web Systems Design and Implementation
-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">

    <title>SHS Library Management System</title>
</head>
<body>
    <div class="header">
        <a href="" class="name"> <h1><strong>Sana High School</strong></h1></a>
        <div class="header-right">
            <a href="login.php" class="logout"><i class="fas fa-power-off"></i> Login</a>
        </div>
    </div>

    <div class="index-design container">
        <div class="page-heading">
            <h3><strong>Online Library Management System</strong></h3>
            <div class="welcome-button container">             
                    <button type="submit" class="welcome-btn" onclick="location.href='login.php'"><span>Login In Here</span></button> 
                    <form method="post" action="controller/login_validate.php">
                        <button type="submit" name="guest_submit" class="welcome-btn"><span>Log in as a Guest</span></button>   
                    </form>
            
                </div> 
        </div>

        <div class="row-index">
            <div class="column-index">
                <div class="grid-box">
                <div class="box">
                    <div>
                        <ul>
                            <li>Upcoming Library Events</li>
                            <li>Freedom of information day  <p><em>Wed, Oct 15, 2021</em></p>  </li>
                            <li>Library Card Sign-up month <p><em>Mon, Oct 25, 2021</em></p> </li>
                            <li>National Library Outreach day  <p><em>Thur, Nov 10, 2021</em></p></li>
                            <li>Take Action for Libraries Day <p><em>Fri, Dec 1, 20211</em></p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
            </div>

            <div class="column-index">
            <div class="grid-box">
                <div class="box">
                    <div>
                        <ul>
                            <li>Hours</li>
                            <li>Monday</li>
                            <li>Tuesday</li>
                            <li>Wednesday</li>
                            <li>Thursday</li>
                            <li>Friday</li>
                            <li>Saturday</li>
                            <li>Sunday</li>
                        </ul>
                    </div>
                    <div>
                        <ul>
                            <li><span>Open</span></li>
                            <li>9:00am to 6:00pm</li>
                            <li>9:00am to 6:00pm</li>
                            <li>9:00am to 6:00pm</li>
                            <li>9:00am to 6:00pm</li>
                            <li>9:00am to 4:00pm</li>
                            <li>11:00am to 4:00pm</li>
                            <li>Closed</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="HSfooter">
    <p>© Copyright 2021 Sana High School. Design by <strong>Shanique</strong></p>
    </div>
</body>
</html>