<?php
// Check if all required form fields are set
if (isset($_POST['name'], $_POST['email'], $_POST['message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['message'];

    // Check if the 'message' field is set
    $message = isset($_POST['message'])? $_POST['message'] : '';

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'lyricsclubyt');
    if ($conn->connect_error) {
        echo "Connection Failed : ". $conn->connect_error;
    } else {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO registration (name, email, message) VALUES (?,?,?)");

        // Bind parameters
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute statement
        $execval = $stmt->execute();

        if ($execval) {
            echo "Registration successfully...";
        } else {
            echo "Error: ". $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
} else {
    echo "Required form fields are missing.";
}
?>