import React from 'react';
import Draggable from 'react-draggable';
import './Text.css';

const Text = ({isSelected, values, selectElement, updateElement}) => (
  <Draggable 
        position={values.position}
        onStart={selectElement}
        onStop={updateElement}
    >
      <g className={isSelected ? "selected text-wrapper" : "text-wrapper"}>
        <rect x="0" y="0" width="200" height="40"/>
        <text x="100" y="10">{values.text}</text>
      </g>
  </Draggable>
);

export default Text;