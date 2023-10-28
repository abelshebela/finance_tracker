<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/finance_tracker/dashboard">Finance Tracker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/finance_tracker/dashboard">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="transactionsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Budget
                </a>
                <div class="dropdown-menu" aria-labelledby="transactionsDropdown">
                    <a class="dropdown-item" href="/finance_tracker/budget/add_budget">Add Budget</a>
                    <a class="dropdown-item" href="/finance_tracker/budget/view_budget">View Budgets</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="transactionsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Transactions
                </a>
                <div class="dropdown-menu" aria-labelledby="transactionsDropdown">
                    <a class="dropdown-item" href="/finance_tracker/transaction/add_income">Add Income</a>
                    <a class="dropdown-item" href="/finance_tracker/transaction/add_expense">Add Expense</a>
                    <a class="dropdown-item" href="/finance_tracker/transaction/view_transactions">View Transactions</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/finance_tracker/goal/financial_goals">Financial Goals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/finance_tracker/profile">User Profile</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="/finance_tracker/notification">Notifications</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>
