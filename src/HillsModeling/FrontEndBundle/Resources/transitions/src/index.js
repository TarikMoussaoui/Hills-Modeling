import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { createStore } from 'redux';
import devToolsEnhancer from 'remote-redux-devtools';
import reducer from './reducers/index';
import App from './components/App/App';
import './index.css';

const state = document.getElementById('root').getAttribute('data-state');
let store;

if (state) {
  const data = JSON.parse(state);
  store = createStore(reducer, data, devToolsEnhancer());
} else {
  store = createStore(reducer, devToolsEnhancer());
}

ReactDOM.render(
  <Provider store={store}>
    <App store={store}/>
  </Provider>,
  document.getElementById('root')
);
