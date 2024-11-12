<?php
session_start();
include 'cartFunction.php'; 

// Initialize the cart session if it is not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); // Initialize the cart as an empty array
}

// Item array with updated format
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
    "image_hover" => "images/c4b.png"
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
$itemCollection = [$item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
    // Loop through each item ID in the quantity data
    foreach ($_POST['quantity'] as $id => $sizes) {
        // Loop through each size for the current item ID
        foreach ($sizes as $size => $quantity) {
            // Find the item in the cart
            $found = false;
            foreach ($_SESSION['cart'] as &$cart_item) {
                if ($cart_item['id'] == $id && $cart_item['size'] == $size) {
                    // Update the quantity for the matching size
                    $cart_item['quantity'] = min(max(1, (int)$quantity), 99);
                    $found = true;
                    break;
                }
            }

            // If item with this size is not found in the cart, add it
            if (!$found) {
                foreach ($itemCollection as $item) {
                    if ($item['id'] == $id) {
                        $_SESSION['cart'][] = [
                            'id' => $item['id'],
                            'size' => $size,
                            'quantity' => min(max(1, (int)$quantity), 99)
                        ];
                        break;
                    }
                }
            }
        }
    }

    header("Location: cart.php");
    exit;
}



// Calculate total cart value and item count
$total_price = 0;
$total_quantity = 0;

foreach ($_SESSION['cart'] as $cart_item) {
    foreach ($itemCollection as $item) {
        if ($item['id'] === $cart_item['id']) {
            $total_price += $cart_item['quantity'] * $item['price'];
            break;
        }
    }
    $total_quantity += $cart_item['quantity'];
}

$cart_count = $total_quantity;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - JACKET SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white py-3 shadow-sm mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">JACKET SHOP</h1>
            <a href="cart.php" class="btn btn-outline-light position-relative">
                <i class="bi bi-cart"></i> Cart
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                    <?php echo $cart_count; ?>
                </span>
            </a>
        </div>
    </header>

    <div class="table-responsive" style="margin: 0 60px;">
    <form method="POST" action="cart.php">
        <table class="table table-hover align-middle">
            <thead class="table-secondary">
                <tr>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($_SESSION['cart'])): ?>
                    <tr class="no-hover">
                        <td colspan="6" class="text-left no-hover">
                            Cart is still empty.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($_SESSION['cart'] as $cart_item): ?>
                        <?php
                            $item_details = null;
                            foreach ($itemCollection as $item) {
                                if ($item['id'] === $cart_item['id']) {
                                    $item_details = $item;
                                    break;
                                }
                            }
                            if ($item_details):
                                $item_total = $item_details['price'] * $cart_item['quantity'];
                        ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo $item_details['image']; ?>" alt="<?php echo htmlspecialchars($item_details['name']); ?>" class="me-3 rounded" style="width: 60px; height: auto;">
                                    <div>
                                        <strong><?php echo htmlspecialchars($item_details['name']); ?></strong>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><?php echo htmlspecialchars($cart_item['size']); ?></td>
                            <td class="text-center">
                            <input type="number" name="quantity[<?php echo $cart_item['id']; ?>][<?php echo $cart_item['size']; ?>]" value="<?php echo $cart_item['quantity']; ?>" min="1" max="99" class="form-control w-50 mx-auto">
                            <input type="hidden" name="size[<?php echo $cart_item['id']; ?>][<?php echo $cart_item['size']; ?>]" value="<?php echo $cart_item['size']; ?>">

                            </td>
                            <td>₱<?php echo number_format($item_details['price'], 2); ?></td>
                            <td>₱<?php echo number_format($item_total, 2); ?></td>
                            <td class="text-center">
                                <a href="remove.php?product_id=<?php echo $cart_item['id']; ?>&size=<?php echo urlencode($cart_item['size']); ?>" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Remove
                                </a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr class="table-light">
                        <td colspan="4" class="text-end fw-bold">Total</td>
                        <td colspan="2" class="fw-bold">₱<?php echo number_format($total_price, 2); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if (!empty($_SESSION['cart'])): ?>
    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="index.php" class="btn continue-shopping-btn">
            <i class="bi bi-basket"></i> Continue Shopping
        </a>
        <button type="submit" class="btn update-cart-btn"><i class="bi bi-save"></i> Update Cart</button>
        <a href="checkout.php" class="btn proceed-checkout-btn"><i class="bi bi-credit-card"></i> Proceed to Checkout</a>
    </div>
<?php else: ?>
    <!-- If cart is empty, show Continue Shopping button only -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="index.php" class="btn continue-shopping-btn">
            <i class="bi bi-basket"></i> Continue Shopping
        </a>
    </div>
<?php endif; ?>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<style>
/* Styling for the Continue Shopping button */
.continue-shopping-btn {
    background-color: #e30022; /* Background color */
    color: white; /* Text color */
    padding: 12px 20px; /* Adjust padding for size */
    font-size: 1.2rem; /* Increase font size */
    border-radius: 5px; /* Optional: Adjust border radius */
    width: auto; /* Adjust to fit content or set a specific width */
    margin-left: 60px; /* Add margin to the right to create space for Update Cart button */
}

.continue-shopping-btn:hover {
    background-color: #a5081a; /* Hover background color */
    color: white; /* Text color on hover */
}

.update-cart-btn {
    background-color: #28a745; /* Green color for Update Cart */
    color: white; /* Text color */
    padding: 12px 20px; /* Adjust padding to match Continue Shopping button */
    font-size: 1.2rem; /* Font size */
    border-radius: 5px; /* Border radius */
    width: auto; /* Adjust to fit content */
    margin-left: 10px; /* Add margin to the right if necessary */
}

.update-cart-btn:hover {
    background-color: #218838; /* Darker green on hover */
    color: white;
}

.proceed-checkout-btn {
    background-color: #007bff; /* Blue color for Proceed to Checkout */
    color: white; /* Text color */
    padding: 12px 20px; /* Adjust padding */
    font-size: 1.2rem; /* Font size */
    border-radius: 5px; /* Border radius */
    margin-left: 10px
}

.proceed-checkout-btn:hover {
    background-color: #0069d9; /* Darker blue on hover */
    color: white;
}
</style>