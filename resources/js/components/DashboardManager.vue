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
    import AgencyEmployees from './agencies/AgencyEmployees.vue';

    import ManageAccount from './acc/ManageAccount.vue';
    import UserList from './acc/UserList.vue';

    import TextMessages from './sms/TextMessages.vue';

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
                {
                    path : '/edit-agency',
                    component : AgencyForm,
                    name : 'edit-agency'
                },
                {
                    path : '/agency-employees',
                    component : AgencyEmployees,
                    name : 'agency-employees'
                },
                {
                    path : '/acc',
                    component : ManageAccount,
                    name : 'manage-account'
                },
                {
                    path : '/user-list',
                    component : UserList,
                    name : 'user-list'
                },
                {
                    path : '/text-messages',
                    component : TextMessages,
                    name : 'text-messages'
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
