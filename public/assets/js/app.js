(() => {
    'use strict';

    // Keep the script intentionally small: navigation and database rendering remain server-side.
    document.documentElement.classList.add('js-ready');

    const main = document.querySelector('#main-content');
    if (main) {
        main.addEventListener('animationend', () => {
            main.classList.add('is-settled');
        }, { once: true });
    }

    document.querySelectorAll('form[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!window.confirm(form.dataset.confirm)) event.preventDefault();
        });
    });
})();
