<?php
$servername = "localhost";
$username = "id22219688_ammasaveyourtime1";
$password = "Payaman1234#";
$dbname = "id22219688_amma"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    if (isValidEmail($email)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO subscribers (email, user_type) VALUES (?, ?)");
        if ($stmt) {
            $stmt->bind_param("ss", $email, $user_type);

            if ($stmt->execute()) {
                $message = "Berhasil Mendaftar Aplikasi";
            } else {
                $message = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Invalid email format.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
        .carousel-container {
            width: 80%;
            max-width: 600px;
        }
    </style>
</head>
<body>
    <div class="carousel-container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img style="border-radius: 20px;" src="images/1.png" class="d-block w-100" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img style="border-radius: 20px;" src="images/2.png" class="d-block w-100" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img style="border-radius: 20px;" src="images/3.png" class="d-block w-100" alt="Slide 3">
                </div>
                <div class="carousel-item">
                    <img style="border-radius: 20px;" src="images/4.png" class="d-block w-100" alt="Slide 4">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
