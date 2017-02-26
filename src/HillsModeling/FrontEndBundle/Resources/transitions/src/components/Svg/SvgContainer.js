import { connect } from 'react-redux';
import { selectElement, updateElement } from './../../actions';
import { getElementListByType } from './../../reducers/element';
import Svg from './Svg';

const mapStateToProps = (state) => {
  return {
    element: state.element,
    elements: {
      circles: getElementListByType(state.element, 'circle'),
      nodes: getElementListByType(state.element, 'node'),
      rectangles: getElementListByType(state.element, 'rectangle'),
      irectangles: getElementListByType(state.element, 'irectangle'),
      texts: getElementListByType(state.element, 'text')
    },
    selectedId: state.element.selectedId
  }
}

const mapDispatchToProps = (dispatch, ownProps) => {
  return {
    selectElement : (id) => {
      dispatch(selectElement(id))
    } ,
    updateElement : (element, event, ui) => {
      dispatch(updateElement(Object.assign({}, element, {position: {x: ui.x, y: ui.y}})))
    }
  }
}

const ElementsList = connect(
  mapStateToProps,
  mapDispatchToProps
)(Svg);

export default ElementsList;
