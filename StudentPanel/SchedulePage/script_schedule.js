
function toggleSidePanel() {

    var topNav = document.getElementById("topNav");
    var sidePanel = document.getElementById("sidePanel");
    var schedulePanel = document.getElementById("scheduleSection");



    if (window.matchMedia("(max-width: 768px)").matches && window.getComputedStyle(sidePanel).display === "none") {
        topNav.style.display = "none";
        schedulePanel.style.display = "none";
        sidePanel.style.display = "flex";
    }
    else {
        topNav.style.display = "flex";
        schedulePanel.style.display = "flex";
        sidePanel.style.display = "none";
    }
}
document.addEventListener("DOMContentLoaded", function () {
    fetch('php/fetch_schedule.php')  // PHP API
        .then(response => response.json())
        .then(data => {
            const scheduleSection = document.getElementById('scheduleSection');

            // Gün isimleri
            const dayNames = {
                1: "Monday",
                2: "Tuesday",
                3: "Wednesday",
                4: "Thursday",
                5: "Friday",
                6: "Saturday",
                7: "Sunday"
            };

            // Verileri günlere ayırma
            const daySchedules = {};

            data.forEach(schedule => {
                const dayId = schedule.day_id;

                if (!daySchedules[dayId]) {
                    daySchedules[dayId] = [];
                }

                daySchedules[dayId].push(schedule);
            });

            // Gün kartlarını oluşturma ve doldurma
            Object.keys(daySchedules).forEach(dayId => {
                // Gün kartını oluştur
                const dayCard = document.createElement('div');
                dayCard.className = 'day-card';
                dayCard.textContent = dayNames[dayId];

                // Gün kartını sayfaya ekle
                scheduleSection.appendChild(dayCard);

                // Ders kartları için kapsayıcı eleman oluştur
                const dailyLectures = document.createElement('div');
                dailyLectures.className = 'daily-lectures';

                // Ders kartlarını oluşturma
                daySchedules[dayId].forEach(schedule => {
                    const card = document.createElement('div');
                    card.className = 'card';

                    card.innerHTML = `
                        <div class="row">
                            <h2>${schedule.course_name}</h2>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="col">
                                    <h4>starts</h4>
                                </div>
                                <div class="col">
                                    <h4>finishes</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">${schedule.start_time}</div>
                                <div class="col">${schedule.end_time}</div>
                            </div>
                        </div>
                    `;

                    dailyLectures.appendChild(card);
                });

                // Gün kartından sonra ders kartlarını ekle
                scheduleSection.appendChild(dailyLectures);
            });
        });
});

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