import PropTypes from 'prop-types';
import React from 'react';

function AffiliatesTable(props) {
    return (
        <div className="col-md-6">
            <div className="card h-100">
                <div className="card-header">Affiliates Within distance</div>
                <div className="card-body">
                    <table className="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">ID</th>
                            <th scope="col">lat</th>
                            <th scope="col">lon</th>
                        </tr>
                        </thead>
                        <tbody>
                        {props.affiliates && props.affiliates.map((affiliate, index) => (
                            <tr>
                            <th scope="row">{index + 1}</th>
                            <td>{affiliate.name}</td>
                            <td>{affiliate.affiliate_id}</td>
                            <td>{affiliate.lat}</td>
                            <td>{affiliate.lon}</td>
                            </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
}

AffiliatesTable.propTypes = {
    affiliates: PropTypes.array.isRequired,
};

export default AffiliatesTable;
