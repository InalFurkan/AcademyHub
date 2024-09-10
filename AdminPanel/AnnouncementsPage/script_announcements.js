function logout() {
    // Kullanıcıya onay penceresi göster
    if (confirm('Are you sure you want to log out?')) {
        // Kullanıcı onayladıysa, yönlendir
        window.location.href = '../../index.php'; // Burada doğru yönlendirme URL'sini kullanın
    }
}

function getAnnouncements() {
    fetch('php/fetch_announcements.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#announcements-table tbody');
            if (tableBody) { // tbody öğesinin seçildiğinden emin olun
                tableBody.innerHTML = ''; // Var olan satırları temizle

                data.forEach((announcement) => {
                    const row = document.createElement('tr');

                    row.innerHTML = `
                        <td><input type="radio" name="select-radio" value="${announcement.announcement_id}" class="select-radio"></td>
                        <td>${announcement.announcement_id}</td>
                        <td>${announcement.title}</td>
                        <td>${announcement.content}</td>
                        <td>${announcement.created_at}</td>
                        <td>${announcement.updated_at}</td>
                    `;

                    tableBody.appendChild(row);
                });
            } else {
                console.error('Table body not found.');
            }
        })
        .catch(error => {
            console.error('Error fetching announcements:', error);
        });
}

// Sayfa yüklendiğinde fonksiyonu çağır
document.addEventListener('DOMContentLoaded', getAnnouncements);

function editBtnClicked() {
    // Seçili radyo butonunu bul
    const selectedRadio = document.querySelector('input[name="select-radio"]:checked');
    var editSection = document.getElementById("edit-section");
    var contentSection = document.getElementById("content-section");

    console.log(selectedRadio.value);

    if (selectedRadio) {
        // Radyo butonuna ait satırı bul
        const selectedRow = selectedRadio.closest('tr');

        // Satırdaki hücreleri al
        const cells = selectedRow.querySelectorAll('td');

        // Form alanlarını bul
        document.getElementById('announcement_id').value = cells[1].textContent;
        document.getElementById('announcementTitle').value = cells[2].textContent;
        document.getElementById('announcementContent').value = cells[3].textContent;
        document.getElementById('created_at').value = cells[4].textContent;
        document.getElementById('updated_at').value = cells[5].textContent;

        // Bölüm görünür yapma
        editSection.style.display = 'flex'; // string olarak 'flex'
        contentSection.style.display = 'none'; // string olarak 'none'
    } else {
        alert('Please select an announcement to edit.');
    }
}


function saveButtonClicked() {
    // Form alanlarındaki değerleri al
    const announcementID = document.getElementById('announcement_id').value;
    const title = document.getElementById('announcementTitle').value;
    const content = document.getElementById('announcementContent').value;
    const updatedAt = document.getElementById('updated_at').value;

    // Verileri bir JavaScript nesnesine yerleştir
    const formData = new FormData();
    formData.append('announcement_id', announcementID);
    formData.append('title', title);
    formData.append('content', content);
    formData.append('updated_at', updatedAt);

    // Fetch API ile PHP dosyasına POST isteği gönder
    fetch('php/update_announcement.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            alert('Announcement updated successfully!'); // Başarılı güncelleme mesajı
            // Gerekirse formu temizleme veya başka işlemler yapabilirsiniz
            location.reload();
        })
        .catch(error => {
            console.error('Error updating announcement:', error);
            alert('An error occurred while updating the announcement.');
        });
}

function cancelButtonClicked() {
    // Formu sıfırla
    const form = document.getElementById('announcement-form');
    form.reset();

    const editSection = document.getElementById('edit-section');
    editSection.style.display = 'none';

    // content-section'ı tekrar göster
    const contentSection = document.getElementById('content-section');
    contentSection.style.display = 'block';



}

function deleteButtonClicked() {
    // Seçili radyo butonunu bul
    const selectedRadio = document.querySelector('input[name="select-radio"]:checked');

    if (selectedRadio) {
        // Seçili announcement_id'yi al
        const announcementId = selectedRadio.value;

        // Kullanıcıya silme işlemi için onay sor
        if (confirm('Are you sure you want to delete this announcement?')) {
            // Silme isteğini PHP dosyasına gönder
            fetch('php/delete_announcement.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `announcement_id=${announcementId}`
            })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        alert('Announcement deleted successfully.');
                        // Sayfayı yenile
                        location.reload();
                    } else {
                        alert('Failed to delete the announcement. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error deleting announcement:', error);
                    alert('An error occurred while trying to delete the announcement.');
                });
        }
    } else {
        alert('Please select an announcement to delete.');
    }
}

function createButtonClicked() {

    const form = document.getElementById('announcement-form');
    var editSection = document.getElementById("edit-section");
    var contentSection = document.getElementById("content-section");

    form.reset();
    document.getElementById('announcement_id').value = -1;

    // Bölüm görünür yapma
    editSection.style.display = 'flex'; // string olarak 'flex'
    contentSection.style.display = 'none'; // string olarak 'none'

}