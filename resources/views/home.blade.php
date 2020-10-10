@extends('layouts.dashboard')


@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2"> @lang('DASHBOARD') </h4>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="row">

                    <div class="col-lg-3 col-sm-3">
                        <div class="widget-box bg-white m-b-30">
                            <div class="row d-flex text-center align-items-center">
                                <div class="col-2">
                                    <div class="text-center"><i class="ti ti-money ti-1"></i></div>
                                </div>
                                <div class="col-4">
                                    <div class="dynamicbar">@lang('LOADING...')</div>
                                </div>
                                <div class="col-6">
                                    <h2 class="m-0 counter">548</h2>
                                    <p>@lang('TODAY_SELL_COUNT')</p>
                                </div>
                            </div>
                       </div>
                    </div>

                    <div class="col-lg-3 col-sm-3">
                       <div class="widget-box bg-white m-b-30">
                            <div class="row d-flex text-center align-items-center">
                                <div class="col-2">
                                    <div class="text-center"><i class="ti ti-wallet ti-2"></i></div>
                                </div>
                                <div class="col-4">
                                    <div class="dynamicbar">@lang('LOADING...')</div>
                                </div>
                                <div class="col-6">
                                    <h2 class="m-0 counter">15,800,000</h2>
                                    <p>@lang('TODAY_INCOME')</p>
                                </div>
                            </div>
                       </div>
                    </div>

                    <div class="col-lg-3 col-sm-3">
                       <div class="widget-box bg-white m-b-30">
                            <div class="row d-flex text-center align-items-center text-center">
                                <div class="col-2">
                                    <div class="text-center"><i class="ti ti-calendar ti-3"></i></div>
                                </div>
                                <div class="col-4">
                                    <div class="inlinesparkline">@lang('LOADING...')</div>
                                </div>
                                <div class="col-6">
                                    <h2 class="m-0 counter">946</h2>
                                    <p>@lang('TODAY_COUNSELING_SESSIONS')</p>
                                </div>
                            </div>
                       </div>
                    </div>

                    <div class="col-lg-3 col-sm-3">
                        <div class="widget-box bg-white m-b-30">
                            <div class="row d-flex text-center align-items-center">
                                <div class="col-2">
                                    <div class="text-center"><i class="ti ti-id-badge ti-4"></i></div>
                                </div>
                                <div class="col-4">
                                    <div class="inlinesparkline">@lang('LOADING...')</div>
                                </div>
                                <div class="col-6">
                                    <h2 class="m-0 counter">999</h2>
                                    <p>@lang('ACTIVE_VISA_COUNT')</p>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="row">

            <div class="col-lg-3 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title pb-3"> @lang('RECENT_SHOP_LIST') </h5>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        تقویم ...
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
