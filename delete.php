<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $db->prepare("DELETE FROM tbl_items WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php?deleted=1");
        exit();
    } else {
        echo "Error deleting item.";
    }

    $stmt->close();
} else {
    echo "No ID provided.";
}
?>

<?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Item deleted successfully.</div>
<?php endif; ?>