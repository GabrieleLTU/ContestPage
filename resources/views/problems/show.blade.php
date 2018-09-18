@extends('layouts.app')
@section('content')
<div>
    <h1>{{$problem->title}}</h1>
    <p>{{$problem->condition}}</p>
    @auth
        @if(auth()->User()->is_admin)
            {!!Form::open(['action' => ['ProblemsController@destroy', $problem->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            @csrf
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-default', 'style'=>'float:right'])}}
            {!!Form::close() !!}
            <a href="/problems/{{$problem->id}}/edit" class="btn btn-primary" style="float: right; margin-left: 10px;">Edit</a>
        @else
            {!! Form::open(['action' => ['SolutionsController@store'], 'method' =>'POST']) !!}
                <div class="form-group">
                    {{Form::label('answer', 'Answer')}}
                    {{Form::text('answer', '', ['class' => 'form-control'])}}
                </div>

            <input id="problem_id" type="hidden" name="problem_id" value="{{ $problem->id }}" required readonly>

            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
            <button onclick="goBack()" class="btn btn-default">Go Back</button>
        @endif
    @endauth
    <button onclick="goBack()" class="btn btn-default" style="float: left">Go Back</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</div>
@endsection