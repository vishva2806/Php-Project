<?php
    include('conn.php');

    if (isset($_POST['submit']) && isset($_FILES['csvFile'])) {
        $fileTmp = $_FILES['csvFile']['tmp_name'];
        $fileExt = strtolower(pathinfo($_FILES['csvFile']['name'], PATHINFO_EXTENSION));

        if ($fileExt !== 'csv') {
            echo "<script>alert('Only .csv files are allowed!'); window.location.href='home.php';</script>";
            exit;
        }

        if (($handle = fopen($fileTmp, "r")) !== false) {
            fgetcsv($handle);
            $updated = 0;
            $inserted = 0;
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                if (count($row) < 7) continue;
            
                $sku = mysqli_real_escape_string($conn, trim($row[0]));
                $title = mysqli_real_escape_string($conn, trim($row[1]));
                $modelName = mysqli_real_escape_string($conn, trim($row[2]));
                $categories = mysqli_real_escape_string($conn, trim($row[3]));
                $price = mysqli_real_escape_string($conn, trim($row[4])); 
                $stock = mysqli_real_escape_string($conn, trim($row[5]));
                $imageName = mysqli_real_escape_string($conn, trim($row[6]));
            
                if (!str_starts_with($imageName, 'uploads/')) {
                    $imagePath = 'uploads/' . $imageName;
                } else {
                    $imagePath = $imageName;
                }
            
                $imageJson = json_encode([$imagePath]);
                
                $characteristics = json_encode([]);
            
                $checkQuery = "SELECT COUNT(*) as count FROM mobile WHERE sku = '$sku'";
                $result = mysqli_query($conn, $checkQuery);
                $data = mysqli_fetch_assoc($result);
            
                if ($data['count'] > 0) {
                    $query = "UPDATE mobile SET 
                                Title='$title', 
                                ModelName='$modelName', 
                                Categories='$categories', 
                                Price='$price', 
                                Stock='$stock',
                                image='$imageJson',
                                Characteristics='$characteristics'
                            WHERE sku='$sku'";
                    mysqli_query($conn, $query);
                    $updated++;
                } else {
                    $query = "INSERT INTO mobile (sku, Title, ModelName, Categories, Price, Stock, image, Characteristics) 
                            VALUES ('$sku', '$title', '$modelName', '$categories', '$price', '$stock', '$imageJson', '$characteristics')";
                    mysqli_query($conn, $query);
                    $inserted++;
                }
            }
            fclose($handle);
            echo "<script>alert('Updated: $updated | Inserted: $inserted'); window.location.href='home.php';</script>";
        } else {
            echo "Failed to open the CSV file.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <title>CSV Upload</title>
    </head>
    <body>
        <div class="input-group mb-3" style="justify-content: flex-end;">
            <form method="post" enctype="multipart/form-data" class="d-flex align-items-center justify-content-end gap-2">
                <label for="csvFile" class="form-label mb-0 fw-bold text-dark">Upload CSV file:</label>
                <input type="file" name="csvFile" class="form-control" id="csvFile" accept=".csv" required style="max-width: 250px;">
                <button type="submit" name="submit" class="btn btn-dark">Upload</button>
            </form>
        </div>
    </body>
</html>
