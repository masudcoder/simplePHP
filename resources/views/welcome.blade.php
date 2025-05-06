<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Grade A Tree Care</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap3.3.7.min.css') }}">
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

        .status-pending {
            color: #000;
        }

        .status-declined {
            color: red;
        }

        .status-accepted {
            color: green;
        }

        .status-requested {
            color: blue;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="company-name text-center">Grade A Tree Care</div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-inline text-center" method="GET" action="{{ url('/')}}">
                    <div class="form-group">
                        <input type="text" class="form-control" required name="ref_id" placeholder="Search by Ref. ID" value="@if(!empty($data['search_by'])){{ $data['search_by'] }}@endif">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
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
            <div class="col-md-12 text-center" style="padding-bottom:8px">
                Ref. ID: {{ str_pad($data['bid_info']->id, 6, '0', STR_PAD_LEFT) }}. &nbsp;
                <strong>Status: </strong>
                @if($data['bid_info']->status === 1)
                <span class="status-pending">Pending</span>
                @elseif($data['bid_info']->status === 2)
                <span class="status-declined">Declined</span>
                @elseif($data['bid_info']->status === 3)
                <span class="status-accepted">Accepted</span>
                @elseif($data['bid_info']->status === 4)
                <span class="status-requested">Requested</span>
                @else
                <span class="status-pending">Unknown</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="{{url('/submitBid')}}" id="service-form">
                    <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 80%;">Product/Service</th>
                                <th style="width: 20%;">Cost @php $total = 0; @endphp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['bid_services_data'] as $key => $service)
                            @continue(!$service->price)
                            <tr>
                                <td><input type="checkbox" {{ empty($data['selected_services']) || in_array($service->id, $data['selected_services']) ? 'checked="checked"' : '' }} name="services[]" value="{{ $service->id}}" data-price="{{  $service->price ?? 0 }}" id="chkboxService_{{ $service->id}}" class="chkboxService">
                                    <label for="chkboxService_{{ $service->id}}"> {{ config('constants')[$key] }}</label><br>
                                    {!! $service->service_description!!}
                                </td>
                                <td>$@php $total += $service->price; @endphp {{ number_format($service->price, 2, '.', ',') }}</td>
                            </tr>
                            @endforeach
                            <!-- More rows can go here -->
                        </tbody>
                    </table>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 80%;" class="txt-bold text-right">Grand Total: </td>
                            <td style="width: 20%;" class="txt-bold text-left">&nbsp;${{ number_format($total, 2, '.', ',') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 80%;" class="txt-bold text-right">SubTotal: </td>
                            <td id="subtotal" style="width: 80%;" class="txt-bold text-left"></td>
                        </tr>
                    </table>
                    <!-- <div class="row">
                        <div class="col-sm-offset-10 col-md-offset-10 col-sm-1 col-md-1 txt-bold text-right">
                            Total:
                        </div>
                        <div class="col-sm-1 col-md-1 txt-bold text-left">
                            ${{ number_format($total, 2, '.', ',') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-10 col-md-offset-10 col-sm-1 col-md-1 txt-bold text-right">
                            SubTotal:
                        </div>
                        <div class="col-sm-1 col-md-1 txt-bold text-left" id="subtotalsssdas">
                        </div>
                    </div> -->

                    <div class="row">
                        <br />
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group inline-form-group">
                                <label for="name" style="width:110px">First Name:</label>
                                <input type="text" class="form-control customer-info" name="customer_first_name" value="{{ $data['bid_info']->customer_first_name }}" placeholder="First name" required>
                            </div>
                            <div class="form-group inline-form-group">
                                <label for="name" style="width:110px">Last Name:</label>
                                <input type="text" class="form-control customer-info" name="customer_last_name" value="{{ $data['bid_info']->customer_last_name }}" placeholder="Last name" required>
                            </div>
                            <!-- Phone Field -->
                            <div class="form-group inline-form-group">
                                <label for="phone" style="width:110px">Phone:</label>
                                <input type="tel" class="form-control customer-info" id="phone" name="phone" value="{{ $data['bid_info']->customer_phone }}" placeholder="Phone number" required>
                            </div>

                            <!-- Email Field -->
                            <div class="form-group inline-form-group">
                                <label for="email" style="width:110px">Email:</label>
                                <input type="email" class="form-control customer-info" id="email" name="email" value="{{ $data['bid_info']->customer_email }}" placeholder="Email address" required>
                            </div>
                        </div>

                        @if(!empty($data['bid_info']))
                        <div class="col-sm-6 col-md-6">
                            <div style="padding:20px 0 0 40px ">
                                <div>Street: {{ $data['bid_info']->street}}</div>
                                <div>City: {{ $data['bid_info']->city}}</div>
                                <div>State: {{ $data['bid_info']->state}}</div>
                                <div>Zip: {{ $data['bid_info']->zip}}</div>
                            </div>
                        </div>
                        @endif
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

    <script src="{{ asset('jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap3.3.7.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            calculateSubTotal();
            // On Change value
            $('.chkboxService').on('change', function() {

                //select at least one checkbox is selected.
                // if ($("input[type='checkbox']:checked").length == 0) {
                //     // At least one checkbox is checked
                //     alert("At least one service should be selected.");
                //     return false;
                // } 

                calculateSubTotal();
            });

            $("#service-form").on("submit", function(e) {
                // Check if any checkbox is checked
                if ($("input[type='checkbox']:checked").length == 0) {
                    // At least one checkbox is checked
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Wait!',
                        text: 'Please select at least one option before submitting.',
                    });
                    return false;
                }
            });

            function calculateSubTotal() {
                let subtotal = 0;
                const checkboxes = document.querySelectorAll('.chkboxService');
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        subtotal += parseFloat(checkbox.dataset.price);
                    }
                });

                const formattedSubtotal = subtotal.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                $('#subtotal').html('&nbsp;$' + formattedSubtotal);
            }

            // populate customer data in form
            /*document.querySelectorAll('.customer-info').forEach(input => {
                if (input.value != '') {
                    return;
                }
                const savedValue = localStorage.getItem(input.id);
                if (savedValue) {
                    input.value = savedValue;
                }
               
                input.addEventListener('input', () => {
                    localStorage.setItem(input.id, input.value);
                });
            });*/

        });
    </script>
    <script src="{{ asset('sweetalert2@11.js') }}"></script>

</body>

</html>