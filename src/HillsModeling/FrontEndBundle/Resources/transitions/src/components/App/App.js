import React, { Component } from 'react';
import SvgContainer from './../Svg/SvgContainer';
import FactoryContainer from './../Factory/FactoryContainer';
import FormContainer from './../Form/FormContainer';
import './App.css';

class App extends Component {
  save() {
    const saveUrl = document.getElementById('root').getAttribute('data-action');

    let req = new XMLHttpRequest();

    req.open("POST", saveUrl);
    req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    req.send(encodeURI('redux_state=' + JSON.stringify(this.props.store.getState())));
  }
  render() {
    return (
      <div className="App">
        <div className="save-container">
          <button className="btn btn-danger" onClick={this.save.bind(this)}>Register Transitions</button>
        </div>
        <div id="side-menu">
          <FactoryContainer />
          <FormContainer />
        </div>
        <SvgContainer />
      </div>
    );
  }
}

export default App;
