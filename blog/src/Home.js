import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './Css/User.css'; // Import CSS for styling
import Navbar from './Header/Navbar';
import { Link, useNavigate } from "react-router-dom";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faThumbsUp } from '@fortawesome/free-solid-svg-icons';
import { faThumbsDown } from '@fortawesome/free-solid-svg-icons';



const User = () => {
  const [hasLike, setHasLike] = useState({});

  const [likesCounts, setLikesCounts] = useState({});
  const [userdetails, setUserdetails] = useState([]);
  const [userData, setUserData] = useState(null);
  const [selectedCategory, setSelectedCategory] = useState(null);
  const [searchQuery, setSearchQuery] = useState('');
  const [showLoginPopup, setShowLoginPopup] = useState(false);
  const navigate = useNavigate();
  const [showAllPosts, setShowAllPosts] = useState(false);
  const subscription = localStorage.getItem('subscription');
  const [showSubscriptionPopup, setShowSubscriptionPopup] = useState(false); // Define showSubscriptionPopup state
  //console.log(likesCounts);


  useEffect(() => {
    const fetchUserDetails = async () => {
      try {
        const response = await axios.get('https://projectlatest.ddev.site/api/homepage', {
          params: {
            category: selectedCategory
          }
        });
        console.log(response.data);
        setUserdetails(response.data.userdetails);
        setUserData(response.data); // Set the received data  the state

      } catch (error) {
        console.error('Error fetching user details:', error);
      }

      // const handleReadMoreClick = (postId) => {
      //   if(postId == ){}
      // }
    };
    // const fetchLikesCounts = async () => {
    //   try {
    //     const response = await axios.get('https://projectlatest.ddev.site/api/postLike');
    //     console.log(response.data);
    //     // Assuming the response is an object where keys are post IDs and values are like counts
    //     //setLikesCounts(response);
    //   } catch (error) {
    //     console.error('Error fetching likes counts:', error);
    //   }
    // };
    // fetchLikesCounts();
    fetchUserDetails();
  }, [selectedCategory]);

  const handleCategoryClick = (categoryId) => {
    setSelectedCategory(categoryId);
  };

  const handleSearchInputChange = async (event) => {
    setSearchQuery(event.target.value);
    try {
      const response = await axios.get('https://projectlatest.ddev.site/api/homepage', {
        params: {
          search: event.target.value,
          category: selectedCategory
        }
      });
      // setLikesCounts(prevLikesCounts => ({
      //   ...prevLikesCounts,
      //   [postId]: response.data.likes_count
      // }));

      setUserData(response.data); // Set the received data  the state

    } catch (error) {
      console.error('Error fetching user details:', error);
    }
  };

  const handleReadMoreClick = (postId) => {
    const isLoggedIn = localStorage.getItem('token');
    if (isLoggedIn) {
      navigate(`/Detail/${postId}`);
      console.log("Navigating to detail page...");
    } else {
      // Show login popup
      setShowLoginPopup(true);
    }
  };
  const isLoggedIn = localStorage.getItem('token');
  const handleBrowseAllClick = () => {
    if (subscription === '1') {
      setShowAllPosts(true);
    } else {
      // Check if user is logged in
      if (isLoggedIn) {
        // Show subscription popup
        setShowSubscriptionPopup(true);
      } else {
        // Redirect user to login page
        window.location.href = '/login'; // Modify the URL according to your application's routing
      }
    }
  };

  const handleShowLessClick = () => {
    setShowAllPosts(false);
  };

  const handleLikeClick = async (postId, hasLike) => {
    if (isLoggedIn) {

    try {
      const value = hasLike ? 0 : 1;
      const user_id = localStorage.getItem('user_id');
      const response = await axios.post('https://projectlatest.ddev.site/api/postLike', {
        postid: postId,
        user_id: user_id,
        value: value
      });
      const { data } = response;

      // Update the like count for the specific post
      setLikesCounts(prevLikesCounts => ({
        ...prevLikesCounts,
        [postId]: data.likes_count
      }));
      setHasLike(prevHasLike => ({
        ...prevHasLike,
        [postId]: !hasLike // Toggle like status for the specific post
      }));

      // Fetch the updated userData after the like operation to reflect the new like count
      const updatedResponse = await axios.get('https://projectlatest.ddev.site/api/homepage', {
        params: {
          category: selectedCategory
        }
      });
      // Update the userData state with the new data
      setUserData(updatedResponse.data);
    } catch (error) {
      console.error('Error liking post:', error);
    }
  }
  };


  return (
    <>
      <Navbar />

      <body className="home-page">
        <div className="header-wrapper header-wrapper-home">
          <div className="bg-slider-wrapper">
            <div id="bg-slider" className="flexslider bg-slider">
              <ul className="slides">
                <li class="slide slide-1"></li>
              </ul>
            </div>
          </div>
          <section id="home-promo" className="home-promo section">
            <div className="container text-center">
              <h2 className="title">
                <span className="upper">We build</span>
                <span className="middle">Web and Mobile Apps</span>
                <span className="bottom">for startups and agencies</span>
              </h2>
              <Link to="/About" className="btn btn-cta btn-cta-primary" type="button" data-toggle="modal" data-target="#modal-contact" data-backdrop="static">More about us</Link>
            </div>
          </section>
        </div>
      </body>
      <section id="who" className="who section">
        <div className="container text-center">
          <h2 className="title text-center">Who we are</h2>
          <p className="intro text-center">We are a small team of web developers and designers based in XYZ. We are specialised in JavaScript, AngularJS and Python. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
          <section id="categories" className="section">
            <div className="container text-center">
              <h2 className="title">Browse by Category</h2>
              <div className="category-list">
                {userData &&
                  userData.categories &&
                  userData.categories.length > 0 &&
                  userData.categories.map((category) => (
                    <button
                      key={category.id}
                      onClick={() => handleCategoryClick(category.id)}
                      className="category-item"
                    >
                      {category.category_name}
                    </button>
                  ))}
              </div>
            </div>
          </section>
          {/* Search Form */}
          <input
            type="text"
            placeholder="Search by title..."
            value={searchQuery}
            onChange={handleSearchInputChange}
            style={{
              padding: '10px',
              fontSize: '16px',
              border: '1px',
              borderRadius: '50px',
              width: '60%',
              marginBottom: '10px',
              border: 'none',
              outline: 'none'
            }}
          />
          <div className="row benefits text-center">
            <div className="blog-grid">
              <div className="container">
                <div className="row">
                  {userData ? (
                    userData.post && userData.post.length > 0 ? (
                      userData.post.slice(0, showAllPosts ? userData.post.length : 3).map((post, index) => (
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
                              <p>{post.date}</p>
                            </div>
                            {/* Like button */}
                            {/* <button className="btn-like" onClick={() => handleLikeClick(post.id)}>
                              <FontAwesomeIcon icon={faThumbsUp} />
                            </button>{Object.keys(likesCounts).map(postId => (
                              <p key={postId} className="likes-count">Likes: {likesCounts[postId]}</p>
                            ))} */}
                            {/* You can style this button as needed */}
                            {/* <button className="btnmore" onClick={() => handleReadMoreClick(post.id)}>Read More</button> */}

                            <button className="btn-like" onClick={() => handleLikeClick(post.id, hasLike[post.id])}>
                              {hasLike[post.id] ?
                                <span title="Unlike"><FontAwesomeIcon icon={faThumbsDown} /></span> :
                                <span title="Like"><FontAwesomeIcon icon={faThumbsUp} /></span>
                              }
                            </button>
                            <p className="likes-count">Likes : {post.likes_count}</p>
                            {/* <button className="btn btn-secondary btn-sm m-1 disabled">Count : {post.likes_count}</button><br></br> */}
                            <button className="btnmore" onClick={() => handleReadMoreClick(post.id)}>Read More</button>

                            {/* <Link to={`/Detail/${post.id}`} className="btnmore">Read More</Link> */}
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
          {!showAllPosts ? (
            <button className="btn btn-cta btn-cta-secondary" onClick={handleBrowseAllClick}>Browse all</button>
          ) : (
            <button className="btn btn-cta btn-cta-secondary" onClick={handleShowLessClick}>Show less</button>
          )}

        </div>
        <div className="user-container">
          <h1>Authors</h1>
          <div className="user-list">
            {userdetails
              .filter(user => user.usertype === "user")
              .map((user, index) => (
                <div className="user-card" key={index}>
                  <div className="profile-image" style={{ backgroundImage: `url('/images/uIgDDDd(1).jpg')` }}>
                    {/* You can add an image here if available */}
                  </div>
                  <div className="user-info">
                    <p>{user.name}</p>
                    <p>{user.email}</p>
                  </div>
                </div>
              ))}
          </div>
        </div>

      </section>
      <section id="cta-section" class="cta-section section text-center home-cta-section">
        <div class="container">
          <h2 class="title">Want to have a quick chat?</h2>
          <p class="phone contact-info">
            <span class="intro">We are only a phone call away</span>
            <span class="info"><a href="tel:+08001234567">0800 123 4567</a></span>
          </p>
          <p class="email contact-info">
            <span class="intro">You can also email us</span>
            <span class="info"><a href="mailto:hello@yourdevstudio.com">hello@yourdevstudio.com</a></span>
          </p>
        </div>
      </section>
      {showLoginPopup && (
        <div className="login-popup">
          <p>Please log in to view the details.</p>
          <Link to="/login">Log in</Link>
          <button className="close-btn" onClick={() => setShowLoginPopup(false)}>Close</button>
        </div>
      )}
      {showSubscriptionPopup && (
        <div className="subscription-popup">
          <p>Please subscribe to access more content.</p>
          <Link to="/subscribe">Subscribe</Link>
          <button className="close-btn" onClick={() => setShowSubscriptionPopup(false)}>Close</button>
        </div>
      )}

    </>
  );
};

export default User;
