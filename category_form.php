<?php
include('conn.php');
include 'header.php';

$id = $_GET['id'] ?? '';
$name = $status = $assignProduct = '';

$assignProduct =  [];
if ($id) {
    $result = $conn->query("SELECT * FROM categories WHERE id='$id'");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $status = $row['status'];
        $assignProduct = json_decode($row['assignProduct'], true) ?? [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    </head>
    <body>
        <div class="container">
            <h1 class="mt-5"><?= $id ? 'Edit' : 'Add' ?> Category</h1>
            <form class="p-4" id="categoryform" action="save_category.php " method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>" >
                    <label for="name">Name</label>
                    <div id="error-name" class="text-danger small mt-1"></div>

                </div>

                <div class="form-floating mb-3">
                <select class="form-select" id="status" aria-label="Status" name="status">
                    <option value="1" <?= $status === '1' ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= $status === '0' ? 'selected' : '' ?>>Inactive</option>
                </select>

                    <label for="status">Status</label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Assign Products:</label><br>
                    <?php
                        $products = $conn->query("SELECT id, Title FROM mobile");
                        while ($p = $products->fetch_assoc()):
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="assignProduct[]" value="<?= $p['id'] ?>"
                            <?= in_array((string)$p['id'], $assignProduct) ? 'checked' : '' ?> >
                        <label class="form-check-label"><?= $p['Title']?></label>
                    </div>
                    <?php endwhile; ?>
                    <div id="error-assignProduct" class="text-danger small mt-1"></div>
                </div>
                <button type="submit" class="btn btn-primary"><?= $id?'Update':'Submit' ?></button>
                <a href="category.php" class="btn btn-secondary">Back to Categories</a>
            </form>                 
        </div>
        <script>
            document.getElementById("categoryform").addEventListener("submit", function(e) {
                document.getElementById('error-name').textContent = '';
                document.getElementById('error-assignProduct').textContent = '';

                const name = document.getElementById("name").value.trim();
                const charCount = document.querySelectorAll('input[name="assignProduct[]"]:checked').length;

                let hasError = false;   

                const namePattern = /^[A-Za-z\s]+$/;
                if (!name) {
                    document.getElementById("error-name").textContent = "Name is required.";
                    hasError = true;
                } else if (!namePattern.test(name)) {
                    document.getElementById("error-name").textContent = "Name should only contain letters and spaces.";
                    hasError = true;
                }

                if (charCount === 0) {
                    document.getElementById("error-assignProduct").textContent = "Select at least one assigned product.";
                    hasError = true;
                }

                if (hasError) {
                    e.preventDefault();
                }
            });
        </script>
    </body>
</html>