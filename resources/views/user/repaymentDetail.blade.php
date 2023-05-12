@extends('layouts.user')
@section('content')
    <h1>Repayments Details</h1>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Loan</th>
                <th scope="col">Amount</th>
                <th scope="col">Due Date</th>
                <th scope="col">Paid at</th>
                <th scope="col">Payment source</th>
                <th scope="col">Verified on</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row"> 1</th>
                <td>{{$data->loan->loan_type->name}}</td>
                <td>{{$data->amount}}</td>
                <td>{{$data->due_date}}</td>
                <td>{{$data->paid_at}}</td>
                <td>{{$data->payment_type->name}}</td>
                <td>{{$data->verified_at}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
