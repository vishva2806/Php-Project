<?php include 'conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Shop Products</title>
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
            <h2 class="mb-4 text-center"> Product Listings</h2>
            <div class="row g-4">
                <?php
                $query = "SELECT mobile.*, categories.name AS CategoriesName FROM mobile
                        LEFT JOIN categories ON mobile.Categories = categories.id
                        ORDER BY mobile.id DESC";
                $data = mysqli_query($conn, $query);

                if (mysqli_num_rows($data) > 0) {
                    while ($row = mysqli_fetch_assoc($data)) {
                        $imagePaths = json_decode($row['image'], true);
                        $firstImage = (!empty($imagePaths) && file_exists($imagePaths[0])) ? $imagePaths[0] : 'placeholder.jpg';
                ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card product-card h-100">
                            <a href="show.php?id=<?php echo $row['id']; ?>">
                                <img src="<?php echo $firstImage; ?>" class="card-img-top" alt="Product Image">
                            </a>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo $row['Title']; ?></h5>
                                <p class="card-text mb-2">
                                    <strong>Categories:</strong> <?php echo $row['CategoriesName']; ?><br>
                                    <strong>Price:</strong> ₹<?php echo $row['Price']; ?><br>
                                    <strong>Stock:</strong> <?php echo $row['Stock']; ?>
                                </p>
                            
                            </div>
                        </div>
                    </div>
                <?php
                    }
                } else {
                    echo "<p class='text-center'>No products found.</p>";
                }
                ?>
            </div>
        </div>
    </body>
</html>
