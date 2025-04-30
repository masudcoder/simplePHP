@extends('layouts.manageBid')

@section('breadcrumb')
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create New Bid</li>
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
                    <h3 class="box-title">Bid Update &nbsp;&nbsp;&nbsp;
                        <strong>Ref ID:</strong> {{ str_pad($data['bid_info']->id, 6, '0', STR_PAD_LEFT) }} &nbsp;&nbsp;
                        <strong>Status:</strong> @if($data['bid_info']->status == 1)
                        Pending
                        @elseif($data['bid_info']->status == 2)
                        Declined
                        @elseif($data['bid_info']->status == 3)
                        Accepted
                        @elseif($data['bid_info']->status == 4)
                        Requested
                        @else
                        Unknown
                        @endif
                    </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{ url('/bid/updateBid')}}">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="box-body">
                                <div class="row">
                                    <label class="col-sm-2 col-md-1">Street</label>
                                    <div class="col-sm-4 col-md-2">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="street"
                                            name="street"
                                            placeholder="Street"
                                            value="{{ $data['bid_info']->street }}"
                                            required>
                                    </div>
                                    <label class="col-sm-2 col-md-1 text-right">City</label>
                                    <div class="col-sm-4 col-md-2">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="city"
                                            name="city"
                                            placeholder="city"
                                            value="{{ $data['bid_info']->city }}"
                                            required>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="box-body">
                                <div class="row">
                                    <label class="col-sm-4 col-md-1">State</label>
                                    <div class="col-sm-4 col-md-2">
                                        <select name="state" id="state" class="form-control" required>
                                            <option value="">--Select State--</option>
                                            <option value="Alabama">Alabama</option>
                                            <option value="Alaska">Alaska</option>
                                            <option value="Arizona">Arizona</option>
                                            <option value="Arkansas">Arkansas</option>
                                            <option value="California">California</option>
                                            <option value="Colorado">Colorado</option>
                                            <option value="Connecticut">Connecticut</option>
                                            <option value="Delaware">Delaware</option>
                                            <option value="Florida">Florida</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Hawaii">Hawaii</option>
                                            <option value="Idaho">Idaho</option>
                                            <option value="Illinois">Illinois</option>
                                            <option value="Indiana">Indiana</option>
                                            <option value="Iowa">Iowa</option>
                                            <option value="Kansas">Kansas</option>
                                            <option value="Kentucky">Kentucky</option>
                                            <option value="Louisiana">Louisiana</option>
                                            <option value="Maine">Maine</option>
                                            <option value="Maryland">Maryland</option>
                                            <option value="Massachusetts">Massachusetts</option>
                                            <option value="Michigan">Michigan</option>
                                            <option value="Minnesota">Minnesota</option>
                                            <option value="Mississippi">Mississippi</option>
                                            <option value="Missouri">Missouri</option>
                                            <option value="Montana">Montana</option>
                                            <option value="Nebraska">Nebraska</option>
                                            <option value="Nevada">Nevada</option>
                                            <option value="New Hampshire">New Hampshire</option>
                                            <option value="New Jersey">New Jersey</option>
                                            <option value="New Mexico">New Mexico</option>
                                            <option value="New York">New York</option>
                                            <option value="North Carolina">North Carolina</option>
                                            <option value="North Dakota">North Dakota</option>
                                            <option value="Ohio">Ohio</option>
                                            <option value="Oklahoma">Oklahoma</option>
                                            <option value="Oregon">Oregon</option>
                                            <option value="Pennsylvania">Pennsylvania</option>
                                            <option value="Rhode Island">Rhode Island</option>
                                            <option value="South Carolina">South Carolina</option>
                                            <option value="South Dakota">South Dakota</option>
                                            <option value="Tennessee">Tennessee</option>
                                            <option value="Texas">Texas</option>
                                            <option value="Utah">Utah</option>
                                            <option value="Vermont">Vermont</option>
                                            <option value="Virginia">Virginia</option>
                                            <option value="Washington">Washington</option>
                                            <option value="West Virginia">West Virginia</option>
                                            <option value="Wisconsin">Wisconsin</option>
                                            <option value="Wyoming">Wyoming</option>
                                        </select>

                                    </div>
                                    <label class="col-sm-4 col-md-1 text-right">Zip</label>
                                    <div class="col-sm-4 col-md-2">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="zip"
                                            name="zip"
                                            placeholder="zip"
                                            value="{{ $data['bid_info']->zip }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            @php $total = 0; $subtotal = 0; @endphp
                            <table class="table" id="serviceTable">
                                <thead class="table-light table-bordered">
                                    <tr>
                                        <th style="width:15%">Products/Services</th>
                                        <th style="width:65%">Description</th>
                                        <th style="width:20%">Cost </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['bid_services_data'] as $key => $service)
                                    <tr>
                                        <td>
                                            @if($data['bid_info']->status == 1)
                                            <input type="checkbox" disabled checked="checked" name="services[]" value="{{ $service->id}}" data-price="{{ $service->price ?? 0 }}" id="chkboxService_{{ $service->id}}" class="chkboxService">
                                            @else
                                            <input type="checkbox" {{ empty($data['selected_services']) || in_array($service->id, $data['selected_services']) ? 'checked="checked"' : '' }} name="services[]" value="{{ $service->id}}" data-price="{{ $service->price }}" id="chkboxService_{{ $service->id}}" class="chkboxService">
                                            @endif
                                            <label for="chkboxService_{{ $service->id}}"> {{ config('constants')[$key] }}</label>
                                            <input type="hidden" name="bid_row_id[]" value="{{ $service->id}}">
                                        </td>

                                        <td><textarea class="textarea service-description" name="service_description[]">{!! $service->service_description !!}</textarea></td>
                                        <td>
                                            <div class="input-price"><input type="text" value="{{ $service->price}}" class="form-control price" name="price[]"></div>
                                            @php $total += $service->price; @endphp
                                            @php
                                            if($data['bid_info']->status == 1 || in_array($service->id, $data['selected_services'])) {
                                            $subtotal += $service->price;
                                            }
                                            @endphp
                                        </td>

                                        <!-- <td><textarea class="form-control" rows="1" name="service_description[]">{{ $service->service_description}}</textarea></td> -->
                                        <!-- <td>
                                            <input type="text" value="{{ $service->price}}" class="form-control price" name="price[]">
                                           
                                        </td> -->
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td class="text-right"><b>Grand Total</b></td>
                                        <td class="grand-total">${{ number_format($total, 2, '.', ',') }}</td>
                                    </tr>
                                    @if($data['bid_info']->status != 1)
                                    <tr>
                                        <td></td>
                                        <td class="text-right"><b>Sub Total</b></td>
                                        <td class="subtotal" id="subtotal">
                                            ${{ number_format($subtotal, 2, '.', ',') }}
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        @if($data['bid_info']->status != 1)
                        <div class="form-group">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <table cellspacing="2" cellpadding="2">
                                            <tr>
                                                <td style="padding:0 15px">First Name </td>
                                                <td style="padding:0 15px"><input type="text" class="form-control" name="customer_first_name" value="{{ $data['bid_info']->customer_first_name }}"></td>
                                                <td style="padding:0 15px">Last Name </td>
                                                <td style="padding:0 15px"><input type="text" class="form-control" name="customer_last_name" value="{{ $data['bid_info']->customer_last_name }}"></td>
                                                <td style="padding:0 15px">Phone</td>
                                                <td style="padding:0 15px"><input type="text" class="form-control" name="phone" value="{{ $data['bid_info']->customer_phone }}"></td>
                                                <td style="padding:0 15px">Email</td>
                                                <td style="padding:0 15px"><input type="text" class="form-control" name="email" value="{{ $data['bid_info']->customer_email }}"></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['bid_info']->id}}">
                        <input type="hidden" name="status" value="{{ $data['bid_info']->status}}">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>

    </div>
    <!-- /.row -->
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        $(".textarea").wysihtml5();

        // On Change value
        $('.price').on('change', function() {
            let grandTotal = 0;
            $('#serviceTable tbody tr').each(function() {
                grandTotal += parseFloat($(this).find('.price').val()) || 0;
            });

            $('#serviceTable tbody tr td.grand-total').text(`$${grandTotal.toFixed(2)}`);
            calculateSubTotal();
        });

        //calculateSubTotal();
        $('.chkboxService').on('change', function() {
            calculateSubTotal();
        });


        function calculateSubTotal() {
           
            console.log(`calculateSubTotal`);

            let subtotal = 0;
            $("#serviceTable tbody tr").each(function(index) {
                const checkbox = $(this).find(".chkboxService");
                if (checkbox.length && checkbox.prop("checked")) {
                    let price = parseFloat($(this).find('.price').val()) || 0;
                    subtotal +=  price;
                }
            });

            const formattedSubtotal = subtotal.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            $('#subtotal').text('$' + formattedSubtotal);

        }

        // function calculateSubTotalOnLoad() {
        //     //alert('calculateSubTotalOnLoad');
        //     let subtotal = 0;
        //     const checkboxes = document.querySelectorAll('.chkboxService');

        //     checkboxes.forEach(checkbox => {
        //         if (checkbox.checked) {

        //             //console.log(parseFloat(checkbox.dataset.price));
        //             subtotal += parseFloat(checkbox.dataset.price);
        //         }
        //     });

        //     const formattedSubtotal = subtotal.toLocaleString('en-US', {
        //         minimumFractionDigits: 2,
        //         maximumFractionDigits: 2
        //     });

        //     $('#subtotal').text('$' + formattedSubtotal);
        // }

        // make state dropdown selected.
        document.getElementById("state").value = "<?php echo $data['bid_info']->state ?>";

    });
</script>
@endpush