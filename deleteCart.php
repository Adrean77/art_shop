<?php
include 'db.php';

if (isset($_GET['id'])) {



    $id = $_GET['id'];
    $cid = null;
    $stmt = $db->prepare("UPDATE tbl_items SET cart_id = ? WHERE id=?");
    $stmt->bind_param("ii", $cid, $id);

    if ($stmt->execute()) {

        header("Location: cart.php");
        exit();
    }
} elseif (isset($_GET['sid'])) {
    $id = $_GET['sid'];
    $cid = null;
    $stmt = $db->prepare("UPDATE tbl_items SET cart_id = ? WHERE id=?");
    $stmt->bind_param("ii", $cid, $id);

    if ($stmt->execute()) {

        header("Location: index.html");
        exit();
    }
}
