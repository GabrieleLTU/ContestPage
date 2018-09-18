@extends('layouts.app')
@section('content')
    <h1>Create problem</h1>
    {!! Form::open(['action' => 'ProblemsController@store', 'method' =>'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title','', ['class' => 'form-control', 'placeholder'=>'title'])}}
        </div>
        <div class="form-group">
            {{Form::label('condition', 'Condition')}}
            {{Form::textarea('condition','', ['class' => 'form-control', 'placeholder'=>'condition of the problem, requirements for the answer, example, etc.'])}}
        </div>
        <div class="form-group">
            {{Form::label('answer', 'Answer')}}
            {{Form::text('answer','', ['class' => 'form-control', 'placeholder'=>'correct answer of the problem'])}}
        </div>
        <div>
            {{Form::radio('is_ready', true)}} ready
            {{Form::radio('is_ready', false, true)}} not ready
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection