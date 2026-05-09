export function initLogin() {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            if (btn && !btn.classList.contains('btn-loading')) {
                btn.classList.add('btn-loading');
                btn.textContent = '';
            }
        });
    }

    const inputs = document.querySelectorAll('.input-animate');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value && this.checkValidity()) {
                this.style.borderColor = '#10b981';
            } else if (this.value && !this.checkValidity()) {
                this.style.borderColor = '#ef4444';
            } else {
                this.style.borderColor = '';
            }
        });

        input.addEventListener('input', function() {
            if (this.value) {
                this.style.borderColor = '';
            }
        });

        input.addEventListener('focus', function() {
            this.style.borderColor = '#2563eb';
        });
    });
}