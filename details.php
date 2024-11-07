<?php
session_start();
include 'cartFunction.php';

$items = [
    $item1 = [
        "id" => 1,
        "name" => "JACKET IN SILK CREPE BLACK",
        "price" => 550,
        "image" => "images/c1a.png",
        "image_hover" => "images/c1b.png",
        "description" => "A luxurious silk crepe jacket in classic black, perfect for any formal occasion."
    ],
    $item2 = [
        "id" => 2,
        "name" => "JACKET IN SILK CREPE MUSLIN TAUPE FONCE",
        "price" => 500,
        "image" => "images/c2a.png",
        "image_hover" => "images/c2b.png",
        "description" => "An elegant silk crepe jacket in taupe fonce, offering sophistication and style."
    ],
    $item3 = [
        "id" => 3,
        "name" => "JACKET IN SILK CREPE BEIGE ROSE",
        "price" => 470,
        "image" => "images/c3a.png",
        "image_hover" => "images/c3b.png",
        "description" => "A stylish silk crepe jacket in beige rose, perfect for adding a touch of charm."
    ],
    $item4 = [
        "id" => 4,
        "name" => "JACKET IN STRIPED WOOL GABARDINE NOIR GRIS",
        "price" => 550,
        "image" => "images/c4a.png",
        "image_hover" => "images/c4b.png",
        "description" => "A sophisticated striped wool gabardine jacket in noir gris, ideal for formal events."
    ],
    $item5 = [
        "id" => 5,
        "name" => "JACKET IN CASHMERE ANTHRACITE",
        "price" => 480,
        "image" => "images/c5a.png",
        "image_hover" => "images/c5b.png",
        "description" => "A luxurious cashmere jacket in anthracite, combining warmth and elegance."
    ],
    $item6 = [
        "id" => 6,
        "name" => "JACKET IN WOOL MARINE FONCE",
        "price" => 530,
        "image" => "images/c6a.png",
        "image_hover" => "images/c6b.png",
        "description" => "A classic wool jacket in marine fonce, perfect for any season."
    ],
    $item7 = [
        "id" => 7,
        "name" => "TUXEDO JACKET IN GRAIN DE POUDRE BLACK",
        "price" => 600,
        "image" => "images/c7a.png",
        "image_hover" => "images/c7b.png",
        "description" => "A stylish tuxedo jacket in grain de poudre black, designed for formal occasions."
    ],
    $item8 = [
        "id" => 8,
        "name" => "JACKET IN SILK CREPE NARINE FONCE",
        "price" => 650,
        "image" => "images/c8a.png",
        "image_hover" => "images/c8b.png",
        "description" => "An exquisite silk crepe jacket in narine fonce, perfect for a chic evening out."
    ]
];


// Get item ID from URL
$item_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$item = null;

// Find item by ID
foreach ($items as $product) {
    if ($product['id'] === $item_id) {
        $item = $product;
        break;
    }
}

// Redirect if item not found
if (!$item) {
    header("Location: index.php");
    exit;
}

// Calculate total item count in the cart
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        $cart_count += $cart_item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $item['name']; ?> - Jackets Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-dark text-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="h4 m-0">Jacket Collection</h1>
        <a href="cart.php" class="btn btn-outline-light">
            <i class="bi bi-cart"></i> Cart 
            <span class="badge bg-warning text-dark"><?php echo $cart_count; ?></span>
        </a>
    </div>
</header>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-5 col-md-6 mb-4">
            <div class="product-image-wrapper">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid rounded shadow-sm">
                <img src="<?php echo $item['image_hover']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid rounded shadow-sm hover-image position-absolute top-0 start-0">
            </div>
        </div>
        <div class="col-lg-7 col-md-6">
            <h2 class="fw-bold"><?php echo $item['name']; ?></h2>
            <p class="text-muted fs-4">₱<?php echo number_format($item['price'], 2); ?></p>
            <p class="text-muted"><?php echo $item['description']; ?></p>

            <form action="confirm.php" method="POST" class="mt-4" onsubmit="return validateForm()">
    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
    
    <h5>Select Size:</h5>
    <div class="mb-3">
        <?php foreach (['XS', 'S', 'M', 'L', 'XL'] as $size): ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="size" value="<?php echo $size; ?>" id="size<?php echo $size; ?>" <?php echo $size === 'XS' ? 'checked' : ''; ?>>
                <label class="form-check-label" for="size<?php echo $size; ?>"><?php echo $size; ?></label>
            </div>
        <?php endforeach; ?>
    </div>

    <h5>Enter Quantity:</h5>
    <input type="number" class="form-control w-50 mb-3" name="quantity" placeholder="0" min="1" max="99" required>

    <button type="submit" class="btn btn-confirm btn-lg w-100">
        <i class="bi bi-check-circle"></i> Confirm Product Purchase
    </button>
        <a href="index.php" class="btn btn-cancel btn-lg w-100 mt-2">
    <i class="bi bi-arrow-left"></i> Cancel/Go Back
</a>

</form>

<script>
    function validateForm() {
        var quantity = document.querySelector('input[name="quantity"]');
        var value = quantity.value;

        if (value < 1) {
            alert("Please Enter a Number greater than 0");
            quantity.focus(); 
            return false; 
        }
        
        return true;
    }
</script>



        </div>
    </div>
</div>

<style>
    .product-image-wrapper {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
    }

    .hover-image {
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .product-image-wrapper:hover .hover-image {
        opacity: 1;
    }

    .product-image-wrapper:hover img {
        opacity: 0;
    }

   
    .btn-confirm {
        background-color: #36454F; 
        color: white; 
        transition: background-color 0.3s;
    }

    .btn-confirm:hover {
        background-color: #202020; 
        color: white;
    }

    .btn-cancel {
        background-color: #e30022 ; 
        color: white; 
        transition: background-color 0.3s;
    }

    .btn-cancel:hover {
        background-color: #a5081a; 
        color: white;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
