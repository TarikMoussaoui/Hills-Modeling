import React from 'react';
import { Field, reduxForm } from 'redux-form';

let IrectangleForm = ({handleSubmit}) => (
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label htmlFor="label">Label :</label>
          <Field name="label" component="input" type="text" className="form-control"/>
        </div>
        <div className="form-group">
          <label htmlFor="properties">Properties :</label>
          <Field name="properties" component="input" type="text" className="form-control"/>
        </div>
        <div className="form-group">
          <label htmlFor="activities">Activities :</label>
          <Field name="activities" component="input" type="text" className="form-control"/>
        </div>
        <button className="btn btn-success" type="submit">Enregistrer</button>
      </form>
  );

IrectangleForm = reduxForm({
  form: 'irectangle',
  enableReinitialize: true
})(IrectangleForm);

export default IrectangleForm;