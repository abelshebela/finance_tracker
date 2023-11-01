<?php
session_start();
include 'includes/db.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="dashboard.php">Finance Tracker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="transactionsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Budget
                </a>
                <div class="dropdown-menu" aria-labelledby="transactionsDropdown">
                    <a class="dropdown-item" href="add_budget.php">Add Budget</a>
                    <a class="dropdown-item" href="view_budget.php">View Budgets</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="transactionsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Transactions
                </a>
                <div class="dropdown-menu" aria-labelledby="transactionsDropdown">
                    <a class="dropdown-item" href="add_income.php">Add Income</a>
                    <a class="dropdown-item" href="add_expense.php">Add Expense</a>
                    <a class="dropdown-item" href="view_transactions.php">View Transactions</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="financial_goals.php">Financial Goals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">User Profile</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="notification.php">Notifications</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
