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
                        Ref.ID: {{ str_pad($data['bid_info']->id, 6, '0', STR_PAD_LEFT) }}. &nbsp;&nbsp;{{ $data['bid_info']->street}} Address:{{ $data['bid_info']->street}} {{ $data['bid_info']->city}} {{ $data['bid_info']->state}} {{ $data['bid_info']->zip}}
                        <br>Status:  @if($data['bid_info']->status === 1)
                                    Pending
                                    @elseif($data['bid_info']->status === 2)
                                    Declined
                                    @elseif($data['bid_info']->status === 3)
                                    Accepted
                                    @elseif($data['bid_info']->status === 4)
                                    Requested
                                    @else
                                    Unknown
                                    @endif
                    </div>
                    <table class="table table-bordered table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 50%;">Product/Service</th>
                                <th style="width: 15%;">Qty</th>
                                <th style="width: 15%;">Unit Price</th>
                                <th style="width: 20%;">Total @php $total = 0; $subtotal = 0; @endphp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['bid_services_data'] as $key => $service)
                            <tr>
                                <td><input type="checkbox" {{ in_array($service->id, $data['selected_services']) ? 'checked="checked"' : '' }}>
                                    <label for="chkboxService_{{ $service->id}}"> {{ config('constants')[$key] }}</label><br>
                                    {{ $service->service_description}}
                                </td>
                                <td>{{ $service->qty}}</td>
                                <td>{{ $service->unit_price}}</td>
                                <td>
                                    @php $total += $service->qty * $service->unit_price; @endphp
                                    @php
                                        if(in_array($service->id, $data['selected_services'])) {
                                            $subtotal += $service->qty * $service->unit_price;
                                        }
                                    @endphp
                                    ${{ number_format($service->qty * $service->unit_price, 2, '.', ',') }}
                                </td>
                            </tr>
                            @endforeach
                            <!-- More rows can go here -->
                        </tbody>
                    </table>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 50%;"></td>
                            <td style="width: 15%;"></td>
                            <td style="width: 15%;">Total:</td>
                            <td style="width: 20%;">${{ number_format($total, 2, '.', ',') }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%;"></td>
                            <td style="width: 15%;"></td>
                            <td style="width: 15%;">Sub Total:</td>
                            <td style="width: 20%;">${{ number_format($subtotal, 2, '.', ',') }}</td>
                        </tr>
                    </table>

                    <div>
                        <strong>Name: </strong>{{ $data['bid_info']->customer_name}}, <strong>Phone: </strong> {{ $data['bid_info']->customer_phone}}, <strong>Email: </strong> {{ $data['bid_info']->customer_email}}
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
    
</script>
@endpush