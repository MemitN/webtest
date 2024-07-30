<?php
$servername = "sql212.infinityfree.com"; // Replace with your MySQL host
$username = "if0_36990717"; // Replace with your MySQL username
$password = "IJB07MxbSfY"; // Replace with your MySQL password
$dbname = "oif0_36990717_olkeju_mara_tours"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO bookings (fullName, email, phone, tourPackage, adults, children, startDate, duration, accommodation, additionalActivities, specialRequests, paymentMethod, termsAgreement) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("ssssiiisisssi", $fullName, $email, $phone, $tourPackage, $adults, $children, $startDate, $duration, $accommodation, $additionalActivities, $specialRequests, $paymentMethod, $termsAgreement);

// Set parameters from POST data
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$tourPackage = $_POST['tourPackage'];
$adults = $_POST['adults'];
$children = $_POST['children'];
$startDate = $_POST['startDate'];
$duration = $_POST['duration'];
$accommodation = $_POST['accommodation'];
$additionalActivities = implode(', ', $_POST['additionalActivities']); // Convert array to comma-separated string
$specialRequests = $_POST['specialRequests'];
$paymentMethod = $_POST['paymentMethod'];
$termsAgreement = isset($_POST['termsAgreement']) ? 1 : 0;

// Execute SQL statement
if ($stmt->execute()) {
    echo "Booking submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
