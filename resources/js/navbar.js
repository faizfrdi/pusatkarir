document.addEventListener("DOMContentLoaded", () => {
  const mobileToggle = document.getElementById('mobile-menu-toggle');
  const mobileMenu   = document.getElementById('mobile-menu');

  if (mobileToggle && mobileMenu) {
    mobileToggle.addEventListener('click', () => {
      mobileToggle.classList.toggle('active');   // garis jadi X
      mobileMenu.classList.toggle('open');       // slide-down menu
      // ⛔ tidak ada transform main-content lagi
    });
  }

  // === MOBILE DROPDOWN HANDLER (biarin) ===
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

  // === DESKTOP DROPDOWN (biarin) ===
  window.toggleDropdown = function (id) {
    const dropdown = document.getElementById(id);
    const allDropdowns = document.querySelectorAll('ul[id$="Dropdown"]');
    allDropdowns.forEach(el => { if (el.id !== id) el.classList.add('hidden'); });
    dropdown.classList.toggle('hidden');
  };

  window.addEventListener('click', e => {
    if (!e.target.closest('button[onclick^="toggleDropdown"]')) {
      document.querySelectorAll('ul[id$="Dropdown"]').forEach(d => d.classList.add('hidden'));
    }
  });
});