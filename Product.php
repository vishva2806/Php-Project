<?php
include 'conn.php';
include 'header.php';

$id = $_GET['id'] ?? '';
if (!$id) {
    echo "Invalid category!";
    exit;
}

$category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM categories WHERE id='$id'"));
if (!$category) {
    echo "Category not found!";
    exit;
}

$assignProductIds = json_decode(str_replace("'", '"', $category['assignProduct']), true);
$productList = [];

if (!empty($assignProductIds)) {
    $ids = implode(',', array_map('intval', $assignProductIds));

    $query = "SELECT mobile.*, categories.name AS CategoriesName 
              FROM mobile 
              LEFT JOIN categories ON mobile.Categories = categories.id
              WHERE mobile.id IN ($ids)";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $productList[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$category['name'] ?> Products</title>
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
<div class="container py-5">
    <h2 class="mb-4 text-center"><?= $category['name'] ?> Products</h2>
    <div class="row g-4">
        <?php if ($productList): foreach ($productList as $product): 
            $images = json_decode($product['image'], true);
            $firstImage = (!empty($images) && file_exists($images[0])) ? $images[0] : 'placeholder.jpg';
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card product-card h-100">
                <a href="show.php?id=<?= $product['id'] ?>">
                    <img src="<?= $firstImage ?>" class="card-img-top" alt="Product Image">
                </a>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= $product['Title'] ?></h5>
                    <p class="card-text mb-2">
                        <strong>Categories:</strong> <?= $product['CategoriesName'] ?><br>
                        <strong>Price:</strong> ₹<?= number_format($product['Price']) ?><br>
                        <strong>Stock:</strong> <?= $product['Stock'] ?>
                    </p>
                </div>
            </div>
        </div>
        <?php endforeach; else: ?>
            <p class="text-center">No products assigned to this category.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
