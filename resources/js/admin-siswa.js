// Admin Siswa Modal Functions
console.log('admin-siswa.js loaded');

window.openDetailModal = function(button) {
    console.log('openDetailModal called', button);
    var data = {
        id: button.getAttribute('data-id'),
        nama: button.getAttribute('data-nama'),
        nis: button.getAttribute('data-nis'),
        jenis_kelamin: button.getAttribute('data-gender'),
        tahun_ajaran: button.getAttribute('data-tahun'),
        kelas_nama: button.getAttribute('data-kelas'),
        wali_nama: button.getAttribute('data-wali')
    };
    console.log('data', data);
    
    var modal = document.getElementById('detailModal');
    console.log('modal', modal);
    if (!modal) {
        console.error('Modal not found');
        return;
    }
    
    document.getElementById('modalAvatar').textContent = data.nama ? data.nama.charAt(0).toUpperCase() : 'U';
    document.getElementById('modalName').textContent = data.nama || '-';
    document.getElementById('modalClass').textContent = data.kelas_nama || '-';
    document.getElementById('modalNIS').textContent = data.nis || '-';
    document.getElementById('modalName2').textContent = data.nama || '-';
    document.getElementById('modalGender').textContent = data.jenis_kelamin === 'L' ? 'Laki-Laki' : 'Perempuan';
    document.getElementById('modalTahunAjaran').textContent = data.tahun_ajaran || '-';
    document.getElementById('modalKelas').textContent = data.kelas_nama || '-';
    document.getElementById('modalWaliKelas').textContent = data.wali_nama || '-';
    
    modal.classList.remove('hidden');
};

window.closeDetailModal = function() {
    var modal = document.getElementById('detailModal');
    if (modal) {
        modal.classList.add('hidden');
    }
};

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('detailModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                window.closeDetailModal();
            }
        });
    }
});
