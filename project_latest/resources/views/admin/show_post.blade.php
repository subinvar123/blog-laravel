<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        .img_deg {
            height: 100px;
            width: 150px;
            padding: 10px;
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
            @if(session()->has('deletemessage'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden='true'>x</button>
                {{ session()->get('deletemessage') }}
            </div>
            @endif

            <h1 class="post_title">Post Listing</h1>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>User ID</th>
                        <th>Post Status</th>
                        <th>User Type</th>
                        <th>Delete</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($post as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td><img class="img_deg" src="postimage/{{ $post->image }}" /></td>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->user_id }}</td>
                        <td>{{ $post->post_status }}</td>
                        <td>{{ $post->usertype }}</td>
                        <td>
                            <a href="{{ url('delete_post/'.$post->id) }}" class="delete-btn" onclick="confirmation(event)">Delete</button>

                        </td>
                        <td> <button><a href="{{ url('edit_post/'.$post->id) }}" class="success-btn">Edit</button></td>
                        <td><a href="{{ url('approve/'.$post->id.'?value=1') }}" class="success-btn"><button value="1" type="button">Approve</button></a></td>
                        <td><a href="{{ url('reject/'.$post->id.'?value=2') }}" class="success-btn"><button value="2" type="button">Reject</button></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
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