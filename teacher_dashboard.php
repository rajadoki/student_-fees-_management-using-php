<?php
session_start(); // Start session to manage user login state

include 'db.php'; // Include the database connection

// Assume the teacher's ID is stored in the session after login
$teacher_id = 'Teacher1'; // Replace with the actual logged-in teacher's ID

// Fetch teacher details from the database
$teacher_query = "SELECT * FROM teachers WHERE id='$teacher_id'";
$teacher_result = $conn->query($teacher_query);

// Check if the teacher exists
if ($teacher_result->num_rows > 0) {
    $teacher = $teacher_result->fetch_assoc();
} else {
    // Handle case when teacher not found
    echo "Teacher not found!";
    exit();
}

// Fetch students from the database
$students_query = "SELECT * FROM students";
$result = $conn->query($students_query);
$students = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
$conn->close(); // Close the connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('images/teacher_background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        .teacher-info {
            text-align: center;
            margin: 20px;
            padding: 15px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
        }
        .student-table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        .student-table th, .student-table td {
            border: 1px solid #fff;
            padding: 8px;
            text-align: left;
        }
        .student-table th {
            background: rgba(0, 0, 0, 0.8);
        }
        .student-table tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.1);
        }
        .button {
            background: #28a745; /* Green */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background: #218838; /* Darker Green */
        }
        .edit-link {
            color: #ffc107; /* Yellow */
            text-decoration: none;
        }
        .edit-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="teacher-info">
        <h1>Welcome, <?php echo htmlspecialchars($teacher['name']); ?></h1>
        <p>ID: <?php echo htmlspecialchars($teacher['id']); ?></p>
        <p>Branch: <?php echo htmlspecialchars($teacher['branch']); ?></p>
        <p>Qualification: <?php echo htmlspecialchars($teacher['qualification']); ?></p>
        <p>Role: <?php echo htmlspecialchars($teacher['role']); ?></p>
        <p>Teaching Subject: <?php echo htmlspecialchars($teacher['teaching_subject']); ?></p>
        <p>Contact: <?php echo htmlspecialchars($teacher['contact']); ?></p>
        <p>Experience: <?php echo htmlspecialchars($teacher['experience']); ?> Years</p>
    </div>

    <h2>Students List</h2>
    <table class="student-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>ID</th>
                <th>Branch</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['name']); ?></td>
                    <td><?php echo htmlspecialchars($student['id']); ?></td>
                    <td><?php echo htmlspecialchars($student['branch']); ?></td>
                    <td><?php echo htmlspecialchars($student['contact']); ?></td>
                    <td>
                        <a href="edit_student.php?id=<?php echo $student['id']; ?>" class="edit-link">Edit Details</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
