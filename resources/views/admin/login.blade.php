@extends('layouts.admin')
@section('content')
    <div class="card" style="left: 160px; top: 120px">
        <div class="card-body">
            <h1 class="card-title">Admin Login</h1>

            {!! Form::open(['url' => '/adminLogin']) !!}

            <div class="form-group">
                {{ Form::label('email', 'E-mail')}}
                {{ Form::text('email', 'admin@aspire.com', ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password')}}
                {{ Form::password('password', ['class' => 'form-control']) }}
            </div>

            <div>
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
