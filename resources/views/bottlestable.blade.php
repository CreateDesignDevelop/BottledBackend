@extends('layouts.app')

@section('content')

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<table class="table table-striped table-bordered table-bottles">
    <thead>
        <tr>
            <td>Message</td>
            <td>Nickname</td>
            <td>Lat</td>
            <td>Lng</td>
            <td>Public</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($bottles as $key => $value)
        <tr>
            <td>{{ $value->message }}</td>
            <td>{{ $value->nickname }}</td>
            <td>{{ $value->lat }}</td>
            <td>{{ $value->lng }}</td>
            <td>{{ $value->public }}</td>
            <td>
                {{ Form::open(array('url' => 'note/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-delete')) }}
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<ul class="pagination">
    <li class="disabled"><span>&laquo;</span></li>

    <li class="active"><span>1</span></li>
    <li><a href="http://woutverhoeven.webhosting.be/notestable?page=2">2</a></li>
    <li><a href="http://woutverhoeven.webhosting.be/notestable?page=3">3</a></li>

    <li><a href="http://woutverhoeven.webhosting.be/notestable?page=2" rel="next">&raquo;</a></li>
</ul>


@endsection
