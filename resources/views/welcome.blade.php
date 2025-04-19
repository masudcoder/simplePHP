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

        .txt-bold-red {
            color: red;
            font-weight: bold;
        }

        .txt-bold {
            font-weight: bold;
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
                        <input type="text" class="form-control" required name="ref_id" placeholder="Search by Ref. ID" value="@if(!empty($data['search_by'])) {{ $data['search_by'] }}@endif">
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
        @if(isset($data['show_search_result']) && empty($data['bid_info']))
        <div class="row">
            <div class="col-md-12 text-center txt-bold-red">Sorry, Invalid Ref. ID</div>
        </div>
        @endif

        @if(!empty($data['bid_info']))
        <div class="row">
            <div class="col-md-12 text-center">Ref. ID: {{ str_pad($data['bid_info']->id, 6, '0', STR_PAD_LEFT) }}. Address: {{ $data['bid_info']->address}}</div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 70%;">Product/Service</th>
                            <th style="width: 10%;">Qty</th>
                            <th style="width: 10%;">Unit Price</th>
                            <th style="width: 10%;">Total @php $total = 0; @endphp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['bid_services_data'] as $key => $service)
                        <tr>
                            <td><input type="checkbox" name="services" value="{{ $service->bid_id}}" data-price="{{ $service->qty * $service->unit_price }}" id="chkboxService_{{ $service->id}}" class="chkboxService">
                                <label for="chkboxService_{{ $service->id}}"> {{ config('constants')[$key] }}</label><br>
                                {{ $service->service_description}}
                            </td>
                            <td>{{ $service->qty}}</td>
                            <td>{{ $service->unit_price}}</td>
                            <td>$@php $total += $service->qty * $service->unit_price; @endphp {{ number_format($service->qty * $service->unit_price, 2, '.', ',') }}</td>
                        </tr>
                        @endforeach
                        <!-- More rows can go here -->
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-sm-offset-10 col-md-offset-10 col-sm-1 col-md-1 txt-bold text-right">
                        Total:
                    </div>
                    <div class="col-sm-1 col-md-1 txt-bold text-left">
                        ${{ number_format($total, 2, '.', ',') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-10 col-md-offset-10 col-sm-1 col-md-1 txt-bold text-right">
                        SubTotal :
                    </div>
                    <div class="col-sm-1 col-md-1 txt-bold text-left" id="subtotal">
                        0.00
                    </div>
                </div>

                <div class="row">
                    <form method="POST" action="{{url('/submitBid')}}">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group inline-form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control customer-info" id="name" name="name" placeholder="Enter your name" required>
                            </div>

                            <!-- Phone Field -->
                            <div class="form-group inline-form-group">
                                <label for="phone">Phone:</label>
                                <input type="tel" class="form-control customer-info" id="phone" name="phone" placeholder="Enter your phone number" required>
                            </div>

                            <!-- Email Field -->
                            <div class="form-group inline-form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control customer-info" id="email" name="email" placeholder="Enter your email address" required>
                            </div>
                        </div>
                </div>

                <div class="row customer-submit-btn">
                    <div class="text-center">
                        <div class="flex">
                            <input type="hidden" name="id" value="{{ $data['bid_info']->id }}">
                            <button type="submit" name="action" value="2" class="btn btn-danger" style="margin-right: 30px;">Decline</button>
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

    <script>
        $(document).ready(function() {
            // On Change value
            $('.chkboxService').on('change', function() {
                calculateSubTotal();
            });

            function calculateSubTotal() {
                let subtotal = 0;
                const checkboxes = document.querySelectorAll('.chkboxService');
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        subtotal += parseFloat(checkbox.dataset.price);
                    }
                });

                $('#subtotal').html('$' + (subtotal.toFixed(2)));
            }


            // populate customer data in form
            document.querySelectorAll('.customer-info').forEach(input => {
                const savedValue = localStorage.getItem(input.id);
                if (savedValue) {
                    input.value = savedValue;
                }
                // Add input listener to save changes
                input.addEventListener('input', () => {
                    localStorage.setItem(input.id, input.value);
                });
            });


            // const customerInfos = document.querySelectorAll('.customer-info');

            // customerInfos.forEach(input => {
            //     input.addEventListener('input', function() {

            //     });

            // });
        });
    </script>

</body>

</html>
