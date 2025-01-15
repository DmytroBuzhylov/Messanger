<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мессенджер</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>


        body {
            background-color: #212f42;
        }
        nav {
            background-color: #212f42 !important;
        }
        nav .nav-link {
            color: #212f42 !important;
        }
        nav .nav-link:hover {
            color: #212f42 !important;
        }
        .scrollable {
            max-height: calc(100vh - 56px);
            overflow-y: auto;
        }
        .chat-box {
            max-height: calc(100vh - 112px);
            overflow-y: auto;
        }
        .form-footer {
            background-color: #6c757d;
        }
        .form-footer input {
            background-color: #495057;
            color: #ffffff;
        }
        .form-footer input::placeholder {
            color: #adb5bd;
        }
        .form-footer button {
            background-color: #343a40;
            border: none;
        }
        .form-footer button:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary" >
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('main') }}">Мессенджер</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('main') }}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile') }}">Профиль</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Авторизация</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



@yield('content')



</body>
</html>
