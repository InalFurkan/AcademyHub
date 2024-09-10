function navigateCourses() {
    // Change the URL to the desired HTML page
    window.location.href = '../CoursesPage/courses.php';
}

function navigateSchedule() {
    // Change the URL to the desired HTML page
    window.location.href = '../SchedulePage/schedule.php';
}

function navigateAnnouncements() {
    // Change the URL to the desired HTML page
    window.location.href = '../AnnouncementsPage/announcements.php';
}

function navigateProfile() {
    // Change the URL to the desired HTML page
    window.location.href = '../ProfilePage/profile.php';
}


function logout() {
    if (confirm("Are you sure you want to log out?")) {
        // Oturumu sonlandırmak için PHP dosyasına bir AJAX isteği gönder
        fetch('../LoginPage/php/logout_process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Başarıyla çıkış yapıldığında ana sayfaya yönlendir
                    window.location.href = '../../index.php';
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => console.error('Error:', error));
    }
}
