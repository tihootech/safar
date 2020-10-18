<template>
    <div>
        <router-view :fa="fa"></router-view>
    </div>
</template>

<script>
    import fa from '../../lang/fa.json'; // translate file
    import VueRouter from 'vue-router';
    import Home from './Home.vue';
    import VisaList from './visas/VisaList.vue';
    import VisaForm from './visas/VisaForm.vue';
    import AgencyList from './agencies/AgencyList.vue';
    import AgencyForm from './agencies/AgencyForm.vue';

    export default {
        router : new VueRouter ({
            routes : [
                {
                    path : '/home',
                    name : 'home',
                    component : Home
                },
                {
                    path : '/',
                    redirect : {name : 'home'}
                },
                {
                    path : '/visa-list',
                    component : VisaList,
                    name : 'visa-list'
                },
                {
                    path : '/visa/:cid?',
                    component : VisaForm,
                    name : 'visa-form'
                },
                {
                    path : '/agency-list',
                    component : AgencyList,
                    name : 'agency-list'
                },
                {
                    path : '/agency/:aid?',
                    component : AgencyForm,
                    name : 'agency-form'
                },
            ]
        }),
        data(){
            return{
                fa: fa
            }
        }
    }
</script>
