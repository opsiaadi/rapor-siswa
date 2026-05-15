document.addEventListener('DOMContentLoaded', function () {
    const fotoInput = document.getElementById('foto');
    if (!fotoInput) return;

    fotoInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (ev) {
                document.getElementById('preview-foto').src = ev.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
