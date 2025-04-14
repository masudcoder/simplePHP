@extends('layouts.admin')

@section('content')
<div>

    <form method="POST" action="{{ url('/changePin')}}">
        <div class="row mb-3">
            <label for="inputOldPin" class="col-sm-2 col-form-label">Old PIN</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="old_pin" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputnewPin" class="col-sm-2 col-form-label">New PIN</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="new_pin" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputcPin" class="col-sm-2 col-form-label">Confirm PIN</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="confirm_pin" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-10">
            @csrf
            <button type="submit" class="btn btn-primary">UPDATE</button>
            </div>
        </div>
    </form>
</div>
@endsection