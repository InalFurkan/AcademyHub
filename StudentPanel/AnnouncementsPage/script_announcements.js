
function toggleSidePanel() {

    var topNav = document.getElementById("topNav");
    var sidePanel = document.getElementById("sidePanel");
    var announcementPanel = document.getElementById("announcement-section");



    if (window.matchMedia("(max-width: 768px)").matches && window.getComputedStyle(sidePanel).display === "none") {
        topNav.style.display = "none";
        announcementPanel.style.display = "none";
        sidePanel.style.display = "flex";
    }
    else {
        topNav.style.display = "flex";
        announcementPanel.style.display = "flex";
        sidePanel.style.display = "none";
    }
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

document.addEventListener("DOMContentLoaded", function () {
    fetchAnnouncements();
});

function fetchAnnouncements() {
    fetch('php/fetch_announcements.php')
        .then(response => response.json())
        .then(data => {
            const announcementCardsContainer = document.getElementById('announcement-cards');
            announcementCardsContainer.innerHTML = ''; // Mevcut içeriği temizle

            data.forEach(announcement => {
                const card = document.createElement('div');
                card.className = 'announcement-card';

                card.innerHTML = `
                    <div class="row">
                        <div class="col announcement-title">
                            <h3>${announcement.title}</h3>
                        </div>
                        <div class="col more-btn">more</div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>${announcement.content}</p>
                        </div>
                    </div>
                    <div class="row date-text">${announcement.created_at}</div>
                `;

                announcementCardsContainer.appendChild(card);
            });
        })
        .catch(error => console.error('Error fetching announcements:', error));
}
