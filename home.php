<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <title>Mobile Information</title>
    </head>
    <body>
        <?php include 'conn.php';
        include 'header.php';
        ?>
        <div class="container mt-5">
            <?php include 'upload_sku.php';?>
            <h2 class="text-center">product Information</h2>
            <div class="input-group mb-3">
                <input type="text" id="searchBox" class="form-control" placeholder="Search by title or categories...">
                <button class="btn btn-primary" type="button" onclick="searchData()">Search</button>
            </div>
            <select id="sortOption" class="form-control mb-3">
                <option value="default"> select option</option>
                <option value="price_desc">Price - Descending</option>
                <option value="price_asc">Price - Ascending</option>
                <option value="categories_asc">Categories - Ascending</option>
                <option value="categories_desc">Categories - Descending</option>
            </select>
            <table class="table table-bordered text-center" id="myTable">
                <thead  class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Categories</th>
                        <th>Model Name</th>
                        <th> SKU</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT mobile.*, categories.name AS CategoriesName FROM mobile
                    LEFT JOIN categories ON mobile.Categories = categories.id
                    ORDER BY mobile.id DESC";
        
                        $data = mysqli_query($conn, $query);
                        $result = mysqli_num_rows($data);

                        if ($result) {
                            while ($row = mysqli_fetch_array($data)) {
                                $imagePathsJson = $row['image'];
                                $imagePaths = json_decode($imagePathsJson, true);
                    ?>
                                <tr >
                                    <td><?php echo $row['id']; ?></td>
                                    <td>
                                        <?php
                                            if (!empty($imagePaths) && is_array($imagePaths)) {
                                                foreach ($imagePaths as $imagePath) {
                                                    if (file_exists($imagePath)) {
                                                        echo '<img src="' . $imagePath . '" alt="' . $row['Title'] . '" style="max-width: 80px; max-height: 80px; margin-right: 5px;">';
                                                    } else {
                                                        echo '<span class="text-muted">Image not found</span><br>';
                                                    }
                                                }
                                            } else {
                                                echo '<span class="text-muted">No images uploaded</span>';
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $row['Title']; ?></td>
                                    <td><?php echo $row['CategoriesName']; ?></td>
                                    <td><?php echo $row['ModelName']; ?></td>
                                    <td> <?php echo $row['sku']; ?></td>
                                    <td><?php echo $row['Price']; ?></td>
                                    <td><?php echo $row['Stock']; ?></td>
                                    <td>
                                        <a href="form.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm" >Edit</a>
                                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                    </td>
                                </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='8'>No records found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <script>

            let table = new DataTable('#myTable', {
                pageLength: 10,
                lengthChange: false, 
                ordering: false,
                searching : false,

            });

            function redirectToForm() {
                location.replace("form.php");
            }

            // function fetchData(searchQuery = '', sortOption = '') {
            //     $.ajax({
            //         url: "fetch_mobile_data.php",
            //         method: "POST",
            //         data: {search: searchQuery, sort: sortOption},
            //         success: function(data) {
            //             $("tbody").html(data);
            //         }
            //     });
            // }

            // function searchData() {
            //     fetchData($("#searchBox").val(), $("#sortOption").val());
            // }

            $(document).ready(function() {
                
                $("#sortOption").on("change", function() {
                    fetchData($("#searchBox").val(), $(this).val());
                });
                // fetchData();
            });
        </script>
    </body>
</html>