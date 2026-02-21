<!DOCTYPE html>
<html lang="en">
<?php
// Include database connection
require_once("../connection/connect.php");

// Start session and enable error reporting in development
session_start();
ini_set('display_errors', 0);
error_reporting(E_ALL);

// CSRF Token Generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Initialize variables
$message = '';
$success = '';
$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $errors[] = 'Invalid request. Please try again.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        // Input validation
        if (empty($username)) {
            $errors[] = 'Username is required.';
        }

        if (empty($password)) {
            $errors[] = 'Password is required.';
        }

        // If validation passes, attempt login
        if (empty($errors)) {
            try {
                // Use prepared statement to prevent SQL injection
                $stmt = $db->prepare("SELECT adm_id, username, password FROM admin WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    $admin = $result->fetch_assoc();

                    // Verify password (assuming passwords are now hashed with password_hash)
                    // For backward compatibility, check both hashed and MD5 passwords
                    $passwordValid = false;

                    if (password_verify($password, $admin['password'])) {
                        // Modern password hash
                        $passwordValid = true;
                    } elseif (md5($password) === $admin['password']) {
                        // Legacy MD5 (should be updated)
                        $passwordValid = true;
                        // Optionally update to modern hash (uncomment if you want to migrate)
                        // $newHash = password_hash($password, PASSWORD_DEFAULT);
                        // $updateStmt = $db->prepare("UPDATE admin SET password = ? WHERE adm_id = ?");
                        // $updateStmt->bind_param("si", $newHash, $admin['adm_id']);
                        // $updateStmt->execute();
                    }

                    if ($passwordValid) {
                        // Set session variables
                        $_SESSION['adm_id'] = $admin['adm_id'];
                        $_SESSION['admin_username'] = $admin['username'];
                        $_SESSION['admin_logged_in'] = true;

                        // Regenerate session ID for security
                        session_regenerate_id(true);

                        $success = 'Login successful! Redirecting to dashboard...';

                        // Redirect after a short delay for user feedback
                        header("refresh:2;url=dashboard.php");
                        exit();
                    } else {
                        $errors[] = 'Invalid username or password.';
                    }
                } else {
                    $errors[] = 'Invalid username or password.';
                }

                $stmt->close();
            } catch (Exception $e) {
                error_log("Login error: " . $e->getMessage());
                $errors[] = 'An error occurred. Please try again later.';
            }
        }
    }

    // Set message for display
    if (!empty($errors)) {
        $message = implode('<br>', $errors);
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Modern Dashboard</title>

    <!-- Modern Fonts and Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 (Modern) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/login.css">

    <style>
        /* Additional modern styles */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            animation: slideDown 0.3s ease-out;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .alert-success {
            background: linear-gradient(135deg, #51cf66, #40c057);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .login-form.submitting {
            pointer-events: none;
            opacity: 0.7;
        }

        .login-form.submitting input[type="submit"] {
            background: linear-gradient(135deg, #ccc, #999) !important;
            cursor: not-allowed;
        }

        .login-form.submitting input[type="submit"]:before {
            content: '';
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="info">
            <h1><i class="fas fa-shield-alt"></i> Admin Panel</h1>
            <p>Secure Access Portal</p>
        </div>
    </div>

    <div class="form">
        <div class="thumbnail">
            <img src="images/manager.png" alt="Admin Avatar"/>
        </div>

        <?php if (!empty($message)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="loginForm">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

            <div class="input-group">
                <i class="fas fa-user input-icon"></i>
                <input type="text"
                       name="username"
                       placeholder="Enter your username"
                       value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                       required
                       autocomplete="username">
            </div>

            <div class="input-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password"
                       name="password"
                       placeholder="Enter your password"
                       required
                       autocomplete="current-password">
            </div>

            <button type="submit" name="submit" id="loginBtn">
                <i class="fas fa-sign-in-alt"></i>
                Login to Dashboard
            </button>
        </form>

        <div class="form-footer">
            <p class="message">
                <i class="fas fa-info-circle"></i>
                Secure admin access only
            </p>
        </div>
    </div>

    <!-- Floating background elements -->
    <div class="floating-1"></div>
    <div class="floating-2"></div>

    <!-- Modern JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            // Form submission handling
            $('#loginForm').on('submit', function(e) {
                const $form = $(this);
                const $btn = $('#loginBtn');

                // Add loading state
                $form.addClass('submitting');
                $btn.prop('disabled', true).html('<span class="loading"></span>Authenticating...');

                // Remove loading state after 3 seconds if no redirect (for errors)
                setTimeout(function() {
                    $form.removeClass('submitting');
                    $btn.prop('disabled', false).html('<i class="fas fa-sign-in-alt"></i> Login to Dashboard');
                }, 3000);
            });

            // Input focus effects
            $('.input-group input').on('focus', function() {
                $(this).parent().addClass('focused');
            }).on('blur', function() {
                $(this).parent().removeClass('focused');
            });

            // Password visibility toggle (optional enhancement)
            let passwordVisible = false;
            $('.input-group:has(input[type="password"])').append('<i class="fas fa-eye toggle-password"></i>');

            $('.toggle-password').on('click', function() {
                const $input = $(this).siblings('input');
                const $icon = $(this);

                if (passwordVisible) {
                    $input.attr('type', 'password');
                    $icon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    $input.attr('type', 'text');
                    $icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
                passwordVisible = !passwordVisible;
            });
        });
    </script>
</body>
</html>