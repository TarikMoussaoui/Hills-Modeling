import { connect } from 'react-redux';
import { addElement } from './../../actions';
import Factory from './Factory';

const mapDispatchToProps = (dispatch, ownProps) => {
  return {
    addElement: (element) => {
      dispatch(addElement(element))
    }
  }
}

const FactoryContainer = connect(
  null,
  mapDispatchToProps
)(Factory);

export default FactoryContainer;
