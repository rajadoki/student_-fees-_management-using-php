<?php
session_start(); // Start the session to manage user login state
include 'db.php'; // Include the database connection file

// Get the student ID from POST data
$student_id = $_POST['student_id']; // Assume student ID is posted from the dashboard

// Fetch the student's fee details from the database
$fee_query = "SELECT * FROM fee_details WHERE student_id='$student_id'";
$fee_result = $conn->query($fee_query);
$fee_data = $fee_result->fetch_assoc();

// If no fee details are found, handle accordingly
if (!$fee_data) {
    die("Fee details not found for this student.");
}

$total_fee = $fee_data['total_fee'];
$paid_fee = $fee_data['paid_fee'];
$pending_fee = $total_fee - $paid_fee; // Calculate pending fee

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay_amount'])) {
    $pay_amount = intval($_POST['pay_amount']);
    
    if ($pay_amount > 0 && $pay_amount <= $pending_fee) {
        // Update paid amount and calculate new pending fee
        $paid_fee += $pay_amount;
        $pending_fee = $total_fee - $paid_fee;
        
        // Update the fee details in the database
        $update_query = "UPDATE fee_details SET paid_fee = ?, pending_fee = ? WHERE student_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("dds", $paid_fee, $pending_fee, $student_id); // dds for double and string types
        $stmt->execute();
        
        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            echo "<p style='color:green;'>Payment of ₹" . number_format($pay_amount) . " was successful!</p>";
        } else {
            echo "<p style='color:red;'>Payment failed. Please try again.</p>";
        }
        
        $stmt->close(); // Close the prepared statement
    } else {
        echo "<p style='color:red;'>Invalid payment amount. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('images/fee_details.jpg'); /* Background image */
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
        .fee-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 50%;
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
            font-size: 1.1em;
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #007BFF;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1.1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease;
            display: block;
            margin: 0 auto;
            text-align: center;
        }
        .payment-form {
            margin-top: 20px;
            text-align: center;
        }
        .payment-form input[type="number"] {
            padding: 10px;
            font-size: 1.1em;
            width: 100px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="fee-container">
        <h1>Fee Details for <?php echo htmlspecialchars($student_id); ?></h1>
        <table>
            <tr>
                <th>Total Academic Fee</th>
                <td>₹<?php echo number_format($total_fee); ?></td>
            </tr>
            <tr>
                <th>Paid Fee</th>
                <td>₹<?php echo number_format($paid_fee); ?></td>
            </tr>
            <tr>
                <th>Pending Fee</th>
                <td>₹<?php echo number_format($pending_fee); ?></td>
            </tr>
        </table>
        
        <!-- Payment Form -->
        <form action="" method="POST" class="payment-form">
            <label for="pay_amount">Enter Amount to Pay (Max ₹<?php echo number_format($pending_fee); ?>):</label><br>
            <input type="number" name="pay_amount" id="pay_amount" max="<?php echo $pending_fee; ?>" min="1" required><br>
            <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>">
            <input type="submit" class="btn" value="Make Payment">
        </form>

        <!-- Back to Dashboard Button -->
        <a href="student_dashboard.php" class="btn" style="background-color: #007BFF; margin-top: 20px;">Back to Dashboard</a>
    </div>
</body>
</html>
