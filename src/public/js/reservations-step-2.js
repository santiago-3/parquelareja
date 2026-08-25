
const state = {}
const elements = {}

document.addEventListener('DOMContentLoaded', () => {
    init()
    stateHasChanged()
})

function init() {
    elements.buttons = {}
    elements.checkboxes = {}
    elements.datepickers = {}

    elements.form                     = document.querySelector('form')
    elements.buttons.addHost          = document.querySelector('#add_host')
    elements.checkboxes.taller        = document.querySelector('#taller_check')
    elements.checkboxes.centros       = document.querySelector('#centros_check')
    elements.checkboxes.glassWorkshop = document.querySelector('#workshop_glass')
    elements.datepickers.workshopFrom = document.querySelector('#workshop_from')
    elements.datepickers.workshopTo   = document.querySelector('#workshop_to')

    elements.buttons.addHost.addEventListener('click', addHostLine())
}

function stateHasChanged() {
    update()
    render()
}

function update() {
}

function render() {
}
