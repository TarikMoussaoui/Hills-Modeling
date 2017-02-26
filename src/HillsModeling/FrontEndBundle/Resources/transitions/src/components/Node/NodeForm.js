import React from 'react';
import { Field, reduxForm } from 'redux-form';

let NodeForm = ({handleSubmit}) => (
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label htmlFor="dot">Dot :</label>
          <div className="radio">
            <label><Field name="dot" component="input" type="radio" value="right" className="radio"/> Right</label>
          </div>
          <div className="radio">
            <label><Field name="dot" component="input" type="radio" value="left" className="radio"/> Left</label>
          </div>
          <div className="radio">
            <label><Field name="dot" component="input" type="radio" value="top" className="radio"/> Top</label>
          </div>
          <div className="radio">
            <label><Field name="dot" component="input" type="radio" value="bottom" className="radio"/> Bottom</label>
          </div>
        </div>
        <button className="btn btn-success" type="submit">Enregistrer</button>
      </form>
  );

NodeForm = reduxForm({
  form: 'node',
  enableReinitialize: true
})(NodeForm);

export default NodeForm;