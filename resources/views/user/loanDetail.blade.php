@extends(Auth::id() === 1 ? 'layouts.admin' : 'layouts.user')
@section('content')
    <p></p>
    <h1>Loan detail</h1>
    <p></p>
    <div>
        <table>
            <tbody>
            <tr>
                <td><b>Loan Name:</b></td>
                <td>{{$data->loan_type->name}}</td>
            </tr>
            <tr>
                <td><b>User:</b></td>
                <td>{{$data->user->email}}</td>
            </tr>
            <tr>
                <td><b>Sanctioned:</b></td>
                <td>{{$data->sanctioned_at}}</td>
            </tr>
            <tr>
                <td><b>Loan Status:</b></td>
                <td>{{$data->loan_status->name}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Amount</th>
                <th scope="col">Due Date</th>
                <th scope="col">Paid at</th>
                <th scope="col">Payment</th>
                <th scope="col">Verified on</th>
                <th scope="col">Action(s)</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($data->loan_repayments); $i++)
                <tr>
                    <th scope="row">{{$i + 1}}</th>
                    <td>{{$data->loan_repayments[$i]->amount}}</td>
                    <td>{{$data->loan_repayments[$i]->due_date}}</td>
                    <td>{{$data->loan_repayments[$i]->paid_at}}</td>
                    <td>
                        @if($data->loan_repayments[$i]->payment_type_id)
                            {{$data->loan_repayments[$i]->payment_type->name}}
                        @endif
                    </td>
                    <td>{{$data->loan_repayments[$i]->verified_at}}</td>
                    <td>
                        @if(!$data->loan_repayments[$i]->verified_at && auth()->id() === 1)
                            <a class="btn btn-primary" role="button"
                               href="/verifyPayment/{{$data->loan_repayments[$i]->id}}?url=loanDetail/{{$data->id}}">
                                Verify
                            </a>
                        @elseif(is_null($data->loan_repayments[$i]->paid_at) && auth()->id() >= 2)
                            <a class="btn btn-primary" role="button"
                               href="/premiumPayment/{{$data->loan_repayments[$i]->id}}?url=loanDetail/{{$data->id}}">
                                Pay
                            </a>
                        @endif
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
@endsection
