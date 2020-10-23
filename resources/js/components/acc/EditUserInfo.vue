<template>
    <form class="row justify-content-center" @submit.prevent="formSubmit">
        <div :class="'col-md-'+colspan">
            <label> {{fa.NAME}} </label>
            <input type="text" class="form-control" v-model="user.name">
        </div>
        <div :class="'col-md-'+colspan">
            <label> {{fa.EMAIL}} </label>
            <input type="text" class="form-control" v-model="user.email">
        </div>
        <div :class="'col-md-'+colspan">
            <label> {{fa.PHONE}} </label>
            <input type="text" class="form-control" v-model="user.phone">
        </div>
        <div class="w-100 my-2"></div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-block btn-sm"> <i class="mdi mdi-check"></i> {{fa.EDIT}} </button>
        </div>
    </form>
</template>

<script>
export default {
    props : ['fa', 'user', 'colspan'],
    methods : {
        formSubmit : function () {
            axios.put(`/api/user/${this.user.id}`, this.user).then( res => {
                if (res.data.success) {
                    $('.modal').modal('hide');
                    swalSuccess(this.fa.USER_UPDATED_SUCCESSFULLY);
                }
            }).catch( err => {
                if (err.response.status == 422) { // validation error
                    swalValidationErrors(err.response.data.errors);
                }
            });
        }
    }
}
</script>

<style lang="css" scoped>
</style>
