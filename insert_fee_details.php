<?php
include 'db.php'; // Include the database connection

// Sample fee details data for students
$fee_details_data = [
    [
        'student_id' => 'Student1',
        'total_fee' => 60000.00,
        'paid_fee' => 20000.00,
        'pending_fee' => 40000.00
    ],
    [
        'student_id' => 'Student2',
        'total_fee' => 70000.00,
        'paid_fee' => 30000.00,
        'pending_fee' => 40000.00
    ],
    [
        'student_id' => 'Student3',
        'total_fee' => 80000.00,
        'paid_fee' => 10000.00,
        'pending_fee' => 70000.00
    ]
];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO fee_details (student_id, total_fee, paid_fee, pending_fee) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sddd", $student_id, $total_fee, $paid_fee, $pending_fee);

// Insert each fee detail
foreach ($fee_details_data as $fee_detail) {
    $student_id = $fee_detail['student_id'];
    $total_fee = $fee_detail['total_fee'];
    $paid_fee = $fee_detail['paid_fee'];
    $pending_fee = $fee_detail['pending_fee'];

    // Execute the statement
    if ($stmt->execute()) {
        echo "New fee detail record created successfully for {$student_id}<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
}

$stmt->close();
$conn->close();
?>
