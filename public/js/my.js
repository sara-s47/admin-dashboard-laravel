document.addEventListener("DOMContentLoaded", function () {

    // Toggle sidebar collapse
    const sidebarToggleBtn = document.querySelector('.sidebar-toggle');
    const body = document.body;
    let isCollapsed = false;

    sidebarToggleBtn.addEventListener('click', function () {
        isCollapsed = !isCollapsed;
        if (isCollapsed) {
            body.classList.add('sidebar-collapsed');
            body.classList.remove('sidebar-expanded');
        } else {
            body.classList.remove('sidebar-collapsed');
            body.classList.add('sidebar-expanded');
        }
    });
});
