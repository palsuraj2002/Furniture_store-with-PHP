<?php
session_start();
if(empty( $_SESSION['username'])){
  header("location: admin_login.php" );
 exit;
}
?>
<?php
include 'admin_conn.php';
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <title>User Management</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <style>
   body{
       
         background-image: url('admin_img/mgmt.jpg');
                background-repeat:no-repeat;
                background-size:cover;
                background-attachment: fixed;
      }

        .logout{
        text-decoration:none;
        border:1px dashed black;
        border-radius:25px;
        padding:10px;
        background-color: aliceblue;
        color:black;
      }

      
h2 {
  margin-bottom: 20px;
}

.table {
  border-collapse: collapse;
  width: 100%;
  border-radius:15px;
}

th, td {
  border: 1px solid #ddd;
  border-radius:15px;
  padding: 15px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

.btn {
  margin-right: 5px;
}

.btn-danger {
  background-color: #dc3545;
  border-color: #dc3545;
    border-radius:25px;
}

.btn-warning {
  background-color: #ffc107;
  border-color: #ffc107;
    border-radius:25px;
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
        class="navbar navbar-expand-sm navbar-light bg-light"
      >
        <div class="container">
          <a class="navbar-brand" href="dashboard.php">
<img
  src="admin_img/logo.jpg"
  class="img-fluid rounded-circle"
  alt=""
  width="70px"
  height="70px"
/>
          </a>
          <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
              <li class="nav-item">
                <a class="nav-link active" href="productmanagement.php" aria-current="page"
                  >Products
                  <span class="visually-hidden">(current)</span></a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="usermanagement.php" aria-current="page"
                  >Users
                  <span class="visually-hidden"></span></a
                >
              </li>
            
            </ul>
            <form class="d-flex my-2 my-lg-0">
                <h6>welcome! &nbsp;<h6>$<?php echo htmlspecialchars($_SESSION['username']);?>
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
        <center><h2 class="mt-5">User Management</h2></center>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
           
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td>
                                <a href="edituser.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="deleteuser.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

<?php
$conn->close();
?>