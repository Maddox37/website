document.addEventListener('DOMContentLoaded', function() {
    // Registro
    const regForm = document.querySelector('form#registerForm');
    if (regForm) {
        regForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const user = regForm.f1.value.trim();
            const pass = regForm.f2.value.trim();
            const mail = regForm.f3.value.trim();
            if (!user || !pass || !mail) {
                alert('Por favor, completa todos los campos.');
                return;
            }
            fetch('../includes/auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'register', user, pass, mail })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Registro exitoso');
                    regForm.reset();
                    window.location.href = '/sections/login.php'; // Redirige al login
                } else {
                    alert('Error: ' + (data.message || 'Error desconocido'));
                }
            })
            .catch((err) => alert('Error en la conexión con el servidor.'));
        });
    }

    // Login
    const loginForm = document.querySelector('form#loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const user = loginForm.f1.value.trim();
            const pass = loginForm.f2.value.trim();
            if (!user || !pass) {
                alert('Por favor, completa todos los campos.');
                return;
            }
            fetch('../includes/auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'login', user, pass })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Bienvenido, ' + user + '!');
                    window.location.href = '/sections/home.php'; // Redirige a home
                } else {
                    alert('Error: ' + (data.message || 'Credenciales incorrectas'));
                }
            })
            .catch((err) => alert('Error en la conexión con el servidor.'));
        });
    }
});