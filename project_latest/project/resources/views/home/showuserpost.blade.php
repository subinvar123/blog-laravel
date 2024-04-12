<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('home.homecss')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: black;
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

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .card {
            width: 300px;
            margin: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
        }

        .delete-btn,
        .edit {
            display: block;
            margin-top: 10px;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            text-align: center;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .edit {
            background-color: #04AA6D;
        }

        .edit:hover {
            background-color: #038153;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            /* Corrected */
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <header class="header">
        @include('home.header')
    </header>
    <div class="d-flex align-items-stretch">
        <div class="page-content">
            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden='true'>x</button>
                {{ session()->get('message') }}
            </div>
            @endif
            @if(session()->has('deletemessage'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden='true'>x</button>
                {{ session()->get('deletemessage') }}
            </div>
            @endif

            <h1 class="post_title">{{$username}} Blogs</h1>
            <div class="cards-container">
                @foreach($post as $post)
                <div class="card">
                    <img src="postimage/{{ $post->image }}" alt="{{ $post->title }}">
                    <div class="card-content">
                        <h4>{{ $post->title }}</h4>
                        <p>{{ $post->description }}</p>
                        <p>By: {{ $post->name }}</p>
                        <p>Status: {{ $post->post_status }}</p>
                        <a href="{{ url('deleteuserpost/'.$post->id) }}" class="delete-btn"
                            onclick="confirmation(event)">Delete</a>
                        <a href="{{ url('edituserpost/'.$post->id) }}" class="edit">Edit</a>
                    </div>
                </div>
                @endforeach
            </div>
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
    <!-- JavaScript files

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
<script>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
                title: "Are you sure to Delete this post",
                text: "You will not be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel) => {
                if (willCancel) {



                    window.location.href = urlToRedirect;

                }


            });


    }
</script>

</html>