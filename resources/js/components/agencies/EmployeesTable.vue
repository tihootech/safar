<template>
  <div class="table-responsive">
      <table class="table">
          <thead>
              <tr>
                  <th> {{fa.NAME}} </th>
                  <th> {{fa.NATIONAL_CODE}} </th>
                  <th> {{fa.PHONE}} </th>
                  <th> {{fa.EMAIL}} </th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="e, i in list">
                  <td> {{e.first_name+' '+e.last_name}} </td>
                  <td> {{e.national_code}} </td>
                  <td> {{e.phone}} </td>
                  <td> {{e.email}} </td>
              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
export default {
    props : ['fa', 'list']
}
</script>

<style lang="css" scoped>
</style>
