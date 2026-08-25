const places = {
    centers : 0,
    multipurpose: 1,
}

const solicitants = {
    master: 0,
    message: 1,
    organism: 2,
}

const state = {}
const elements = {}

document.addEventListener('DOMContentLoaded', () => {
    init()
    stateHasChanged()
})

function init() {
    elements.selects = {}
    elements.form = document.querySelector('form')
    elements.submitButton = document.querySelector('#submitButton')
    elements.multipurposeForm = document.querySelector('.multiuso')
    elements.mensajeForm = document.querySelector('.category_2 .mensaje');
    elements.organismoForm = document.querySelector('.category_2 .organismo');
    elements.selects.solicitant = document.querySelector('#solicitante')
    elements.selects.organisms = document.querySelector('#organisms')

    document.querySelectorAll('.lugares input').forEach(radio => {
        radio.addEventListener('click', ev => {
            stateHasChanged()
        })
    })

    elements.selects.solicitant.addEventListener('click', () => {
        stateHasChanged()
    })

    elements.submitButton.addEventListener('click', (ev) => {
        onSubmit()
    })
}

function stateHasChanged() {
    update()
    render()
}

function update() {
    state.selectedPlace = elements.form.elements['type'].value == 'centros' ? places.centers : places.multipurpose
    state.selectedSolicitante = elements.selects.solicitant.value == 'mensaje' ? solicitants.message 
                                : elements.selects.solicitant.value == 'organismo' ? solicitants.organism
                                    : solicitants.master
    state.selectedOrganism = elements.selects.organisms.value
}

function render() {
    if (state.selectedPlace == places.multipurpose) {
        elements.multipurposeForm.style.display = 'flex'
    }
    else {
        elements.multipurposeForm.style.display = 'none'
    }

    elements.mensajeForm.style.display = state.selectedSolicitante == solicitants.message ? 'block' : 'none'
    elements.organismoForm.style.display = state.selectedSolicitante == solicitants.organism ? 'block' : 'none'
}

function onSubmit() {
    if(state.selectedPlace != places.multipurpose) {
        elements.multipurposeForm.remove()
    }
    if(state.selectedPlace != places.centers) {
        elements.organismoForm.remove()
    }
    if (elements.form.checkValidity()) {
        console.log('valid!')
        elements.form.submit()
    }
    else {
        elements.form.reportValidity()
        console.log('not valid :(')
    }
}
