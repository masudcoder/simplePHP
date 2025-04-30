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
                    <h3 class="box-title">Bid Creation &nbsp;&nbsp;&nbsp;<strong>Ref ID:</strong> {{ $data['next_ref_id'] }} </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{ url('/createBid')}}">
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
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <table class="table" id="serviceTable">
                                <thead class="table-light table-bordered">
                                    <tr>
                                        <th style="width:15%">Products/Services</th>
                                        <th style="width:35%">Description</th>
                                        <th style="width:20%">Qty</th>
                                        <th style="width:20%">Unit Price </th>
                                        <th style="width:10%">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ config('constants')[0] }}</td>
                                        <td><textarea class="form-control" rows="1" name="service_description[]" required></textarea></td>
                                        <td><input type="text" class="form-control qty" name="qty[]" required></td>
                                        <td><input type="text" class="form-control unit_price" name="unit_price[]" required></td>
                                        <td class="row-total">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('constants')[1] }}</td>
                                        <td><textarea class="form-control" rows="1" name="service_description[]" required></textarea></td>
                                        <td><input type="text" class="form-control qty" name="qty[]" required></td>
                                        <td><input type="text" class="form-control unit_price" name="unit_price[]" required></td>
                                        <td class="row-total">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('constants')[2] }}</td>
                                        <td><textarea class="form-control" rows="1" name="service_description[]" required></textarea></td>
                                        <td><input type="text" class="form-control qty" name="qty[]" required></td>
                                        <td><input type="text" class="form-control unit_price" name="unit_price[]" required></td>
                                        <td class="row-total">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('constants')[3] }}</td>
                                        <td><textarea class="form-control" rows="1" name="service_description[]" required></textarea></td>
                                        <td><input type="text" class="form-control qty" name="qty[]" required></td>
                                        <td><input type="text" class="form-control unit_price" name="unit_price[]" required></td>
                                        <td class="row-total">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>{{ config('constants')[4] }}</td>
                                        <td><textarea class="form-control" rows="1" name="service_description[]" required></textarea></td>
                                        <td><input type="text" class="form-control qty" name="qty[]" required></td>
                                        <td><input type="text" class="form-control unit_price" name="unit_price[]" required></td>
                                        <td class="row-total">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td><b>Grand Total</b></td>
                                        <td class="grand-total">$0.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        @csrf
                        <button type="submit" class="btn btn-primary">Submit</button>
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
        // On Change value
        $('.qty, .unit_price').on('change', function() {
            calculateGrandTotal();
            // const row = $(this).closest('tr');
            // const qty = parseFloat(row.find('.qty').val().replace(/[^0-9.]/g, '')) || 0;
            // const unit_price = parseFloat(row.find('.unit_price').val().replace(/[^0-9.]/g, '')) || 0;
            // const total = qty * unit_price;
            // row.find('.row-total').html('$' + total.toFixed(2));

        });

        function calculateGrandTotal() {
            let grandTotal = 0;
            $('#serviceTable tbody tr').each(function() {
                // Skip the last row (Total row)
                if (!$(this).find('.qty').length) return;

                grandTotal += calculateRowTotal($(this));
            });
            // Set grand total in the last row
            $('#serviceTable tbody tr:last .grand-total').text(`$${grandTotal.toFixed(2)}`);
        }

        function calculateRowTotal(row) {
            let qty = parseFloat(row.find('.qty').val()) || 0;
            let unitPrice = parseFloat(row.find('.unit_price').val()) || 0;
            let total = qty * unitPrice;
            row.find('.row-total').text(`$${total.toFixed(2)}`);
            return total;
        }

    });
</script>
@endpush