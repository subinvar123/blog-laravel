import axios from "axios";
import React, { useState } from "react";
import { useNavigate } from "react-router";
import './Create.css';
import Navbar from '../../Header/Navbar';

const Create = () => {
    const [title, setTitle] = useState("");
    const [description, setDescription] = useState("");
    const [image, setImage] = useState(null);
    const history = useNavigate();

    const handleSubmit = (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append('title', title);
        formData.append('description', description);
        formData.append('image', image);

        const token = localStorage.getItem('token'); // Get the token from localStorage

        axios
            .post("https://projectlatest.ddev.site/api/addpost", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': `Bearer ${token}` // Include the token in the request headers
                }
            })
            .then(() => {
                history("/");
            })
            .catch(error => {
                console.error("Error:", error);
            });
    };

    return (
        <>
         <Navbar />
            <div className="box">
                <div className="relative">
                    <div className="form absolute">
                        <form>
                            <h2>Create</h2>
                            <div className="mb-3">
                                <label className="form-label">Post Title</label>
                                <input
                                    type="text"
                                    className="form-control"
                                    onChange={(e) => setTitle(e.target.value)}
                                />
                            </div>

                            <div className="mb-3">
                            <label className="form-label">Post Description</label>
                                {/* Change type from "description" to "text" */}
                                <input
                                    type="text"
                                    className="form-control"
                                    onChange={(e) => setDescription(e.target.value)}
                                />

                            </div>

                            <div className="mb-3">
                                <label className="form-label">Post Image</label>
                                <input
                                    type="file"
                                    className="form-control"
                                    accept="image/*"
                                    onChange={(e) => setImage(e.target.files[0])}
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

export default Create;
