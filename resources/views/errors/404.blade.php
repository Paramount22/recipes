

{{--@section('title', __('Not Found'))--}}
{{--@section('code', '404')--}}
{{--@section('message', __('Not Found'))--}}
    <!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>404 Not Found</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #f1f1f1;
        }

        .not-found {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }
        .title-code {
            font-size: 10rem;
        }
        h2 {
            font-size: 4rem;
            margin-bottom: 2rem;
        }
        .btn {
            font-size: 2rem;
        }
    </style>
</head>
<body class="container">
<div class="not-found">
    <h1 class="title-code">404</h1>
    <h2>Page was not found <i class="far fa-sad-tear"></i></h2>
    <a class="btn btn-success" href="{{url('/')}}">Home</a>
</div>




<!-- Optional JavaScript; choose one of the two! -->


</body>
</html>

