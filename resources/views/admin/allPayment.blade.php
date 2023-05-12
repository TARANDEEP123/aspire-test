@extends('layouts.admin')
@section('content')
    <h1>All Payment</h1>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">id</th>
                <th scope="col">User</th>
                <th scope="col">Loan</th>
                <th scope="col">Amount</th>
                <th scope="col">Due date</th>
                <th scope="col">Paid At</th>
                <th scope="col">Verified At</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($data); $i++)
                <tr>
                    <th scope="row">{{$i + 1}}</th>
                    <td>{{$data[$i]->id}}</td>
                    <td>{{$data[$i]->user->email}}</td>
                    <td>{{$data[$i]->loan->loan_type->name}}</td>
                    <td>{{$data[$i]->amount}}</td>
                    <td>{{$data[$i]->due_date}}</td>
                    <td>{{$data[$i]->paid_at}}</td>
                    <td>{{$data[$i]->verified_at}}</td>
                    <td>
                        @if(!$data[$i]->verified_at && auth()->id() === 1)
                            <a href="/verifyPayment/{{$data[$i]->id}}?url=/allPayment">
                                Verify Payment
                            </a>
                        @endif
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
@endsection
