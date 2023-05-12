@extends('layouts.admin')
@section('content')
    <p></p>
    <h1>Home page</h1>
    <p></p>
    <h2>Loan Application</h2>
    <p></p>
    <div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">id</th>
                <th scope="col">User</th>
                <th scope="col">Loan</th>
                <th scope="col">Amount</th>
                <th scope="col">Sanctioned</th>
                <th scope="col">Status</th>
                <th scope="col">Note</th>
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
                    <td>{{$data[$i]->sanctioned_at}}</td>
                    <td>{{$data[$i]->loan_status->name}}</td>
                    <td>{{$data[$i]->note}}</td>
                    <td>
                        @if($data[$i]->loan_status->id == APPLIED_LOAN_STATUS_ID)
                            <a class="btn btn-success" role="button" href="/approveLoan/{{$data[$i]->id}}">Approve</a>
                            <a class="btn btn-danger" role="button" href="/rejectLoan/{{$data[$i]->id}}">Reject</a>
                        @endif
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
