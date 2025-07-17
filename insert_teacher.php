<?php
include 'db.php'; // Include the database connection

// Sample data to insert (you can modify this to accept user input)
$teacher_data = [
    'id' => 'Teacher1',
    'name' => 'Mr. John Doe',
    'branch' => 'CSE',
    'qualification' => 'M.Tech',
    'role' => 'Senior Lecturer',
    'teaching_subject' => 'Data Structures',
    'contact' => '9876543210',
    'address' => '123 Street, City',
    'experience' => 10
];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO teachers (id, name, branch, qualification, role, teaching_subject, contact, address, experience) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssisss", $teacher_data['id'], $teacher_data['name'], $teacher_data['branch'], $teacher_data['qualification'], $teacher_data['role'], $teacher_data['teaching_subject'], $teacher_data['contact'], $teacher_data['address'], $teacher_data['experience']);

// Execute the statement
if ($stmt->execute()) {
    echo "New teacher record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
