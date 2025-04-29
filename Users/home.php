<?php
include 'user_conn.php';
session_start();
if (empty($_SESSION['username'])) {
  header("location: user_login.php");
  exit();
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Home Page</title>
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
  </style>
</head>

<body>
  <header>
    <nav
      class="navbar navbar-expand-sm navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="home.php">
          <img
            src="u_img/logo.jpg"
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
              <a class="nav-link active" href="home.php" aria-current="page">Products
                <span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php">
                Cart
              </a>
            </li>
          </ul>
          <form class="d-flex my-2 my-lg-0">
            <h6>welcome! &nbsp;<h6><?php echo htmlspecialchars($_SESSION['username']); ?>
                &nbsp;
                &nbsp;
                <a class="logout" href="user_logout.php ">Logout</a>
          </form>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <?php

    // Fetch products from database
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    ?>

    <div class="container m-5">
      <div class="row">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
            <div class="col-md-3 mb-4">
              <div class="card">
                <img src="../admin/<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $row['name']; ?></h5>
                  <p class="card-text"><?php echo $row['description']; ?></p>
                  <p class="card-text">Price: Rs. <?php echo $row['price']; ?></p>
                  <a href="addtocart.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Add to Cart</a>
                </div>
              </div>
            </div>
          <?php
          }
        } else {
          ?>
          <div class="col-md-12">
            <p>No products found.</p>
          </div>
        <?php
        }
        ?>
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