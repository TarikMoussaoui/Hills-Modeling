import React from 'react';
import Draggable from 'react-draggable';

const Irectangle = ({isSelected, values, selectElement, updateElement}) => (
  <Draggable 
        position={values.position}
        onStart={selectElement}
        onStop={updateElement}
    >
      <g className={isSelected ? "selected rectangle" : "rectangle"}>
        <rect x="0" y="0" width="200" height="100"/>
        <rect x="0" y="0" width="190" height="100"/>
        <rect x="0" y="0" width="190" height="20"/>
        <rect x="0" y="20" width="190" height="20"/>
        <rect x="0" y="40" width="190" height="20"/>
        <text x="100" y="10">{values.label}</text>
        <text x="100" y="30">{values.properties}</text>
        <text x="100" y="50">{values.activities}</text>
      </g>
  </Draggable>
);

export default Irectangle;