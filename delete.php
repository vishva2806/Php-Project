<?php
include 'conn.php';
$id = $_GET['id'];
$query = "DELETE FROM mobile WHERE id = '$id'";
$data = mysqli_query($conn, $query);

if ($data) {
    ?>
    <script type="text/javascript">
        alert("Data deleted successfully");
        window.location.href = "http://localhost/php_form/home.php"; 
    </script>
    <?php
} else {
    ?>
    <script type="text/javascript">
        alert("Error deleting record: <?php echo mysqli_error($conn); ?>");
    </script>
    <?php
}
?>