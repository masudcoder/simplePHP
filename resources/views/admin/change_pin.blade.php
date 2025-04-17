@extends('layouts.admin')

@section('breadcrumb')
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change PIN</li>
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
                    <h3 class="box-title">Change PIN</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{ url('/changePin')}}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Current PIN</label>
                            <input type="password" class="form-control" name="old_pin"  placeholder="Current PIN" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New PIN</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="New PIN">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm PIN</label>
                            <input type="password" class="form-control" name="confirm_pin"  placeholder="Confirm PIN" required>
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