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
                                <th style="width: 8%;">Ref ID</th>
                                <th style="width: 8%;">Street</th>
                                <th style="width: 8%;">City</th>
                                <th style="width: 8%;">State</th>
                                <th style="width: 8%;">Zip</th>
                                <th style="width: 8%;">F. Name</th>
                                <th style="width: 8%;">L. Name</th>
                                <th style="width: 8%;">Cust. Phone</th>
                                <th style="width: 8%;">Cust. Email</th>
                                <th style="width: 8%;">Est Cost</th>
                                <th style="width: 8%;">Status</th>
                                <th style="width: 12%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['bids'] as $bid)
                            <tr>
                                <td><a href="{{ url('/bid/details/'. $bid->id)}}">{{ str_pad($bid->id, 6, '0', STR_PAD_LEFT) }}</a></td>
                                <td>{{ $bid->street}}</td>
                                <td>{{ $bid->city }}</td>
                                <td>{{ $bid->state }}</td>
                                <td>{{ $bid->zip }}</td>
                                <td>{{ $bid->customer_first_name }}</td>
                                <td>{{ $bid->customer_last_name }}</td>
                                <td>{{ $bid->customer_phone }}</td>
                                <td>{{ $bid->customer_email }}</td>
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
                                <td>

                                    <a href="{{ url('/bid/details/'. $bid->id)}}" class="btn btn-info">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    <a href="{{ url('/bid/edit/'. $bid->id)}}" class="btn btn-primary btn-sm">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>

                                    <!-- <button class="btn btn-danger" onclick="confirmDelete({{ $bid->id }})">Delete</button> -->
                                    
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $bid->id }})">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>

                                    <form id="delete-form-{{ $bid->id }}" action="{{ url('/bid/delete/')}}" method="POST" style="display: none;">
                                        <input type="hidden" name="id" value="{{ $bid->id }}">
                                        @csrf
                                    </form>

                                    <!-- <form action="" method="POST" style="display:inline;">
                                         @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                    </form> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Ref ID</th>
                                <th>Street</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                                <th>F. Name</th>
                                <th>L. Name</th>
                                <th>Cust. Phone</th>
                                <th>Cust. Email</th>
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
<script src="{{ asset('sweetalert2@11.js') }}"></script>

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



    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure to Delete?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush