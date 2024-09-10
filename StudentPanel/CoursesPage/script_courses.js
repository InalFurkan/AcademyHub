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
    } else {
        topNav.style.display = "flex";
        contentPanel.style.display = "flex";
        sidePanel.style.display = "none";
        saveButtons.style.display = "flex";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    fetch('php/fetch_courses.php')  // The PHP script from step 1
        .then(response => response.json())
        .then(data => {
            const blocksContainer = document.querySelector('.blocks');
            const gpaDisplay = document.querySelector('#gpa'); // Element for displaying GPA

            // Display GPA if the element exists
            if (gpaDisplay) {
                gpaDisplay.textContent = `GPA: ${data.gpa || 'N/A'}`;
            }

            data.courses.forEach(course => {
                // Kontrolleri yap ve uygun değeri ata
                if (course.midterm_score === null || course.midterm_score === undefined || course.midterm_score === "") {
                    course.midterm_score = "-";
                }

                if (course.final_score === null || course.final_score === undefined || course.final_score === "") {
                    course.final_score = "-";
                }

                if (course.midterm_score === "-" && course.final_score === "-") {
                    course.letter_grade = "-";
                }

                // Block elemanını oluştur
                const block = document.createElement('div');
                block.className = 'block';

                // Arka plan rengini ve metin rengini belirle
                let backgroundColor;
                let textColor;
                switch (course.letter_grade) {
                    case 'AA':
                    case 'BA':
                    case 'BB':
                    case 'CB':
                    case 'CC':
                    case 'DC':
                    case 'DD':
                        backgroundColor = '#FF6751'; // Geçer notlar için açık turuncu
                        textColor = '#000'; // Metin rengi siyah
                        break;
                    case 'FF':
                        backgroundColor = '#36373E'; // Kalır notlar için koyu gri
                        textColor = 'rgba(255, 255, 255, 0.5)'; // Metin rengi beyaz
                        break;
                    default:
                        backgroundColor = '#DCDCDD'; // Tanımlı olmayan veya mevcut değil için açık gri
                        textColor = '#000'; // Metin rengi siyah
                        break;
                }

                // HTML içeriğini ayarla ve arka plan rengini uygula
                block.innerHTML = `
                    
                        <div class="row">
                            <h2>${course.course_name}</h2>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="col-4">Midterm</div>
                                <div class="col-4">Final</div>
                                <div class="col-4"> </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <h1>${course.midterm_score}</h1>
                                </div>
                                <div class="col-4">
                                    <h1>${course.final_score}</h1>
                                </div>
                                <div class="col-4">
                                    <h1>${course.letter_grade}</h1>
                                </div>
                            </div>
                        </div>
                `;

                block.style.backgroundColor = backgroundColor;
                block.style.color = textColor; // Metin rengini ayarla

                blocksContainer.appendChild(block);
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