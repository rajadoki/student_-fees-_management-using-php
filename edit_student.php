<?php
session_start(); // Start session to manage user login state
include 'db.php'; // Include the database connection



// Get the student ID from the URL
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Fetch student details from the database
    $student_query = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($student_query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $student_result = $stmt->get_result();

    // Check if the student exists
    if ($student_result->num_rows == 0) {
        echo "No student found!";
        exit;
    }

    $student = $student_result->fetch_assoc();
} else {
    echo "Invalid request!";
    exit;
}

// Update student details if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $branch = $_POST['branch'];
    $contact = $_POST['contact'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $address = $_POST['address'];

    // Update the student details in the database
    $update_query = "UPDATE students SET name=?, year=?, semester=?, branch=?, contact=?, father_name=?, mother_name=?, address=? WHERE id=?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssssssss", $name, $year, $semester, $branch, $contact, $father_name, $mother_name, $address, $student_id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Student details updated successfully!'); window.location.href='teacher_dashboard.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $update_stmt->close();
}

$stmt->close(); // Close the statement
$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Details</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('images/edit_background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
        }
        input[type="submit"] {
            background: #28a745; /* Green */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background: #218838; /* Darker Green */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Student Details</h1>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>

            <label for="year">Year:</label>
            <input type="number" id="year" name="year" value="<?php echo htmlspecialchars($student['year']); ?>" required>

            <label for="semester">Semester:</label>
            <input type="number" id="semester" name="semester" value="<?php echo htmlspecialchars($student['semester']); ?>" required>

            <label for="branch">Branch:</label>
            <input type="text" id="branch" name="branch" value="<?php echo htmlspecialchars($student['branch']); ?>" required>

            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($student['contact']); ?>" required>

            <label for="father_name">Father's Name:</label>
            <input type="text" id="father_name" name="father_name" value="<?php echo htmlspecialchars($student['father_name']); ?>" required>

            <label for="mother_name">Mother's Name:</label>
            <input type="text" id="mother_name" name="mother_name" value="<?php echo htmlspecialchars($student['mother_name']); ?>" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($student['address']); ?>" required>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
