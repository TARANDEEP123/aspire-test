@extends('layouts.user')
@section('content')
    <p></p>
    <h1>Loan type</h1>
    @if(auth()->id() === 1)
        <div align="right" class="container">
            <a class="btn btn-primary" href="/createLoanTypeForm" role="button">Create Loan Types</a>
        </div>
        <p></p>
    @else
        <p></p>
        <h3>Apply for loan</h3>
    @endif

    <div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Amount</th>
                <th scope="col">Interest (%)</th>
                <th scope="col">Duration</th>
                <th scope="col">Fee</th>
                <th scope="col">Action(s)</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($data); $i++)
                <tr>
                    <th scope="row">{{$i + 1}}</th>
                    <td>{{$data[$i]->name}}</td>
                    <td>{{$data[$i]->description}}</td>
                    <td>{{$data[$i]->amount}}</td>
                    <td>{{$data[$i]->interest_rate}}</td>
                    <td>{{$data[$i]->duration}}</td>
                    <td>{{$data[$i]->arrangement_fee}}</td>
                    <td>
                        @if(auth()->id() !== 1)
                            <a class="btn btn-primary" role="button" role="button"
                               href="/applyForLoan/{{$data[$i]->id}}">Apply</a>
                        @endif
                    </td>

                </tr>
            @endfor
            </tbody>
        </table>
    </div>
@endsection
@section('sidebar')
    @parent
@endsection
