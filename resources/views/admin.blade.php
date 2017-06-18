@extends('layouts.app')

@section('content')
<img class="logo-bottled" src="img/logo-bottled.png" alt="">

<div class="container">
    <div class="row">
        <div id="adminContent" class="col-md-12 col-md-offset-0">

          <a class="go-to-table-button" href="/notestable">Notes Table</a>
          <a class="go-to-table-button" href="/userstable">Users Table</a>
        </div>
    </div>
</div>
@endsection
