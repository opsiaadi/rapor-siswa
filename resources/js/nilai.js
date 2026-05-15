function editNilai() {
    const inputs = document.querySelectorAll('.nilai-input');
    inputs.forEach(input => input.removeAttribute('readonly'));
    alert('Mode edit aktif. Silakan ubah nilai kemudian klik Simpan.');
}

function kirimNilai() {
    document.getElementById('actionInput').value = 'kirim';
    document.getElementById('nilaiForm').submit();
}

window.editNilai = editNilai;
window.kirimNilai = kirimNilai;
