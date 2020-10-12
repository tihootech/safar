<template>
    <div>
        <router-view :fa="fa"></router-view>
    </div>
</template>

<script>
    import fa from '../../lang/fa.json'; // translate file
    import VueRouter from 'vue-router';
    import Home from './Home.vue';
    import VisaList from './VisaList.vue';
    import NewVisa from './NewVisa.vue';

    export default {
        router : new VueRouter ({
            routes : [
                {
                    path : '/home',
                    name : 'home',
                    component : Home,
                },
                {
                    path : '/',
                    redirect : {name : 'home'}
                },
                {
                    path : '/visa-list',
                    component : VisaList,
                    name : 'visa-list',
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
