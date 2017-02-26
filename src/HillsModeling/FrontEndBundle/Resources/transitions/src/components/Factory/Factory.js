import React from 'react';
import './Factory.css';
import {createElement} from './../../actions/element';

const Factory = ({addElement}) => (
    <div id="factory-container">
        <button className="btn btn-primary" onClick={() => addElement(createElement('circle'))}>Add circle</button>
        <button className="btn btn-primary" onClick={() => addElement(createElement('node'))}>Add node</button>
        <button className="btn btn-primary" onClick={() => addElement(createElement('rectangle'))}>Add Rectangle</button>
        <button className="btn btn-primary" onClick={() => addElement(createElement('irectangle'))}>Add iRectangle</button>
        <button className="btn btn-primary" onClick={() => addElement(createElement('text'))}>Add Text</button>
    </div>
);

export default Factory;