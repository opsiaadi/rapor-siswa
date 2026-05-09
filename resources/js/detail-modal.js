export function openDetailModal(avatar, nama, nis, jenisKelamin, tahunAjaran, kelas, waliKelas) {
    document.getElementById('modalAvatar').textContent = avatar;
    document.getElementById('modalName').textContent = nama;
    document.getElementById('modalNIS').textContent = nis;
    document.getElementById('modalName2').textContent = nama;
    document.getElementById('modalGender').textContent = jenisKelamin;
    document.getElementById('modalTahunAjaran').textContent = tahunAjaran;
    document.getElementById('modalKelas').textContent = kelas || '-';
    document.getElementById('modalWaliKelas').textContent =waliKelas || '-';

    document.getElementById('detailModal').classList.remove('hidden');
    document.getElementById('detailModal').classList.add('flex');
}

export function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

export function initDetailModal() {
    const modal = document.getElementById('detailModal');
    if (!modal) return;

    modal.addEventListener('click', function(e) {
        if (e.target === this) closeDetailModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeDetailModal();
    });
}

document.addEventListener('DOMContentLoaded', initDetailModal);

window.openDetailModal = openDetailModal;
window.closeDetailModal = closeDetailModal;
window.initDetailModal = initDetailModal;