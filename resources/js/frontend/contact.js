window.showContactMessage = function (event) {

    event.preventDefault();

    const name =
        document.getElementById('name').value.trim();

    const email =
        document.getElementById('email').value.trim();

    const message =
        document.getElementById('message').value.trim();

    if (!name || !email || !message) {
        return false;
    }

    document
        .getElementById('contact-success')
        .classList.remove('hidden');

    /*
    |--------------------------------------------------------------------------
    | FRONTEND ONLY
    |--------------------------------------------------------------------------
    |
    | Later this form will submit to a Laravel controller.
    |
    */

    return false;
};
