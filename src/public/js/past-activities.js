const props = {
    batchSize: 20
}

let state = {
    currentLoadOffset: 0,
    safeToLoadFurther: true,
    lastLoadScrollTop: 0,
    scrollHeight: document.documentElement.scrollHeight,
}

const loader = document.querySelector('#loader')
const activitiesElem = document.querySelector('#activities')
let activities = []
loader.style.display = 'none';

document.addEventListener('DOMContentLoaded', () => {
    initActivities()
    console.log('scroll height', state.scrollHeight)
    document.addEventListener('scroll', () => {
        const clientHeight = document.documentElement.clientHeight
        const scrollTop = document.documentElement.scrollTop
        if (scrollTop + clientHeight > state.scrollHeight - 10) {
            if (state.safeToLoadFurther) {
                loadFurther()
            }
        }
    })
})

function initActivities() {
    document.querySelectorAll('#activities.past .activity').forEach( activity => {
        frameHeight = activity.querySelector('.frame').offsetHeight
        if (frameHeight > 270) {
            activity.classList.add('high')
        }
    })
    document.querySelectorAll('#activities.past .activity:not(.initialized).high').forEach( activity => {
        activity.addEventListener('click', ev =>  {
            let activity = ev.target.closest('.activity')
            activity.classList.add('initialized')
            if (activity.classList.contains('selected')) {
                activity.classList.remove('selected')
            }
            else {
                hideAll()
                activity.classList.add('selected')
            }
        })
    })
}

function hideAll() {
    document.querySelectorAll('#activities.past .activity').forEach( activity => {
        activity.classList.remove('selected')
    })
}

async function loadFurther() {
    state.safeToLoadFurther = false
    loader.style.display = 'block';
    const url = `/load-activities/${state.currentLoadOffset+props.batchSize}`
    try {
        const response = await fetch(url)
        if (!response.ok) {
            throw new Error(`Response status ${response.status}`)
        }

        const result = await response.json()
        activities = result
        render()
    }
    catch (error) {
        console.log(error.message)
    }

    state.scrollHeight = document.documentElement.scrollHeight;
    state.safeToLoadFurther = true
    state.currentLoadOffset = state.currentLoadOffset + props.batchSize

    loader.style.display = 'none'
    initActivities()
}

function render() {
    activities
        .filter(activity => activity.hasOwnProperty('image') && activity.image != null)
        .forEach( activity => {
            const activityElem = newElem('div', {
                classes: ['activity'],
                nodes: [
                    newElem('div', {
                        classes: ['frame'],
                        nodes: [
                            newElem('div', {
                                classes: ['header'],
                                nodes: [
                                    newElem('div', {
                                        classes: ['date'],
                                        content: activity.date,
                                    }),
                                    newElem('div', {
                                        classes: ['title'],
                                        content: activity.name,
                                    }),
                                ]
                            }),
                            newElem('div', {
                                classes: ['content'],
                                nodes: [
                                    newElem('div', {
                                        classes: ['img'],
                                        nodes: [
                                            newElem('img', {
                                                attributes: [
                                                    ['src', activity.image.path],
                                                    ['alt', activity.name],
                                                ]
                                            }),
                                        ],
                                    }),
                                    newElem('div', {
                                        classes: ['description'],
                                        content: activity.description,
                                    }),
                                    newElem('div', {
                                        classes: ['vail'],
                                    }),
                                ],
                            }),
                        ],
                    }),
                ],
            })
            activitiesElem.appendChild(activityElem)
        })
}
