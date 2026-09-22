import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.getElementById('navbar');

    if (!navbar || navbar.querySelector('.language-switch, [data-language-switch]')) {
        return;
    }

    const desktopActions = navbar.querySelector('.hidden.md\\:flex.items-center');
    const currentLocale = document.documentElement.lang === 'en' ? 'en' : 'id';
    const targetLocale = currentLocale === 'id' ? 'en' : 'id';
    const languageButton = document.createElement('a');

    languageButton.href = `/language/${targetLocale}`;
    languageButton.dataset.languageSwitch = 'true';
    languageButton.className = 'language-switch inline-flex h-10 items-center gap-2 rounded-full px-4 text-xs font-semibold transition';
    languageButton.style.border = '1px solid rgba(255,255,255,.45)';
    languageButton.style.color = '#fff';
    languageButton.style.background = 'rgba(255,255,255,.12)';
    languageButton.innerHTML = `<span>${targetLocale.toUpperCase()}</span>`;

    if (desktopActions) {
        desktopActions.classList.add('gap-3');
        desktopActions.prepend(languageButton);
    }

    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenu && !mobileMenu.querySelector('[data-language-switch]')) {
        const mobileButton = languageButton.cloneNode(true);
        mobileButton.className = 'inline-flex items-center justify-center rounded-lg border border-slate-200 px-4 py-2 text-center text-slate-700';
        mobileButton.style.cssText = '';
        mobileButton.innerHTML = `<span>${targetLocale.toUpperCase()}</span>`;
        mobileMenu.querySelector('.flex.flex-col')?.insertBefore(mobileButton, mobileMenu.querySelector('.flex.flex-col')?.lastElementChild ?? null);
    }
});
