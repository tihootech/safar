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
        </div>
        <div class="row" id="upload-images">
            <div class="col-md-3">
                <h5> {{fa.MAIN_PICTURE}} </h5>
                <p> {{fa.UPLOAD_A_FILE_AS_MAIN}} </p>
                <hr>
                <vue-dropzone ref="mainDropzone" id="main-dropzone" :options="dropzoneOptions"></vue-dropzone>
            </div>
            <div class="col-md-9">
                <h5> {{fa.OTHER_PICTURES}} </h5>
                <p> {{fa.DZ_HELP}} </p>
                <hr>
                <vue-dropzone ref="otherDropzone" id="other-dropzone" :options="dropzoneOptions"></vue-dropzone>
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
                                <th> {{fa.DELETE}} </th>
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
                            <tr v-for="v, i in country.visas">
                                <input type="hidden" name="id" v-model="v.id">
                                <th class="steper"> {{i+1}} </th>
                                <td align="center">
                                    <a href="javascript:void(0)" @click="deleteRow(i, v.id)"> <i class="mdi mdi-delete text-danger"></i> </a>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="name" v-model="v.name">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="latin_name" v-model="v.latin_name" dir="ltr">
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
                                <td class="counseling-checkboxes">
                                    <label class="cr-styled">
                                        <input type="checkbox" name="counselings" value="1" :checked="v.counselings && v.counselings.includes(1)">
                                        <i class="fa"></i>
                                        {{fa.IN_TEXT}}
                                    </label>
                                    <label class="cr-styled">
                                        <input type="checkbox" name="counselings" value="2" :checked="v.counselings && v.counselings.includes(2)">
                                        <i class="fa"></i>
                                        {{fa.IN_TELEPHONE}}
                                    </label>
                                    <label class="cr-styled">
                                        <input type="checkbox" name="counselings" value="3" :checked="v.counselings && v.counselings.includes(3)">
                                        <i class="fa"></i>
                                        {{fa.IN_VIDEO}}
                                    </label>
                                    <label class="cr-styled">
                                        <input type="checkbox" name="counselings" value="4" :checked="v.counselings && v.counselings.includes(4)">
                                        <i class="fa"></i>
                                        {{fa.IN_PERSON}}
                                    </label>
                                </td>
                                <td class="text-center">
                                    <label class="cr-styled">
                                        <input type="checkbox" name="online_sopping" v-model="v.online_sopping" value="1">
                                        <i class="fa"></i>
                                        {{fa.YES}}
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

import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';


export default {
    components: {
        'vueDropzone': vue2Dropzone
    },
    props : ['fa'],
    data() {
        return {
            country: {
                visas : [{}],
                gallery : [{}],
            },
            deletelist : [],
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
                country : this.country,
                visas : this.country.visas,
                deletelist : this.deletelist,
                gallery: []
            }

            // sending the path of main uploaded file to back-end
            let mainImage = this.$refs.mainDropzone.getAcceptedFiles();
            if (mainImage.length > 0 && mainImage[0].filename) {
                formData.gallery.push({
                    main : 1,
                    path : mainImage[0].filename
                });
            }

            // sending the path of other uploaded files to back-end
            let otherImages = this.$refs.otherDropzone.getAcceptedFiles();
            if (otherImages.length > 0) {
                for (var i = 0; i < otherImages.length; i++) {
                    if (otherImages[i].filename) {
                        formData.gallery.push({
                            main : 0,
                            path : otherImages[i].filename
                        });
                    }
                }
            }

            // read counseling checkboxes and send to back-end
            $('.counseling-checkboxes').each(function(index, el) {
                var list = [];
                $(this).find('input[type=checkbox]:checked').each(function() {
                    list.push($(this).val());
                });
                formData.visas[index].counselings = list.join(',');
            });


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
        },
        deleteRow : function (index, id) {
            let visas = this.country.visas;
            if (visas.length < 2) {
                swalWarning(this.fa.CANT_DELETE_ALL);
            }else {
                visas.splice(index, 1);
                if (id) {
                    this.deletelist.push(id);
                }
            }
        }
    },
    mounted: function() {
        // find object in db if country id is provided
        var cid = this.$route.params.cid;
        if (cid) {
            axios.get(`api/country/get/${cid}`).then( res => {
                this.country = res.data;
                let gallry = res.data.gallery;
                if (gallry.length) {
                    for (var i = 0; i < gallry.length; i++) {
                        var file = { size: 0, name: gallry[i].path.replace('/storage/images/',''), type: "image/png" };
                        var url = gallry[i].path;
                        if (gallry[i].main) {
                            this.$refs.mainDropzone.manuallyAddFile(file, url);
                        }else {
                            this.$refs.otherDropzone.manuallyAddFile(file, url);
                        }
                    }
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

    .excel-form thead th:nth-child(-n+2) { /* 1 & 2 */
        min-width: 20px;
    }

    .excel-form thead th:nth-child(n+3):nth-child(-n+6) { /* 3~6 */
        min-width: 200px;
    }

    .excel-form thead th:nth-child(7) { /* 7 */
        min-width: 70px;
    }

    .excel-form thead th:nth-child(8) { /* 8 */
        min-width: 225px;
    }

    .excel-form thead th:nth-child(9) { /* 9 */
        min-width: 100px;
    }

    .excel-form thead th:nth-child(n+10) { /* after 10 */
        min-width: 300px;
    }

    .upload-hidden-image + i {
        display: none;
    }

</style>
