@extends('layout')

@section('content')

<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
    <br />
  @endif
<div class=buttons>
  <a href="{{ route('customers.create') }}">
      <button class="btn btn-primary" href=>Add new customer</button>
  </a> 
</div>
<div>
  <input type="text" name="search" id="search" placeholder="search" class="form-control">
</div>
<br>
<table class="table table-striped" border=1>
<thead>
    <tr>
        <td>ID</td>
        <td>CI</td>
        <td>First name</td>
        <td>Second name</td>
        <td>Father last name</td>
        <td>Mother last name</td>
        <td>Phone number</td>
        <td>Birth date</td>
    </tr>
</thead>
<tbody>
  
</tbody>
</table>
<div>
<script>
  $(document).ready(function()
  {
    function fetch_customers_data(query = ''){
      $.ajax({
        url:"{{route("customer.action")}",
        methond: 'GET',
        data:{query:query},
        dataType:'json',
        success:function(data)
        {
          $('tbody').html(data.table_data);
          $('#total_records').text(data.total_data);
        }
      })
    }
    $(document).on('keyup',"#search",function(){
      var query= $(this).val();
      fetch_customers_data(query);
    });
  });
</script>
@endsection