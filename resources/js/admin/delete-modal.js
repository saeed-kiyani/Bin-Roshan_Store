/**
 * Admin delete confirmation modal
 * + success/error flash message auto-hide
 */

document.addEventListener('DOMContentLoaded', () => {

    const deleteModal = document.getElementById('deleteModal');
    const cancelDelete = document.getElementById('cancelDelete');
    const confirmDelete = document.getElementById('confirmDelete');

    let deleteForm = null;

    // -----------------------------------------
    // DELETE CONFIRMATION MODAL
    // -----------------------------------------

    if (deleteModal && cancelDelete && confirmDelete) {

        const deleteForms = document.querySelectorAll(
            '.delete-category-form, .delete-product-form'
        );

        deleteForms.forEach((form) => {

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                deleteForm = this;

                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });

        });

        // Cancel
        cancelDelete.addEventListener('click', () => {

            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');

            deleteForm = null;
        });

        // Confirm Delete
        confirmDelete.addEventListener('click', () => {

            if (!deleteForm) {
                return;
            }

            deleteForm.submit();
        });

        // Click outside modal
        deleteModal.addEventListener('click', (event) => {

            if (event.target === deleteModal) {

                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');

                deleteForm = null;
            }

        });
    }


    // -----------------------------------------
    // FLASH MESSAGE AUTO HIDE
    // -----------------------------------------

    const successMessage = document.getElementById('success-message');
    const errorMessage = document.getElementById('error-message');

    if (successMessage) {
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 2000);
    }

    if (errorMessage) {
        setTimeout(() => {
            errorMessage.style.display = 'none';
        }, 1000);
    }

});