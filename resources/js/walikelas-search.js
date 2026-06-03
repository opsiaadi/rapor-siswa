export function initSearchSiswa() {
    const searchInput = document.getElementById('searchSiswa');
    if (!searchInput) return;

    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const nama = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() ?? '';
            row.style.display = nama.includes(keyword) ? '' : 'none';
        });
    });
}

document.addEventListener('DOMContentLoaded', initSearchSiswa);

window.initSearchSiswa = initSearchSiswa;