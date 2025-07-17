<?php
// Connect to the database
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "student_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming the student is logged in and their ID is stored in session
session_start();
$student_id = $_SESSION['username']; // Get the username from session (e.g., Student1)

// Fetch student data from the database
$sql = "SELECT * FROM students WHERE id = '$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the student data
    $row = $result->fetch_assoc();
    $student_name = $row['name'];
    $year = $row['year'];
    $semester = $row['semester'];
    $branch = $row['branch'];
    $contact = $row['contact'];
    $father_name = $row['father_name'];
    $mother_name = $row['mother_name'];
    $address = $row['address'];
    $total_fee = $row['total_fee'];
} else {
    echo "No student data found.";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('images/student_dashboard.jpg'); /* Set background image */
            background-size: cover;
            background-position: center;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dashboard-container {
            background-color: rgba(255, 255, 255, 0.9); /* Light transparent background */
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 60%;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }
        table tr:hover {
            background-color: #f5f5f5;
        }
        .btn {
            background-color: #4CAF50; /* Button color */
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
            display: block;
            margin: 0 auto;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Welcome, <?php echo $student_name; ?>!</h1>
        <table>
            <tr>
                <th>Student Name</th>
                <td><?php echo $student_name; ?></td>
            </tr>
            <tr>
                <th>Student ID</th>
                <td><?php echo $student_id; ?></td>
            </tr>
            <tr>
                <th>Year</th>
                <td><?php echo $year; ?></td>
            </tr>
            <tr>
                <th>Semester</th>
                <td><?php echo $semester; ?></td>
            </tr>
            <tr>
                <th>Branch</th>
                <td><?php echo $branch; ?></td>
            </tr>
            <tr>
                <th>Contact</th>
                <td><?php echo $contact; ?></td>
            </tr>
            <tr>
                <th>Father's Name</th>
                <td><?php echo $father_name; ?></td>
            </tr>
            <tr>
                <th>Mother's Name</th>
                <td><?php echo $mother_name; ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo $address; ?></td>
            </tr>
            <tr>
                <th>Total College Fee</th>
                <td>₹<?php echo $total_fee; ?></td>
            </tr>
        </table>
        <!-- Fee Details Button -->
        <form action="fee_details.php" method="POST">
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
            <input type="submit" class="btn" value="View Fee Details">
        </form>
    </div>
</body>
</html>
