@extends('layouts.admin')

@section('content')
<div>
    <div class="mt-auto text-end p-2">
        <button class="btn btn-success create-bid-btn">
            <a href="{{ url('/createBid')}}"> + Create New Bid</a>
        </button>
    </div>

    <div class="table-responsive">
        <table id="example" class="table">
            <thead>
                <tr>
                    <th width="15%">Ref ID</th>
                    <th width="25%">Address</th>
                    <th width="15%">Est Cost</th>
                    <th width="15%">Unknown-1</th>
                    <th width="30%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['bids'] as $bid)
                <tr>
                    <td>{{ $bid->ref_id }}</td>
                    <td>{{ $bid->address }}</td>
                    <td>{{ $bid->address }}</td>
                    <td>----</td>
                    <td>
                        Edit | Delete | Print
                    </td>
                </tr>
                @endforeach



            </tbody>
            <tfoot>
                <tr>
                    <th>Ref ID</th>
                    <th>Address</th>
                    <th>Est Cost</th>
                    <th>Unknown-1</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection