<?php
include 'user_conn.php';
session_start();
if (empty($_SESSION['username'])) {
    header("location: user_login.php");
    exit();
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("location: cart.php"); // Redirect to cart if it's empty
    exit();
}

$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

// In a real application, you would:
// 1. Collect user's shipping and billing information.
// 2. Integrate with a payment gateway (e.g., PayPal, Stripe).
// 3. Handle successful and failed payments.
// 4. Update your database with the order details.
// 5. Send confirmation emails.
?>

<!doctype html>
<html lang="en">

<head>
    <title>Checkout</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
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

        .invoice-section {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="home.php">
                    <img src="u_img/logo.jpg" class="img-fluid rounded-circle" alt="" width="70px" height="70px" />
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
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
                            <a class="nav-link" href="cart.php">
                                Cart
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="checkout.php">
                                Checkout
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
        <h2>Checkout</h2>
        <div class="row">
            <div class="col-md-8">
                <h3>Shipping Information</h3>
                <form action="process_order.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Shipping Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>

                    <h3>Payment Information</h3>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select" id="payment_method" name="payment_method">
                            <option value="cod">Cash on Delivery</option>
                        </select>
                    </div>

                    <form action="process_order.php" method="post">
                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </form>
                </form>
            </div>
            <div class="col-md-4 invoice-section">
                <h3>Order Summary</h3>
                <ul class="list-group">
                    <?php
                    foreach ($_SESSION['cart'] as $item) {
                    ?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"><?php echo $item['name']; ?></div>
                                Quantity: <?php echo $item['quantity']; ?> x Rs. <?php echo $item['price']; ?>
                            </div>
                            <span class="badge bg-primary rounded-pill">Rs. <?php echo $item['price'] * $item['quantity']; ?></span>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total:</span>
                        <strong class="text-danger">Rs. <?php echo $total_price; ?></strong>
                    </li>
                </ul>
            </div>
        </div>
    </main>
    <footer>
    <div class="container">
      <p>&copy; 2025 Suraj. All rights reserved.</p>
    </div>
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqjzjvLbK6vgPWht30lAAgm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
</body>

</html>