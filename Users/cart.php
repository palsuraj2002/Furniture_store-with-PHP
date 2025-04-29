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
    <title>Shopping Cart</title>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

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

        .cart-item {
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .cart-item:last-child {
            border-bottom: none;
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
                            <a class="nav-link" href="home.php" aria-current="page">Products
                                <span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="cart.php">
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
    <main class="container mt-5">
        <h2>Your Shopping Cart</h2>
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $total_price = 0;
            foreach ($_SESSION['cart'] as $key => $item) {
        ?>
                <div class="row cart-item">
                    <div class="col-md-3">
                        <img src="../admin/<?php echo $item['image']; ?>" class="img-fluid" alt="<?php echo $item['name']; ?>" width="100">
                    </div>
                    <div class="col-md-6">
                        <h5><?php echo $item['name']; ?></h5>
                        <p>Price: Rs. <?php echo $item['price']; ?></p>
                        <p>Quantity: <?php echo $item['quantity']; ?></p>
                        <p>Subtotal: Rs. <?php echo $item['price'] * $item['quantity']; ?></p>
                        <a href="removefromcart.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
                    </div>
                </div>
            <?php
                $total_price += $item['price'] * $item['quantity'];
            }
            ?>
            <div class="row mt-3">
                <div class="col-md-12 text-end">
                    <h4>Total: Rs. <?php echo $total_price; ?></h4>
                    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                </div>
            </div>
        <?php
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2025 Suraj. All rights reserved.</p>
        </div>
    </footer>
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqjzjvLbK6vgPWht30lAAgm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
</body>

</html>