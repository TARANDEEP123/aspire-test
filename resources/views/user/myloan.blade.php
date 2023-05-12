@extends('layouts.user')
@section('content')
    <h1>My Loans</h1>
    <div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
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
                    <td>{{$data[$i]->loan_type->name}}</td>
                    <td>{{$data[$i]->amount}}</td>
                    <td>{{$data[$i]->sanctioned_at}}</td>
                    <td>{{$data[$i]->loan_status->name}}</td>
                    <td>{{$data[$i]->note}}</td>
                    <td>
                        @if($data[$i]->loan_status->id == 6)
                            <a class="btn btn-primary" role="button"
                               href="/earlyLoanClosure/{{$data[$i]->id}}?url=loanHistory">Early Close</a>
                        @endif
                        <a class="btn btn-primary" role="button" href="/loanDetail/{{$data[$i]->id}}">Detail</a>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
@endsection
