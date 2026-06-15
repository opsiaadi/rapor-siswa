const NOTIF = window.__notif || {};

window.toggleNotifDropdown = function() {
    const panel = document.getElementById('notif-panel');
    panel.classList.toggle('hidden');
    if (!panel.classList.contains('hidden')) loadNotifications();
}

document.addEventListener('click', function (e) {
    const dropdown = document.getElementById('notif-dropdown');
    if (!dropdown.contains(e.target)) {
        document.getElementById('notif-panel').classList.add('hidden');
    }
});

async function loadNotifications() {
    try {
        const res = await fetch(NOTIF.url, { headers: { 'Accept': 'application/json' } });
        const data = await res.json();
        updateBadge(data.unread_count);
        renderNotifications(data.notifications);
    } catch (e) {
        document.getElementById('notif-list').innerHTML =
            '<p class="px-4 py-6 text-center text-sm text-red-400">Gagal memuat notifikasi.</p>';
    }
}

function updateBadge(count) {
    const badge = document.getElementById('notif-badge');
    if (count > 0) {
        badge.textContent = count > 99 ? '99+' : count;
        badge.classList.remove('hidden');
    } else {
        badge.classList.add('hidden');
    }
}

function renderNotifications(notifications) {
    const list = document.getElementById('notif-list');
    if (!notifications.length) {
        list.innerHTML = '<p class="px-4 py-6 text-center text-sm text-gray-400">Tidak ada notifikasi</p>';
        return;
    }
    list.innerHTML = notifications.map(n => `
        <div onclick="markAsRead(${n.id}, '${n.url || ''}')" class="px-4 py-3 hover:bg-gray-50 cursor-pointer transition-colors ${n.is_read ? 'opacity-60' : ''}">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-0.5 ${n.type === 'success' ? 'bg-emerald-100 text-emerald-600' : n.type === 'error' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600'}">
                    ${n.type === 'success'
                        ? '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
                        : '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 ${n.is_read ? '' : 'font-semibold'}">${n.title}</p>
                    <p class="text-xs text-gray-500 mt-0.5 truncate">${n.message}</p>
                    <p class="text-[10px] text-gray-400 mt-1">${timeAgo(n.created_at)}</p>
                </div>
                ${!n.is_read ? '<div class="w-2 h-2 bg-blue-500 rounded-full shrink-0 mt-2"></div>' : ''}
            </div>
        </div>
    `).join('');
}

window.markAsRead = async function(id, url) {
    try {
        await fetch(`${NOTIF.readUrl}/${id}/read`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': NOTIF.csrf, 'Accept': 'application/json' }
        });
        loadNotifications();
        if (url) window.location.href = url;
    } catch (e) {}
}

window.markAllRead = async function() {
    try {
        const res = await fetch(`${NOTIF.readUrl}/read-all`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': NOTIF.csrf, 'Accept': 'application/json' }
        });
        const data = await res.json();
        updateBadge(data.unread_count);
        loadNotifications();
    } catch (e) {}
}

window.clearAllNotifications = async function() {
    if (!confirm('Hapus semua notifikasi?')) return;
    try {
        await fetch(`${NOTIF.readUrl}/clear-all`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': NOTIF.csrf, 'Accept': 'application/json' }
        });
        loadNotifications();
    } catch (e) {}
}

function timeAgo(dateString) {
    const diff = Math.floor((Date.now() - new Date(dateString).getTime()) / 1000);
    if (diff < 60) return 'Baru saja';
    if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
    if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
    return Math.floor(diff / 86400) + ' hari lalu';
}

function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    const bgClass = type === 'success' ? 'bg-emerald-600' : type === 'error' ? 'bg-red-600' : 'bg-blue-600';
    const icon = type === 'success'
        ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
        : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
    toast.className = `${bgClass} text-white px-4 py-3 rounded-lg shadow-lg flex items-center gap-2 text-sm font-medium transform translate-x-full opacity-0 transition-all duration-300`;
    toast.innerHTML = `${icon}<span>${message}</span>`;
    container.appendChild(toast);
    requestAnimationFrame(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
    });
    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}

document.addEventListener('DOMContentLoaded', function () {
    loadNotifications();
    NOTIF.flashSuccess && showToast(NOTIF.flashSuccess, 'success');
    NOTIF.flashError && showToast(NOTIF.flashError, 'error');
});
