
  // === MASQUER/AFFICHER MOT DE PASSE ===
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            togglePassword.classList.toggle('slash');
        });

        // === CONNEXION ===
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;
            const alert = document.getElementById('alert');

            if (username === 'admin' && password === 'admin123') {
                document.cookie = "admin_session=loggedin; path=/; max-age=2592000; Secure; SameSite=Lax";
                
                alert.className = 'alert alert-success show';
                alert.textContent = 'Connexion réussie !';

                setTimeout(() => {
                    window.location.replace('tableau de bord.html');
                }, 1000);
            } else {
                alert.className = 'alert alert-error show';
                alert.textContent = 'Identifiants incorrects.';
            }
        });