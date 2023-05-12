@extends('layouts.user')
@section('content')
    <h1>My Repayments</h1>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">id</th>
                <th scope="col">Loan</th>
                <th scope="col">Amount</th>
                <th scope="col">Due Date</th>
                <th scope="col">Paid at</th>
                <th scope="col">source</th>
                <th scope="col">Verified on</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($data); $i++)
                <tr>
                    <th scope="row">{{$i + 1}}</th>
                    <td>{{$data[$i]->id}}</td>
                    <td>{{$data[$i]->loan->loan_type->name}}</td>
                    <td>{{$data[$i]->amount}}</td>
                    <td>{{$data[$i]->due_date}}</td>
                    <td>{{$data[$i]->paid_at}}</td>
                    <td>
                        @if($data[$i]->payment_type_id)
                            {{$data[$i]->payment_type->name}}
                        @endif
                    </td>
                    <td>{{$data[$i]->verified_at}}</td>
                    <td>
                        @if(is_null($data[$i]->paid_at) && auth()->id() >= 2)
                            <a href="/premiumPayment/{{$data[$i]->id}}?url=repaymentHistory">Pay</a>
                        @endif
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
@endsection
