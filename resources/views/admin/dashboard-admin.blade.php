@extends('template.admin-layout')
@section('dashboard-active')
    active
    
@endsection
@section('content')
    <div class="market-updates row text-light">
        <div class="col-md-4 market-update-gd card pt-2 bg-primary">
            <div class="market-update-block clr-block-1">
                <div class="col-md-8 market-update-left">
                    <!--  -->
                    <h3>{{ \App\User::all()->count() }}</h3>
                    <h4>Registered User</h4>
                    <!-- <a href="#" style="color:white; text-decoration: underline">See detail</a> -->
                </div>
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-file-text-o"> </i>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>

        <div class="col-md-4 market-update-gd card bg-primary pt-2">
            <div class="market-update-block clr-block-2">
                <div class="col-md-8 market-update-left">
                    <!--  -->
                    <h3>{{ \App\Pesanan::all()->count() }}</h3>
                    <h4>Transaction</h4>
                
                </div>
                <!-- <div class="col-md-4 market-update-right">
                    <i class="fa fa-eye"> </i>
                </div> -->
                <div class="clearfix"> </div>
            </div>
        </div>

        <div class="col-md-4 market-update-gd card bg-primary pt-2">
            <div class="market-update-block clr-block-3">
                <div class="col-md-8 market-update-left">
                    <h3>{{ \App\Product::all()->count() }}</h3>
                    <h4>Active Product</h4>
                    
                </div>
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-envelope-o"> </i>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
@endsection