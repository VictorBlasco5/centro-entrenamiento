document.addEventListener('DOMContentLoaded', () => {

    //Acordeón
    document.querySelectorAll('.accordion-toggle').forEach(toggle => {
        toggle.addEventListener('click', () => {
            const content = toggle.nextElementSibling;
            const icon = toggle.querySelector('i');
            const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';

            if (isOpen) {
                content.style.maxHeight = '0';
                icon.classList.remove('fa-angle-up');
                icon.classList.add('fa-angle-down');
            } else {
                content.style.maxHeight = 'none';
                const height = content.scrollHeight;
                content.style.maxHeight = '0';
                content.offsetHeight;
                content.style.maxHeight = height + 'px';

                icon.classList.remove('fa-angle-down');
                icon.classList.add('fa-angle-up');
            }
        });
    });

    //Modal
    window.openSessionModal = function (id) {
        const modal = document.getElementById(`modal-${id}`);
        modal.style.display = 'flex';

        modal.addEventListener('click', function (e) {
            if (!e.target.closest('.session-modal-content')) {
                modal.style.display = 'none';
            }
        }, {
            once: true
        });
    }

    window.closeSessionModal = function (id) {
        const modal = document.getElementById(`modal-${id}`);
        modal.style.display = 'none';
    }
});