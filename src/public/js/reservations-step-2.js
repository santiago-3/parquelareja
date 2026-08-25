const state = {
    workshopSelected : false,
    centersSelected : false,
}

const inputs = {
    checkboxes: {},
    datepickers: {},
}
const areas = {}
const elements = {}

document.addEventListener('DOMContentLoaded', () => {
    init()
    stateHasChanged()
})

function init() {
    elements.buttons = {}
    elements.checkboxes = {}
    elements.datepickers = {}

    elements.form                   = document.querySelector('form')
    elements.buttons.addHost        = document.querySelector('#add_host')
    elements.hosts                  = document.querySelector('.hosts')
    inputs.checkboxes.workshop      = document.querySelector('#taller_check')
    inputs.checkboxes.centers       = document.querySelector('#centros_check')
    inputs.checkboxes.glassWorkshop = document.querySelector('#workshop_glass')
    inputs.datepickers.workshopFrom = document.querySelector('#workshop_from')
    inputs.datepickers.workshopTo   = document.querySelector('#workshop_to')
    elements.advice                 = document.querySelector('#android_chrome_advice')
    areas.centers                   = document.querySelector('.area.centros .area-content')
    areas.workshop                  = document.querySelector('.area.taller .area-content')

    elements.buttons.addHost.addEventListener('click', addHostLine)
    inputs.checkboxes.workshop.addEventListener('change', stateHasChanged)
    inputs.checkboxes.centers.addEventListener('change', stateHasChanged)
}

function stateHasChanged() {
    update()
    render()
}

function update() {
    state.workshopSelected = inputs.checkboxes.workshop.checked
    state.centersSelected  = inputs.checkboxes.centers.checked
}

function render() {
    elements.advice.style.display = 'none'
    areas.centers.style.display = state.centersSelected ? 'block' : 'none'
    areas.workshop.style.display = state.workshopSelected ? 'block' : 'none'
}


function addHostLine() {

    const newHost = newElem('div', { classes: ['host'],
        nodes: [
            newElem('button', { classes: ['remove', 'button-red', 'blue-link'], attributes: [ ['type', 'button'], ['title', 'Eliminar alojade'] ], eventListeners: [ ['click', removeHost] ],
                nodes: [
                    newElem('i', { classes: ['fa', 'fa-trash'], }),
                ],
            }),
            newElem('div', { classes: ['line'],
                nodes: [
                    newElem('input', { classes: ['name'], attributes: [ ['type', 'text'], ['placeholder', 'Nombre'], ['name', 'hosts[][name]'], ], }),
                    newElem('input', { classes: ['name'], attributes: [ ['type', 'text'], ['placeholder', 'Apellido'], ['name', 'hosts[][last_name]'], ], }),
                    newElem('input', { classes: ['name'], attributes: [ ['type', 'email'], ['placeholder', 'Email'], ['name', 'hosts[][email]'], ], }),
                ],
            }),
            newElem('div', { classes: ['line'],
                nodes: [
                    newElem('input', { classes: ['date_from'], attributes: [ ['type', 'date'], ['placeholder', 'Desde'], ['name', 'hosts[][date_from]'], ], }),
                    newElem('input', { classes: ['date_to'], attributes: [ ['type', 'date'], ['placeholder', 'Hasta'], ['name', 'hosts[][date_to]'], ], }),
                    newElem('select', { classes: ['place'], attributes: [ ['name', 'hosts[][place]'], ],
                        nodes: [
                            newElem('option', { attributes: [ ['value', 2], ], content: 'Centro de trabajo', }),
                        ]
                    }),
                ],
            }),
        ],
    })


    elements.hosts.appendChild(newHost)
}

function removeHost(ev) {
    const host = ev.target.closest('.host')
    host.remove()
}
