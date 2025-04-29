<?php
include 'conn.php';

$search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';
$sortOption = isset($_POST['sort']) ? $_POST['sort'] : '';

$query = "SELECT mobile.*, categories.name AS CategoriesName FROM mobile LEFT JOIN categories ON mobile.Categories = categories.id WHERE mobile.Title LIKE '%$search%' OR categories.name LIKE '%$search%'";

switch ($sortOption) {

    case 'price_desc':
        $query .= " ORDER BY mobile.Price DESC";
        break;
    case 'price_asc':
        $query .= " ORDER BY mobile.Price ASC";
        break;
    case 'categories_asc':
        $query .= " ORDER BY categories.name ASC";
        break;
    case 'categories_desc':
        $query .= " ORDER BY categories.name DESC";
        break;
    default:
        $query .= " ORDER BY mobile.id DESC";
        break;
    
}

$data = mysqli_query($conn, $query);
$output = "";

if (mysqli_num_rows($data) > 0) {
    while ($row = mysqli_fetch_array($data)) {
        $output .= "<tr>
            <td>{$row['id']}</td>
            <td>";

        $imagePaths = json_decode($row['image'], true);
        if (!empty($imagePaths) && is_array($imagePaths)) {
            foreach ($imagePaths as $imagePath) {
                if (file_exists($imagePath)) {
                    $output .= "<img src='{$imagePath}' alt='{$row['Title']}' style='max-width: 80px; max-height: 80px; margin-right: 5px;'>";
                } else {
                    $output .= "<span class='text-muted'>Image not found</span><br>";
                }
            }
        } else {
            $output .= "<span class='text-muted'>No images uploaded</span>";
        }

        $output .= "</td>
            <td>{$row['Title']}</td>
            <td>{$row['CategoriesName']}</td>
            <td>{$row['ModelName']}</td>
            <td>{$row['Price']}</td>
            <td>{$row['Stock']}</td>
            <td>
                <a href='form.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
            </td>
        </tr>";
    }
} else {
    $output = "<tr><td colspan='8'>No records found</td></tr>";
}

echo $output;
?>