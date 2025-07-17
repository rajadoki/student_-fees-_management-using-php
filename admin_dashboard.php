<?php
session_start(); // Start session to manage user login state

include 'db.php'; // Include the database connection

// Fetch admin details (you can modify this as needed)
$admin_id = 'Admin1'; // Replace with the actual logged-in admin's ID
$admin_query = "SELECT * FROM admins WHERE id='$admin_id'";
$admin_result = $conn->query($admin_query);
$admin = $admin_result->fetch_assoc();

// Fetch students and calculate totals
$students_query = "SELECT * FROM students";
$students_result = $conn->query($students_query);
$students = [];
$total_students = 0;
$total_fee = 0;
$total_paid = 0;

if ($students_result->num_rows > 0) {
    while ($row = $students_result->fetch_assoc()) {
        $students[] = $row;
        $total_students++;
        $total_fee += $row['total_fee'];
        $total_paid += $row['paid_fee'];
    }
}
$total_pending = $total_fee - $total_paid;

// Fetch teachers
$teachers_query = "SELECT * FROM teachers";
$teachers_result = $conn->query($teachers_query);
$teachers = [];
$total_teachers = 0;

if ($teachers_result->num_rows > 0) {
    while ($row = $teachers_result->fetch_assoc()) {
        $teachers[] = $row;
        $total_teachers++;
    }
}
$conn->close(); // Close the connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('images/admin.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        .admin-info, .summary {
            text-align: center;
            margin: 20px;
            padding: 15px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
        }
        .table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #fff;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background: rgba(0, 0, 0, 0.8);
        }
        .table tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.1);
        }
        .button {
            background: #007BFF; /* Blue */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background: #0056b3; /* Darker Blue */
        }
    </style>
</head>
<body>
    <div class="admin-info">
        <h1>Welcome, Admin</h1>
        <p>Role: System Administrator.</p>
    </div>

    <div class="summary">
        <h2>Summary</h2>
        <p>Total Students: <?php echo $total_students; ?></p>
        <p>Total Teachers: <?php echo $total_teachers; ?></p>
        <p>Total Fee: ₹<?php echo number_format($total_fee); ?></p>
        <p>Total Paid: ₹<?php echo number_format($total_paid); ?></p>
        <p>Total Pending: ₹<?php echo number_format($total_pending); ?></p>
    </div>

    <h2>Students List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>ID</th>
                <th>Branch</th>
                <th>Total Fee</th>
                <th>Paid Fee</th>
                <th>Pending Fee</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['branch']; ?></td>
                    <td><?php echo number_format($student['total_fee']); ?></td>
                    <td><?php echo number_format($student['paid_fee']); ?></td>
                    <td><?php echo number_format($student['total_fee'] - $student['paid_fee']); ?></td>
                    <td>
                        <a href="edit_student.php?id=<?php echo $student['id']; ?>" class="button">Edit</a>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Teachers List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>ID</th>
                <th>Branch</th>
                <th>Qualification</th>
                <th>Role</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachers as $teacher): ?>
                <tr>
                    <td><?php echo $teacher['name']; ?></td>
                    <td><?php echo $teacher['id']; ?></td>
                    <td><?php echo $teacher['branch']; ?></td>
                    <td><?php echo $teacher['qualification']; ?></td>
                    <td><?php echo $teacher['role']; ?></td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
