import React, {Component} from 'react';
import CircleForm from './../Circle/CircleForm';
import NodeForm from './../Node/NodeForm';
import RectangleForm from './../Rectangle/RectangleForm'; 
import IrectangleForm from './../iRectangle/IrectangleForm'; 
import TextForm from './../Text/TextForm';

class Form extends Component {
    handleSubmit (values){
        const {updateElement, selectedElement} = this.props;
        updateElement(Object.assign({}, selectedElement, values));
    }
    handleForm(selectedElement) {
        if (!selectedElement) {
            return <h3>No element selected</h3>;
        }

        let form = '';

        switch(selectedElement.type) {
            case 'circle' :
            form = <CircleForm initialValues={selectedElement} onSubmit={this.handleSubmit.bind(this)}/>;
            break;

            case 'node' :
            form = <NodeForm initialValues={selectedElement} onSubmit={this.handleSubmit.bind(this)}/>
            break;

            case 'rectangle' :
            form = <RectangleForm initialValues={selectedElement} onSubmit={this.handleSubmit.bind(this)}/>
            break;

            case 'irectangle' :
            form = <IrectangleForm initialValues={selectedElement} onSubmit={this.handleSubmit.bind(this)}/>
            break;

            case 'text' :
            form = <TextForm initialValues={selectedElement} onSubmit={this.handleSubmit.bind(this)}/>
            break;
            
            default:
            return new Error('Unknow element type :' + selectedElement.type);
        }

        return <div><h3>A {selectedElement.type} is selected</h3>{form}</div>
    }
    render() {
        const {selectedElement} = this.props;
        return (
            <div id="form-container">
                {this.handleForm(selectedElement)}
            </div>
        );
    }
}

export default Form;