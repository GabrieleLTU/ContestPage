@extends('layouts.app')
@section('content')
    <h1>Edit problem</h1>
    {!! Form::open(['action' => ['ProblemsController@update', $problem->id], 'method' =>'POST']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $problem->title, ['class' => 'form-control', 'placeholder'=>'title'])}}
    </div>
    <div class="form-group">
        {{Form::label('condition', 'Condition')}}
        {{Form::textarea('condition', $problem->condition, ['class' => 'form-control', 'placeholder'=>'condition of the problem, requirements for the answer, example, etc.'])}}
    </div>
    <div class="form-group">
        {{Form::label('answer', 'Answer')}}
        {{Form::text('answer', $problem->answer, ['class' => 'form-control', 'placeholder'=>'correct answer of the problem'])}}
    </div>
    <div>
        {{Form::radio('is_ready', true, $problem->is_ready ? true : false)}} ready
        {{Form::radio('is_ready', false, $problem->is_ready ? false : true)}} not ready
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection