<?php
include 'db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $item = trim($_POST["item_name"]);
  $price = trim($_POST["price"]);
  $image_url = $_FILES["image_url"];
  $description = trim($_POST["description"]);
  $date = trim($_POST["date"]);

  // Basic validation
  if (empty($item) || empty($price) || empty($image_url)) {
    die("Required fields are missing.");
  }

  // File upload handling
  if (isset($_FILES["image_url"]) && $_FILES["image_url"]["error"] == 0) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["image_url"]["name"]);
    $targetFilePath = $targetDir . uniqid() . "_" . $fileName;

    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];

    if (in_array($fileType, $allowedTypes)) {
      if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true); // create folder if not exist
      }

      if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $targetFilePath)) {
        $image_url = $targetFilePath; // Save the path to DB
      } else {
        die("Error uploading the file.");
      }
    } else {
      die("Only JPG, JPEG, PNG & GIF files are allowed.");
    }
  } else {
    die("Image upload failed or no file selected.");
  }


  // Prepare statement to prevent SQL injection
  $stmt = $db->prepare("INSERT INTO tbl_items (item_name, price, `date`, image_url, `description`) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sdsss", $item, $price, $date, $image_url, $description);


  if ($stmt->execute()) {
    // Redirect back to gallery page
    header("Location: index.html?success=1");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}


?>

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <form action="create.php" method="POST" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addItemModalLabel">Add New Artwork</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label for="artTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="artTitle" name="item_name" required>
          </div>

          <div class="mb-3">
            <label for="artPrice" class="form-label">Price</label>
            <input type="number" class="form-control" id="artPrice" name="price" required>
          </div>

          <div class="mb-3">
            <label for="artImage" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="artImage" name="image_url" accept="image/*" required>
          </div>


          <div class="mb-3">
            <label for="artDesc" class="form-label">Description</label>
            <textarea class="form-control" id="artDesc" name="description" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="artDate" class="form-label">Date</label>
            <input type="date" class="form-control" id="artDate" name="date">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Item</button>
        </div>
      </div>
    </form>
  </div>
</div>