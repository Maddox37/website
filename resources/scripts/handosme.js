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

    // Cambia el enlace de sesión en la barra superior según el estado de sesión
    function updateSessionLink() {
        fetch('/includes/auth.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'check_session' })
        })
        .then(res => res.json())
        .then(data => {
            const sessionLink = document.getElementById('sessionLink');
            if (sessionLink) {
                if (data.logged_in) {
                    sessionLink.textContent = data.user;
                    sessionLink.href = "/sections/profile.php";
                    sessionLink.style.fontWeight = "bold";
                } else {
                    sessionLink.textContent = "Iniciar Sesión";
                    sessionLink.href = "/sections/login.php";
                    sessionLink.style.fontWeight = "normal";
                }
            }
        });
    }

    updateSessionLink();

    // Si haces logout, refresca el enlace
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            fetch('/includes/auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'logout' })
            })
            .then(() => {
                updateSessionLink();
                window.location.href = '/sections/login.php';
            });
        });
    }

    // --- PERFIL DE USUARIO ---
    const profileName = document.getElementById('profileName');
    const profilePic = document.getElementById('profilePic');
    const profilePicInput = document.getElementById('profilePicInput');
    const changePicBtn = document.getElementById('changePicBtn');
    const savePicBtn = document.getElementById('savePicBtn');

    // Imagen de perrito por defecto
    const defaultPic = "https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg?auto=compress&w=120&h=120&fit=crop";

    // Solo si estamos en profile.php
    if (profileName && profilePic) {
        // Cargar datos de sesión y foto
        fetch('../includes/auth.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'check_session' })
        })
        .then(res => res.json())
        .then(data => {
            if (data.logged_in) {
                profileName.textContent = data.user;
                // Cargar foto de perfil de localStorage (puedes cambiarlo a base de datos si quieres)
                const picUrl = localStorage.getItem('profilePic_' + data.user) || defaultPic;
                profilePic.src = picUrl;
                profilePicInput.value = picUrl;
            } else {
                window.location.href = '/sections/login.php';
            }
        });

        // Cambiar foto
        changePicBtn.addEventListener('click', function() {
            profilePicInput.style.display = 'block';
            savePicBtn.style.display = 'inline-block';
            changePicBtn.style.display = 'none';
        });

        // Guardar nueva foto
        savePicBtn.addEventListener('click', function() {
            const url = profilePicInput.value.trim() || defaultPic;
            profilePic.src = url;
            // Guardar en localStorage (por usuario)
            fetch('../includes/auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'check_session' })
            })
            .then(res => res.json())
            .then(data => {
                if (data.logged_in) {
                    localStorage.setItem('profilePic_' + data.user, url);
                }
            });
            profilePicInput.style.display = 'none';
            savePicBtn.style.display = 'none';
            changePicBtn.style.display = 'inline-block';
        });
    }

    // Inventario: pedidos
    document.querySelectorAll('.pedidoBtn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            fetch('../includes/pedido.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ producto_id: id })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('pedidoMsg').textContent = data.success ? '¡Pedido realizado!' : (data.message || 'Error al pedir');
            });
        });
    });

    // --- AGREGAR PRODUCTO ---
    const addProductForm = document.getElementById('addProductForm');
    if (addProductForm) {
        addProductForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = addProductForm.querySelector('input[type="submit"]');
            submitBtn.disabled = true; // Deshabilita el botón para evitar doble envío

            const data = {
                nombre: this.nombre.value.trim(),
                descripcion: this.descripcion.value.trim(),
                imagen: this.imagen.value.trim(),
                precio: this.precio.value.trim(),
                empresa: this.empresa.value.trim(),
                cantidad: this.cantidad.value.trim()
            };
            fetch('../includes/add_product.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                const msg = document.getElementById('addProductMsg');
                if (data.success) {
                    msg.textContent = "Producto agregado correctamente.";
                    msg.style.color = "lime";
                    addProductForm.reset();
                } else {
                    msg.textContent = data.message || "Error al agregar producto.";
                    msg.style.color = "red";
                }
                submitBtn.disabled = false; // Habilita el botón de nuevo
            })
            .catch(() => {
                const msg = document.getElementById('addProductMsg');
                msg.textContent = "Error de conexión con el servidor.";
                msg.style.color = "red";
                submitBtn.disabled = false; // Habilita el botón de nuevo
            });
        });
    }
});