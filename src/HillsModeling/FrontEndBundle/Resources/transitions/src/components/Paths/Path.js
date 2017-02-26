import React from 'react';
import Dot from './Dot';

const Path = ({dots, moveDot}) => {
    <g>
        <path />
        {dots.map( (dot) =>
            <Dot cx={dot.cx} cy={dot.cy} moveDot={moveDot}/>
        )}
    </g>
}

export default Path;