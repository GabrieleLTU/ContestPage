@extends('app2')
@section('content')
    <h1>Sign in</h1>
    {!! Form::open(['action' => 'UserController@store', 'method' =>'POST']) !!}
    <div class="form-group">
        {{Form::label('nickname', 'Nickname')}}
        {{Form::text('nickname','', ['class' => 'form-control', 'placeholder'=>'Your\'s nickname'])}}
    </div>
    <div class="form-group">
        {{Form::label('name', 'First name')}}
        {{Form::text('name','', ['class' => 'form-control', 'placeholder'=>'First name'])}}
    </div>
    <div class="form-group">
        {{Form::label('surname', 'Surname')}}
    {{Form::text('surname','', ['class' => 'form-control', 'placeholder'=>'Surname'])}}
    </div>
    <div class="form-group">
        {{Form::label('email', 'Email')}}
    {{Form::text('email','', ['class' => 'form-control', 'placeholder'=>'Email@mail.com'])}}
    </div>
    <div class="form-group">
        {{Form::label('password', 'Password')}}
    {{Form::text('password','', ['class' => 'form-control', 'placeholder'=>'password'])}}
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection