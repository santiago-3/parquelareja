document.addEventListener('DOMContentLoaded', () => {
    console.log('contenido cargado')
    document.querySelectorAll('.past.activities .activity').forEach( activity => {
        activity.addEventListener('click', ev =>  {
            let activity = ev.target.closest('.activity')
            if (activity.classList.contains('selected')) {
                activity.classList.remove('selected')
            }
            else {
                hideAll()
                activity.classList.add('selected')
            }
        })
    })
})

function hideAll() {
    document.querySelectorAll('.past.activities .activity').forEach( activity => {
        activity.classList.remove('selected')
    })
}
