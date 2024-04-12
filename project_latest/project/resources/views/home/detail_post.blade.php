<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homecss')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f8f9fa;
        }

        header {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .post_image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .post_title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .post_description {
            font-size: 16px;
            line-height: 1.5;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }

        services_img {
            width: 100%;
            /* Set the width to 100% to ensure it takes the full width of the container */
            height: auto;
            /* Automatically adjust the height to maintain the aspect ratio */
            max-height: 200px;
            /* Set a maximum height if needed */
            object-fit: cover;
            /* Ensure the image covers the entire container */
        }
    </style>
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
        <div class="container">
        <img class="post_image" src="postimage/{{ $post->image }}" alt="{{ $post->title }}">
        <h1 class="post_title">{{ $post->title }}</h1>
        <p class="post_description">{{ $post->description }}</p>
    </div>
</body>

</html>
<style>

</style>