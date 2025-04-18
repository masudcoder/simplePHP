@extends('layouts.manageBid')

@section('breadcrumb')
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bids List</li>
    </ol>
</section>
@endsection

@section('content')
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Bid Listing</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Ref ID</th>
                                <th>Address</th>
                                <th>Est Cost</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['bids'] as $bid)
                            <tr>
                                <td> {{ str_pad($bid->id, 6, '0', STR_PAD_LEFT) }} </td>
                                <td>{{ $bid->address }} </td>
                                <td>${{ $bid->total_price }}</td>
                                <td>
                                    @if($bid->status === 1)
                                    Pending
                                    @elseif($bid->status === 2)
                                    Declined
                                    @elseif($bid->status === 3)
                                    Accepted
                                    @elseif($bid->status === 4)
                                    Requested
                                    @else
                                    Unknown
                                    @endif

                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Ref ID</th>
                                <th>Address</th>
                                <th>Est Cost</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

</section>
@endsection


@push('scripts')

<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>

<script>
    $(function() {
        $("#example1").DataTable();

    });

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