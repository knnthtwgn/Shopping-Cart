<?php
session_start();
include 'cartFunction.php'; 
$cart_count = get_cart_count();

$item_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : null;
$item = null;

if ($item_id && isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] == $item_id) {
            $item = $cart_item;
            break;
        }
    }
}

if (!$item) {
    header("Location: cart.php");
    exit;
}

// Array declaration for items following the same format as cart.php
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

// Function to get item details
function getItemDetails($id, $items) {
    foreach ($items as $item) {
        if ($item['id'] == $id) {
            return $item;
        }
    }
    return null;
}

$product_details = getItemDetails($item_id, $items);

if (!$product_details) {
    echo "<div class='alert alert-danger'>Product details not found. Please go back and try again.</div>";
    exit;
}

// Remove item from the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_SESSION['cart'] as $key => $cart_item) {
        if ($cart_item['id'] == $item_id) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array after removing
            break;
        }
    }
    header("Location: cart.php?message=Item Successfully Removed.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Confirmation - Jackets Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="bg-dark text-white py-3 shadow-sm mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Jackets Shop</h1>
            <a href="cart.php" class="btn btn-outline-light position-relative">
                <i class="bi bi-cart"></i> Cart
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                    <?php echo $cart_count; ?>
                </span>
            </a>
        </div>
    </header>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="position-relative">
                            <img src="<?php echo htmlspecialchars($product_details['image']); ?>" alt="<?php echo htmlspecialchars($product_details['name']); ?>" class="img-fluid normal-image">
                            <img src="<?php echo htmlspecialchars($product_details['image_hover']); ?>" alt="<?php echo htmlspecialchars($product_details['name']); ?> (hover)" class="img-fluid hover-image position-absolute top-0 start-0">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3><?php echo htmlspecialchars($product_details['name']); ?> <span class="badge bg-warning">₱<?php echo number_format($product_details['price'], 2); ?></span></h3>
                        <p class="mt-3"><?php echo htmlspecialchars($product_details['description']); ?></p>
                        <p><strong>Size:</strong> <?php echo htmlspecialchars($item['size']); ?></p>
                        <p><strong>Quantity:</strong> <?php echo (int)$item['quantity']; ?></p>
                        <div class="mt-4">
                            <form method="POST">
                                <button type="submit" class="btn btn-dark me-2">
                                    <i class="bi bi-trash"></i> Confirm Product Removal
                                </button><br><br>
                            </form>
                            <a href="cart.php" class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Cancel/Go Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
