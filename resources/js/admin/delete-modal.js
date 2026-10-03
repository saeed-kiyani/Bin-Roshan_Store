/**
 * Shared admin delete confirmation modal and flash-message auto-hide.
 *
 * Used by admin list pages that contain #deleteModal and delete forms.
 */
document.addEventListener('DOMContentLoaded', () => {
    const deleteModal = document.getElementById('deleteModal');
    const cancelDelete = document.getElementById('cancelDelete');
    const confirmDelete = document.getElementById('confirmDelete');

    if (deleteModal && cancelDelete && confirmDelete) {
        let deleteForm = null;

        // Support the existing delete form classes used across admin list pages.
        const deleteForms = document.querySelectorAll(
            '.delete-category-form, .delete-product-form'
        );

        deleteForms.forEach((form) => {
            form.addEventListener('submit', (event) => {
                event.preventDefault();

                deleteForm = form;

                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });
        });

        cancelDelete.addEventListener('click', () => {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
            deleteForm = null;
        });

        confirmDelete.addEventListener('click', () => {
            if (deleteForm) {
                deleteForm.submit();
            }
        });

        deleteModal.addEventListener('click', (event) => {
            if (event.target === deleteModal) {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
                deleteForm = null;
            }
        });
    }

    // Preserve the existing 2-second auto-hide behavior.
    setTimeout(() => {
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        if (successMessage) {
            successMessage.style.display = 'none';
        }

        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 2000);
});