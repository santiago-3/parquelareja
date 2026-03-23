document.addEventListener('DOMContentLoaded', () => {
    console.log('lists loaded')
    document.querySelectorAll('table tbody tr').forEach( row => {
        row.addEventListener('click', ev => {
            let row = ev.target.closest('tr')
            let link = row.dataset.link
            document.location.href = link
        })
    })
})
