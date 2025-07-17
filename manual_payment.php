<?php
// Assuming database connection is already established
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $pay_amount = intval($_POST['pay_amount']);

    // Simulated student fee update (in reality, you'd update the database)
    $students[$student_id]['paid_fee'] += $pay_amount;
    $pending_fee = $students[$student_id]['total_fee'] - $students[$student_id]['paid_fee'];

    echo "<p style='color:green;'>Successfully added ₹$pay_amount to $student_id's payment record!</p>";
    
    // Redirect back to teacher dashboard after update
    header("Location: teacher_dashboard.php");
}
?>
