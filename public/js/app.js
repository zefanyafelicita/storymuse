// StoryMuse: shared behaviour. Page-specific scripts (filters, quiz) arrive in part 2.
document.addEventListener('DOMContentLoaded', () => {
    // Close the mobile menu after choosing a link.
    const menu = document.getElementById('mainNav');
    if (menu && window.bootstrap) {
        menu.querySelectorAll('a').forEach((a) =>
            a.addEventListener('click', () => bootstrap.Collapse.getInstance(menu)?.hide())
        );
    }
});

// Filter forms: submit automatically when a control changes (search is debounced).
// Empty fields are skipped so URLs stay clean, e.g. /discover?status=ongoing&genre=Romance
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form').forEach((form) => {
        form.addEventListener('submit', () => {
            [...form.elements].forEach((el) => {
                if (el.name && el.type !== 'submit' && !el.value) el.disabled = true;
            });
        });

        if (!form.hasAttribute('data-auto-submit') || form.dataset.autoSubmit === 'off') return;

        form.addEventListener('change', () => form.requestSubmit());

        const search = form.querySelector('[data-debounce]');
        if (search) {
            let t;
            search.addEventListener('input', () => {
                clearTimeout(t);
                t = setTimeout(() => form.requestSubmit(), 450);
            });
        }
    });

    // Back/forward cache can restore a form with disabled fields.
    window.addEventListener('pageshow', (e) => {
        if (e.persisted) document.querySelectorAll('form [disabled]').forEach((el) => el.disabled = false);
    });
});
