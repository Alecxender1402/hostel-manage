<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDHostel</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            padding: 20px;
            position: fixed;
            /* Keep the sidebar fixed on the left */
            height: 100%;
        }

        .sidebar .profile {
            text-align: center;
        }

        .sidebar .profile img {
            width: 50px;
            border-radius: 50%;
        }

        .username {
            margin-top: 10px;
            font-size: 18px;
        }

        .menu {
            list-style-type: none;
            margin-top: 20px;
        }

        .menu li {
            padding: 10px 0;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .menu li:hover {
            background-color: #444;
        }

        .menu li a {
            text-decoration: none;
            /* Remove underline from links */
            color: white;
            /* Set button (link) color to white */
            width: 100%;
            display: block;
            padding-left: 10px;
        }

        .menu li a:hover {
            color: #ddd;
            /* Optional hover color */
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-left: 250px;
            /* Adjust for the sidebar width */
        }

        .top-bar {
            background-color: #2c91c1;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .top-bar h1 {
            margin-left: 20px;
        }

        .user {
            display: flex;
            align-items: center;
        }

        .user img {
            width: 30px;
            height: 30px;
            margin-left: 10px;
            border-radius: 50%;
            text-decoration: none;
            /* Remove underline from image inside links */
        }

        .main-content {
            padding: 20px;
        }

        .top-bar h1 a {
            color: white;
            /* Set the link color to white */
            text-decoration: none;
            /* Remove underline from the link */
        }

        .top-bar h1 a:hover {
            color: #ddd;
            /* Optional: Change color on hover */
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }
        }

        @media (max-width: 600px) {
            .menu li {
                text-align: center;
            }

            .menu li a {
                padding-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">

        <ul class="menu">
            <li><a href="hostel-fees.php">Hostel Fees</a></li>
            <li><a href="maintenance-issue.php">Maintenance Issue</a></li>
            <li><a href="applied-promotion.php">Applied For Promotion</a></li>
            <li><a href="gate-pass.php">Gate Pass & Leave</a></li>
            <li><a href="reporting-history.php">Reporting History</a></li>
            <li><a href="change-password.php">Change Password</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="top-bar">
            <h1><a href="dashboard.php"> SDHOSTEL</a></h1>
            <div class="user">
                <span>Student</span>

            </div>
        </div>
        <div class="main-content">
            <!-- Main content goes here -->
        </div>
    </div>
</body>

</html>