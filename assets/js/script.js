// --- Self-invoking function to avoid polluting global scope ---
(function() {
    
    // --- Mobile Navigation Logic ---
    const navSlide = () => {
        const hamburger = document.querySelector('.hamburger');
        const nav = document.querySelector('.nav-links');
        const body = document.querySelector('body');

        if (hamburger) {
            hamburger.addEventListener('click', () => {
                nav.classList.toggle('nav-active');
                hamburger.classList.toggle('is-active');
                body.classList.toggle('no-scroll');
            });
        }
    }
    navSlide();

    // --- THEME SWITCHER LOGIC ---
    const themeSwitcher = () => {
        const themeToggle = document.querySelector('#theme-toggle');
        const THEME_KEY = 'nazirfolio_theme';
        const savedTheme = localStorage.getItem(THEME_KEY);
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
        }
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                localStorage.setItem(THEME_KEY, document.body.classList.contains('dark-mode') ? 'dark' : 'light');
            });
        }
    }
    themeSwitcher();

    // --- PROJECT FILTERING LOGIC ---
    const projectFilter = () => {
        const filterContainer = document.querySelector('#project-filters');
        const projectCards = document.querySelectorAll('.project-grid .project-card');

        if (filterContainer) {
            filterContainer.addEventListener('click', (e) => {
                if (e.target.classList.contains('filter-btn')) {
                    // Update active button
                    filterContainer.querySelector('.active').classList.remove('active');
                    e.target.classList.add('active');

                    const filterValue = e.target.getAttribute('data-filter');

                    projectCards.forEach(card => {
                        if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                            card.classList.remove('hide');
                        } else {
                            card.classList.add('hide');
                        }
                    });
                }
            });
        }
    }
    projectFilter();

    // --- FEATURES ---

    // 1. Back to Top Button Logic
    const backToTopButton = document.querySelector("#back-to-top");
    if (backToTopButton) {
        window.addEventListener("scroll", () => {
            backToTopButton.classList.toggle('visible', window.pageYOffset > 300);
        });
        backToTopButton.addEventListener("click", (e) => {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    // 2. Scroll Animation Logic (Intersection Observer)
    const revealElements = document.querySelectorAll('.reveal-on-scroll');
    if (revealElements.length > 0) {
        const observerOptions = { root: null, rootMargin: '0px', threshold: 0.1 };
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        revealElements.forEach(element => observer.observe(element));
    }

})(); // End of self-invoking function

