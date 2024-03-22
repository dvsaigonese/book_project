@extends('admin.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div id="dashboard-container" class="container">
        <h3>Orders</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xxl-5 g-4">
            <div class="col d-flex">
                <div class="card text-primary border-primary flex-fill">
                    <div class="card-header row-cols-md-2 row-cols-sm-2 row-cols-lg-1 row-cols-xl-2">
                        <i class="ti-shopping-cart"></i>
                        <h4 class="card-title">Today Orders</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-text" id="today-orders">100</h1>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card text-primary border-primary flex-fill">
                    <div class="card-header">
                        <i class="ti-shopping-cart"></i>
                        <h4 class="card-title">Today Pending Orders</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-text" id="today-pending-orders">100</h1>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card text-primary border-primary flex-fill">
                    <div class="card-header">
                        <i class="ti-shopping-cart"></i>
                        <h4 class="card-title">Total Pending Orders</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-text" id="total-pending-orders">100</h1>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card text-primary border-primary flex-fill">
                    <div class="card-header">
                        <i class="ti-shopping-cart"></i>
                        <h4 class="card-title">Total Canceled Orders</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-text" id="total-canceled-orders">100</h1>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card text-primary border-primary flex-fill">
                    <div class="card-header row-cols-md-2 row-cols-sm-2 row-cols-lg-1 row-cols-xl-2">
                        <i class="ti-shopping-cart"></i>
                        <h4 class="card-title">Total Orders</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-text" id="total-orders">100</h1>
                    </div>
                </div>
            </div>
        </div>
        <h3>Profit</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-xxl-4 g-4">
            <div class="col d-flex">
                <div class="card  border-warning flex-fill">
                    <div class="card-header">
                        <i class="ti-money"></i>
                        <h4 class="card-title">Today Profit</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-text" id="today-profit">100</h1>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card  border-warning flex-fill">
                    <div class="card-header">
                        <i class="ti-money"></i>
                        <h4 class="card-title">This Month Profit</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-text" id="this-month-profit">100</h1>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card  border-warning flex-fill">
                    <div class="card-header">
                        <i class="ti-money"></i>
                        <h4 class="card-title">This Year Profit</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-text" id="this-year-profit">100</h1>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card  border-warning flex-fill">
                    <div class="card-header">
                        <i class="ti-money"></i>
                        <h4 class="card-title">Total Profit</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-text" id="total-profit">100</h1>
                    </div>
                </div>
            </div>
        </div>
        <h3>Others Control</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-4">
            <div class="col d-flex">
                <div class="card  text-danger border-danger flex-fill">
                    <div class="card-header">
                        <i class="ti-book"></i>
                        <h4 class="card-title">Books List</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-text" id="books-list">100</h1>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card  text-danger border-danger flex-fill">
                    <div class="card-header">
                        <i class="ti-user"></i>
                        <h4 class="card-title">Users List</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-text" id="user-list">100</h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('styles')
    <style>
        #dashboard-container a {
            cursor: pointer;
            padding: 0.5rem;
            color: white;
            border: #111111 1px solid;
            border-radius: 5px;
        }

        #dashboard-container h3 {
            margin: 1rem;
        }
    </style>
@endsection
