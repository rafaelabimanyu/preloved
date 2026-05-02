import './bootstrap';
import './lang'; // locale persistence — syncs server locale → localStorage on every page

// ─── Navbar scroll effect ─────────────────────────────────────────────────
const nav = document.getElementById('main-nav');
if (nav) {
    const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 40);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

// ─── Mobile nav toggle ────────────────────────────────────────────────────
const hamburger = document.getElementById('nav-hamburger');
const navLinks  = document.getElementById('nav-links');
if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => {
        const open = navLinks.classList.toggle('nav__links--open');
        hamburger.setAttribute('aria-expanded', String(open));
    });

    // Close drawer when a nav link is clicked
    navLinks.querySelectorAll('.nav__link').forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('nav__links--open');
            hamburger.setAttribute('aria-expanded', 'false');
        });
    });

    // Close on Escape key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && navLinks.classList.contains('nav__links--open')) {
            navLinks.classList.remove('nav__links--open');
            hamburger.setAttribute('aria-expanded', 'false');
        }
    });
}

// ─── Admin sidebar toggle (mobile) ───────────────────────────────────────
const adminToggle  = document.getElementById('admin-sidebar-toggle');
const adminSidebar = document.getElementById('admin-sidebar');
const adminOverlay = document.getElementById('admin-sidebar-overlay');
if (adminToggle && adminSidebar) {
    const openSidebar = () => {
        adminSidebar.classList.add('admin-sidebar--open');
        adminOverlay?.classList.add('active');
        document.body.style.overflow = 'hidden';
    };
    const closeSidebar = () => {
        adminSidebar.classList.remove('admin-sidebar--open');
        adminOverlay?.classList.remove('active');
        document.body.style.overflow = '';
    };

    adminToggle.addEventListener('click', () => {
        adminSidebar.classList.contains('admin-sidebar--open') ? closeSidebar() : openSidebar();
    });

    adminOverlay?.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeSidebar();
    });

    // Auto-close on nav link click (mobile)
    adminSidebar.querySelectorAll('.admin-nav__link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 768) closeSidebar();
        });
    });
}

// ─── Catalog filter sidebar toggle (mobile) ──────────────────────────────
const filterToggle  = document.getElementById('filter-toggle');
const filterSidebar = document.querySelector('.filter-sidebar');
const filterOverlay = document.getElementById('filter-sidebar-overlay');
if (filterToggle && filterSidebar) {
    const openFilter = () => {
        filterSidebar.classList.add('filter-sidebar--open');
        filterOverlay?.classList.add('active');
        document.body.style.overflow = 'hidden';
    };
    const closeFilter = () => {
        filterSidebar.classList.remove('filter-sidebar--open');
        filterOverlay?.classList.remove('active');
        document.body.style.overflow = '';
    };

    filterToggle.addEventListener('click', openFilter);
    filterOverlay?.addEventListener('click', closeFilter);

    // Auto-close when a filter radio is changed
    filterSidebar.querySelectorAll('input[type="radio"]').forEach(input => {
        input.addEventListener('change', () => {
            if (window.innerWidth < 768) closeFilter();
        });
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeFilter();
    });
}

// ─── Scroll-reveal (Intersection Observer) ───────────────────────────────
const animateTargets = document.querySelectorAll('[data-animate]');
if (animateTargets.length) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-up');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08 });
    animateTargets.forEach(el => observer.observe(el));
}

// ─── Gallery thumb switcher (item detail page) ────────────────────────────
const mainImg = document.getElementById('gallery-main');
const thumbs  = document.querySelectorAll('[data-gallery-thumb]');
if (mainImg && thumbs.length) {
    thumbs.forEach(thumb => {
        thumb.addEventListener('click', () => {
            mainImg.src = thumb.dataset.galleryThumb;
            thumbs.forEach(t => t.style.opacity = '0.5');
            thumb.style.opacity = '1';
        });
    });
}

// ─── Flash message auto-dismiss ───────────────────────────────────────────
const flash = document.getElementById('flash-message');
if (flash) {
    setTimeout(() => {
        flash.style.transition = 'opacity .4s, transform .4s';
        flash.style.opacity    = '0';
        flash.style.transform  = 'translateY(-8px)';
        setTimeout(() => flash.remove(), 400);
    }, 4000);
}
