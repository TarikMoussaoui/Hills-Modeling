import {ADD_ELEMENT, SELECT_ELEMENT, UPDATE_ELEMENT} from './../actions';
import { combineReducers } from 'redux';

const list = (type) => {
    return (state = [], action) => {
        switch(action.type) {
            case ADD_ELEMENT:
            return action.element.type === type ?
            [...state, action.element.id] :
            state

            default:
            return state;
        }
    }
}

const byId = (state = {}, action) => {
    switch(action.type){
        case ADD_ELEMENT:
        case UPDATE_ELEMENT:
        return Object.assign({}, state, {
                [action.element.id]: action.element
            }
        );

        default:
        return state;
    }
}

const selectedId = (state = '', action) => {
    switch(action.type){
        case SELECT_ELEMENT:
        return action.id;

        default:
        return state;
    }
}

const listByType = combineReducers({
    circle: list('circle'),
    rectangle: list('rectangle'),
    node: list('node'),
    irectangle: list('irectangle'),
    text: list('text')
});

const element = combineReducers({
    byId,
    listByType,
    selectedId
});

export default element;

export const getElementById = (state, id) => state.byId[id];

export const getElementListByType = (state, type) => state.listByType[type].map((id) =>
    getElementById(state, id)
)