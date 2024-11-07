<?php
// Check if a session is already active before calling session_start().
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!function_exists('get_cart_count')) {
    function get_cart_count() {
        return isset($_SESSION['cart']) && is_array($_SESSION['cart'])
            ? array_sum(array_column($_SESSION['cart'], 'quantity'))
            : 0;
    }
}
?>
