document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('admin-overlay');
    const menuButton = document.getElementById('admin-menu-button');

    function openSidebar() {

        sidebar.classList.remove('-translate-x-full');

        overlay.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');

    }

    function closeSidebar() {

        sidebar.classList.add('-translate-x-full');

        overlay.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    }

    if (menuButton) {

        menuButton.addEventListener('click', openSidebar);

    }

    if (overlay) {

        overlay.addEventListener('click', closeSidebar);

    }

    document.querySelectorAll('#admin-sidebar a').forEach(function (link) {

        link.addEventListener('click', function () {

            if (window.innerWidth < 1024) {

                closeSidebar();

            }

        });

    });

});
