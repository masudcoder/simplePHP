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
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
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