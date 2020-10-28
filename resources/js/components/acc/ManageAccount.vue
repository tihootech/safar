<template>
    <div class="mt-4">
        <div class="card my-3">
            <div class="card-header">
                {{fa.MANAGE_ACC}}
            </div>
            <div class="card-body">
                <edit-user-info :user="user" :fa="fa" :colspan="3"></edit-user-info>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-header">
                {{fa.CHANGE_PASSWORD}}
            </div>
            <div class="card-body">
                <form class="row justify-content-center" @submit.prevent="updatePassword" id="update-password-form">
                    <div class="col-md-3">
                        <label> {{fa.NEW_PASSWORD}} </label>
                        <input type="password" name="new" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label> {{fa.CONFIRM_NEW_PASSWORD}} </label>
                        <input type="password" name="confirm" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label> {{fa.OLD_PASSWORD}} </label>
                        <input type="password" name="old" class="form-control">
                    </div>
                    <div class="w-100 my-2"></div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block btn-sm"> <i class="mdi mdi-check"></i> {{fa.UPDATE}} </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-header">
                {{fa.MANAGE_SESSIONS}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 my-2" v-for="s,i in user.sessions">
                        <div class="card bg-primary text-light text-center">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h5 class="d-inline"> <small>IP :</small> <b>{{s.ip_address}}</b> </h5>
                                    <h5 v-if="s.same" class="badge badge-light text-dark"> {{fa.THIS_SESSION}} </h5>
                                    <h5 v-else class="badge badge-light text-dark"> {{fa.SOME_SESSION_ELSE}} </h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p> نوع دستگاه : <span v-if="s.devtype"> {{s.devtype}} </span> <span v-else> - </span> </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p> نام دستگاه : <span v-if="s.devname"> {{s.devname}} </span> <span v-else> - </span> </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p> پلتفرم : <span v-if="s.platform"> {{s.platform}} </span> <span v-else> - </span> </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p> مرورگر : <span v-if="s.browser"> {{s.browser}} </span> <span v-else> - </span> </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p> <i class="mdi mdi-calendar-clock"></i> {{fa.LAST_ACTIVITY_DATE}} : </p>
                                        <p> {{persianDate(s.last_activity_date)}} </p>
                                        <p> ساعت <span dir="ltr"> {{getTime(s.last_activity_date)}} </span> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-sm btn-light" :disabled="s.same" @click="cutAccess(i)"> {{fa.CUT_ACCESS}} </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import EditUserInfo from './EditUserInfo.vue';
export default {
    props : ['fa'],
    components : {
        'edit-user-info' : EditUserInfo
    },
    data() {
        return { user: {} }
    },
    mounted : function () {
        axios.get('/api/user/current').then( res => {
            this.user = res.data;
        });
    },
    methods : {
        cutAccess : function (index) {
            let session = this.user.sessions[index];
            var data = {
                user_id : session.user_id,
                user_agent : session.user_agent,
            };
            axios.post('/api/session/clear', data).then( res => {
                if (res.data.success) {
                    this.user.sessions.splice(index, 1);
                    swalSuccess(this.fa.SESSION_DELETED);
                }
            });
        },
        updatePassword : function () {
            var data = {};
            $('#update-password-form input').each(function() {
                data[$(this).attr('name')] = $(this).val();
            });
            axios.put(`/api/user/update-password/${this.user.id}`, data).then( res => {
                if (res.data.errors && res.data.errors.length) {
                    swalValidationErrors(res.data.errors);
                }else if (res.data.success) {
                    redirect('login');
                }
            });
        }
    }
}
</script>

<style scoped>
</style>
