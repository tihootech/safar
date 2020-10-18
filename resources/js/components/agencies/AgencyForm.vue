<template>
    <form @submit.prevent="formSubmit" method="post">

        <!-- BASIC INPUTS -->
        <div class="page-head">
            <h4 class="mt-2 mb-2"> {{fa.NEW_AGENCY}} </h4>
        </div>
        <div class="card card-body" id="agency-data">
            <div class="row justify-content-center">
                <div class="col-md-3 form-group">
                    <label> {{fa.AGENCY_NAME}} </label>
                    <input type="text" class="form-control" name="name" v-model="agency.name">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.AGENCY_LATIN_NAME}} </label>
                    <input type="text" class="form-control" name="latin_name" v-model="agency.latin_name" dir="ltr">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.LICENSE_TYPE}} </label>
                    <input type="text" class="form-control" name="license_type" v-model="agency.license_type">
                </div>
                <div class="w-100"></div>
                <div class="col-md-3 form-group">
                    <label> {{fa.MANAGER_NAME}} </label>
                    <input type="text" class="form-control" name="manager_name" v-model="agency.manager_name">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.MANAGER_PHONE}} </label>
                    <input type="text" class="form-control" name="manager_phone" v-model="agency.manager_phone" dir="ltr">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.ITGUY_NAME}} </label>
                    <input type="text" class="form-control" name="itguy_name" v-model="agency.itguy_name">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.ITGUY_PHONE}} </label>
                    <input type="text" class="form-control" name="itguy_phone" v-model="agency.itguy_phone" dir="ltr">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.WEBSITE}} </label>
                    <input type="text" class="form-control" name="website" v-model="agency.website">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.EMAIL}} </label>
                    <input type="text" class="form-control" name="email" v-model="agency.email">
                </div>
                <div class="col-md-6 form-group">
                    <label> {{fa.ADDRESS}} </label>
                    <input type="text" class="form-control" name="address" v-model="agency.address">
                </div>
                <div class="col-md-12">
                    <div class="text-center my-3">
                        <button type="button" class="btn btn-info btn-sm" @click="newPhone">
                            <i class="mdi mdi-plus"></i> {{fa.ADD_NEW_TELEPHONE}}
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group" v-for="phone, i in phonelist">
                            <label class="d-flex justify-content-between">
                                {{fa.TELEPHONE}}
                                <button type="button" class="btn btn-link btn-sm" @click="removePhone(i)">
                                    <i class="mdi mdi-delete text-danger"></i>
                                </button>
                            </label>
                            <input type="text" class="form-control" name="phonelist" :value="phone">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <label> {{fa.BRIEF_INFO}} </label>
                    <textarea name="brief_info" rows="3" class="form-control" v-model="agency.brief_info"></textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label> {{fa.FULL_INFO}} </label>
                    <textarea name="full_info" rows="6" class="form-control" v-model="agency.full_info"></textarea>
                </div>

            </div>
        </div>

        <!-- UPLOAD PICTURES -->
        <div class="page-head d-flex justify-content-between my-2">
            <h4> {{fa.UPLOAD_PICTURES}}</h4>
        </div>
        <div class="row" id="upload-images">
            <div class="col-md-3">
                <h5> {{fa.MAIN_PICTURE}} </h5>
                <p> {{fa.UPLOAD_A_FILE_AS_MAIN}} </p>
                <hr>
                <vue-dropzone ref="mainDropzone" id="main-dropzone" :options="dropzoneOptions"></vue-dropzone>
            </div>
            <div class="col-md-3">
                <h5> {{fa.UPLOAD_LOGO}} </h5>
                <p> {{fa.UPLOAD_A_FILE_AS_LOGO}} </p>
                <hr>
                <vue-dropzone ref="logoDropzone" id="logo-dropzone" :options="dropzoneOptions"></vue-dropzone>
            </div>
        </div>

        <!-- AGENCY TYPES -->
        <div class="page-head d-flex justify-content-between my-2">
            <h4> {{fa.DEFINE_USERS}}</h4>
            <a href="javascript:void(0)" class="btn btn-info btn-sm ml-3" @click="addNewEmployee">
                <i class="mdi mdi-plus"></i> {{fa.ADD_NEW_USER}}
            </a>
        </div>
        <div class="card my-3 ">
            <div class="card-body">
                <div class="excel-form">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> {{fa.DELETE}} </th>
                                <th> {{fa.NAME}} </th>
                                <th> {{fa.LAST_NAME}} </th>
                                <th> {{fa.NATIONAL_CODE}} </th>
                                <th> {{fa.USER_TYPE}} </th>
                                <th> {{fa.AVAILABLE_LICENSES}} </th>
                                <th> {{fa.RATE}} </th>
                                <th> {{fa.PHONE}} </th>
                                <th> {{fa.EMAIL}} </th>
                                <th> {{fa.ABOUT_COUNSELER}} </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="e, i in agency.employees">
                                <input type="hidden" name="id" v-model="e.id">
                                <th class="steper"> {{i+1}} </th>
                                <td align="center">
                                    <a href="javascript:void(0)" @click="deleteRow(i, e.id)"> <i class="mdi mdi-delete text-danger"></i> </a>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="first_name" v-model="e.first_name">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="last_name" v-model="e.last_name">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="national_code" v-model="e.national_code" dir="ltr">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="user_type" v-model="e.user_type">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="available_licenses" v-model="e.available_licenses">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="rate" v-model="e.rate" min="0" max="5">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="phone" v-model="e.phone" dir="ltr">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="email" v-model="e.email" dir="ltr">
                                </td>
                                <td>
                                    <textarea name="info" rows="1" class="form-control" v-model="e.info"></textarea>
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

import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';


export default {
    components: {
        'vueDropzone': vue2Dropzone
    },
    props : ['fa'],
    data() {
        return {
            phonelist : [''],
            deletelist : [],
            agency: {
                employees : [{}],
            },
            dropzoneOptions: {
                url: '/api/gallery/upload',
                maxFilesize: 2,
                acceptedFiles : 'image/*',
                addRemoveLinks: true,
                dictDefaultMessage : this.fa.DZ_MESSAGE,
                dictRemoveFile : this.fa.REMOVE_FILE,
                headers : { 'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content },
                success (file, res) {
                    file.filename = res;
                },
                removedfile(file) {
                    if (this.$refs.vueDropzone.dropzone.disabled !== true) {
                        // clear the image from db
                        let path = '/storage/images/'+file.name;
                        axios.post('/api/gallery/delete', {path:path});
                        // clear the image from display
                        var _ref;
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                    }
                }
            }
        }
    },
    methods : {
        formSubmit : function () {

            var formData = {
                agency : this.agency,
                employees : this.agency.employees,
                gallery: [],
                deletelist : this.deletelist
            }

            // sending the path of main uploaded file and logo to back-end
            let mainImage = this.$refs.mainDropzone.getAcceptedFiles();
            if (mainImage.length > 0 && mainImage[0].filename) {
                formData.gallery.push({
                    name : 'first_picture',
                    path : mainImage[0].filename
                });
            }
            let logoImage = this.$refs.logoDropzone.getAcceptedFiles();
            if (logoImage.length > 0 && logoImage[0].filename) {
                formData.gallery.push({
                    name : 'logo',
                    path : logoImage[0].filename
                });
            }

            // take care of phones and prepare them
            var finalPhoneList = [];
            $('[name=phonelist]').each(function() {
                let val = $(this).val()
                if (val) {
                    finalPhoneList.push(val);
                }
            });
            formData.agency.phones = finalPhoneList.join(',');

            axios.post('/api/agency/upsert', formData).then( res => {
                if (res.status == 200 && res.data.success) {
                    redirect("/dashboard#/agency-list");
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
        addNewEmployee : function () {
            this.agency.employees.push({});
        },
        newPhone : function () {
            this.phonelist.push('');
        },
        removePhone : function (index) {
            if (this.phonelist.length < 2) {
                swalWarning(this.fa.CANT_DELETE_ALL);
            }else {
                this.phonelist.splice(index, 1);
            }
        },
        deleteRow : function (index, id) {
            let employees = this.agency.employees;
            if (employees.length < 2) {
                swalWarning(this.fa.CANT_DELETE_ALL);
            }else {
                employees.splice(index, 1);
                if (id) {
                    this.deletelist.push(id);
                }
            }
        }
    },
    mounted: function() {

        // find object in db if agency id is provided
        var aid = this.$route.params.aid;
        if (aid) {
            axios.get(`api/agency/get/${aid}`).then( res => {
                this.agency = res.data;
                let first_picture = res.data.first_picture;
                let logo = res.data.logo;
                let phones = res.data.phones;
                if (first_picture) {
                    var file = { size: 0, name: first_picture.path.replace('/storage/images/',''), type: "image/png" };
                    var url = first_picture.path;
                    this.$refs.mainDropzone.manuallyAddFile(file, url);
                }
                if (logo) {
                    var file = { size: 0, name: logo.path.replace('/storage/images/',''), type: "image/png" };
                    var url = logo.path;
                    this.$refs.logoDropzone.manuallyAddFile(file, url);
                }
                if (phones) {
                    this.phonelist = phones.split(',');
                }
            });
        }

    }
}
</script>

<style scoped>

    .excel-form {
        white-space: nowrap;
        overflow-x: auto;
    }

</style>
