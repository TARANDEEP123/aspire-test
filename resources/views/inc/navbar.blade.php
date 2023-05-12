<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand"
           href="/userHomePage"><?php use Illuminate\Support\Facades\Auth;echo Auth::user()->email?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <button type="button" class="btn btn-dark">
                    <a class="nav-link active" aria-current="page" href="/userHomePage">Home</a>
                </button>
                <button type="button" class="btn btn-dark">
                    <a class="nav-link active" href="/loanHistory">My loans</a>
                </button>
                <button type="button" class="btn btn-dark">
                    <a class="nav-link active" href="/repaymentHistory">My repayments</a>
                </button>
                <button type="button" class="btn btn-dark">
                    <a class="nav-link" href="/logout" tabindex="-1" aria-disabled="true">Logout</a>
                </button>
            </div>
        </div>
    </div>
</nav>

