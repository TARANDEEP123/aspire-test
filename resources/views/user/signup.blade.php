@extends('layouts.user')
@section('content')
    <h1>Login</h1>

    {!! Form::open(['url' => '/login']) !!}

    <div class="form-group">
        {{ Form::label('name', 'Name')}}
        {{ Form::text('name', 'Aspire', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'E-Mail Address')}}
        {{ Form::text('email', 'suriya@aspire.com', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Password')}}
        {{ Form::password('password', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('address', 'Address')}}
        {{ Form::text('address', 'Enter Address', ['class' => 'form-control']) }}
    </div>

    <div>
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@endsection
