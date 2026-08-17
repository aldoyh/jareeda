/**
 * Dark Mode Toggle
 * Persists user preference in localStorage
 * Respects system preference on first visit
 */

const STORAGE_KEY = 'jareeda-theme';
const DARK = 'dark';
const LIGHT = 'light';

function getSystemPreference(): string {
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? DARK : LIGHT;
}

function getStoredTheme(): string | null {
    return localStorage.getItem(STORAGE_KEY);
}

function setTheme(theme: string): void {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem(STORAGE_KEY, theme);
    updateToggleIcon(theme);
}

function updateToggleIcon(theme: string): void {
    const toggle = document.querySelector('.dark-mode-toggle');
    if (!toggle) {
        return;
    }

    const label = toggle.querySelector('.toggle-label');
    if (label) {
        label.textContent = theme === DARK ? 'Light' : 'Dark';
    }
}

function initDarkMode(): void {
    // Apply stored or system theme immediately
    const stored = getStoredTheme();
    const theme = stored || getSystemPreference();
    document.documentElement.setAttribute('data-theme', theme);
    updateToggleIcon(theme);

    // Listen for system preference changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!getStoredTheme()) {
            setTheme(e.matches ? DARK : LIGHT);
        }
    });

    // Create toggle button if it doesn't exist
    createToggleButton();

    // Handle toggle clicks
    document.addEventListener('click', (e) => {
        const target = e.target as HTMLElement;
        if (target.closest('.dark-mode-toggle')) {
            e.preventDefault();
            const current = document.documentElement.getAttribute('data-theme');
            setTheme(current === DARK ? LIGHT : DARK);
        }
    });
}

function createToggleButton(): void {
    // Check if toggle already exists
    if (document.querySelector('.dark-mode-toggle')) {
        return;
    }

    const header = document.querySelector('.header-container');
    if (!header) {
        return;
    }

    const current = document.documentElement.getAttribute('data-theme') || LIGHT;

    const toggle = document.createElement('button');
    toggle.className = 'dark-mode-toggle';
    toggle.setAttribute('aria-label', `Switch to ${current === DARK ? 'light' : 'dark'} mode`);
    toggle.setAttribute('type', 'button');
    toggle.innerHTML = `
        <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="4"></circle>
            <path d="M12 2v2"></path>
            <path d="M12 20v2"></path>
            <path d="m4.93 4.93 1.41 1.41"></path>
            <path d="m17.66 17.66 1.41 1.41"></path>
            <path d="M2 12h2"></path>
            <path d="M20 12h2"></path>
            <path d="m6.34 17.66-1.41 1.41"></path>
            <path d="m19.07 4.93-1.41 1.41"></path>
        </svg>
        <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
        </svg>
        <span class="toggle-label">${current === DARK ? 'Light' : 'Dark'}</span>
    `;

    // Insert before the hamburger menu
    const nav = header.querySelector('.header-offcanvas');
    if (nav) {
        nav.parentNode?.insertBefore(toggle, nav);
    } else {
        header.appendChild(toggle);
    }
}

export { initDarkMode, setTheme, getStoredTheme };
