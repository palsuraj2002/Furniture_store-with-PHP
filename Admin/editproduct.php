<?php

session_start();
if (empty($_SESSION['username'])) {
  header("location: adminlogin.php");
  exit;
}
?>
<?php
include 'admin_conn.php';
$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id='$id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>




<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
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

      background-image: url('admin_img/addprod.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
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

    .logout {
      text-decoration: none;
      border: 1px dashed black;
      border-radius: 25px;
      padding: 10px;
      background-color: aliceblue;
      color: black;
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
                <span class="visually-hidden">(current)</span></a>
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
    <div class="container">
      <h2 class="mt-5">Edit products</h2>
      <form action="updateproduct.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
        </div>
        <br>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
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