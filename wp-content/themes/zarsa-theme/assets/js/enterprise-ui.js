document.addEventListener('DOMContentLoaded', () => {
    const MOBILE_NAV_MAX = 900;
    const toggle = document.getElementById('mobileToggle');
    const nav = document.getElementById('mainNav');
    const closeBtn = document.getElementById('mobileClose');
    const header = document.getElementById('siteHeader');

    const isMobileNav = () => window.innerWidth <= MOBILE_NAV_MAX;

    const closeMenu = () => {
        if (!toggle || !nav) {
            return;
        }
        toggle.classList.remove('active');
        nav.classList.remove('active');
        document.body.classList.remove('menu-open');
    };

    if (toggle && nav) {
        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggle.classList.toggle('active');
            nav.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                closeMenu();
            });
        }

        document.querySelectorAll('.nav-menu a').forEach((link) => {
            link.addEventListener('click', () => {
                if (isMobileNav()) {
                    closeMenu();
                }
            });
        });

        document.addEventListener('click', (e) => {
            if (!isMobileNav() || !nav.classList.contains('active')) {
                return;
            }
            if (nav.contains(e.target) || toggle.contains(e.target)) {
                return;
            }
            closeMenu();
        });
    }

    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                header.classList.add('header-scrolled');
            } else {
                header.classList.remove('header-scrolled');
            }
        });
    }
});
