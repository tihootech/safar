<template>
    <form @submit.prevent="formSubmit" method="post">

        <!-- BASIC INPUTS -->
        <div class="page-head">
            <h4 class="mt-2 mb-2"> {{fa.NEW_VISA}} </h4>
        </div>
        <div class="card card-body" id="country-data">
            <div class="row justify-content-center">
                <div class="col-md-3 form-group">
                    <label> {{fa.COUNTRY_FA_NAME}} </label>
                    <input type="text" class="form-control" name="fa_name" v-model="country.fa_name">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.COUNTRY_LATIN_NAME}} </label>
                    <input type="text" class="form-control" name="latin_name" v-model="country.latin_name">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.ISO_CODE}} </label>
                    <input type="text" class="form-control" name="iso_code" v-model="country.iso_code" maxlength="2" dir="ltr">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.COUNTRY_CODE}} </label>
                    <input type="text" class="form-control" name="country_code" v-model="country.country_code" dir="ltr">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.LANG}} </label>
                    <input type="text" class="form-control" name="lang" v-model="country.lang">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.LOCAL_NAME}} </label>
                    <input type="text" class="form-control" name="local_name" v-model="country.local_name">
                </div>
                <div class="col-md-12 form-group">
                    <label> {{fa.BRIEF_INFO}} </label>
                    <textarea name="brief_info" rows="3" class="form-control" v-model="country.brief_info"></textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label> {{fa.FULL_INFO}} </label>
                    <textarea name="full_info" rows="6" class="form-control" v-model="country.full_info"></textarea>
                </div>

            </div>
        </div>

        <!-- UPLOAD PICTURES -->
        <div class="page-head d-flex justify-content-between my-2">
            <h4> {{fa.UPLOAD_PICTURES}}</h4>
            <a href="javascript:void(0)" class="btn btn-info btn-sm ml-3 cloner" data-target="upload-images">
                <i class="mdi mdi-plus"></i> {{fa.NEW_PICTURE}}
            </a>
        </div>
        <div class="row" id="upload-images">
            <div class="col-md-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h5 class="header-title"> {{fa.MAIN_PICTURE}} </h5>
                        <label for="input-file-now" class="mb-3">{{fa.THIS_WILL_BE_YOUR_MAIN_PICTURE}}</label>
                        <input type="file" name="main_picture" class="dropify" />
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-none model">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="header-title"> {{fa.OTHER_PICTURES}} </h5>
                            <a href="javascript:void(0)" class="remove-cloned"> <i class="mdi mdi-delete text-danger"></i> </a>
                        </div>
                        <label for="input-file-now" class="mb-3">{{fa.PICTURE_NUMBER_X}} <span></span> </label>
                        <input type="file" name="pictures[]"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- VISA TYPES -->
        <div class="page-head d-flex justify-content-between my-2">
            <h4> {{fa.DEFINE_VISA_TYPE}}</h4>
            <a href="javascript:void(0)" class="btn btn-info btn-sm ml-3" @click="addNewVisa">
                <i class="mdi mdi-plus"></i> {{fa.ADD_NEW_VISA}}
            </a>
        </div>
        <div class="card my-3 ">
            <div class="card-body">
                <div class="excel-form">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> {{fa.NAME}} </th>
                                <th> {{fa.LATIN_NAME}} </th>
                                <th> {{fa.VISA_TYPE}} </th>
                                <th> {{fa.CHOOSE_QUIZ}} </th>
                                <th> {{fa.FIRST_PICTURE}} </th>
                                <th> {{fa.AVAILABLE_COUNSELING}} </th>
                                <th> {{fa.ONLINE_SOPPING}} </th>
                                <th> {{fa.DOCUMENTS}} </th>
                                <th> {{fa.CONDITIONS}} </th>
                                <th> {{fa.ISSUANCE_TIME}} </th>
                                <th> {{fa.ISSUANCE_STEPS}} </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="v, i in country.visas" class="model">
                                <input type="hidden" name="id" v-model="v.id">
                                <th class="steper"> {{i+1}} </th>
                                <td>
                                    <input type="text" class="form-control" name="name" v-model="v.name">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="latin_name" v-model="v.latin_name">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="type" v-model="v.type">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="quiz" v-model="v.quiz">
                                </td>
                                <td>
                                    <label class="btn btn-link">
                                        {{fa.UPLOAD}}
                                        <input type="file" class="form-control upload-hidden-image d-none" name="first_picture">
                                        <i class="mdi mdi-check-circle"></i>
                                    </label>
                                </td>
                                <td>
                                    <select class="form-control" name="counselings" dir="rtl" v-model="v.counselings">
                                        <option value="1" :selected="v.counselings && v.counselings.includes('1')"> {{fa.IN_TEXT}} </option>
                                        <option value="2" :selected="v.counselings && v.counselings.includes('2')"> {{fa.IN_TELEPHONE}} </option>
                                        <option value="3" :selected="v.counselings && v.counselings.includes('3')"> {{fa.IN_VIDEO}} </option>
                                        <option value="4" :selected="v.counselings && v.counselings.includes('4')"> {{fa.IN_PERSON}} </option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <label class="cr-styled">
                                        <input type="checkbox" name="online_sopping" :checked="v.online_sopping" value="1">
                                        <i class="fa"></i>
                                    </label>
                                </td>
                                <td>
                                    <textarea name="documents" rows="1" class="form-control" v-model="v.documents"></textarea>
                                </td>
                                <td>
                                    <textarea name="conditions" rows="1" class="form-control" v-model="v.conditions"></textarea>
                                </td>
                                <td>
                                    <textarea name="issuance_time" rows="1" class="form-control" v-model="v.issuance_time"></textarea>
                                </td>
                                <td>
                                    <textarea name="issuance_steps" rows="1" class="form-control" v-model="v.issuance_steps"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row justify-content-center my-3">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block"> <i class="mdi mdi-check"></i> {{fa.CONFIRM}} </button>
            </div>
        </div>

    </form>
</template>

<script>

export default {
    props : ['fa'],
    data() {
        return {
            country: {
                id: 0,
                visas: [{}]
            }
        }
    },
    methods : {
        formSubmit : function () {
            var formData = {
                country : this.country,
                visas : this.country.visas,
            }
            axios.post('/api/visa/upsert', formData).then( res => {
                if (res.status == 200 && res.data.success) {
                    redirect("/dashboard#/visa-list");
                    swalSuccess();
                }else {
                    swalError();
                }
            }).catch( err => {
                if (err.response.status == 422) { // validation error
                    swalValidationErrors(err.response.data.errors);
                }
            });
        },
        addNewVisa : function () {
            this.country.visas.push({});
        }
    },
    mounted: function() {

        $('.select2').select2(window.SELECT2_OPTIONS);
        $('.dropify').dropify(window.DROPIFY_OPTIONS);

        // find object in db if country id is provided
        var cid = this.$route.params.cid;
        if (cid) {
            axios.get(`api/country/get/${cid}`).then( res => {
                this.country = res.data;
            });
        }

    }
}
</script>

<style scoped>
    .remove-cloned {
        font-size: 1.75em;
    }

    .sticky-top {
        padding-top: 60px;
    }

    .model .remove-cloned {
        display: none;
    }

    .excel-form {
        white-space: nowrap;
        overflow-x: auto;
    }

    .excel-form thead th:nth-child(1) { /* 1 */
        min-width: 20px;
    }

    .excel-form thead th:nth-child(n+2):nth-child(-n+5) { /* 2~5 */
        min-width: 200px;
    }

    .excel-form thead th:nth-child(6) { /* 6 */
        min-width: 70px;
    }

    .excel-form thead th:nth-child(7) { /* 7 */
        min-width: 225px;
    }

    .excel-form thead th:nth-child(8) { /* 8 */
        min-width: 100px;
    }

    .excel-form thead th:nth-child(n+9) { /* after 9 */
        min-width: 300px;
    }

    .upload-hidden-image + i {
        display: none;
    }

</style>
