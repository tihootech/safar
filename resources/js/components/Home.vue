<template>
    <div>
        <div v-if="user.type == 'ADMIN'">
            <div class="row mt-5">
                <div class="col-lg-12 col-sm-12">
                    <div class="row">

                        <div class="col-lg-3 col-sm-3">
                            <div class="widget-box bg-white m-b-30">
                                <div class="row d-flex text-center align-items-center">
                                    <div class="col-4">
                                        <div class="text-center"><i class="ti ti-money ti-1"></i></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="dynamicbar">{{fa.LAST_WEEK_CHART}}</div>
                                    </div>
                                    <hr class="col-10">
                                    <div class="col-12">
                                        <h3 class="m-0 counter">548</h3>
                                        <p>{{fa.TODAY_SELL_COUNT}}</p>
                                    </div>
                                </div>
                           </div>
                        </div>

                        <div class="col-lg-3 col-sm-3">
                           <div class="widget-box bg-white m-b-30">
                                <div class="row d-flex text-center align-items-center">
                                    <div class="col-4">
                                        <div class="text-center"><i class="ti ti-wallet ti-2"></i></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="dynamicbar">{{fa.LAST_WEEK_CHART}}</div>
                                    </div>
                                    <hr class="col-10">
                                    <div class="col-12">
                                        <h3 class="m-0 counter">15,800,000</h3>
                                        <p>{{fa.TODAY_INCOME}}</p>
                                    </div>
                                </div>
                           </div>
                        </div>

                        <div class="col-lg-3 col-sm-3">
                           <div class="widget-box bg-white m-b-30">
                                <div class="row d-flex text-center align-items-center text-center">
                                    <div class="col-4">
                                        <div class="text-center"><i class="ti ti-calendar ti-3"></i></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="inlinesparkline">{{fa.LAST_WEEK_CHART}}</div>
                                    </div>
                                    <hr class="col-10">
                                    <div class="col-12">
                                        <h3 class="m-0 counter">946</h3>
                                        <p>{{fa.TODAY_COUNSELING_SESSIONS}}</p>
                                    </div>
                                </div>
                           </div>
                        </div>

                        <div class="col-lg-3 col-sm-3">
                            <div class="widget-box bg-white m-b-30">
                                <div class="row d-flex text-center align-items-center">
                                    <div class="col-4">
                                        <div class="text-center"><i class="ti ti-id-badge ti-4"></i></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="inlinesparkline">{{fa.LAST_WEEK_CHART}}</div>
                                    </div>
                                    <hr class="col-10">
                                    <div class="col-12">
                                        <h3 class="m-0 counter">850</h3>
                                        <p>{{fa.ACTIVE_VISA_COUNT}}</p>
                                    </div>
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-3 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5 class="header-title pb-3"> {{fa.RECENT_SHOP_LIST}} </h5>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            تقویم ......
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div  v-if="user.type == 'COUNSELER'">
            <div class="card mt-4">
                <div class="card-body">
                    <schedule :fa="fa" :employee="user.employee" :index="-1"></schedule>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

    import Schedule from './agencies/Schedule.vue';

    export default {
        props : ['fa'],
        components : {
            'schedule' : Schedule
        },
        data(){
            return{
                user : {}
            }
        },
        mounted : function () {
            axios.get('/api/user/current').then( res => {
                this.user = res.data;
            });
        }
    }
</script>
