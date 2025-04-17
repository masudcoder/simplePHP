<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Simple Search Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 70px;
        }

        footer {
            position: fixed;
            bottom: 0;
            margin: 10px 0 0 0;
            width: 100%;
            background-color: #176B35;
            padding: 10px 0;
            text-align: center;
            color: #fff;
        }

        .company-name {
            padding: 0 0 8px 0;
            margin: 0 0 8px 0;
            font-weight: bold;
            font-size: 20px;
        }

        .inline-form-group {
            display: flex;
            align-items: center;
        }

        .inline-form-group label {
            margin-right: 10px;
            /* Adjust as needed */
        }

        .customer-submit-btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="company-name text-center">A Tree Care Website</div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-inline text-center" method="POST" action="{{ url('/')}}">
                    <div class="form-group">
                        <input type="text" class="form-control" required name="ref_id" placeholder="Search by Ref Id">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                    @csrf
                </form>
            </div>
        </div>

        <hr>

        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif


        <!-- Search Result Table -->
        @if(isset($data['bid_info']))
        @if(empty($data['bid_info']))
        NOt found
        @else
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product/Service</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Total @php $total = 0; @endphp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['bid_services_data'] as $service)
                        <tr>
                            <td><input type="checkbox"> {{ $service->service_description}}</td>
                            <td>{{ $service->qty}}</td>
                            <td>{{ $service->unit_price}}</td>
                            <td>$@php $total += $service->qty * $service->unit_price; @endphp {{ $service->qty * $service->unit_price }}</td>
                        </tr>
                        @endforeach
                        <!-- More rows can go here -->
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-sm-offset-10 col-md-offset-10 col-sm-1 col-md-1 text-right">
                        <strong>Total: </strong>
                    </div>
                    <div class="col-sm-1 col-md-1 text-left">
                        <strong> ${{ $total}}</strong>
                    </div>
                </div>

                <div class="row">
                    <form method="POST" action="{{url('/submitBid')}}">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group inline-form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                            </div>

                            <!-- Phone Field -->
                            <div class="form-group inline-form-group">
                                <label for="phone">Phone:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                            </div>

                            <!-- Email Field -->
                            <div class="form-group inline-form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                            </div>
                        </div>
                </div>

                <div class="row customer-submit-btn">
                    <div class="text-center">
                        <div class="flex">
                            <input type="hidden" name="id" value="{{ $data['bid_info']->id }}">
                            <button type="submit" disabled="disabled" name="action" value="2" class="btn btn-danger" style="margin-right: 30px;">Decline</button>
                            <button type="submit" name="action" value="3" class="btn btn-success" style="margin-right: 30px;">Accept & Submit</button>
                            <button type="submit" name="action" value="4" class="btn btn-info">Request In-Person Follow-Up</button>
                            @csrf
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @endif
        @endif

    </div>

    <!-- Footer -->
    <footer>
        <div class="container p-4">
            <div class="row">
                <!-- Column 1 -->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">

                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center p-3 bg-secondary">
            Do you want to discuss your bid with a Grade A representative? <br />Please call 816-214-6255 or email info@gradeatree.com.
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>