import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom/client';
import LatLonPicker from './LatLonPicker.jsx';
import AffiliatesTable from './AffiliatesTable.jsx';

const InviteAffiliatesMain = () => {
    // Dublin office location as default
    const [lat, setLat] = useState(53.3340285);
    const [lon, setLon] = useState(-6.2535495);

    const [affiliates, setAffiliates] = useState([]);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        setLoading(true);
        axios.get('/api/affiliates', {
            params: {
                lat: lat,
                lon: lon,
            },
        }).then(response => {
            setAffiliates(response.data.data);
            setLoading(false);
        });
    }, [lat, lon]);

    return (
        <div className="container">
            <div className="row justify-content-center my-3">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header">Invite Affiliates</div>
                        <div className="container">
                            <div className="row justify-content-lg-start my-3">
                                {loading
                                    ? <div className="spinner-border" role="status">
                                        <span className="sr-only"></span>
                                    </div>
                                    : <AffiliatesTable affiliates={affiliates} />
                                }
                                <LatLonPicker
                                    lat={lat}
                                    lon={lon}
                                    setLat={setLat}
                                    setLon={setLon}
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

const root = ReactDOM.createRoot(document.getElementById('inviteAffiliatesMain'));
root.render(<InviteAffiliatesMain />);
