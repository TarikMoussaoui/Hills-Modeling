import { combineReducers } from 'redux';
import { reducer as formReducer } from 'redux-form';
import element from './element';

const reducer = combineReducers({
  element,
  form: formReducer
});

export default reducer;