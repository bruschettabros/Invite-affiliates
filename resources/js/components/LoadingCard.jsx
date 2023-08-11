import PropTypes from 'prop-types';
import React from 'react';

function LatLonPicker(props) {
    return (
        <div className="col-md-6">
            <div className="card h-100">
                <div className="card-header">{props.title}</div>
                <div className="card-body">
                    <div className="d-flex justify-content-center">
                        <div className="spinner-border" role="status">
                            <span className="sr-only"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

LatLonPicker.propTypes = {
    title: PropTypes.string.isRequired,
};

export default LatLonPicker;
