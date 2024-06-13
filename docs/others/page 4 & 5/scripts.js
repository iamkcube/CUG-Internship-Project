function showLoginForm(userType) {
    const loginForm = document.getElementById('login-form');
    loginForm.style.display = 'block';
}

function login() {
    const loginId = document.getElementById('login-id').value;
    const loginPassword = document.getElementById('login-password').value;

    if (loginId === 'admin' && loginPassword === '1234') {
        window.location.href = 'admin.html';
    } else {
        alert('Invalid login credentials');
    }
}
