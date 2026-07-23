document.addEventListener('DOMContentLoaded', function () {
    var loginForm = document.getElementById('loginForm');
    if (!loginForm) return;

    var nik = document.getElementById('nik');
    var password = document.getElementById('password');
    var role = document.getElementById('roleSelect');

    loginForm.addEventListener('submit', function (e) {
        var nikVal = nik.value.trim();
        var passVal = password.value.trim();
        var roleVal = role.value.trim();

        var allEmpty = !nikVal && !passVal && !roleVal;
        if (allEmpty) {
            e.preventDefault();
            alert('Warning semua field wajib diisi');
            nik.focus();
            return false;
        }

        if (!nikVal) {
            e.preventDefault();
            alert('Warning username wajib diisi');
            nik.focus();
            return false;
        }
        if (!passVal) {
            e.preventDefault();
            alert('Warning wajib isi password');
            password.focus();
            return false;
        }
        if (!roleVal) {
            e.preventDefault();
            alert('Warning wajib pilih role');
            role.focus();
            return false;
        }
    });
});
