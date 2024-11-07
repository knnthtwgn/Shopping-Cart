<?php
session_start();
include 'cartFunction.php'; 
$cart_count = get_cart_count();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Purchase - JACKETS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 m-0">JACKET COLLECTION</h1>
            <a href="cart.php" class="btn btn-outline-light">
                <i class="bi bi-cart"></i> Cart 
                <span class="badge bg-warning text-dark"><?php echo $cart_count; ?></span>
            </a>
        </div>
    </header>

    <!-- Confirmation Section -->
<div class="container mt-5">
    <div class="card border-0 shadow-sm p-5 text-center">
        <div class="mb-4">
            <i class="bi bi-check-circle-fill text-success display-1"></i>
        </div>
        <h2 class="fw-bold">Success!</h2>
        <p class="lead mt-3">Your product has been successfully added to the cart.</p>
        <div class="mt-4 d-flex justify-content-center gap-3">
            <a href="index.php" class="btn continue-shopping-btn">
                <i class="bi bi-basket-fill"></i> Continue Shopping
            </a>
            <a href="cart.php" class="btn btn-success btn-lg">
                <i class="bi bi-cart-check-fill"></i> View Cart
            </a>
        </div>
    </div>
</div>


    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f6f9;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 0.5rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-outline-primary {
            transition: background-color 0.3s, border-color 0.3s, color 0.3s;
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }

        .btn-success {
            transition: background-color 0.3s ease;
            padding: 0.5rem 1.5rem;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .continue-shopping-btn {
            background-color: #e30022; /* Set the background color */
            color: white; /* Text color */
            padding: 10px 20px; /* Padding for the button */
            text-align: center; /* Center the text */
            font-size: 16px; /* Adjust font size */
            text-decoration: none; /* Remove underline */
            border-radius: 5px; /* Rounded corners */
            display: inline-block; 
            transition: background-color 0.3s ease; 
        }

        .continue-shopping-btn:hover {
            background-color: #a5081a; 
            color: white;
        }

        .card {
            border-radius: 15px;
            background-color: #ffffff;
        }

        .badge {
            border-radius: 50%;
            padding: 0.5rem;
            font-size: 0.9rem;
        }

        .continue-shopping-btn i, .btn-success i {
            margin-right: 8px; 
        }
    </style>

    <?php 
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        $item_id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $size = isset($_POST['size']) ? $_POST['size'] : null;
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        
        if ($quantity > 99) {
            $quantity = 99; 
        }
        
        if ($item_id && $size) {
            $found = false;
            foreach ($_SESSION['cart'] as &$cart_item) {
                if ($cart_item['id'] === $item_id && $cart_item['size'] === $size) {
                    $cart_item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $_SESSION['cart'][] = ["id" => $item_id, "size" => $size, "quantity" => $quantity];
            }
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
