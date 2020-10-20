<template>
    <form @submit.prevent="formSubmit" method="post">

        <!-- BASIC INPUTS -->
        <div class="page-head">
            <h4 class="mt-2 mb-2"> {{fa.NEW_AGENCY}} </h4>
        </div>
        <div class="card card-body" id="agency-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-4 form-group">
                            <label> {{fa.AGENCY_NAME}} </label>
                            <input type="text" class="form-control" name="name" v-model="agency.name">
                        </div>
                        <div class="col-md-4 form-group">
                            <label> {{fa.AGENCY_LATIN_NAME}} </label>
                            <input type="text" class="form-control" name="latin_name" v-model="agency.latin_name" dir="ltr">
                        </div>
                        <div class="col-md-4 form-group">
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
                        <div class="col-md-6 form-group">
                            <label> {{fa.WEBSITE}} </label>
                            <input type="text" class="form-control" name="website" v-model="agency.website">
                        </div>
                        <div class="col-md-6 form-group">
                            <label> {{fa.EMAIL}} </label>
                            <input type="text" class="form-control" name="email" v-model="agency.email">
                        </div>
                        <div class="col-md-12 form-group">
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
                                <div class="col-md-4 form-group" v-for="phone, i in phonelist">
                                    <label class="d-flex justify-content-between">
                                        {{fa.TELEPHONE}}
                                        <button type="button" class="btn btn-link btn-sm" @click="removePhone(i)">
                                            <i class="mdi mdi-delete text-danger"></i>
                                        </button>
                                    </label>
                                    <input type="text" class="form-control" name="phonelist" :value="phone" @change="updatePhoneList">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> {{fa.BRIEF_INFO}} </label>
                        <textarea name="brief_info" rows="3" class="form-control" v-model="agency.brief_info"></textarea>
                    </div>
                    <div class="form-group">
                        <label> {{fa.FULL_INFO}} </label>
                        <vue-editor v-model="agency.full_info" :editorToolbar="customToolbar"></vue-editor>
                    </div>
                </div>
            </div>
        </div>

        <!-- UPLOAD PICTURES -->
        <div class="page-head d-flex justify-content-between my-2">
            <h4> {{fa.UPLOAD_PICTURES}}</h4>
        </div>
        <div class="row" id="upload-images">
            <div class="col-md-4">
                <h5> {{fa.MAIN_PICTURE}} </h5>
                <p> {{fa.UPLOAD_A_FILE_AS_MAIN}} </p>
                <hr>
                <vue-dropzone ref="mainDropzone" @vdropzone-removed-file="dzRemoveMain" id="main-dropzone" :options="dropzoneOptions"></vue-dropzone>
            </div>
            <div class="col-md-4">
                <h5> {{fa.UPLOAD_LOGO}} </h5>
                <p> {{fa.UPLOAD_A_FILE_AS_LOGO}} </p>
                <hr>
                <vue-dropzone ref="logoDropzone" @vdropzone-removed-file="dzRemoveLogo" id="logo-dropzone" :options="dropzoneOptions"></vue-dropzone>
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
                                <th> {{fa.RATE}} </th>
                                <th> {{fa.PHONE}} </th>
                                <th> {{fa.EMAIL}} </th>
                                <th> {{fa.ABOUT_COUNSELER}} </th>
                                <th colspan="2"> {{fa.ACTIONS}} </th>
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
                                    <select class="form-control" name="access_type" v-model="e.access_type">
                                        <option :value="i+1" v-for="a, i in accesstypes" :selected="a==e.access_type" >{{a}}</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="rate" v-model="e.rate">
                                        <option :value="r" v-for="r in rates" :selected="r==e.rate" >{{r}}</option>
                                    </select>
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
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" v-bind:data-target="`#set-visas-${i}`">
                                        {{fa.SET_AVAILABLE_VISAS}}
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" v-bind:data-target="`#set-hours-${i}`">
                                        {{fa.COUNSELING_HOURS}}
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <section id="modals">
            <div v-for="e, i in agency.employees">
                <div class="modal fade" :id="`set-hours-${i}`" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{fa.SET_COUNSELING_HOURS}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 v-if="e.first_name && e.last_name" class="mb-3"> <i class="mdi mdi-account ml-1"></i> {{`${e.first_name} ${e.last_name}`}} </h5>
                                <div class="schedule" v-for="day, dayNumber in weekDays">
                                    <div class="bg-info text-light">
                                        {{day}}
                                    </div>
                                    <div v-for="range in dayHours" @click="setHour(dayNumber, range, i)" :class="{'bg-success text-light':(e.hours && e.hours.includes(`${dayNumber},${range}`))}">
                                        {{range}}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"> {{fa.CONFIRM}} </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-for="e, i in agency.employees">
                <div class="modal fade" :id="`set-visas-${i}`" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{fa.SET_AVAILABLE_VISAS}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 v-if="e.first_name && e.last_name" class="mb-3"> <i class="mdi mdi-account ml-1"></i> {{`${e.first_name} ${e.last_name}`}} </h5>
                                <table class="table">
                                    <thead>
                                        <th> {{fa.SELECT}} </th>
                                        <th> {{fa.VISA_NAME}} </th>
                                        <th> {{fa.VISA_LATIN_NAME}} </th>
                                        <th> {{fa.COUNTRY}} </th>
                                        <th> {{fa.VISA_TYPE}} </th>
                                        <th> {{fa.AVAILABLE_COUNSELING}} </th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="visa,index in allvisas">
                                            <td>
                                                <label class="cr-styled">
                                                    <input type="checkbox" @change="setVisa(visa.id, i)" :checked="isVisaChecked(visa.id, i)">
                                                    <i class="fa"></i>
                                                </label>
                                            </td>
                                            <td> {{visa.name}} </td>
                                            <td> {{visa.latin_name}} </td>
                                            <td> {{visa.country_name}} </td>
                                            <td> {{visa.type}} </td>
                                            <td> {{displayCounselings(visa.counselings)}} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"> {{fa.CONFIRM}} </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row justify-content-center my-3">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block"> <i class="mdi mdi-check"></i> {{fa.CONFIRM}} </button>
            </div>
        </div>

    </form>
</template>

<script>

import vue2Dropzone from 'vue2-dropzone';
import { VueEditor } from "vue2-editor";
import 'vue2-dropzone/dist/vue2Dropzone.min.css';


export default {
    components: {
        'vueDropzone': vue2Dropzone,
        'VueEditor' : VueEditor
    },
    props : ['fa'],
    data() {
        return {
            weekDays : [this.fa.SATURDAY, this.fa.SUNDAY, this.fa.MONDAY, this.fa.TUESDAY, this.fa.WEDNESDAY, this.fa.THRSDAY, this.fa.FRIDAY],
            dayHours : ['6~7', '7~8', '8~9', '9~10', '10~11', '11~12', '12~13', '13~14', '14~15', '15~16', '16~17', '17~18', '18~19', '19~20'],
            accesstypes : [this.fa.COUNSELER, this.fa.MANAGER],
            rates : [1,2,3,4,5],
            customToolbar: [["bold", "italic", "underline", "strike"], [{ align:"right" }, { align:"center" }, { align:"" }], [{ list: "ordered" }, { list: "bullet" }]],
            phonelist : [''],
            deletelist : [],
            allvisas : [],
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
                }
            }
        }
    },
    methods : {
        dzRemoveLogo : function (file) {
            if (this.$refs.logoDropzone.dropzone.disabled !== true) {
                let path = '/storage/images/'+file.name;
                axios.post('/api/gallery/delete', {path:path});
            }
        },
        dzRemoveMain : function (file) {
            if (this.$refs.mainDropzone.dropzone.disabled !== true) {
                let path = '/storage/images/'+file.name;
                axios.post('/api/gallery/delete', {path:path});
            }
        },
        setHour : function (day, range, employeeIndex) {
            var employee = this.agency.employees[employeeIndex];
            var hoursList = employee.hours ? employee.hours : [];
            var format = `${day},${range}`;
            var foundIndex = hoursList.indexOf(format);
            if (foundIndex == -1) {
                hoursList.push(format);
            }else {
                hoursList.splice(foundIndex, 1);
            }
            this.agency.employees[employeeIndex].hours = hoursList;
        },
        setVisa : function (vid, employeeIndex) {
            var employee = this.agency.employees[employeeIndex];
            var visaList = employee.vlist ? employee.vlist : [];
            var foundIndex = visaList.indexOf(vid);
            if (foundIndex == -1) {
                visaList.push(vid);
            }else {
                visaList.splice(foundIndex, 1);
            }
            this.agency.employees[employeeIndex].vlist = visaList;
        },
        isVisaChecked : function (vid, employeeIndex) {
            var employee = this.agency.employees[employeeIndex];
            var visaList = employee.vlist ? employee.vlist : [];
            var foundIndex = visaList.indexOf(vid.toString());
            return foundIndex != -1;
        },
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
            formData.agency.phones = this.phonelist.join(',');

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
        updatePhoneList : function () {
            var list = [];
            $('[name=phonelist]').each(function (i) {
                list[i] = $(this).val();
            });
            this.phonelist = list;
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
        },
        displayCounselings : function (str) {
            return str.replace("1", this.fa.IN_TEXT).replace("2", this.fa.IN_TELEPHONE).replace("3", this.fa.IN_VIDEO).replace("4", this.fa.IN_PERSON).replace(',', '،');
        }
    },
    mounted: function() {

        // get all visas from db
        axios.get('api/visa/all/').then( res => {
            this.allvisas = res.data;
        });

        // find object in db if agency id is provided
        var aid = this.$route.params.aid;
        if (aid) {
            axios.get(`api/agency/get/${aid}`).then( res => {
                this.agency = res.data;
                let first_picture = res.data.first_picture;
                let logo = res.data.logo;
                let phones = res.data.phones;

                // load pictures
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

                // display phones
                if (phones) {
                    this.phonelist = phones.split(',');
                }

                // display employee schedule && mark selected visas for each employee
                var employees = res.data.employees;
                for (var i = 0; i < employees.length; i++) {
                    let e = employees[i];
                    e.hours = e.schedule ? e.schedule.split('&') : [];
                    e.vlist = e.available_visas ? e.available_visas.split(',') : [];
                }
                this.agency.employees = employees;

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

    .schedule {
        display: flex;
    }

    .schedule > div {
        text-align: center;
        border: 1px solid #000;
        padding: 10px;
        width: 6.66%;
    }

    .schedule > div:not(:first-child) {
        cursor: pointer;
        direction: ltr;
    }

    .excel-form thead th:nth-child(n+3):nth-child(-n+5), .excel-form thead th:nth-child(n+8):nth-child(-n+9) { /* 3~5 & 8~9 */
        min-width: 150px;
    }

    .excel-form thead th:nth-child(6) { /* 6 */
        min-width: 125px;
    }

    .excel-form thead th:nth-child(10) { /* 10 */
        min-width: 200px;
    }

</style>
