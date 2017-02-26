import React from 'react';
import Draggable from 'react-draggable';
import './Circle.css';

const Circle = ({isSelected, values, selectElement, updateElement}) => (
  <Draggable
        position={{x: values.position.x, y: values.position.y}}
        onStart={selectElement}
        onStop={updateElement}
    >
      <g className={isSelected ? "selected circle" : "circle"}>
        <circle cx="0" cy="0" r={values.r}/>
        <text x="0" y="0">{values.label}</text>
      </g>
  </Draggable>
);

export default Circle;