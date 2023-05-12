@extends('layouts.admin')
@section('content')
    <h1>Create Loan</h1>

    {!! Form::open(['url' => '/loanTypes']) !!}
    <div class="form-group">
        {{ Form::label('name')}}
        {{ Form::text('name','', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('description')}}
        {{ Form::text('description', '',['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('amount')}}
        {{ Form::number('amount', '',['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('interest_rate')}}
        {{ Form::number('interest_rate', '',['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('duration')}}
        {{ Form::number('duration','', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('arrangement_fee')}}
        {{ Form::number('arrangement_fee','', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('repayment_frequency_type_id')}}
        {{ Form::select('repayment_frequency_type_id', [1 => 'Weekly', 2 => 'Monthly', 3 => 'Yearly'], '1') }}
    </div>

    <div>
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@endsection
