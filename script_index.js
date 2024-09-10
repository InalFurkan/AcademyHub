function navigateToPage(userType) {
    if (userType === 'student') {
        window.location.href = 'StudentPanel/LoginPage/login.php';
    } else if (userType === 'admin') {
        window.location.href = 'AdminPanel/LoginPage/login.php';
    }
}