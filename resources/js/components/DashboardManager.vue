<template>
    <div>
        <router-view :fa="fa"></router-view>
    </div>
</template>

<script>
    import fa from '../../lang/fa.json';
    import VueRouter from 'vue-router';
    import Dashboard from './Dashboard.vue';
    import VisaList from './VisaList.vue';
    import NewVisa from './NewVisa.vue';

    export default {
        router : new VueRouter ({
            routes : [
                {
                    path : '/home',
                    name : 'home',
                    component : Dashboard,
                },
                {
                    path : '/',
                    redirect : {name : 'home'}
                },
                {
                    path : '/visa-list',
                    component : VisaList,
                },
                {
                    path : '/new-visa',
                    component : NewVisa,
                }
            ]
        }),
        data(){
            return{
                fa: fa
            }
        }
    }
</script>
