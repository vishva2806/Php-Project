<?php include 'conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Categories</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <style>
            .card-img-top {
                height: 200px;
                object-fit: contain;
                padding: 10px;
                background-color: #f9f9f9;
            }
            .card-img-top:hover {
                cursor: pointer;
                opacity: 0.9;
                transition: 0.2s;
            }
            .product-card {
                transition: 0.3s;
            }
            .product-card:hover {
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                transform: scale(1.02);
            }
            
        </style>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container py-5">
            <h2 class="mb-4 text-center">All Categories</h2>
            <div class="row g-4">
                <?php
                    $query = "SELECT * FROM categories";
                    $data = mysqli_query($conn, $query);

                    $hasCategories = false;
                    if (mysqli_num_rows($data) > 0) {
                        while ($row = mysqli_fetch_assoc($data)) {
                            $assignProduct = json_decode(str_replace("'", '"', $row['assignProduct']), true);
                            if (!empty($assignProduct) && is_array($assignProduct)) {
                                $hasCategories = true;
                    ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="product.php?id=<?= $row['id'] ?>" style="text-decoration: none; color: inherit;">
                                <div class="card product-card h-100">
                                    <div class="card-body d-flex flex-column">
                                        <img src="https://cdn.pixabay.com/photo/2024/01/26/19/27/delivery-8534531_640.png">
                                        <h3 class="card-title text-center"><?= $row['name']?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    }
                }

                    if (!$hasCategories) {
                        echo "<p class='text-center'>No categories with products found.</p>";
                    }
                    ?>

            </div>
        </div>
    </body>
</html>
