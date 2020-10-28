<template>
  <div>
      <div class="page-head mt-4">
          <h4> {{fa.TEXT_MESSAGES_LIST}} </h4>
      </div>
      <div class="text-center mb-3" v-if="list.length">
          <a href="javascript:void(0)" class="btn btn-info" @click="refresh">
              <i class="mdi mdi-comment-question-outline ml-1"></i>
              {{fa.RECHECK_SMS_STATUS}}
          </a>
      </div>
      <div class="card" v-if="list.length">
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hovered">
                      <thead>
                          <tr>
                              <th> # </th>
                              <th> {{fa.RECEPTOR}} </th>
                              <th> {{fa.TEXT}} </th>
                              <th> {{fa.SENT}} </th>
                              <th> {{fa.DATE}} </th>
                              <th> {{fa.TIME}} </th>
                              <th> {{fa.SENDER}} </th>
                              <th> {{fa.COST}} </th>
                              <th colspan="2"> {{fa.ACTIONS}} </th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="sms, i in list">
                              <td> {{i+1}} </td>
                              <td> {{sms.receptor}} </td>
                              <td> {{sms.body}} </td>
                              <td v-html="boolIcon(sms.sent)"> </td>
                              <td>
                                  {{persianDate(sms.created_at)}}
                              </td>
                              <td>
                                  {{getTime(sms.created_at)}}
                              </td>
                              <td>
                                  <span v-if="sms.sent">{{sms.sender}}</span>
                                  <em v-else> {{fa.NOT_SENT_YET}} </em>
                              </td>
                              <td>
                                  <span v-if="sms.sent">{{sms.cost+fa.T}}</span>
                                  <em v-else> {{fa.NOT_SENT_YET}} </em>
                              </td>
                              <td class="text-center">
                                  <a v-if="sms.sent" href="javascript:void(0)" class="btn btn-info btn-sm" @click="resend(i)">
                                      <i class="mdi mdi-refresh ml-1"></i>
                                      {{fa.RESEND}}
                                  </a>
                                  <em v-else> {{fa.NOT_SENT_YET}} </em>
                              </td>
                              <td class="text-center">
                                  <a href="javascript:void(0)" class="btn btn-danger btn-sm" @click="destroy(i)">
                                      <i class="mdi mdi-delete ml-1"></i>
                                      {{fa.DELETE}}
                                  </a>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
      <div class="alert alert-info" v-else>
          <i class="mdi mdi-alert"></i> {{fa.NOTHING_FOUND}}
      </div>
  </div>
</template>

<script>
export default {
    props : ['fa'],
    data() {
        return { list: [] }
    },
    mounted : function () {
        axios.get('/api/sms/index').then( res => {
            this.list = res.data;
        });
    },
    methods : {
        destroy : function (index) {
            var list = this.list;
            var smsid = list[index].id;
            var fa = this.fa;
            swal({
                title: this.fa.ARE_YOU_SURE,
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-secondary',
                confirmButtonText: fa.YES,
                cancelButtonText: fa.CANCEL,
            }).then(function (result) {
                if (result.value) {
                    list.splice(index, 1);
                    axios.delete(`/api/sms/${smsid}`).then( res => {
                        if (res.data.success) {
                            swalSuccess(fa.ITEM_DELETED);
                        }
                    });
                }
            });
        },
        resend : function (index) {
            var list = this.list;
            var smsid = list[index].id;
            var fa = this.fa;
            swal({
                title: this.fa.ARE_YOU_SURE_TO_RESEND,
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-secondary',
                confirmButtonText: fa.YES,
                cancelButtonText: fa.CANCEL,
            }).then(function (result) {
                if (result.value) {
                    axios.post(`/api/sms/resend/${smsid}`).then( res => {
                        if (res.data.success) {
                            swalSuccess(fa.SMS_Q_TO_SENT);
                            list.unshift(res.data.sms);
                        }
                    });
                }
            });
        },
        refresh : function () {
            axios.get('/api/sms/index').then( res => {
                this.list = res.data;
            });
        }
    }
}
</script>

<style lang="css" scoped>
</style>
