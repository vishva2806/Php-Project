<?php
    include('conn.php');
    $title = "";
    $categories_id = "";
    $modelName = "";
    $sku = "";
    $shortDesc = "";
    $detailedDesc = "";
    $imagePaths = [];
    $price = "";
    $characteristics = [];
    $stock = "In Stock";
    $existingImages = []; 
    
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $edit_query = "SELECT * FROM mobile WHERE id = $id";
        $edit_result = mysqli_query($conn, $edit_query);

        if ($edit_result && mysqli_num_rows($edit_result) > 0) {
            $row = mysqli_fetch_assoc($edit_result);
            $title = $row['Title'];
            $modelName = $row['ModelName'];
            $sku = $row['sku'];
            $categories_id = $row['Categories'];
            $shortDesc = $row['ShortDesc'];
            $detailedDesc = $row['DetailedDesc'];
            $price = $row['Price'];
            $stock = $row['Stock'];
            $imagePaths = json_decode($row['image'], true);
        } else {
            echo "<script>alert('Record not found.'); window.location.href = 'home.php';</script>";
            exit();
        }
    }

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) && is_numeric($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : null;
        $title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
        $modelName = mysqli_real_escape_string($conn, $_POST['modelName'] ?? '');
        $sku = mysqli_real_escape_string($conn, $_POST['sku'] ?? '');
        $categories = mysqli_real_escape_string($conn, $_POST['categories'] ?? '');
        $shortDesc = mysqli_real_escape_string($conn, $_POST['shortDesc'] ?? '');
        $detailedDesc = mysqli_real_escape_string($conn, $_POST['detailedDesc'] ?? '');
        $price = isset($_POST['price']) && is_numeric($_POST['price']) && $_POST['price'] >= 0? mysqli_real_escape_string($conn, $_POST['price'])
            : 0;
        $characteristics = isset($_POST['characteristics']) ? json_encode($_POST['characteristics']) : json_encode([]);
        $stock = $_POST['stock'] ?? 'In Stock';

        $newImagePaths = [];
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (!empty($_FILES['image']['name'][0])) {
            foreach ($_FILES['image']['tmp_name'] as $key => $tmpName) {
                $fileName =  basename($_FILES['image']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;
                if (move_uploaded_file($tmpName, $targetFilePath)) {    
                    $newImagePaths[] = $targetFilePath;
                }
            }
        }
        $stmt = $conn->prepare("SELECT id FROM mobile WHERE sku = ?" . ($id ? " AND id != ?" : ""));
        if ($id) {
            $stmt->bind_param("si", $sku, $id);
        } else {
            $stmt->bind_param("s", $sku);
        }
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('SKU already exists. Please use a unique SKU.'); window.history.back();</script>";
            exit;
        }
        $sku = trim(mysqli_real_escape_string($conn, $_POST['sku'] ?? ''));

    if (!preg_match('/^SKU\d+$/', $sku)) {
        echo "<script>alert('Invalid SKU format. Must start with SKU followed by digits.'); window.history.back();</script>";
        exit;
    }

        $stmt->close();

        
        if ($id) {
            $result = $conn->query("SELECT image FROM mobile WHERE id='$id'");
            $row = $result->fetch_assoc();
            $existingImages = isset($row['image']) ? json_decode($row['image'], true) : [];
        }

        $finalImagePaths = !empty($newImagePaths) ? $newImagePaths : $existingImages;
        $imageJson = json_encode($finalImagePaths);

        if ($id) {
            $query = "UPDATE mobile SET Title='$title',ModelName='$modelName', sku='$sku', Categories='$categories', ShortDesc='$shortDesc', DetailedDesc='$detailedDesc',
            image='$imageJson', Price='$price', Characteristics='$characteristics', Stock='$stock' WHERE id='$id'";
        } else {
            $query = "INSERT INTO mobile (Title, ModelName,sku, Categories, ShortDesc, DetailedDesc, image, Price, Characteristics, Stock) VALUES 
            ('$title', '$modelName', '$sku',  '$categories ', '$shortDesc', '$detailedDesc', '$imageJson', '$price', '$characteristics', '$stock')";
        }

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data saved successfully!'); window.location.href='home.php';</script>";

            exit();
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
?>