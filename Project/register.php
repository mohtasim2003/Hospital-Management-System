
<?php
require_once 'config.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) 
    {
        header("Location: dashboard.php");
        exit();
    }

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $userType = $_POST['userType'];
    
        // Validate passwords match
        if ($password !== $confirmPassword) 
            {
                $error = "Passwords do not match.";
            } 
        else 
            {
                // Check if user already exists
                $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                
                if ($stmt->rowCount() > 0) 
                    {
                        $error = "User with this email already exists.";
                    } 
                else 
                    {
                        // Hash password and insert user
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, type) VALUES (?, ?, ?, ?)");
                        
                        if ($stmt->execute([$name, $email, $hashedPassword, $userType])) 
                            {
                                $success = "Registration successful! You can now login.";
                            } 
                        else 
                            {
                                $error = "Registration failed. Please try again.";
                            }
                    }
            }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCare - Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Main Content -->
    <main>
        <div class="container">
            <section class="auth-container">
                <div class="auth-form">
                    <h2>Create an Account</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Create a password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                        </div>
                        <div class="form-group">
                            <label for="userType">Register As</label>
                            <select id="userType" name="userType" required>
                                <option value="patient">Patient</option>
                                <option value="doctor">Doctor</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-block">Register</button>
                        <div class="form-footer">
                            <p>Already have an account? <a href="index.php">Login</a></p>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'footer.php'; ?>


    <script>
document.addEventListener("DOMContentLoaded", function () 
{
    const form = document.querySelector("form");
    const fields = {
        name: document.getElementById("name"),
        email: document.getElementById("email"),
        password: document.getElementById("password"),
        confirm_password: document.getElementById("confirm_password")
    };

    // Create error message elements below each input
    for (let key in fields) 
    {
        const error = document.createElement("div");
        error.className = "error-message";
        error.style.color = "red";
        error.style.fontSize = "0.9em";
        error.style.marginTop = "4px";
        fields[key].insertAdjacentElement("afterend", error);
    }

    // Create password strength message element
    const strengthMsg = document.createElement("div");
    strengthMsg.className = "password-strength";
    strengthMsg.style.fontSize = "0.9em";
    strengthMsg.style.marginTop = "4px";
    fields.password.nextElementSibling.insertAdjacentElement("afterend", strengthMsg);

    // Create confirm password match message element
    const matchMsg = document.createElement("div");
    matchMsg.className = "confirm-match";
    matchMsg.style.fontSize = "0.9em";
    matchMsg.style.marginTop = "4px";
    fields.confirm_password.nextElementSibling.insertAdjacentElement("afterend", matchMsg);

    // Live password strength checker
    fields.password.addEventListener("input", function () 
    {
        const val = fields.password.value;
        let strength = 0;

        if (val.length >= 8) strength++;
        if (/[A-Za-z]/.test(val)) strength++;
        if (/\d/.test(val)) strength++;
        if (/[^A-Za-z0-9]/.test(val)) strength++;

        if (val.length === 0) 
        {
            strengthMsg.textContent = "";
            return;
        }

        if (strength <= 2) 
        {
            strengthMsg.textContent = "Strength: Weak";
            strengthMsg.style.color = "red";
        } 
        else if (strength === 3) 
        {
            strengthMsg.textContent = "Strength: Medium";
            strengthMsg.style.color = "orange";
        } 
        else 
        {
            strengthMsg.textContent = "Strength: Strong";
            strengthMsg.style.color = "green";
        }
    });

    // Live confirm password match checker
    function checkMatch() 
    {
        if (fields.confirm_password.value.length === 0) 
        {
            matchMsg.textContent = "";
            return;
        }

        if (fields.password.value === fields.confirm_password.value) 
        {
            matchMsg.textContent = "Passwords match";
            matchMsg.style.color = "green";
        } 
        else 
        {
            matchMsg.textContent = "Passwords do not match";
            matchMsg.style.color = "red";
        }
    }

    fields.password.addEventListener("input", checkMatch);
    fields.confirm_password.addEventListener("input", checkMatch);

    // Validation on submit
    form.addEventListener("submit", function (event) 
    {
        let valid = true;

        // Clear previous errors
        document.querySelectorAll(".error-message").forEach(e => e.textContent = "");

        // Name validation
        const nameRegex = /^[A-Za-z\s]+$/;
        if (!nameRegex.test(fields.name.value.trim())) 
        {
            fields.name.nextElementSibling.textContent = "Name must contain only letters.";
            valid = false;
        }

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(fields.email.value.trim())) 
        {
            fields.email.nextElementSibling.textContent = "Please enter a valid email address.";
            valid = false;
        }

        // Password validation
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/;
        if (!passwordRegex.test(fields.password.value)) 
        {
            fields.password.nextElementSibling.textContent = "Password must be 8+ chars, include a letter, number, and special character.";
            valid = false;
        }

        // Confirm password match
        if (fields.password.value !== fields.confirm_password.value) 
        {
            fields.confirm_password.nextElementSibling.textContent = "Passwords do not match.";
            valid = false;
        }

        if (!valid) event.preventDefault();
    });
});

</script>

</body>
</html>