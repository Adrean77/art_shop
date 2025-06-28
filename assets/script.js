
// edit modal id
  const editModal = document.getElementById('editItemModal');

  editModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const itemId = button.getAttribute('data-id');

    // ✅ Log the ID to the browser console
    // console.log("Selected Item ID:", itemId);

    document.getElementById('edit-id').value = itemId;
  });