
<?php
include 'conn.php';

if ($_POST) {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $status = isset($_POST['status']) ? (int)$_POST['status'] : 0;
    $assignProduct = isset($_POST['assignProduct']) ? json_encode($_POST['assignProduct']) : json_encode([]);


    if ($id > 0) {
        $query = "UPDATE categories SET name='$name', status='$status', assignProduct='$assignProduct' WHERE id=$id";
    } else {
        $query = "INSERT INTO categories (name, status, assignProduct) VALUES ('$name', '$status', '$assignProduct')";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Category saved successfully!'); window.location.href='category.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
