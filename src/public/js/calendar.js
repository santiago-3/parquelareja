document.addEventListener('DOMContentLoaded', () => {
    // 1. Event Delegation for calendar days
    document.addEventListener('click', (event) => {
        const day = event.target.closest('.calendars .day.occupied');
        if (day) {
            openModal(day);
        }
    });

    // 2. Close Modal Logic
    document.querySelectorAll('.details-modal .close-button').forEach(btn => {
        btn.addEventListener('click', function() {
            // .parent().parent() equivalent
            this.parentElement.parentElement.style.display = 'none';
        });
    });

    // 3. Initial state
    const selectPlace = document.querySelector('select[name=place]');
    if (selectPlace) {
        select_change(selectPlace.value);
    }
    
    init_radios();
});

function openModal(target) {
    const daystamp = target.dataset.daystamp;
    const dayDetail = document.querySelector(`.day-detail[data-daystamp="${daystamp}"]`);
    const modal = document.querySelector('.details-modal');
    const contentContainer = document.querySelector('.details-modal .container .content');

    if (dayDetail && modal && contentContainer) {
        modal.style.display = 'flex';
        // Replacing innerHTML just like your original fix
        contentContainer.innerHTML = dayDetail.innerHTML;
    }
}

function init_radios() {
    const selectPlace = document.querySelector('select[name=place]');
    if (selectPlace) {
        selectPlace.addEventListener('change', function() {
            select_change(this.value);
        });
    }
}

function select_change(val) {
    console.log(val);

    // Remove class from all days
    document.querySelectorAll('.day').forEach(el => el.classList.remove('occupied'));
    
    // Hide all details
    document.querySelectorAll('.detail').forEach(el => el.style.display = 'none');

    // Helper function to show/occupy elements
    const activate = (selector) => {
        document.querySelectorAll(`.day${selector}`).forEach(el => el.classList.add('occupied'));
        document.querySelectorAll(`.detail${selector}`).forEach(el => el.style.display = 'block');
    };

    switch (val) {
        case 'centros':
            activate('.estudio, .trabajo');
            break;
        case 'estudio':
            activate('.estudio');
            break;
        case 'trabajo':
            activate('.trabajo');
            break;
        case 'taller':
            activate('.taller');
            break;
        case 'multiuso':
            activate('.multiuso');
            break;
        case 'visitantes':
            activate('.visitantes');
            break;
        case 'todos':
            activate('.estudio, .trabajo, .taller, .multiuso, .visitantes');
            break;
    }
}
