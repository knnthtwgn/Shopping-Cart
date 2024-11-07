<?php
session_start();
session_destroy(); 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - Jackets Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>

    <header class="bg-dark text-white py-3 shadow-sm mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Jackets Shop</h1>
            <a href="cart.php" class="btn btn-outline-light position-relative">
                <i class="bi bi-cart"></i> Cart
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">0</span>
            </a>
        </div>
    </header>

 <!-- Success Message -->
 <div class="container mt-5 text-center">
        <div class="success-container">
            <div class="icon mb-4">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <h2 class="fw-bold mb-3 text-success">Thank You for Your Purchase!</h2>
            <p class="text-muted mb-2">Your order was placed successfully. We’re thrilled to be part of your shopping experience!</p>
            <p class="text-muted">Check your email for order updates. We look forward to serving you again soon!</p>
            <!-- Continue Shopping Button -->
            <div class="d-flex justify-content-center align-items-center mt-4">
                <a href="index.php" class="btn continue-shopping-btn">
                    <i class="bi bi-basket"></i> Continue Shopping
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<style>
.success-container {
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            border: 2px solid #198754;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .icon i {
            color: #198754;
            font-size: 4rem;
        }

        .text-success {
            color: #198754 !important;
        }

        .continue-shopping-btn {
            background-color: #198754;
            color: white;
            font-weight: 600;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .continue-shopping-btn:hover {
            background-color: #145a32;
            color: #e9ecef;
            text-decoration: none;
        }

</style>