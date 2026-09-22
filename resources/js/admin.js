const body = document.body;
const sidebar = document.getElementById('sidebar');
const toggles = document.querySelectorAll('[data-admin-menu]');
const mobile = window.matchMedia('(max-width: 991px)');
let menuTrigger;

function setSidebarInert(inert) {
    if (!sidebar) return;
    sidebar.inert = inert;
}

function closeMenu() {
    body.classList.remove('admin-sidebar-open');
    toggles.forEach(button => button.setAttribute('aria-expanded', 'false'));
    if (mobile.matches) setSidebarInert(true);
    menuTrigger?.focus();
}

function syncMenu() {
    if (!sidebar) return;
    body.classList.remove('admin-sidebar-open');
    setSidebarInert(mobile.matches || body.classList.contains('admin-sidebar-collapsed'));
    toggles.forEach(button => button.setAttribute('aria-expanded', String(!sidebar.inert)));
}

toggles.forEach(button => button.addEventListener('click', () => {
    menuTrigger = button;
    if (!sidebar) return;
    if (mobile.matches) {
        const open = !body.classList.contains('admin-sidebar-open');
        body.classList.toggle('admin-sidebar-open', open);
        setSidebarInert(!open);
        toggles.forEach(item => item.setAttribute('aria-expanded', String(open)));
        if (open) sidebar.querySelector('button, a')?.focus();
    } else {
        body.classList.toggle('admin-sidebar-collapsed');
        setSidebarInert(body.classList.contains('admin-sidebar-collapsed'));
        toggles.forEach(item => item.setAttribute('aria-expanded', String(!sidebar.inert)));
    }
}));
document.querySelectorAll('[data-admin-menu-close]').forEach(button => button.addEventListener('click', closeMenu));
document.addEventListener('keydown', event => {
    if (!sidebar || !body.classList.contains('admin-sidebar-open')) return;
    if (event.key === 'Escape') closeMenu();
    if (event.key === 'Tab') {
        const items = [...sidebar.querySelectorAll('a[href], button:not([disabled])')].filter(item => item.offsetParent !== null);
        const first = items[0], last = items.at(-1);
        if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last?.focus(); }
        else if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first?.focus(); }
    }
});
mobile.addEventListener('change', syncMenu);
syncMenu();

// Give existing icon-only actions an accessible name without changing their handlers.
document.querySelectorAll('.content-wrapper a, .content-wrapper button').forEach(action => {
    const icon = action.querySelector('i[class*="fa-"]');
    if (!icon) return;
    icon.setAttribute('aria-hidden', 'true');
    if (action.textContent.trim() || action.getAttribute('aria-label')) return;
    const names = [['trash', 'Hapus data'], ['edit', 'Edit data'], ['pencil', 'Edit data'], ['eye', 'Lihat detail'], ['download', 'Unduh file'], ['key', 'Atur kata sandi']];
    const name = action.title || names.find(([match]) => icon.className.includes(match))?.[1] || 'Buka detail';
    action.setAttribute('aria-label', name);
    action.title ||= name;
});

document.querySelectorAll('.admin-table-toolbar').forEach(form => {
    form.addEventListener('submit', () => {
        const button = form.querySelector('button[type="submit"]');
        button.disabled = true;
        button.textContent = 'Mencari…';
    });
});
window.addEventListener('pageshow', () => {
    document.querySelectorAll('.admin-table-toolbar button[type="submit"]').forEach(button => {
        button.disabled = false;
        button.textContent = 'Cari';
    });
});
