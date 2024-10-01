<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
</head>
<body>
<?php
session_start(); // Start the session

// Check if the session variables are set
if (!isset($_SESSION['name'])) {
    header("Location: resgistration.php"); // Redirect if not set
    exit();
}

// Fetch session variables
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$facebook_url = $_SESSION['facebook_url'];
$phone = $_SESSION['phone'];
$gender = $_SESSION['gender'];
$country = $_SESSION['country'];
$skills = implode(", ", $_SESSION['skills']);
$biography = $_SESSION['biography'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="my-4">User Details</h2>
    <p><strong>Name:</strong> <?php echo $name; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Facebook URL:</strong> <a href="<?php echo $facebook_url; ?>"><?php echo $facebook_url; ?></a></p>
    <p><strong>Phone:</strong> <?php echo $phone; ?></p>
    <p><strong>Gender:</strong> <?php echo $gender; ?></p>
    <p><strong>Country:</strong> <?php echo $country; ?></p>
    <p><strong>Skills:</strong> <?php echo $skills; ?></p>
    <p><strong>Biography:</strong> <?php echo $biography; ?></p>
</div>
</body>
</html>

</body>
</html>