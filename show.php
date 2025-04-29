<?php
    include 'conn.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $query = "SELECT mobile.*, categories.name AS CategoriesName FROM mobile 
                LEFT JOIN categories ON mobile.Categories = categories.id 
                WHERE mobile.id = $id";
        
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        if ($row) {
            $imagePaths = json_decode($row['image'], true);
            ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <title>Mobile Details</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                </head>
                <body>
                    <div class="container mt-5">
                        <div class="card shadow-lg p-4">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <?php
                                    if (!empty($imagePaths)) {
                                        foreach ($imagePaths as $img) {
                                            echo '<img src="' . $img . '" class="img-fluid mb-3" style="max-height: 300px;">';
                                        }
                                    } else {
                                        echo "<p>No images uploaded.</p>";
                                    }
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <h3><?= $row['Title'] ?></h3>
                                    <p><strong>Categories:</strong> <?= $row['CategoriesName'] ?></p>
                                    <p><strong>Model:</strong> <?= $row['ModelName'] ?></p>
                                    <p><strong>Price:</strong> <span class="text-success h5">₹<?= $row['Price'] ?></span></p>
                                    <p><strong>Stock:</strong> <?= $row['Stock'] ?></p>
                                    <p><strong>DetailedDesc:</strong> <?= $row['DetailedDesc'] ?></p>
                                    <div class="mt-4">
                                        <a href="shop_product.php" class="btn btn-secondary">Back</a>
                                        <a href="cart.php?id=<?= $row['id'] ?>" class="btn btn-primary">Add To Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
            </html>
            <?php
        } else {
            echo "Mobile not found.";
        }
    } else {
        echo "Invalid ID.";
    }
?>
