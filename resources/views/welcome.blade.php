@extends('layouts.app')
@section('content')
<div class="jumbotron text-center">
    <h1>Tree Care Service </h1>
    <p>We specialize in Tree care</p>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form class="d-flex" role="search" method="POST" action="{{ url('/')}}">
                <input class="form-control me-2" type="search" required name="ref_id" placeholder="Search By Ref ID" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
                @csrf
            </form>
        </div>
        <div class="col-sm-4"></div>
    </div>

    <div class="row">
    <div class="col-sm-2"></div>
        <div class="col-sm-8">
            @if(isset($data['bid_info']))
            @if(empty($data['bid_info']))
            NOt found
            @else
         
            <div class="table-wrapper">
                <div class="table-title">Bid Found, Details below</div>

                <div class="table">
                    <!-- Header Row -->
                    <div class="row header">
                        <div class="cell">Product/Service</div>
                        <div class="cell">Qty</div>
                        <div class="cell">Unit Price</div>
                        <div class="cell">Total</div>
                    </div>
                   
                    @foreach($data['bid_services_data'] as $service)
                    <div class="row">
                        <div class="cell">{{ $service->service_description}}</div>
                        <div class="cell">{{ $service->qty}}</div>
                        <div class="cell">{{ $service->unit_price}}</div>
                        <div class="cell">${{ $service->qty * $service->unit_price}}</div>
                    </div>
                    @endforeach
                    
                </div>
            </div>

              @endif
            @endif



        </div>
    <div class="col-sm-2"></div>
    </div>


</div>

<div class="container-fluid text-center">
    <h2>About Service Information</h2>
    <h4>Lorem ipsum</h4>
    <p>Lorem ipsum</p>
    <button class="btn btn-default btn-lg">Get in Touch</button>
</div>

<div class="container-fluid bg-grey text-center">
    <h2>Our Values</h2>
    <h4><strong>MISSION:</strong> Our mission lorem ipsum.. </h4>
    <p><strong>VISION:</strong> Coming soon..
</div>

@endsection