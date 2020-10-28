<template>
  <div>
      <div class="page-head mt-4">
          <h4> {{fa.VISA_LIST}} </h4>
      </div>
      <div class="card" v-if="countries.length">
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hovered">
                      <thead>
                          <tr>
                              <th> # </th>
                              <th> {{fa.COUNTRY_FA_NAME}} </th>
                              <th> {{fa.COUNTRY_LATIN_NAME}} </th>
                              <th> {{fa.ISO_CODE}} </th>
                              <th> {{fa.COUNTRY_CODE}} </th>
                              <th colspan="3"> {{fa.ACTIONS}} </th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="c, i in countries">
                              <td> {{i+1}} </td>
                              <td> {{c.fa_name}} </td>
                              <td> {{c.latin_name}} </td>
                              <td> {{c.iso_code}} </td>
                              <td> {{c.country_code}} </td>
                              <td class="text-center">
                                  <a href="#" data-toggle="modal" class="btn btn-info btn-sm" data-target="#visa-list" @click="getVisas(c.id)">
                                      <i class="mdi mdi-format-list-bulleted ml-1"></i>
                                      {{fa.VISA_LIST}}
                                  </a>
                              </td>
                              <td class="text-center">
                                  <a :href="`#/visa/${c.id}`" class="btn btn-success btn-sm">
                                      <i class="mdi mdi-pencil ml-1"></i>
                                      {{fa.EDIT}}
                                  </a>
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

      <div class="modal fade" id="visa-list" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">{{fa.VISA_LIST}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div v-for="v, i in visas">
                          <hr v-if="i">
                          <table class="table table-responsive-md">
                              <thead>
                                  <tr>
                                      <th> {{fa.NAME}} </th>
                                      <th> {{fa.LATIN_NAME}} </th>
                                      <th> {{fa.VISA_TYPE}} </th>
                                      <th> {{fa.QUIZ}} </th>
                                      <th> {{fa.AVAILABLE_COUNSELING}} </th>
                                      <th> {{fa.ONLINE_SOPPING}} </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td> {{v.name}} </td>
                                      <td> {{v.latin_name}} </td>
                                      <td> {{v.type}} </td>
                                      <td> {{v.quiz}} </td>
                                      <td> {{displayCounselings(v.counselings)}} </td>
                                      <td v-html="boolIcon(v.online_sopping)"> </td>
                                  </tr>
                              </tbody>
                          </table>
                          <p> <b>{{fa.DOCUMENTS}}</b> : {{v.documents ? v.documents : '-' }} </p>
                          <p> <b>{{fa.CONDITIONS}}</b> : {{v.conditions ? v.conditions : '-' }} </p>
                          <p> <b>{{fa.ISSUANCE_TIME}}</b> : {{v.issuance_time ? v.issuance_time : '-' }} </p>
                          <p> <b>{{fa.ISSUANCE_STEPS}}</b> : {{v.issuance_steps ? v.issuance_steps : '-' }} </p>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div>
</template>

<script>
export default {
    props : ['fa'],
    data() {
        return { countries: [], visas: [] }
    },
    mounted : function () {
        axios.get('/api/visa/index').then( res => {
            this.countries = res.data;
        });
    },
    methods : {
        getVisas : function (cid) {
            axios.get(`/api/visa/get/${cid}`).then( res => {
                this.visas = res.data;
            });
        },
        displayCounselings : function (str) {
            return str.replace("1", this.fa.IN_TEXT).replace("2", this.fa.IN_TELEPHONE).replace("3", this.fa.IN_VIDEO).replace("4", this.fa.IN_PERSON).replace(',', '،');
        },
        destroy : function (index) {
            var countries = this.countries;
            var cid = countries[index].id;
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
                    countries.splice(index);
                    axios.delete(`/api/visa/${cid}`).then( res => {
                        if (res.data.success) {
                            swalSuccess(fa.ITEM_DELETED);
                        }
                    });
                }
            });
        }
    }
}
</script>

<style lang="css" scoped>
</style>
