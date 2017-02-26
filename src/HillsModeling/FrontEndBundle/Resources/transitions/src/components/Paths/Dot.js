import React from 'react';
import Draggable from 'react-draggable';

const Dot = ({cx, cy, moveDot}) => {
    <Draggable
        onDrag={moveDot}
    >
        <circle cx={cx} cy={cy} r="3" />
    </Draggable>
}

export default Dot;