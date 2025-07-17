<?php
include 'db.php'; // Include the database connection

// Sample data to insert (you can modify this to accept user input)
$student_data = [
    'id' => 'Student1',
    'name' => 'Alice',
    'branch' => 'CSE',
    'year' => 3,
    'total_fee' => 60000.00,
    'paid_fee' => 40000.00,
    'contact' => '9876543210',
    'father_name' => 'Mr. Smith',
    'mother_name' => 'Mrs. Smith',
    'address' => '123 Street, City'
];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO students (id, name, branch, year, total_fee, paid_fee, contact, father_name, mother_name, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiiddsss", $student_data['id'], $student_data['name'], $student_data['branch'], $student_data['year'], $student_data['total_fee'], $student_data['paid_fee'], $student_data['contact'], $student_data['father_name'], $student_data['mother_name'], $student_data['address']);

// Execute the statement
if ($stmt->execute()) {
    echo "New student record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
