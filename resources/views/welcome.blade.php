@extends('layouts.app')
@section('content')
    <div class="jumbotron text-center">
        <h1>Company</h1>
        <p>We specialize in Tree care</p>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" name="search" type="search" placeholder="Enter Ref ID" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
            <div class="col-sm-4"></div>
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