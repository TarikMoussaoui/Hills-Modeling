import React from 'react';
import { Field, reduxForm } from 'redux-form';

let TextForm = ({handleSubmit}) => (
      <form onSubmit={handleSubmit}>
        <div className="form-group">
          <label htmlFor="text">Text :</label>
          <Field name="text" component="textarea" className="form-control"/>
        </div>
        <button className="btn btn-success" type="submit">Enregistrer</button>
      </form>
  );

TextForm = reduxForm({
  form: 'text',
  enableReinitialize: true
})(TextForm);

export default TextForm;