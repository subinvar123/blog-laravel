import axios from "axios";
import React, { useState } from "react";
import { useNavigate } from "react-router";
import { Link } from "react-router-dom";
import './Register.css';


const Register = () => {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [password_confirmation, setPassword_confirmation] = useState("");
    const history = useNavigate();

    const handleSubmit = (e) => {
        e.preventDefault();
        axios
            .post("https://projectlatest.ddev.site/api/register", {
                name: name,
                email: email,
                password: password,
                password_confirmation: password_confirmation
            })
            .then(() => {
                history("/");
            });
    };

    return (
        <>
            <div className="box">
                <div className="relative">
                    <div className="form absolute">
                        <form>
                            <h2>Create</h2>
                            <div className="mb-3">
                                <label className="form-label">Name</label>
                                <input
                                    type="text"
                                    className="form-control"
                                    onChange={(e) => setName(e.target.value)}
                                />
                            </div>

                            <div className="mb-3">
                                <label className="form-label">Email address</label>
                                <input
                                    type="email"
                                    className="form-control"
                                    aria-describedby="emailHelp"
                                    onChange={(e) => setEmail(e.target.value)}
                                />
                            </div>
                            <div className="mb-3">
                                <label className="form-label">password</label>
                                <input
                                    type="text"
                                    className="form-control"
                                    aria-describedby="emailHelp"
                                    onChange={(e) => setPassword(e.target.value)}
                                />
                            </div>
                            <div className="mb-3">
                                <label className="form-label">password_confirmation</label>
                                <input
                                    type="text"
                                    className="form-control"
                                    aria-describedby="emailHelp"
                                    onChange={(e) => setPassword_confirmation(e.target.value)}
                                />
                            </div>

                            <button
                                type="submit"
                                className="btn btn-primary"
                                onClick={handleSubmit}
                            >
                                Submit
                            </button>
                        </form>
                    
                    </div>
                </div>

            </div>


        </>
    );
};

export default Register;