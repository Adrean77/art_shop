

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $name = $_POST['item_name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $date = $_POST['date'];

    // Image upload (optional)
    $imagePath = null;
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === 0) {
        $imageName = uniqid() . "_" . basename($_FILES['image_url']['name']);
        $imagePath = 'uploads/' . $imageName;
        move_uploaded_file($_FILES['image_url']['tmp_name'], $imagePath);
    }

    // Update with or without image
    if ($imagePath) {
        $stmt = $db->prepare("UPDATE tbl_items SET item_name=?, price=?, description=?, date=?, image_url=? WHERE id=?");
        $stmt->bind_param("sdsssi", $name, $price, $desc, $date, $imagePath, $id);
    } else {
        $stmt = $db->prepare("UPDATE tbl_items SET item_name=?, price=?, description=?, date=? WHERE id=?");
        $stmt->bind_param("sdssi", $name, $price, $desc, $date, $id);
    }

    if ($stmt->execute()) {
        header("Location: index.php?updated=1");
        exit();
    } else {
        echo "Error updating item.";
    }

    $stmt->close();
}
?>


<!-- Add Item Modal -->

<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <form action="update.php" method="POST" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editItemModalLabel">Edit the Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
          <div class="mb-3">
            <!-- hidden id -->
            <input type="hidden" name="id" id="edit-id">
            <label for="editItem" class="form-label">Title</label>
            <input type="text" class="form-control" id="editItem" name="item_name" required>
          </div>

          <div class="mb-3">
            <label for="editPrice" class="form-label">Price</label>
            <input type="number" class="form-control" id="editPrice" name="price"  required>
          </div>

    <div class="mb-3">
        <label for="editImage" class="form-label">Upload Image</label>
        <input type="file" class="form-control" id="editImage" name="image_url" accept="image/*" value="img" required>
        </div>


          <div class="mb-3">
            <label for="editDesc" class="form-label">Description</label>
            <textarea class="form-control" id="editDesc" name="description" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="editDate" class="form-label">Date</label>
            <input type="date" class="form-control" id="editDate" name="date">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
