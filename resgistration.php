<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
<?php
session_start(); 


$name = $email = $password = $confirm_password = $facebook_url = $phone = $gender = $country = $biography = "";
$skills = [];
$nameError = $emailError = $passwordError = $confirmPasswordError = $facebookError = $phoneError = $genderError = $countryError = $skillsError = $biographyError = "";


function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["name"])) {
        $nameError = "Name is required";
    } else {
        $name = sanitizeInput($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameError = "Only letters and spaces allowed";
        }
    }

    
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = sanitizeInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }
    }

   
    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
    } else {
        $password = sanitizeInput($_POST["password"]);
        if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-zA-Z0-9]/", $password)) {
            $passwordError = "Password must be at least 8 characters, with at least one uppercase letter and alphanumeric characters";
        }
    }

   
    if (empty($_POST["confirm_password"])) {
        $confirmPasswordError = "Confirm password is required";
    } else {
        $confirm_password = sanitizeInput($_POST["confirm_password"]);
        if ($password !== $confirm_password) {
            $confirmPasswordError = "Passwords do not match";
        }
    }

  
    if (empty($_POST["facebook_url"])) {
        $facebookError = "Facebook URL is required";
    } else {
        $facebook_url = sanitizeInput($_POST["facebook_url"]);
        if (!filter_var($facebook_url, FILTER_VALIDATE_URL)) {
            $facebookError = "Invalid URL format";
        }
    }

    
    if (empty($_POST["phone"])) {
        $phoneError = "Phone number is required";
    } else {
        $phone = sanitizeInput($_POST["phone"]);
        if (!preg_match("/^[0-9]{11}$/", $phone)) {
            $phoneError = "Phone number must be 10 digits";
        }
    }

    // Gender validation
    if (empty($_POST["gender"])) {
        $genderError = "Gender is required";
    } else {
        $gender = sanitizeInput($_POST["gender"]);
    }

    // Country validation
    if (empty($_POST["country"])) {
        $countryError = "Country is required";
    } else {
        $country = sanitizeInput($_POST["country"]);
    }

    // Skills validation
    if (empty($_POST["skills"])) {
        $skillsError = "At least one skill must be selected";
    } else {
        $skills = $_POST["skills"];
    }

    // Biography validation
    if (empty($_POST["biography"])) {
        $biographyError = "Biography is required";
    } else {
        $biography = sanitizeInput($_POST["biography"]);
        if (strlen($biography) > 200) {
            $biographyError = "Biography must not exceed 200 characters";
        }
    }

    // Check if all fields are valid
    if (empty($nameError) && empty($emailError) && empty($passwordError) && empty($confirmPasswordError) &&
        empty($facebookError) && empty($phoneError) && empty($genderError) && empty($countryError) &&
        empty($skillsError) && empty($biographyError)) {
        
        // Store validated values to the session
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['facebook_url'] = $facebook_url;
        $_SESSION['phone'] = $phone;
        $_SESSION['gender'] = $gender;
        $_SESSION['country'] = $country;
        $_SESSION['skills'] = $skills;
        $_SESSION['biography'] = $biography;

        // Redirect to about.php
        header("Location: about.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="my-4">Registration Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

       
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control <?php echo (!empty($nameError)) ? 'is-invalid' : ''; ?>" name="name" value="<?php echo $name; ?>">
            <div class="invalid-feedback"><?php echo $nameError; ?></div>
        </div>

        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?php echo (!empty($emailError)) ? 'is-invalid' : ''; ?>" name="email" value="<?php echo $email; ?>">
            <div class="invalid-feedback"><?php echo $emailError; ?></div>
        </div>

       
        <div class="mb-3">
            <label for="facebook_url" class="form-label">Facebook URL</label>
            <input type="url" class="form-control <?php echo (!empty($facebookError)) ? 'is-invalid' : ''; ?>" name="facebook_url" value="<?php echo $facebook_url; ?>">
            <div class="invalid-feedback"><?php echo $facebookError; ?></div>
        </div>

       
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control <?php echo (!empty($phoneError)) ? 'is-invalid' : ''; ?>" name="phone" value="<?php echo $phone; ?>">
            <div class="invalid-feedback"><?php echo $phoneError; ?></div>
        </div>

       
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control <?php echo (!empty($passwordError)) ? 'is-invalid' : ''; ?>" name="password">
            <div class="invalid-feedback"><?php echo $passwordError; ?></div>
        </div>

       
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control <?php echo (!empty($confirmPasswordError)) ? 'is-invalid' : ''; ?>" name="confirm_password">
            <div class="invalid-feedback"><?php echo $confirmPasswordError; ?></div>
        </div>

        
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <div>
                <input type="radio" name="gender" value="Male" <?php if ($gender == 'Male') echo 'checked'; ?>> Male
                <input type="radio" name="gender" value="Female" <?php if ($gender == 'Female') echo 'checked'; ?>> Female
            </div>
            <div class="text-danger"><?php echo $genderError; ?></div>
        </div>

       
        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <select class="form-control <?php echo (!empty($countryError)) ? 'is-invalid' : ''; ?>" name="country">
                <option value="">Select your country</option>
                <option value="PHILIPPINES" <?php if ($country == 'PHILIPPINES') echo 'selected'; ?>>PHILIPPINES</option>
                <option value="AUSTRALIA" <?php if ($country == 'AUSTRALIA') echo 'selected'; ?>>AUSTRALIA</option>
                <option value="PAKISTAN" <?php if ($country == 'PAKISTAN') echo 'selected'; ?>>PAKISTAN</option>
                <option value="JAPANgasinan" <?php if ($country == 'JAPANgasinan') echo 'selected'; ?>>JAPANgasinan</option>
                <option value="UradanetaCountry" <?php if ($country == 'UradanetaCountry') echo 'selected'; ?>>UradanetaCountry</option>
                
            </select>
            <div class="invalid-feedback"><?php echo $countryError; ?></div>
        </div>

        
        <div class="mb-3">
    <label class="form-label">Skills</label>
    <div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input <?php echo (!empty($skillsError)) ? 'is-invalid' : ''; ?>" name="skills[]" value="Eating" id="skill_eating" <?php if (in_array('Eating', $skills)) echo 'checked'; ?>>
            <label class="form-check-label" for="skill_eating">Eating</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input <?php echo (!empty($skillsError)) ? 'is-invalid' : ''; ?>" name="skills[]" value="Sleeping" id="skill_sleeping" <?php if (in_array('Sleeping', $skills)) echo 'checked'; ?>>
            <label class="form-check-label" for="skill_javascript">Sleeping</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input <?php echo (!empty($skillsError)) ? 'is-invalid' : ''; ?>" name="skills[]" value="Driving" id="skill_driving" <?php if (in_array('Driving', $skills)) echo 'checked'; ?>>
            <label class="form-check-label" for="skill_html">Driving</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input <?php echo (!empty($skillsError)) ? 'is-invalid' : ''; ?>" name="skills[]" value="Drinking" id="skill_drinking" <?php if (in_array('Drinking', $skills)) echo 'checked'; ?>>
            <label class="form-check-label" for="skill_drinking">Drinking</label>
        </div>
    </div>
    <div class="invalid-feedback"><?php echo $skillsError; ?></div>
</div>


        <!-- Biography -->
        <div class="mb-3">
            <label for="biography" class="form-label">Biography</label>
            <textarea class="form-control <?php echo (!empty($biographyError)) ? 'is-invalid' : ''; ?>" name="biography"><?php echo $biography; ?></textarea>
            <div class="invalid-feedback"><?php echo $biographyError; ?></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>
</html>
