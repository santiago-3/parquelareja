document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('.head-and-menu .hamburguer').addEventListener('click', () => {
        let menu = document.querySelector('.head-and-menu ul')
        if (menu.classList.contains('open')) {
            menu.classList.remove('open')
        }
        else {
            menu.classList.add('open')
        }
    })
})
