import React from 'react';
import Draggable from 'react-draggable';

const BlackCircle = () => (
    <Draggable
        defaultPosition={{x: 10, y: 10}}
    >
    <g>
        <circle cx="0" cy="0" r="10px"/>
    </g>
    </Draggable>
);

export default BlackCircle;