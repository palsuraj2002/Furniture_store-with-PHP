<?php
include 'admin_conn.php';
session_start();
if (empty($_SESSION['username'])) {
  header("location: admin_login.php");
  exit;
}
?>

<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "furniture_store";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Count total products
$sql_products = "SELECT COUNT(*) as total_products FROM products";
$result_products = $conn->query($sql_products);
$row_products = $result_products->fetch_assoc();
$total_products = $row_products["total_products"];

// Count total users
$sql_users = "SELECT COUNT(*) as total_users FROM users";
$result_users = $conn->query($sql_users);
$row_users = $result_users->fetch_assoc();
$total_users = $row_users["total_users"];

?>


<!doctype html>
<html lang="en">

<head>
  <title>Dashboard</title>
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

      background-image: url('admin_img/dashboard.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;


    }

    .logout {
      text-decoration: none;
      border: 1px dashed black;
      border-radius: 25px;
      padding: 10px;
      background-color: aliceblue;
      color: black;
    }

    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: #f0f0f0;
      text-align: center;
      padding: 10px 0;
    }

    .content {
      margin-left: 20px;
      padding: 20px;
    }

    .card {
      margin-bottom: 20px;
    }

    h1 {
      text-align: center;
      font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
        "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
      font-weight: bold;

    }
  </style>

</head>

<body>
  <header>
    <nav
      class="navbar navbar-expand-sm navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="dashboard.php">
          <img
            src="admin_img/logo.jpg"
            class="img-fluid rounded-circle"
            alt=""
            width="70px"
            height="70px" />
        </a>
        <button
          class="navbar-toggler d-lg-none"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapsibleNavId"
          aria-controls="collapsibleNavId"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="productmanagement.php" aria-current="page">Products
                <span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="usermanagement.php" aria-current="page">Users
                <span class="visually-hidden"></span></a>
            </li>

          </ul>
          <form class="d-flex my-2 my-lg-0">
            <h6>welcome! &nbsp;<h6>$<?php echo htmlspecialchars($_SESSION['username']); ?>
                &nbsp;
                &nbsp;
                <a class="logout" href="admin_logout.php ">Logout</a>
          </form>
        </div>
      </div>
    </nav>
  </header>
  <main>

    <div class="content">
      <h1>Admin Dashboard</h1>
      <br>

      <div class="row">
        <div class="col-md-3">
          <div class="card bg-primary text-white">
            <div class="card-body">
              <h2><?php echo $total_products; ?></h2>
              <p>Products</p>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card bg-warning text-white">
            <div class="card-body">
              <h2><?php echo $total_users; ?></h2>
              <p>Users</p>
            </div>
          </div>
        </div>
      </div>

    </div>

  </main>
  <footer>
    <div class="container">
      <p>&copy; 2025 Suraj. All rights reserved.</p>
    </div>
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
$conn->close();
?>