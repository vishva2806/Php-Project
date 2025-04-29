<?php
    session_start();
    include 'conn.php';

    if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
        $removeId = $_GET['id'];
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $removeId) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); 
                break;
            }
        }
        header("Location: cart.php?msg=removed");
        exit();
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT id, Title, Price FROM mobile WHERE id = $id";  
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $found = false;

            foreach ($_SESSION['cart'] ?? [] as $key => $item) {
                if ($item['id'] == $row['id']) {
                    $_SESSION['cart'][$key]['quantity'] += 1; 
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $_SESSION['cart'][] = [
                    'id' => $row['id'],
                    'title' => $row['Title'],
                    'price' => $row['Price'],
                    'quantity' => 1
                ];
            }

            header("Location: cart.php?msg=added");
            exit();
        } else {
            echo "Product not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Your Cart</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    </head>
    <body>
    <div class="container mt-5">
        <h2>Your Cart</h2>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'added'): ?>
            <div class="alert alert-success">Item added to cart successfully!</div>
        <?php endif; ?>
        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'removed'): ?>
        <div class="alert alert-warning">Item removed from cart.</div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['cart'])): ?>
            <table class=" table table-dark table-hover mt-5">
                <thead class=" table  table-bordered table-light table-hover mt-5">
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Quantity</th>
                        <th>Price (₹)</th>
                        <th>Total (₹)</th>
                        <th>Delete_item</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grandTotal = 0;
                    foreach ($_SESSION['cart'] as $index => $item):
                        $itemTotal = $item['price'] * $item['quantity'];
                        $grandTotal += $itemTotal;
                    ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $item['title'] ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>₹<?= number_format($item['price'], 2) ?></td>
                            <td>₹<?= number_format($itemTotal, 2) ?></td>
                            <td style="text-align:center;">
                                <a href="cart.php?action=remove&id=<?= $item['id'] ?>" class="text-primary" onclick="return confirm('Are you sure you want to delete this record?')">
                                    <i class="fa-solid fa-trash"></i> 
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="table-success text-center">
                        <td colspan="5" class="text-end text-center "><strong>Grand Total:</strong></td>
                        <td><strong>₹<?= number_format($grandTotal, 2) ?></strong></td>
                    </tr>
                </tbody>
            </table>
            <a href="shop_product.php" class="btn btn-warning">Continue Shopping</a>
            <a href="clear_cart.php" class="btn btn-danger">Clear Cart</a>
        <?php else: ?>
            <p>Your cart is empty.</p>
            <a href="home.php" class="btn btn-primary">Back to Home</a>
        <?php endif; ?>
    </div>
    </body>
</html>
