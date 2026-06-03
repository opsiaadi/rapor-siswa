export function changeTahunAjaran(ta) {
    const url = new URL(window.location.href);
    url.searchParams.set('tahun_ajaran', ta);
    window.location.href = url.toString();
}

export function openAdminModal(siswa) {
    const modal = document.getElementById('detailModal');
    if (!modal) return;

    const initial = (siswa.nama || 'U').charAt(0).toUpperCase();

    document.getElementById('modalAvatar').textContent = initial;
    document.getElementById('modalName').textContent = siswa.nama || '-';
    document.getElementById('modalName2').textContent = siswa.nama || '-';
    document.getElementById('modalClass').textContent = 'Kelas ' + (siswa.kelas_nama || '-');
    document.getElementById('modalNIS').textContent = siswa.nis || '-';
    document.getElementById('modalGender').textContent = siswa.jenis_kelamin === 'L' ? 'Laki-laki' : (siswa.jenis_kelamin === 'P' ? 'Perempuan' : '-');
    document.getElementById('modalTahunAjaran').textContent = siswa.tahun_ajaran || '-';
    document.getElementById('modalKelas').textContent = siswa.kelas_nama || '-';
    document.getElementById('modalWaliKelas').textContent = siswa.wali_nama || '-';

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

export function closeAdminModal() {
    const modal = document.getElementById('detailModal');
    if (!modal) return;
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

export function initAdminDashboard() {
    const modal = document.getElementById('detailModal');
    if (!modal) return;

    modal.addEventListener('click', function(e) {
        if (e.target === this) closeAdminModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeAdminModal();
    });
}

document.addEventListener('DOMContentLoaded', initAdminDashboard);

window.changeTahunAjaran = changeTahunAjaran;
window.openAdminModal = openAdminModal;
window.closeAdminModal = closeAdminModal;
window.initAdminDashboard = initAdminDashboard;