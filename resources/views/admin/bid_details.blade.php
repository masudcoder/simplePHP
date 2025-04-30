@extends('layouts.manageBid')

@section('breadcrumb')
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bid Details</li>
    </ol>
</section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Bid Details </h3>
                </div>

                <div class="box-body">
                    <div style="padding:15px 5px">
                        Ref.ID: {{ str_pad($data['bid_info']->id, 6, '0', STR_PAD_LEFT) }}. &nbsp;&nbsp;
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
                        <br>
                        Street:{{ $data['bid_info']->street}}, City: {{ $data['bid_info']->city}}, State: {{ $data['bid_info']->state}}, Zip: {{ $data['bid_info']->zip}}
                    </div>
                    <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 80%;">Product/Service</th>
                                <th style="width: 20%;">Total @php $total = 0; $subtotal = 0; @endphp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['bid_services_data'] as $key => $service)
                            <tr>
                                <td><input type="checkbox" name="" disabled {{ $data['bid_info']->status == 1 || in_array($service->id, $data['selected_services']) ? 'checked="checked"' : '' }} data-price="{{ $service->price ?? 0 }}" class="chkboxService">
                                    <label for="chkboxService_{{ $service->id}}"> {{ config('constants')[$key] }}</label><br>
                                    {!! $service->service_description !!}
                                </td>
                                <td>
                                    @php $total += $service->price; @endphp
                                    @php
                                    if(in_array($service->id, $data['selected_services'])) {
                                    $subtotal += $service->price;
                                    }
                                    @endphp
                                    ${{ number_format($service->price, 2, '.', ',') }}
                                </td>
                            </tr>
                            @endforeach
                            <!-- More rows can go here -->
                        </tbody>
                    </table>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 80%;" class="text-right">Grand Total:</td>
                            <td style="width: 20%;">&nbsp; ${{ number_format($total, 2, '.', ',') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 80%;" class="text-right">Sub Total:</td>
                            <td style="width: 20%;" id="subtotal">&nbsp; ${{ number_format($subtotal, 2, '.', ',') }}</td>
                        </tr>
                    </table>


                    <div style="padding-bottom:100px">
                        @if($data['bid_info']->status != 1)
                        <strong>First Name: </strong>{{ $data['bid_info']->customer_first_name}}, <strong>Last Name: </strong>{{ $data['bid_info']->customer_last_name}}, <strong>Phone: </strong> {{ $data['bid_info']->customer_phone}}, <strong>Email: </strong> {{ $data['bid_info']->customer_email}}
                        @endif
                    </div>

                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        calculateSubTotal();

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
    });
</script>
@endpush