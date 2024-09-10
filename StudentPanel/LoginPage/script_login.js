document.getElementById('login-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Formun otomatik submit edilmesini engelle

    // Form alanlarını al
    const email = document.getElementById('inputEmail').value;
    const password = document.getElementById('inputPassword').value;

    // Form verilerini gönder
    fetch('php/login_process.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
        .then(response => response.json()) // Sunucudan dönen JSON yanıtını işleme
        .then(data => {
            if (data.success) {
                // Giriş başarılı
                alert("Login successful!");
                window.location.href = '../DashboardPage/dashboard.php'; // Başarılı girişten sonra yönlendirme
            } else {
                // Giriş başarısız
                alert("Login failed: " + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An error occurred. Please try again later.");
        });

});
