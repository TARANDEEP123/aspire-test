@extends('layouts.admin')
@section('content')
    <h1>Loan Due</h1>
    <div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">id</th>
                <th scope="col">User</th>
                <th scope="col">Loan</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th>
                <th scope="col">Action(s)</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($data); $i++)
                <tr>
                    <th scope="row">{{$i + 1}}</th>
                    <td>{{$data[$i]->id}}</td>
                    <td>{{$data[$i]->user->email}}</td>
                    <td>{{$data[$i]->loan_type->name}}</td>
                    <td>{{$data[$i]->amount}}</td>
                    <td>{{$data[$i]->loan_status->name}}</td>
                    <td>
                        @if($data[$i]->loan_status->id == OPEN_LOAN_STATUS_ID)
                            <a class="btn btn-warning" role="button" href="/defaultLoan/{{$data[$i]->id}}">Default</a>
                        @endif
                        <a class="btn btn-primary" role="button" href="/loanDetail/{{$data[$i]->id}}">Detail</a>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
@endsection
