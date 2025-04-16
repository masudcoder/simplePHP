<!doctype html>
<html lang="en">

<head>
    <title>Tree care</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .jumbotron {
            padding: 20px 5px;
        }

        .bg-grey {
            background-color: #f6f6f6;
        }

        .container-fluid {
            padding: 60px 50px;
        }

        .logo-small {
            color: #f4511e;
            font-size: 50px;
        }

        .logo {
            color: #f4511e;
            font-size: 200px;
        }

        .offer-info {
            padding: 0 0 20px 0;
        }

        .footer-bg {
            background-color: #176B35;
        }

        .table-wrapper {
            width: 90%;
            margin: 30px auto;
            font-family: Arial, sans-serif;
        }

        .table-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .table {
            display: flex;
            flex-direction: column;
            border: 1px solid #ccc;
        }

        .row {
            display: flex;
        }

        .cell {
            flex: 1;
            padding: 15px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .header {
            background-color: #f1f1f1;
            font-weight: bold;
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <!-- <ul class="navbar-nav ms-auto">
                       
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Worker Login</a>
                        </li>
                        @endif
                        @endguest
                    </ul> -->
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer class="footer-bg text-white text-center text-lg-start mt-5">
        <div class="container p-4">

            <div class="row">
                <!-- Column 1 -->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">My Website</h5>
                    <p>
                        Do you want to discuss your bid with a Grade A representative? <br />Please call 816-214-6255 or email info@gradeatree.com.
                    </p>
                </div>

                <!-- Column 2 -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#" class="text-white">About</a></li>
                        <li><a href="#" class="text-white">Services</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                    </ul>
                </div>

                <!-- Column 3 -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Follow Us</h5>
                    <ul class="list-unstyled d-flex justify-content-start gap-3">
                        <li><a href="#" class="text-white"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="#" class="text-white"><i class="bi bi-twitter"></i></a></li>
                        <li><a href="#" class="text-white"><i class="bi bi-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center p-3 bg-secondary">
            © 2025 Tree care — All Rights Reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>