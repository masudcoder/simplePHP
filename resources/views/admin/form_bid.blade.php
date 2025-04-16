@extends('layouts.admin')

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
              <h3 class="box-title">Bid Creation</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{ url('/createBid')}}">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <textarea class="form-control" name="address" rows="2" required></textarea>
                </div>
                <div class="form-group">
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
        // On Click
        $('.qty, .unit_price').on('change', function() {
            const row = $(this).closest('tr');
            //const qty = parseFloat(row.find('.qty').val()) || 0;

            const qty = parseFloat(row.find('.qty').val().replace(/[^0-9.]/g, '')) || 0;
            const unit_price = parseFloat(row.find('.unit_price').val().replace(/[^0-9.]/g, '')) || 0;
            const total = qty * unit_price;
            row.find('.row-total').html('$' + total.toFixed(2));
        });

    });
</script>
@endpush