
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('login-form').addEventListener('submit', function (event) {
        event.preventDefault(); // Formun normal submit işlemini engeller

        // Form verilerini al
        const email = document.getElementById('inputEmail').value;
        const password = document.getElementById('inputPassword').value;

        // Basit kontrol (gerçek uygulama için sunucu tarafında yapılmalı)
        if (email === 'admin' && password === 'admin') {
            // Kullanıcıyı dashboard sayfasına yönlendir
            window.location.href = '../CoursesPage/courses.php'; // Burada doğru yönlendirme URL'sini kullanın
        } else {
            // Uyarı mesajını göster
            alert('Invalid email or password!');
        }
    });
});
