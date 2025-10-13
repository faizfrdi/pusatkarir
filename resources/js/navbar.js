document.addEventListener("DOMContentLoaded", () => {
    // === MOBILE MENU TOGGLE ===
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.contains('hidden');
            mobileToggle.classList.toggle('active');
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                setTimeout(() => {
                    mobileMenu.classList.remove('opacity-0', 'scale-y-95');
                    mobileMenu.classList.add('opacity-100', 'scale-y-100');
                }, 10);
            } else {
                mobileMenu.classList.remove('opacity-100', 'scale-y-100');
                mobileMenu.classList.add('opacity-0', 'scale-y-95');
                setTimeout(() => mobileMenu.classList.add('hidden'), 400);
            }
        });
    }

    // === MOBILE DROPDOWN HANDLER ===
    window.toggleMobileDropdown = function (id) {
        const dropdown = document.getElementById(id);
        const icon = document.querySelector(`#${id.replace('Mobile', 'Icon')}`);
        const isHidden = dropdown.classList.contains('hidden');

        if (isHidden) {
            dropdown.classList.remove('hidden');
            setTimeout(() => {
                dropdown.classList.remove('opacity-0', 'scale-y-95');
                dropdown.classList.add('opacity-100', 'scale-y-100');
                icon?.classList.add('rotate-180');
            }, 10);
        } else {
            dropdown.classList.remove('opacity-100', 'scale-y-100');
            dropdown.classList.add('opacity-0', 'scale-y-95');
            icon?.classList.remove('rotate-180');
            setTimeout(() => dropdown.classList.add('hidden'), 400);
        }
    };

    // === DESKTOP DROPDOWN HANDLER ===
    window.toggleDropdown = function (id) {
        const dropdown = document.getElementById(id);
        const allDropdowns = document.querySelectorAll('ul[id$="Dropdown"]');
        allDropdowns.forEach(el => {
            if (el.id !== id) el.classList.add('hidden');
        });
        dropdown.classList.toggle('hidden');
    }

    // === CLOSE DROPDOWN ON OUTSIDE CLICK ===
    window.addEventListener('click', e => {
        if (!e.target.closest('button[onclick^="toggleDropdown"]')) {
            document.querySelectorAll('ul[id$="Dropdown"]').forEach(d => d.classList.add('hidden'));
        }
    });
});