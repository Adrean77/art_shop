<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $cid = $_POST["cid"];

    $stmt = $db->prepare("UPDATE tbl_items SET cart_id = ? WHERE id=?");
    $stmt->bind_param("ii", $cid, $id);

    if ($stmt->execute()) {
        header("Location: index.html");
        exit();
    }
}
