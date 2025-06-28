<?php
include 'db.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ArtShop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/styles.css">
  <link rel="icon" type="image/png" href="assets/icon.png">
  <style>

  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <img src="assets/icon.png" class="circle-img" alt="logo">
      <a class="navbar-brand" href="#">ArtShop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="gallery.php">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Hero -->
  <section class="py-5 text-center bg-light">
    <div class="container">
      <h1 class="display-4">Welcome to Our Online Gallery</h1>
      <p class="lead">Discover and purchase beautiful original artworks from talented artists.</p>
    </div>
  </section>

  <!-- Gallery Grid -->
  <div class="container my-5">
    <div class="row g-4">

      <?php include 'create.php'; ?>

      <!-- Art Item -->

      <?php
      // Fetch all artworks
      $query = "SELECT * FROM tbl_items ORDER BY id DESC";
      $result = $db->query($query);

      if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):

          $date = date("F j, Y", strtotime($row['date']));
      ?>

          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card shadow-sm">
              <!-- Image -->
              <img src="<?php echo htmlspecialchars($row['image_url']); ?>"
                class="card-img-top"
                data-bs-toggle="modal"
                data-bs-target="#imageModal<?php echo $row['id']; ?>"
                style="cursor: zoom-in;">

              <!-- Modal -->
              <div class="modal fade" id="imageModal<?php echo $row['id']; ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                  <div class="modal-content bg-dark">
                    <div class="modal-body p-0 text-center">
                      <img src="<?php echo htmlspecialchars($row['image_url']); ?>"
                        class="img-fluid"
                        alt="Artwork">
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <h5 class="card-title"><?php echo $row['item_name'] ?></h5>
                <p class="card-text"><?php echo '$' . $row['price'] ?></p>
                <p class="card-text"><?php echo $row['description'] ?></p>
                <p class="card-text"><?php echo $date ?></p>



              </div>
            </div>
          </div>
      <?php
        endwhile;
      else:
        echo "<tr><td colspan='6'>No records found.</td></tr>";
      endif;

      $db->close();
      ?>


    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-4">
    <div class="container">
      <p class="mb-0">© 2025 ArtShop. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const editModal = document.getElementById('editItemModal');

    editModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget;
      const itemId = button.getAttribute('data-id');

      // ✅ Log the ID to the browser console
      // console.log("Selected Item ID:", itemId);

      // Example: fill hidden input (optional)
      document.getElementById('edit-id').value = itemId;
    });
  </script>



</body>

</html>