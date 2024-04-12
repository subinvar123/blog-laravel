import axios from "axios";
import React, { useState, useEffect } from "react";
import { useParams, useNavigate } from "react-router";
import '../Create/Create.css';
import Navbar from '../../Header/Navbar';

const Edit = () => {
    const [post, setPost] = useState({}); // State to store post details
    const [title, setTitle] = useState("");
    const [description, setDescription] = useState("");
    const [image, setImage] = useState(null);
    const { id } = useParams(); // Get the post ID from the URL
    const history = useNavigate();

    useEffect(() => {
        // Fetch post details when the component mounts
        const fetchPostDetails = async () => {
            try {
                const token = localStorage.getItem('token'); // Get the token from localStorage
                const response = await axios.get(`https://projectlatest.ddev.site/api/edituserpost/${id}`, {
                    headers: {
                        'Authorization': `Bearer ${token}` // Include the token in the request headers
                    }
                });
    
                const postData = response.data.post; // Access post data under "post" key
                setPost(postData); // Set the post details to the state
                setTitle(postData.title);
                setDescription(postData.description);
            } catch (error) {
                console.error('Error fetching post details:', error);
            }
        };
    
        fetchPostDetails();
    }, [id]); // Include id in the dependency array

    const handleSubmit = (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append('title', title);
        formData.append('description', description);
        formData.append('image', image);

        const token = localStorage.getItem('token'); // Get the token from localStorage

        axios
            .post(`https://projectlatest.ddev.site/api/updateuserpost/${id}`, formData, {
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
                            <h2>Edit</h2>
                            <div className="mb-3">
                                <label className="form-label">Post Title</label>
                                <input
                                    type="text"
                                    className="form-control"
                                    value={title}
                                    onChange={(e) => setTitle(e.target.value)}
                                />
                            </div>

                            <div className="mb-3">
                            <label className="form-label">Post Description</label>
                                {/* Change type from "description" to "text" */}
                                <input
                                    type="text"
                                    className="form-control"
                                    value={description}
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

export default Edit;
