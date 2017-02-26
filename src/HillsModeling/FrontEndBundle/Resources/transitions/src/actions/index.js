export const ADD_ELEMENT = 'ADD_ELEMENT';
export const SELECT_ELEMENT = 'SELECT_ELEMENT';
export const UPDATE_ELEMENT = 'UPDATE_ELEMENT';

export function addElement(element) {
    return {
        type: ADD_ELEMENT,
        element
    }
}

export function selectElement(id) {
    return {
        type: SELECT_ELEMENT,
        id
    }
}

export function updateElement(element) {
    return {
        type: UPDATE_ELEMENT,
        element
    }
}