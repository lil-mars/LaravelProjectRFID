@extends('layout')

@section('content')

<div class="card uper">
  <div class="card-header">
    Add customer
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('customers.store') }}">
        @csrf
          <div class="form-group">              
              <label for="firstName">First name:</label>
              <input type="text" class="form-control" name="firstName"/>
          </div>
          <div class="form-group">
              <label for="secondName">Second name:</label>
              <input type="text" class="form-control" name="secondName"/>
          </div>
          <div class="form-group">
              <label for="fatherName">Father last name:</label>
              <input type="text" class="form-control" name="fatherName"/>
          </div>
          <div class="form-group">
              <label for="motherName">Mother last name:</label>
              <input type="text" class="form-control" name="motherName"/>
          </div>
          <div class="form-group">              
              <label for="ci">CI:</label>
              <input type="text" class="form-control" name="ci"/>
          </div>
          <div class="form-group">
              <label for="phoneNumber">Phone number:</label>
              <input type="text" class="form-control" name="phoneNumber"/>
          </div>
          <div class="form-group">
              <label for="gender">Gender:</label>
              <input type="text" class="form-control" name="gender"/>
          </div>
          <div class="form-group">
              <label for="birthDate">Birth date:</label>
              <input type="date" class="form-control" name="birthDate"/>
          </div>
          <div class="form-group invisible">
              <input type="text" class="form-control" name="enabled" value="1"/>
          </div>          
          
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection