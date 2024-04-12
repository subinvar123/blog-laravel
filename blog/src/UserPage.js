import React, { useState, useEffect } from 'react';
import axios from 'axios';

import Navbar from './Header/Navbar';
import { Link } from "react-router-dom";

const User = () => {
  const [userData, setUserData] = useState(null);

  useEffect(() => {
    const fetchUserDetails = async () => {
      try {
        const token = localStorage.getItem('token');
        const response = await axios.get('https://projectlatest.ddev.site/api/showuserpost', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        console.log(response.data);
        setUserData(response.data); // Set the received data to the state
      } catch (error) {
        console.error('Error fetching user details:', error);
      }
    };

    fetchUserDetails();
  }, []);

  // function handleDelete(id) {
  //   const token = localStorage.getItem('token');
  //   axios.get(`https://projectlatest.ddev.site/api/deleteuserpost/${id}`, {
  //     headers: {
  //       Authorization: `Bearer ${token}`
  //     }
  //   })
  //     .then(() => {
  //       return
  //     });
  // }
  function handleDelete(id) {
    const token = localStorage.getItem('token');
    axios.get(`https://projectlatest.ddev.site/api/deleteuserpost/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
      .then(response => {
        // Show success message to the user
        console.log(response.data.deletemessage); // Log the message to console
        // Remove the deleted post from userData state
        setUserData(prevUserData => ({
          ...prevUserData,
          post: prevUserData.post.filter(post => post.id !== id)
        }));
      })
      .catch(error => {
        console.error('Error deleting post:', error);
        // Optionally, handle errors here
      });
  }


  return (
    <>
      <Navbar />
      <section id="who" className="who section">
        <div className="container text-center">
          <h2 className="title text-center">Who we are</h2>
          <p className="intro text-center">We are a small team of web developers and designers based in XYZ. We are specialised in JavaScript, AngularJS and Python. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
          <div className="row benefits text-center">
            <div className="blog-grid">
              <div className="container">
                <div className="row">
                  {userData ? (
                    userData.post && userData.post.length > 0 ? (
                      userData.post.map((post, index) => (
                        <div className="col-md-4" key={post.id}>
                          <div className="blog-list">
                            <div className="blog-list-img">
                              {post.image && (
                                <img
                                  src={post.image_url}
                                  alt={`Post ${index + 1}`}
                                  className="post-image"
                                  style={{ width: '100px', height: '100px' }} // Adjust width and height as needed
                                />
                              )}
                            </div>
                            <div className="blog-list-description">
                              <h4><a href="#">{post.title}</a></h4>
                              <p>{post.description}</p>
                              {/* Edit and Delete buttons */}
                              <div className="edit-delete-buttons">
                                <Link to={`/Edit/${post.id}`} className="btn btn-primary btn-sm">Edit</Link>
                                <button onClick={() => handleDelete(post.id)} className="btn btn-danger btn-sm">Delete</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      ))
                    ) : (
                      <p className="no-posts">No posts available</p>
                    )
                  ) : (
                    <p className="loading">Loading user details...</p>
                  )}
                </div>
              </div>
            </div>
          </div>
          <Link to="/About" className="btn btn-cta btn-cta-secondary">More about us</Link>
        </div>
      </section>
    </>
  );
};

export default User;
