<!doctype html>
<html lang="en">

<head>
    <title>User Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <style>
        body {
            background-image: url('u_img/login-bg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            font-family: "Courier New", Courier, monospace;
        }

        .container {
            width: 400px;
            margin: 80px auto;
            padding: 80px;
            border: 2px dotted #ccc;
            border-radius: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: white;
            font-weight: bold;
        }

        label {
            color: white;
        }

        p {
            color: white;
        }

        .form-control {
            border: none;
            border-radius: 25px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 25px;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        a {
            color: white;
            text-decoration: none;
            border: 1px solid;
            border-radius: 15px;
            padding: 12px;
        }
    </style>
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container">
            <center>
                <h2>User Login</h2>
            </center>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                </div>
                <br>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control " id="password" name="password" placeholder="" required>
                </div>
                <br>
                <center>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <br>
                    <br>
                    <p>Are You Admin?</p>
                    <a href="../Admin/admin_login.php">Admin_Login_Page</a>
                    <br>
                    <br>
                    <p>New User? </p>
                    <a href="../Users/registration.php">Regsitration_Page</a>
                </center>

            </form>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>

<?php
include 'user_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password using password_verify()
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            header("Location: home.php");
            exit();
        } else {
            echo "<div class='alert alert-danger text-center mt-3'>Invalid password.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>No user found with that username.</div>";
    }
    $stmt->close();
}
$conn->close();
?>