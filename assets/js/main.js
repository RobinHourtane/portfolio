document.addEventListener('DOMContentLoaded', () => {
    
    // --- Mobile Menu Toggle ---
    const mobileBtn = document.querySelector('.mobile-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if(mobileBtn) {
        mobileBtn.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    }

    // --- Projects Filtering System ---
    const checkboxes = document.querySelectorAll('.filter-checkbox');
    const projectCards = document.querySelectorAll('.project-card');
    const activeFiltersContainer = document.getElementById('active-filters');

    if (checkboxes.length > 0) {
        checkboxes.forEach(cb => cb.addEventListener('change', filterProjects));

        function filterProjects() {
            const activeCats = Array.from(document.querySelectorAll('input[data-filter-type="category"]:checked')).map(cb => cb.value);
            const activeTypes = Array.from(document.querySelectorAll('input[data-filter-type="type"]:checked')).map(cb => cb.value);

            projectCards.forEach(card => {
                const cardCat = card.dataset.category;
                const cardType = card.dataset.type;

                // Logic: (Match Category OR No Category Selected) AND (Match Type OR No Type Selected)
                const catMatch = activeCats.length === 0 || activeCats.includes(cardCat);
                const typeMatch = activeTypes.length === 0 || activeTypes.includes(cardType);

                if (catMatch && typeMatch) {
                    card.style.display = 'flex';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => card.style.display = 'none', 300);
                }
            });
        }
    }

    // --- Contact Form Validation ---
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const message = document.getElementById('message').value.trim();
            
            if (!name || !email || !message) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs.');
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Adresse email invalide.');
            }
        });
    }
});