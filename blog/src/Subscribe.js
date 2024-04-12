import React, { useState } from 'react';
import axios from 'axios';

const Subscribe = () => {
    const [successMessage, setSuccessMessage] = useState('');

    const handlePayment = (price, product, value) => {
        // Log the value to the console
        console.log('Value:', value);

        // Handle payment logic here
        // This is just a placeholder
        const successMessage = `Successfully purchased ${product} for $${price}`;
        setSuccessMessage(successMessage);

        console.log('Sending payment notification to API...');

        // Define headers object
        let headers = {
            'Content-Type': 'application/json',
        };

        // Check if token exists in local storage
        const token = localStorage.getItem('token');
        if (token) {
            headers['Authorization'] = `Bearer ${token}`;
        }

        // Make API request to notify successful payment using Axios
        axios.post('https://projectlatest.ddev.site/api/stripe', {
            value: value,
            price: price,
            product: product
        }, {
            headers: headers
        })
        .then(response => {
            console.log('Payment notification sent successfully!');
            // Handle success response here if needed
        })
        .catch(error => {
            console.error('Error notifying payment to API:', error);
            // Handle error here if needed
        });
    }
    

    return (
        <div className="container">
            {successMessage && (
                <div className="alert alert-success">
                    {successMessage}
                </div>
            )}

            <div className="row">
                <div className="col-md-4">
                    <div className="card" style={{ width: '18rem' }}>
                        <img src="https://dummyimage.com/300x200/000/fff" className="card-img-top" alt="Silver Product" />
                        <div className="card-body">
                            <h5 className="card-title">Silver</h5>
                            <p className="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation.
                            </p>
                            <button onClick={() => handlePayment(10, 'silver', 2)} className="btn btn-primary">Make Payment</button>
                        </div>
                    </div>
                </div>

                <div className="col-md-4">
                    <div className="card" style={{ width: '18rem' }}>
                        <img src="https://dummyimage.com/300x200/000/fff" className="card-img-top" alt="Gold Product" />
                        <div className="card-body">
                            <h5 className="card-title">Gold</h5>
                            <p className="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation.
                            </p>
                            <button onClick={() => handlePayment(100, 'gold', 1)} className="btn btn-primary">Make Payment</button>
                        </div>
                    </div>
                </div>

                <div className="col-md-4">
                    <div className="card" style={{ width: '18rem' }}>
                        <img src="https://dummyimage.com/300x200/000/fff" className="card-img-top" alt="Platinum Product" />
                        <div className="card-body">
                            <h5 className="card-title">Platinum</h5>
                            <p className="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation.
                            </p>
                            <button onClick={() => handlePayment(1000, 'platinum', 3)} className="btn btn-primary">Make Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Subscribe;
