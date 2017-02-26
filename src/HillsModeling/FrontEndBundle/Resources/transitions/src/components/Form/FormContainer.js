import { connect } from 'react-redux';
import Form from './Form';
import { updateElement } from './../../actions';
import { getElementById } from './../../reducers/element';

const mapStateToProps = (state) => {
  return {
    selectedElement: getElementById(state.element, state.element.selectedId),
  }
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return{
      updateElement: (element) => {
        dispatch(updateElement(element))
      }
    }
}

const FormContainer = connect(
  mapStateToProps,
  mapDispatchToProps
)(Form);

export default FormContainer;
