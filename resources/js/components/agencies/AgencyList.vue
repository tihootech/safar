<template>
  <div>
      <div class="page-head mt-4">
          <h4> {{fa.AGENCY_LIST}} </h4>
      </div>
      <div class="card">
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hovered">
                      <thead>
                          <tr>
                              <th> # </th>
                              <th> {{fa.AGENCY_NAME}} </th>
                              <th> {{fa.AGENCY_LATIN_NAME}} </th>
                              <th> {{fa.MANAGER_NAME}} </th>
                              <th> {{fa.MANAGER_PHONE}} </th>
                              <th> {{fa.ITGUY_NAME}} </th>
                              <th> {{fa.ITGUY_PHONE}} </th>
                              <th colspan="3"> {{fa.ACTIONS}} </th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="a, i in agencies">
                              <td> {{i+1}} </td>
                              <td> {{a.name}} </td>
                              <td> {{a.latin_name}} </td>
                              <td> {{a.manager_name}} </td>
                              <td> {{a.manager_phone}} </td>
                              <td> {{a.itguy_name}} </td>
                              <td> {{a.itguy_phone}} </td>
                              <td class="text-center">
                                  <a :href="`#/agency/${a.id}`" class="btn btn-success btn-sm">
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

      <div class="modal fade" id="agency-list" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">{{fa.AGENCY_LIST}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div v-for="e, i in agencies">
                          <hr v-if="i">
                          <table class="table table-responsive-md">
                              <thead>
                                  <tr>
                                      <th> {{fa.NAME}} </th>
                                      <th> {{fa.NATIONAL_CODE}} </th>
                                      <th> {{fa.ACCESS_TYPE}} </th>
                                      <th> {{fa.AVAILABLE_LICENSES}} </th>
                                      <th> {{fa.RATE}} </th>
                                      <th> {{fa.PHONE}} </th>
                                      <th> {{fa.EMAIL}} </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td> {{e.first_name + ' ' + e.last_name}} </td>
                                      <td> {{e.national_code}} </td>
                                      <td> {{e.access_type}} </td>
                                      <td> {{e.available_licenses}} </td>
                                      <td> {{e.rate}} </td>
                                      <td> {{e.phone}} </td>
                                      <td> {{e.email}} </td>
                                  </tr>
                              </tbody>
                          </table>
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
        return { agencies: [] }
    },
    mounted : function () {
        axios.get('/api/agency/index').then( res => {
            this.agencies = res.data;
        });
    },
    methods : {
        destroy : function (index) {
            var agencies = this.agencies;
            var aid = agencies[index].id;
            var fa = this.fa;
            swal({
                title: fa.ARE_YOU_SURE,
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-secondary',
                confirmButtonText: fa.YES,
                cancelButtonText: fa.CANCEL,
            }).then(function () {
                agencies.splice(index);
                axios.delete(`/api/agency/${aid}`).then( res => {
                    if (res.data.success) {
                        swalSuccess(fa.ITEM_DELETED);
                    }
                });
            });
        }
    }
}
</script>

<style lang="css" scoped>
</style>
