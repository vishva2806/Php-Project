<?php
    include('conn.php');
    include 'header.php';

    $id = $_GET['id'] ?? '';
    $title = $categories_id = $modelName = $sku = $shortDesc = $detailedDesc = $price = $stock = '' ;
    $imagePaths = [];
    $selectedCharacteristics = [];

    if ($id) {
        $result = $conn->query("SELECT * FROM mobile WHERE id='$id'");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $title = $row['Title'];
            $categories_id = $row['Categories'];
            $modelName = $row['ModelName'];
            $sku = $row['sku'];
            $shortDesc = $row['ShortDesc'];
            $detailedDesc = $row['DetailedDesc'];
            $price = $row['Price'];
            $stock = $row['Stock'];
            $imagePaths = json_decode($row['image'], true);
            $selectedCharacteristics = json_decode($row['Characteristics'], true);
            if (!is_array($selectedCharacteristics)) {
                $selectedCharacteristics = [];
            }
            

        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $id ? 'Edit' : 'Add' ?> Mobile</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <h3><?= $id ? 'Edit' : 'Add' ?> product</h3>
            <form id="mobileform" enctype="multipart/form-data" method="POST" action="data.php">
                <input type="hidden" name="id" value="<?= $id ?>">

                <div class="mb-3">
                <label for="title" class="form-label">Name</label>
                <input type="text" id="title" name="title" class="form-control" value="<?= $title ?>">
                <div id="error-title" class="text-danger small mt-1"></div>
                </div>

                <div class="mb-3">
                    <label for="modelName" class="form-label">Model Name</label>
                    <input type="text" id="modelName" name="modelName" class="form-control" maxlength="20" value="<?= $modelName ?>">
                    <div id="error-modelName" class="text-danger small mt-1"></div>
                </div>
                
                <div class="mb-3">
                    <label for="sku" class="form-label">SKU</label>
                    <input type="text" id="sku" name="sku" class="form-control" maxlength="10" value="<?= $sku ?>">
                    <div id="error-sku" class="text-danger small mt-1"></div>
                </div>
                
                <div class="mb-3">
                    <label for="categories" class="form-label">Categories</label>
                    <select id="categories" name="categories" class="form-select">
                        <option value="" disabled <?= empty($categories_id) ? 'selected' : '' ?>>Select a categories</option>
                        <?php
                            $categoriesResult = $conn->query("SELECT id,name FROM categories");
                            while ($r = $categoriesResult->fetch_assoc()) {
                                $sel = ($r['id']==$categories_id)?'selected':'';
                                echo "<option value='{$r['id']}' $sel>{$r['name']}</option>";
                            }
                        ?>
                    </select>
                    <div id="error-categories" class="text-danger small mt-1"></div>
                </div>

                <div class="mb-3">
                <label for="shortDesc" class="form-label">Short Description</label>
                <textarea id="shortDesc" name="shortDesc" class="form-control" minlength="100" maxlength="200"><?= $shortDesc ?></textarea>
                <div id="error-shortDesc" class="text-danger small mt-1"></div>
                </div>

                <div class="mb-3">
                <label for="detailedDesc" class="form-label">Detailed Description</label>
                <textarea id="detailedDesc" name="detailedDesc" class="form-control"><?= $detailedDesc ?></textarea>
                <div id="error-detailedDesc" class="text-danger small mt-1"></div>
                </div>

                <div class="mb-3">
                <label for="image" class="form-label">Images</label>
                <input type="file" id="image" name="image[]" class="form-control" accept="image/png, image/jpeg,  image/jpg">
                <?php if (!empty($imagePaths)): ?>
                    <div class="mt-2">
                    <p>Existing Images:</p>
                    <?php foreach ($imagePaths as $img): ?>
                        <img src="<?= $img ?>" width="100" style="margin-right:8px">
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?> 
                <div id="error-image" class="text-danger small mt-1"></div>
                </div>

                <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" id="price" name="price" class="form-control" value="<?=$price ?>">
                <div id="error-price" class="text-danger small mt-1"></div>
                </div>

                <div class="mb-3">
                <label class="form-label">Characteristics</label><br>
                <?php   
                $ch = $conn->query("SELECT name FROM characteristics");
                while ($c = $ch->fetch_assoc()):
                ?>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="char-<?= $c['name'] ?>" name="characteristics[]" value="<?= $c['name'] ?>"
                        <?= in_array($c['name'], $selectedCharacteristics)?'checked':'' ?>>
                    <label class="form-check-label" for="char-<?= $c['name'] ?>"><?= $c['name'] ?></label>
                    </div>
                <?php endwhile; ?>
                <div id="error-characteristics" class="text-danger small mt-1"></div>
                </div>
                <div class="mb-3">
                <label class="form-label">Stock</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="stock-in" name="stock" value="In Stock" <?= $stock==='In Stock'?'checked':'' ?>>
                    <label class="form-check-label" for="stock-in">In Stock</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="stock-out" name="stock" value="Out of Stock" <?= $stock==='Out of Stock'?'checked':'' ?>>
                    <label class="form-check-label" for="stock-out">Out of Stock</label>
                </div>
                <div id="error-stock" class="text-danger small mt-1"></div>
                </div>
                <button type="submit" class="btn btn-primary"><?= $id?'Update':'Submit' ?></button>
                <a href="home.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
        <script>
            document.getElementById("mobileform").addEventListener("submit", function(e) {
                ['title','categories','modelName' ,'sku','shortDesc','detailedDesc','image','price','characteristics','stock']
                .forEach(id => document.getElementById('error-' + id).textContent = '');
                const title        = document.getElementById("title").value.trim();
                const categories        = document.getElementById("categories").value;
                const sku = document.getElementById("sku").value.trim();
                const modelName    = document.getElementById("modelName").value.trim();
                const shortDesc    = document.getElementById("shortDesc").value.trim();
                const detailedDesc = document.getElementById("detailedDesc").value.trim();
                const imageInput   = document.getElementById("image");
                const price        = document.getElementById("price").value.trim();
                const charCount    = document.querySelectorAll('input[name="characteristics[]"]:checked').length;
                const stockChecked = !!document.querySelector('input[name="stock"]:checked');
                const existingImages = <?= json_encode($imagePaths) ?>;
                const isEdit = <?= $id ? 'true' : 'false' ?>;

                let hasError = false;

                if (!title) {
                document.getElementById("error-title").textContent = "Title is required.";
                hasError = true;
                }
                
                if ( sku == "") {
                document.getElementById("error-sku").textContent = "SKU is required.";
                hasError = true;
                }
            
                if (!categories) {
                document.getElementById("error-categories").textContent = "Categories is required.";
                hasError = true;
                }

                if (!modelName) {
                document.getElementById("error-modelName").textContent = "Model Name is required.";
                hasError = true;
                }

                if (shortDesc.length < 100 || shortDesc.length > 200) {
                document.getElementById("error-shortDesc").textContent = "Short Description must be 100–200 characters.";
                hasError = true;
                }

                if (!detailedDesc) {
                document.getElementById("error-detailedDesc").textContent = "Detailed Description is required.";
                hasError = true;
                }

                if (!price || isNaN(price) || parseFloat(price) <= 0) {
                document.getElementById("error-price").textContent = "Valid price is required.";
                hasError = true;
                }

                if (charCount === 0) {
                document.getElementById("error-characteristics").textContent = "Select at least one characteristic.";
                hasError = true;
                }

                if (!stockChecked) {
                document.getElementById("error-stock").textContent = "Please select stock availability.";
                hasError = true;
                }

                if (!isEdit && imageInput.files.length === 0) {
                document.getElementById("error-image").textContent = "Please upload at least one image.";
                hasError = true;
                }

                if (imageInput.files.length > 0) {
                for (let i = 0; i < imageInput.files.length; i++) {
                    const file = imageInput.files[i];
                    if (!file.type.startsWith("image/")) {
                    document.getElementById("error-image").textContent = "Only image files are allowed.";
                    hasError = true;
                    break;
                    }
                }
                }

                if (!sku) {
                    document.getElementById("error-sku").textContent = "SKU is required.";
                    hasError = true;
                } else if (!/^[a-zA-Z0-9_-]+$/.test(sku)) {
                    document.getElementById("error-sku").textContent = "SKU must be alphanumeric (underscores/hyphens allowed).";
                    hasError = true;
                }


                if (hasError) {
                e.preventDefault();
                }
            });
        </script>

    </body>
</html>