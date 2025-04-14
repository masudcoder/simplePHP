@extends('layouts.admin')

@section('content')
<div>
    <div class="mt-auto p-2">
       <b>>>Add New Bid</b>
    </div>
    <form method="POST" action="{{ url('/createBid')}}">
        <div class="row mb-3">
            <label for="inputOldPin" class="col-sm-2 col-form-label">Ref ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="ref_id" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="address" rows="3"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="table-responsive">
                <table class="table" id="serviceTable">
                    <thead class="table-light">
                        <tr>
                            <th style="width:15%">Products/Services</th>
                            <th style="width:40%">Description</th>
                            <th style="width:15%">Qty</th>
                            <th style="width:15%">Unit Price </th>
                            <th style="width:15%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Removal</td>
                            <td><textarea class="form-control" rows="1" name="service_description[]" required></textarea></td>
                            <td><input type="text" class="form-control qty" name="qty[]" required></td>
                            <td><input type="text" class="form-control unit_price" name="unit_price[]" required></td>
                            <td class="row-total">$0.00</td>
                        </tr>
                        <tr>
                            <td>Stump Gridning</td>
                            <td><textarea class="form-control" rows="1" name="service_description[]" required></textarea></td>
                            <td><input type="text" class="form-control qty" name="qty[]" required></td>
                            <td><input type="text" class="form-control unit_price" name="unit_price[]" required></td>
                            <td class="row-total">$0.00</td>
                        </tr>
                        <tr>
                            <td>Tree Trimming & Purning</td>
                            <td><textarea class="form-control" rows="1" name="service_description[]" required></textarea></td>
                            <td><input type="text" class="form-control qty" name="qty[]" required></td>
                            <td><input type="text" class="form-control unit_price" name="unit_price[]" required></td>
                            <td class="row-total">$0.00</td>
                        </tr>
                        <tr>
                            <td>Debris cleanup</td>
                            <td><textarea class="form-control" rows="1" name="service_description[]" required></textarea></td>
                            <td><input type="text" class="form-control qty" name="qty[]" required></td>
                            <td><input type="text" class="form-control unit_price" name="unit_price[]" required></td>
                            <td class="row-total">$0.00</td>
                        </tr>
                        <tr>
                            <td>Tree/Plant Healthcare</td>
                            <td><textarea class="form-control" rows="1" name="service_description[]" required></textarea></td>
                            <td><input type="text" class="form-control qty" name="qty[]" required></td>
                            <td><input type="text" class="form-control unit_price" name="unit_price[]" required></td>
                            <td class="row-total">$0.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="row mb-3">
            <div class="col-sm-10">
            @csrf
            <button type="submit" class="btn btn-primary">SAVE</button>
            </div>
        </div>
    </form>
</div>
@endsection