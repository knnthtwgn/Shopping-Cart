<?php
session_start();
include 'cartFunction.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


$item1 = [
    "id" => 1,
    "name" => "JACKET IN SILK CREPE BLACK",
    "price" => 550,
    "image" => "images/c1a.png",
    "image_hover" => "images/c1b.png"
];

$item2 = [
    "id" => 2,
    "name" => "JACKET IN SILK CREPE MUSLIN TAUPE FONCE",
    "price" => 500,
    "image" => "images/c2a.png",
    "image_hover" => "images/c2b.png"
];

$item3 = [
    "id" => 3,
   "name" => "JACKER IN SIL CREPE BEIGE ROSE",
    "price" => 470,
    "image" => "images/c3a.png",
    "image_hover" => "images/c3b.png"
];

$item4 = [
    "id" => 4,
   "name" => "JACKET IN STRIPED WOOL GABARDINE NOIR GRIS",
    "price" => 550,
    "image" => "images/c4a.png",
    "image_hover" => "images/c4b.png",
];

$item5 = [
    "id" => 5,
    "name" => "JACKET IN CASH MERE ANTHRACITE",
    "price" => 480,
    "image" => "images/c5a.png",
    "image_hover" => "images/c5b.png"
];

$item6 = [
    "id" => 6,
     "name" => "JACKET IN WOOL MARINE FONCE",
    "price" => 530,
    "image" => "images/c6a.png",
    "image_hover" => "images/c6b.png"
];

$item7 = [
    "id" => 7,
    "name" => "TUXEDO JACKET IN GRAIN DE POUDRE BLACK",
    "price" => 600,
    "image" => "images/c7a.png",
    "image_hover" => "images/c7b.png"
];

$item8 = [
    "id" => 8,
    "name" => "JACKET IN SILK CREPE NARINE FONCE",
    "price" => 650,
    "image" => "images/c8a.png",
    "image_hover" => "images/c8b.png"
];

// Array of items
$items = [$item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8];

// Calculate total item count in the cart
$cart_count = 0;
foreach ($_SESSION['cart'] as $cart_item) {
    $cart_count += $cart_item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JACKETS COLLECTION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
        <header class="bg-dark text-white py-3">
            <div class="container">
                <div class="text-center">
                    <h1 class="h4 m-0">JACKET SHOP</h1>
                </div>
                <a href="cart.php" class="btn btn-outline-light">
                    <i class="bi bi-cart"></i> Cart 
                    <span class="badge bg-warning text-dark"><?php echo $cart_count; ?></span>
                </a>
            </div>
        </header>


    <main class="container mt-4">
        <div class="row g-4">
            <?php foreach ($items as $item): ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card product-card shadow-lg border-0 rounded-3 position-relative" onclick="window.location.href='details.php?id=<?php echo $item['id']; ?>'">
                        <div class="card-img-top position-relative">
                            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid normal rounded-top">
                            <img src="<?php echo $item['image_hover']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid hover position-absolute top-0 start-0 rounded-top">
                        </div>
                        <div class="card-body p-3 position-relative">
                            <h5 class="card-title fw-bold mb-2"><?php echo $item['name']; ?></h5>
                            <p class="card-text text-muted mb-3">₱<span><?php echo number_format($item['price'], 2); ?></span></p><br>
                            <button class="btn add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <style>
         header .container {
        display: flex;
        justify-content: space-between; 
        align-items: center; 
        }

        header .text-center {
            flex: 1; 
            text-align: center; 
        }

        .product-card {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .product-card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: opacity 0.5s ease;
        }

        .product-card img.hover {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .product-card:hover img.normal {
            opacity: 0;
        }

        .product-card:hover img.hover {
            opacity: 1;
        }

        .card-body {
            text-align: center;
            position: relative;
        }

        .add-to-cart-btn {
            position: absolute;
            bottom: -50px;
            left: 0;
            right: 0;
            margin: auto;
            padding: 10px 20px; 
            transition: bottom 0.3s ease-in-out, background-color 0.3s ease;
            border-radius: 0; 
            background-color: gray; 
            color: white; 
            width: 80%; 
        }

        .add-to-cart-btn:hover {
            background-color: #89CFF0;
        }

        .product-card:hover .add-to-cart-btn {
            bottom: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .cart-badge {
            font-size: 1.2rem;
            background-color: transparent;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .cart-count {
            border-radius: 50%;
            font-size: 0.9rem;
            padding: 2px 7px;
        }
    </style>
</body>
</html>
</html>