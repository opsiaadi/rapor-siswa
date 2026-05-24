export function initSearch() {
    const inputs = document.querySelectorAll('#simple-search, #searchSiswa');
    if (!inputs.length) return;

    inputs.forEach(input => {
        input.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            const table = this.closest('table') || document.querySelector('table');
            if (!table) return;

            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = !keyword || text.includes(keyword) ? '' : 'none';
            });
        });
    });
}

document.addEventListener('DOMContentLoaded', initSearch);
window.initSearch = initSearch;
