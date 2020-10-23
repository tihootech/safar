<template>
    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hovered">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{fa.NAME}} </th>
                                    <th> {{fa.EMAIL}} </th>
                                    <th> {{fa.PHONE}} </th>
                                    <th> {{fa.ACCESS_LEVEL}} </th>
                                    <th> {{fa.REGISTER_DATE}} </th>
                                    <th> {{fa.SHOP_COUNT}} </th>
                                    <th> {{fa.ORDERS_LIST}} </th>
                                    <th> {{fa.BEDEHKARI}} </th>
                                    <th> {{fa.BESTANKARI}} </th>
                                    <th> {{fa.ACTIVE}} </th>
                                    <th colspan="3"> {{fa.ACTIONS}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="u, i in users">
                                    <td> {{i+1}} </td>
                                    <td> {{u.name}} </td>
                                    <td> {{u.email}} </td>
                                    <td> {{u.phone}} </td>
                                    <td> {{fa[u.type]}} </td>
                                    <td> {{persianDate(u.created_at)}} </td>
                                    <td> 0 </td>
                                    <td> - </td>
                                    <td> 0 </td>
                                    <td> 0 </td>
                                    <td v-html="boolIcon(u.active)"> </td>
                                    <td>
                                        <button type="button" :class="'btn btn-sm ' + (u.active ? 'btn-warning' : 'btn-info')" @click="changeActivationStatus(u.id, i)">
                                            <span v-if="u.active">{{fa.INACTIVATE}}</span>
                                            <span v-else>{{fa.ACTIVATE}}</span>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit-user" @click="loadUser(u.id)">
                                            <i class="mdi mdi-pencil"></i> {{fa.EDIT}}
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="edit-user" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{fa.EDIT_USER}}</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <edit-user-info :user="user" :fa="fa" :colspan="4"></edit-user-info>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{fa.CANCEL}}</button>
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
        return { users: [], user:null }
    },
    mounted : function () {
        axios.get('/api/user/all').then( res => {
            this.users = res.data;
        });
    },
    methods : {
        changeActivationStatus : function (userid, index) {
            axios.post(`/api/user/change-activation-status/${userid}`).then( res => {
                if (res.data.success) {
                    let result = res.data.active;
                    this.users[index].active = result;

                    let message = result ? this.fa.USER_IS_NOW_ACTIVE : this.fa.USER_IS_NOW_INACTIVE;
                    swalSuccess(message);
                }
            });
        },
        loadUser : function (userid) {
            axios.get(`/api/user/${userid}`).then( res => {
                this.user = res.data;
            });
        }
    }
}
</script>

<style scoped>
</style>
