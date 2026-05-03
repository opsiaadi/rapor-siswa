function openDetailModal(avatar, nama, nis, jenisKelamin, tahunAjaran, kelas, waliKelas) {
    document.getElementById('modalAvatar').textContent = avatar;
    document.getElementById('modalName').textContent = nama;
    document.getElementById('modalNIS').textContent = nis;
    document.getElementById('modalName2').textContent = nama;
    document.getElementById('modalGender').textContent = jenisKelamin;
    document.getElementById('modalTahunAjaran').textContent = tahunAjaran;
    document.getElementById('modalKelas').textContent = kelas || '-';
    document.getElementById('modalWaliKelas').textContent = waliKelas || '-';
    
    document.getElementById('detailModal').classList.remove('hidden');
    document.getElementById('detailModal').classList.add('flex');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
    document.getElementById('detailModal').classList.remove('flex');
}
