window.addEventListener('DOMContentLoaded', event => {
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    const sidenav = document.body.querySelector('#layoutSidenav_nav');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    if (window.innerWidth < 992) {
        document.addEventListener('click', event => {
            if (sidenav && !sidenav.contains(event.target) && !sidebarToggle.contains(event.target)) {
                if (document.body.classList.contains('sb-sidenav-toggled')) {
                    document.body.classList.remove('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', false);
                }
            }
        });
    }
});

$(document).ready(function () {
    let socket = io(nodeUrl);

    socket.on(`sendNotificationToAdmin`, (body) => {
        $.ajax({
            url: "/admin/notification/reload",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.count > 0) {
                    $('#notification_count--count').text(response.count);
                    $('#notification_count--count').show();
                } else {
                    $('#notification_count--count').hide();
                }

                var currentPath = window.location.pathname;

                if (currentPath === '/admin/notification' || currentPath === '/admin/notification?page=1') {
                    $('#notifications_container').html(response.html);
                }
            }
        })
    });
})
