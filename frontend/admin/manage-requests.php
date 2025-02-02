<?php

session_start();
if (!isset($_SESSION['role'])) {
    
    echo "<script>
        alert('You need to login first. Access denied.');
        window.location.href = '../index.php'; // Redirect to the homepage or any other page
    </script>";
    exit(); 
}

if ($_SESSION['role'] !== 'admin') {
    
    echo "<script>
        alert('You are not an admin. Access denied.');
        window.location.href = '../index.php'; // Redirect to the homepage or any other page
    </script>";
    exit(); 
}


$con = new mysqli('localhost', 'root', '', 'hostel-manage');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$query = "SELECT * FROM gatepass";
$result = $con->query($query);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; 
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $update_query = "UPDATE gatepass SET status = 'Approved' WHERE id = ?";
    } elseif ($action === 'reject') {
        $update_query = "UPDATE gatepass SET status = 'Rejected' WHERE id = ?";
    }

    $update_stmt = $con->prepare($update_query);
    $update_stmt->bind_param("i", $request_id);
    $update_stmt->execute();
    $update_stmt->close();

    header("Location: manage-requests.php");
    exit();
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Manage Requests</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
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
            height: 100%;
        }

        .sidebar .menu {
            list-style-type: none;
            margin-top: 20px;
        }

        .menu li {
            padding: 10px 0;
            cursor: pointer;
        }

        .menu li:hover {
            background-color: #444;
        }

        .menu li a {
            text-decoration: none;
            color: white;
            display: block;
            padding-left: 10px;
        }

        .menu li a:hover {
            color: #ddd;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-left: 250px;
        }

        .top-bar {
            background-color: #2c91c1;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .top-bar h1 a {
            color: white;
            text-decoration: none;
        }

        .main-content {
            padding: 20px;
        }

        .table {
            width: 100%;
            margin-top: 20px;
        }

        
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
    </style>
</head>

<body>
    <div class="sidebar">
        <ul class="menu">
            <li><a href="AdminHostelFees.php">Hostel Fees</a></li>
            <li><a href="maintenance-issue.php">Maintenance Issue</a></li>
            <li><a href="gate-pass.php">Gate Pass & Leave</a></li>
            
        </ul>
    </div>

    <div class="content">
        <div class="top-bar">
            <h1><a href="dashboard.php">SDHOSTEL</a></h1>
            <div class="user">
                <span>Admin</span>
            </div>
        </div>

        <div class="main-content">
            <h2 class="my-4">Manage Gate Pass & Leave Requests</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Reason</th>
                        <th>Out Date</th>
                        <th>Return Date</th>
                        <th>Out Time</th>
                        <th>In Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)) : ?>
                        <?php foreach ($data as $row) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['type']); ?></td>
                                <td><?php echo htmlspecialchars($row['reason']); ?></td>
                                <td><?php echo htmlspecialchars($row['date_from']); ?></td>
                                <td><?php echo htmlspecialchars($row['date_to']); ?></td>
                                <td><?php echo htmlspecialchars($row['out_time']); ?></td>
                                <td><?php echo htmlspecialchars($row['in_time']); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <button type="submit" name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                                        <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" class="text-center">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
