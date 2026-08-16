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
    document.addEventListener('scroll', () => {
        const clientHeight = document.documentElement.clientHeight
        const scrollTop = document.documentElement.scrollTop
        if (scrollTop + clientHeight > state.scrollHeight - 65) {
            if (state.safeToLoadFurther) {
                loadFurther()
            }
        }
    })
})

addEventListener('load', () => {
    initActivities()
})

function initActivities() {
    let activitiesVisited = 0
    let activitiesMarked = 0
    document.querySelectorAll('#activities.past .activity').forEach( activity => {
        activitiesVisited++
        markActivityAsHighIfNeeded(activity)
    })
    let highActivitiesVisited = 0
    document.querySelectorAll('#activities.past .activity:not(.initialized).high').forEach( activity => {
        highActivitiesVisited++
        bindClickEventToActivity(activity)
    })
}

function markActivityAsHighIfNeeded(activityElem) {
    frameHeight = activityElem.querySelector('.frame').offsetHeight
    if (frameHeight > 270) {
        activityElem.classList.add('high')
    }
}

function bindClickEventToActivity(activityElem) {
    activityElem.addEventListener('click', ev =>  {
        let actualActivity = ev.target.closest('.activity') // actualActivity because though the click event is binded to the activity element, the target of the event will be vail cause it's in front
        if (actualActivity.classList.contains('selected')) {
            actualActivity.classList.remove('selected')
        }
        else {
            hideAll(parseInt(actualActivity.getAttribute('key')))
            actualActivity.classList.add('selected')
        }
        actualActivity.classList.add('initialized')
    })
}

function hideAll(clickedActivityKey) {
    document.querySelectorAll('#activities.past .activity').forEach( activity => {
        const key = parseInt(activity.getAttribute('key'))
        console.log(key, clickedActivityKey)
        if (key <= clickedActivityKey-3 || key > clickedActivityKey) {
            activity.classList.remove('selected')
        }
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
}

function render() {
    const images = []
    activities
        .filter(activity => activity.hasOwnProperty('image') && activity.image != null)
        .forEach( (activity, index) => {
            const activityElem = newElem('div', {
                classes: ['activity'],
                attributes: [['key', index]],
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

            let image = activityElem.querySelector('img')
            new Promise(resolve => { image.onload = image.onerror = resolve; }).then(() => {
                markActivityAsHighIfNeeded(activityElem)
                if (activityElem.classList.contains('high')) {
                    bindClickEventToActivity(activityElem)
                }
            });

            activitiesElem.appendChild(activityElem)
        })
}
