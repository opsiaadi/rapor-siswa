function openDetailModal(avatar, name, nis, jk, ta, kelas, walikelas) {
    if (typeof avatar === 'object' && avatar !== null) {
        const data = avatar;
        avatar = data.id || data.nama?.charAt(0) || 'S';
        name = data.nama || '-';
        nis = data.nis || '-';
        jk = data.jenis_kelamin || '-';
        ta = data.tahun_ajaran || '-';
        kelas = data.kelas_nama || '-';
        walikelas = data.wali_nama || '-';
    }

    document.getElementById('modalAvatar').textContent = avatar || 'S';
    document.getElementById('modalName').textContent = name || '-';
    document.getElementById('modalName2').textContent = name || '-';
    document.getElementById('modalNIS').textContent = nis || '-';
    document.getElementById('modalGender').textContent = jk === 'L' ? 'Laki-laki' : (jk === 'P' ? 'Perempuan' : '-');
    document.getElementById('modalTahunAjaran').textContent = ta || '-';
    document.getElementById('modalKelas').textContent = kelas || '-';
    document.getElementById('modalWaliKelas').textContent = walikelas || '-';
}

window.openDetailModal = openDetailModal;
