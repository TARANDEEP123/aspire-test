@section('sidebar')
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" style="margin: 40px;">{{$error}}</div>
        @endforeach
    @endif

    @if(session('failure'))
        <div class="alert alert-danger" style="margin: 40px">{{session('failure')}}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success" style="margin: 40px">{{session('success')}}</div>
    @endif
@show

