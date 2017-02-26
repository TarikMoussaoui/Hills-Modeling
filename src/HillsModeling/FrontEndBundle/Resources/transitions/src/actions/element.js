import { v4 } from 'node-uuid';

const circle = {
    type: 'circle',
    r: 50,
    label: 'label',
    properties: 'properties',
    activities: 'activities',
    position: {
        x: 0,
        y: 0
    }
}

const rectangle = {
    type: 'rectangle',
    label: 'label',
    properties: 'properties',
    sojournTime: 'sojournTime',
    activities: 'activities',
    position: {
        x: 0,
        y: 0
    }
}

const node = {
    type: 'node',
    dot: 'left',
    position: {
        x: 0,
        y: 0
    }
}

const irectangle = {
    type: 'irectangle',
    label: 'label',
    properties: 'properties',
    activities: 'activities',
    position: {
        x: 0,
        y: 0
    }
}

const text = {
    type: 'text',
    text: 'Type text here',
    position: {
        x: 0,
        y: 0
    }
}

export const createElement = (type, params) => {
    switch(type) {
        case 'circle':
            return Object.assign({id: v4()}, circle, params);
        case 'rectangle':
            return Object.assign({id: v4()}, rectangle, params);
        case 'node':
            return Object.assign({id: v4()}, node, params);
        case 'irectangle':
            return Object.assign({id: v4()}, irectangle, params);
        case 'text':
            return Object.assign({id: v4()}, text, params);


        default :
        throw new Error('Impossible to create an element of type ' + type);
    }
}