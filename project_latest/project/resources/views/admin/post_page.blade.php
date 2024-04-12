<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
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

        .d-flex {
            display: flex;
        }

        .align-items-stretch {
            align-items: stretch;
        }

        .page-content {
            flex-grow: 1;
            padding: 20px;
        }

        .post_title {
            text-align: center;
            color: white;
            font-size: 60px;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        form {
            background-color: LightGray;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
            /* Center the form */
            width: 60%;
            /* Set the width of the form */
        }

        label {
            display: block;
            margin-bottom: 12px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: green;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            /* Make the button full-width */
        }

        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>

<body>
    <header class="header">
        @include('admin.header')
    </header>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden='true'>x</button>
                {{ session()->get('message') }}
            </div>
            @endif

            <h1 class="post_title">Add Post</h1>
            <form action="{{ url('add_post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="title">Post Title:</label>
                <input type="text" name="title" required>

                <label for="description">Post Description:</label>
                <textarea name="description" required></textarea>

                <label for="image">Add Image:</label>
                <input type="file" name="image" accept="image/*">

                <button type="submit">Submit Post</button>
            </form>
            <footer class="footer">
                <div class="footer__block block no-margin-bottom">
                    <div class="container-fluid text-center">
                        <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank"
                                href="https://templateshub.net">Templates Hub</a>.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="Admincss/vendor/jquery/jquery.min.js"></script>
    <script src="Admincss/vendor/popper.js/umd/popper.min.js"></script>
    <script src="Admincss/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="Admincss/vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="Admincss/vendor/chart.js/Chart.min.js"></script>
    <script src="Admincss/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="Admincss/js/charts-home.js"></script>
    <script src="Admincss/js/front.js"></script>
</body>

</html>
