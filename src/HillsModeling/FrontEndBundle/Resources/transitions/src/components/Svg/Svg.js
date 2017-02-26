import React, { Component } from 'react';
import './Svg.css';
import BlackCircle from './../BlackCircle/BlackCircle';
import Circle from './../Circle/Circle';
import Node from './../Node/Node';
import Rectangle from './../Rectangle/Rectangle';
import Irectangle from './../iRectangle/Irectangle';
import Text from './../Text/Text';


class Svg extends Component {
    isSelected(id) {
        const {selectedId} = this.props;
        return id === selectedId;
    }
    render() {
        const {elements, selectElement, updateElement} = this.props;

        return (
            <svg id="main-svg" width="600px" height="600px">
                <BlackCircle />
                {elements.texts.map((text) => 
                    <Text key={text.id} values={text} selectElement={selectElement.bind(this, text.id)} isSelected={this.isSelected(text.id)} updateElement={updateElement.bind(this, text)}/> 
                )}
                {elements.circles.map( (circle) =>
                    <Circle key={circle.id} values={circle} selectElement={selectElement.bind(this, circle.id)} isSelected={this.isSelected(circle.id)} updateElement={updateElement.bind(this, circle)}/>
                )}
                {elements.nodes.map( (node) =>
                    <Node key={node.id} values={node} selectElement={selectElement.bind(this, node.id)} isSelected={this.isSelected(node.id)} updateElement={updateElement.bind(this, node)}/>
                )}
                {elements.rectangles.map( (rectangle) =>
                    <Rectangle key={rectangle.id} values={rectangle} selectElement={selectElement.bind(this, rectangle.id)} isSelected={this.isSelected(rectangle.id)} updateElement={updateElement.bind(this, rectangle)}/>
                )}
                {elements.irectangles.map( (irectangle) =>
                    <Irectangle key={irectangle.id} values={irectangle} selectElement={selectElement.bind(this, irectangle.id)} isSelected={this.isSelected(irectangle.id)} updateElement={updateElement.bind(this, irectangle)}/>
                )}
            </svg>
        );
    }
}

export default Svg;