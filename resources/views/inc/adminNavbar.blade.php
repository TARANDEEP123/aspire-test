<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand"
           href="/adminHomePage"><?php use Illuminate\Support\Facades\Auth;echo Auth::user()->email?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <button type="button" class="btn btn-primary">
                    <a class="nav-link active" aria-current="page" href="/adminHomePage">
                        Loan Application
                    </a>
                </button>
                <button type="button" class="btn btn-primary">
                    <a class="nav-link active" href="/loanDue">Loan Dues</a>
                </button>
                <button type="button" class="btn btn-primary">
                    <a class="nav-link active" href="/loanType">Loans Type</a>
                </button>
                <button type="button" class="btn btn-primary">
                    <a class="nav-link active" href="/allPayment">Payments</a>
                </button>
                <button type="button" class="btn btn-primary">
                    <a class="nav-link" href="/logout" tabindex="-1" aria-disabled="true">Logout</a>
                </button>
            </div>
        </div>
    </div>
</nav>

