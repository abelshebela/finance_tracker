<?php
session_start();
include 'includes/db.php';
?>
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" data-target="#budgetDropdown">
                                Budget
                            </a>
                            <ul class="nav flex-column sub-menu collapse" id="budgetDropdown">
                                <li class="nav-item">
                                    <a class="nav-link" href="add_budget.php">
                                        Add Budget
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="view_budget.php">
                                        View Budgets
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" data-target="#transactionsDropdown">
                                Transactions
                            </a>
                            <ul class="nav flex-column sub-menu collapse" id="transactionsDropdown">
                                <li class="nav-item">
                                    <a class="nav-link" href="add_income.php">
                                        Add Income
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="add_expense.php">
                                        Add Expense
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="view_transactions.php">
                                        View Transactions
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="financial_goals.php">
                                Financial Goals
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">
                                User Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="notification.php">
                                Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>


