document.addEventListener('DOMContentLoaded', function () {
    const mapelGuruMap = window.mapelGuruMap || {};

    function autoSelectGuru(checkbox) {
        const mapelId = checkbox.value;
        const guruSelect = document.getElementById('guru_mapel_' + mapelId);

        if (checkbox.checked) {
            if (mapelGuruMap[mapelId] && mapelGuruMap[mapelId].length > 0) {
                guruSelect.value = mapelGuruMap[mapelId][0];
            }
        } else {
            guruSelect.value = '';
        }
    }

    document.querySelectorAll('input[name="mapel_ids[]"]').forEach(function (checkbox) {
        autoSelectGuru(checkbox);
        checkbox.addEventListener('change', function () {
            autoSelectGuru(this);
        });
    });
});
