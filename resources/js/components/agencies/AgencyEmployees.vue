<template>
  <div>
      <div class="page-head mt-4">
          <h4> {{agency.name}} ({{agency.latin_name}}) </h4>
      </div>
      <div class="card my-2">
          <div class="card-body">
              <h6 class="text-info font-weight-bold"> {{fa.USERS_WITH_MANAGER_ACCESS}} </h6>
              <employees-table :fa="fa" :list="agency.managers"></employees-table>
          </div>
      </div>
      <div class="card my-2">
          <div class="card-body">
              <h6 class="text-info font-weight-bold"> {{fa.USERS_WITH_COUNSELER_ACCESS}} </h6>
              <employees-table :fa="fa" :list="agency.counselers"></employees-table>
          </div>
      </div>
  </div>
</template>

<script>

import EmployeesTable from './EmployeesTable.vue';

export default {
    props : ['fa'],
    components : {
        'employees-table' : EmployeesTable
    },
    data() {
        return { agency: [] }
    },
    mounted : function () {
        axios.get('/api/agency/current').then( res => {
            this.agency = res.data;
        });
    }
}
</script>

<style lang="css" scoped>
</style>
