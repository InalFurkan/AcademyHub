
function toggleSidePanel() {

    var topNav = document.getElementById("topNav");
    var sidePanel = document.getElementById("sidePanel");
    var contentPanel = document.getElementById("content-section");
    var saveButtons = document.getElementById("button-section");


    if (window.matchMedia("(max-width: 768px)").matches && window.getComputedStyle(sidePanel).display === "none") {
        topNav.style.display = "none";
        contentPanel.style.display = "none";
        sidePanel.style.display = "flex";
        saveButtons.style.display = "none";
    }
    else {
        topNav.style.display = "flex";
        contentPanel.style.display = "flex";
        sidePanel.style.display = "none";
        saveButtons.style.display = "flex";
    }
}

// Sayfa yüklendiğinde çalıştır
document.addEventListener("DOMContentLoaded", function () {
    // PHP dosyasından verileri çek
    fetch('php/fetch_student_info.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
            } else {
                // PHP'den gelen verileri kullanarak sayfayı doldur
                document.getElementById('studentName').innerText = `${data.name} ${data.surname}`;
                document.getElementById('fieldOfStudy').innerText = data.field_name;
                document.getElementById('email').innerText = data.email;
                document.getElementById('phoneNumber').innerText = data.phone_number;
                document.getElementById('gpa').innerText = data.gpa;

                // receive_sms radyo butonlarını ayarla
                if (data.receive_sms == 1) {
                    document.getElementById('receive_sms_yes').checked = true;
                } else {
                    document.getElementById('receive_sms_no').checked = true;
                }

                // receive_email radyo butonlarını ayarla
                if (data.receive_email == 1) {
                    document.getElementById('receive_email_yes').checked = true;
                } else {
                    document.getElementById('receive_email_no').checked = true;
                }
            }
        })
        .catch(error => console.error('Error fetching student data:', error));
});


document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('saveButton').addEventListener('click', function () {
        // Radio buton değerlerini al
        let receiveSms = document.querySelector('input[name="receive_sms"]:checked').value;
        let receiveEmail = document.querySelector('input[name="receive_email"]:checked').value;

        // Şifre alanlarını al
        let currentPassword = document.getElementById('inputPassword').value;
        let newPassword = document.getElementById('inputNewPassword').value;
        let newPassword2 = document.getElementById('inputNewPassword2').value;

        // Şifre alanlarının doldurulup doldurulmadığını kontrol et
        if (currentPassword || newPassword || newPassword2) {
            // Şifre alanları doldurulmuşsa
            if (newPassword === newPassword2) {
                // AJAX ile PHP dosyasına veri gönder
                fetch('php/update_profile.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        currentPassword: currentPassword,
                        newPassword: newPassword,
                        receiveSms: receiveSms,
                        receiveEmail: receiveEmail
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Profile updated successfully');
                        } else {
                            alert('Error: ' + data.error);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                alert("New passwords do not match!");
            }
        } else {
            // Şifre alanları doldurulmamışsa sadece radio buton değerlerini gönder
            fetch('php/update_profile.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    receiveSms: receiveSms,
                    receiveEmail: receiveEmail
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Profile updated successfully');
                    } else {
                        alert('Error: ' + data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
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


