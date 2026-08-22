const places = {
    centers : 0,
    multipurpose: 1,
}
const state = {
    selectedPlace: places.centers
}
const elements = {
    multipurposeForm: document.querySelector('.multiuso')
}
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.centros input').forEach(radio => {
        radio.addEventListener('click', ev => {
            state.selectedPlace = ev.target.value == 'centros' ? places.centers : places.multipurpose
            render()
        })
    })
})

function render() {
    if (state.selectedPlace == places.multipurpose) {
        elements.multipurposeForm.style.display = 'flex'
    }
    else {
        elements.multipurposeForm.style.display = 'none'
    }
}
