import React, { useState, useEffect } from "react";
import { Link, useParams, useNavigate } from "react-router-dom";
import axios from "axios";
import Navbar from '../../Header/Navbar';
import './Detail.css';

const Detail = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const [showAllComments, setShowAllComments] = useState(false);
    const [commentData, setCommentData] = useState(null);
    const [userData, setUserData] = useState(null);
    const [commentText, setCommentText] = useState('');
    const [showCommentForm, setShowCommentForm] = useState(false);

    const fetchUserDetails = async () => {
        try {
            const response = await axios.get(`https://projectlatest.ddev.site/api/detail_post/${id}`);
            setUserData(response.data);
            setCommentData(response.data.comments);
        } catch (error) {
            console.error('Error fetching user details:', error);
        }
    };

    useEffect(() => {
        fetchUserDetails();
    }, [id, commentText]); // Make sure to include commentText in the dependency array

    const handleSubmitComment = async (event) => {
        event.preventDefault();
        try {
            await axios.post(`https://projectlatest.ddev.site/api/addComment/${id}`, {
                comment: commentText
            });
            // Reset the comment text after submitting
            setCommentText('');
            // Hide the comment form
            setShowCommentForm(false);
            // Fetch updated user details to reflect the new comment
            fetchUserDetails();
        } catch (error) {
            console.error('Error adding comment:', error);
        }
    };

    const handleCommentClick = () => {
        setShowCommentForm(true);
    };

    const handleCommentChange = (event) => {
        setCommentText(event.target.value);
    };

    const goBack = () => {
        //history.goBack(); // Navigate back to the previous page
        navigate('/')
    };

    return (
        <>
            <Navbar />
            <section id="who" className="who section">
                <div className="container text-center">
                    {/* Back button */}
                    <button className="back-button" onClick={goBack}>
                        Back
                    </button>
                    <h2 className="title text-center">{userData?.post?.title}</h2>
                    <div className="header_section">
                        <div className="containers">
                            <div className="row">
                                {userData && userData.post ? (
                                    <div className="col-md-12">
                                        <div className="blog-list-description">
                                            <h4><a href="#">{userData.post.title}</a></h4>
                                            {userData.post.image && (
                                                <img
                                                    src={userData.post.image_url}
                                                    alt={`Post image`}
                                                    className="post-image"
                                                    style={{ width: '100px', height: '100px' }} // Adjust width and height as needed
                                                />
                                            )}
                                            <p>{userData.post.description}</p>
                                            {/* Add comment section */}
                                            <div className="blog-list-description">
                                                <button className="comment-button" onClick={handleCommentClick}>
                                                    <i className="fas fa-comment"></i> Comment
                                                </button>
                                                {/* Comment form */}
                                                {showCommentForm && (
                                                    <form onSubmit={handleSubmitComment} className="comment-form">
                                                        <textarea
                                                            value={commentText}
                                                            onChange={handleCommentChange}
                                                            placeholder="Enter your comment..."
                                                        />
                                                        <button type="submit">Submit</button>
                                                    </form>
                                                )}
                                                {/* Display comments */}
                                                <div className="comments-section">
                                                    {commentData && commentData.slice(0, showAllComments ? commentData.length : 2).map((comment, index) => (
                                                        <div key={index} className="comment">
                                                            <p>{comment.comment}</p>
                                                        </div>
                                                    ))}
                                                    {/* Show more button */}
                                                    {userData.comments && userData.comments.length > 3 && (
                                                        <button className="show-more-button" onClick={() => setShowAllComments(!showAllComments)}>
                                                            {showAllComments ? 'Show less' : 'Show more'}
                                                        </button>
                                                    )}
                                                </div>
                                               
                                            </div>
                                        </div>
                                         {/* Back button */}
                                         <button className="back-button" onClick={goBack}>
                                                    Back
                                                </button>
                                    </div>
                                ) : (
                                    <p className="no-posts">No posts available</p>
                                )}
                            </div>
                        </div>

                    </div>
                    <Link to="/About" className="btn btn-cta btn-cta-secondary">More about us</Link>
                </div>
            </section>
        </>
    );
};

export default Detail;
