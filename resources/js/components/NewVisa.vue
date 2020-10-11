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
                    <input type="text" class="form-control" name="fa_name" value="">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.COUNTRY_LATIN_NAME}} </label>
                    <input type="text" class="form-control" name="latin_name" value="">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.ISO_CODE}} </label>
                    <input type="text" class="form-control" name="iso_code" value="" maxlength="2" dir="ltr">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.COUNTRY_CODE}} </label>
                    <input type="text" class="form-control" name="country_code" value="" dir="ltr">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.LANG}} </label>
                    <input type="text" class="form-control" name="lang" value="">
                </div>
                <div class="col-md-3 form-group">
                    <label> {{fa.LOCAL_NAME}} </label>
                    <input type="text" class="form-control" name="local_name" value="">
                </div>
                <div class="col-md-12 form-group">
                    <label> {{fa.BRIEF_INFO}} </label>
                    <textarea name="brief_info" rows="3" class="form-control"></textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label> {{fa.FULL_INFO}} </label>
                    <textarea name="full_info" rows="6" class="form-control"></textarea>
                </div>

            </div>
        </div>

        <!-- UPLOAD PICTURES -->
        <div class="card bg-info text-light my-4">
            <div class="card-body py-0">
                <div class="page-head d-flex justify-content-between">
                    <h4> {{fa.UPLOAD_PICTURES}}</h4>
                    <a href="javascript:void(0)" class="btn btn-light btn-sm ml-3 cloner" data-target="upload-images">
                        <i class="mdi mdi-plus"></i> {{fa.NEW_PICTURE}}
                    </a>
                </div>
            </div>
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
        <div class="sticky-top">
            <div class="card bg-info text-light">
                <div class="card-body py-0">
                    <div class="page-head d-flex justify-content-between">
                        <h4> {{fa.DEFINE_VISA_TYPE}}</h4>
                        <a href="javascript:void(0)" class="btn btn-light btn-sm ml-3 cloner" data-target="visas">
                            <i class="mdi mdi-plus"></i> {{fa.ADD_NEW_VISA}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="visas">
            <div class="card my-3 model">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5> ویزا شماره <span>1</span> </h5>
                        <a href="javascript:void(0)" class="remove-cloned"> <i class="mdi mdi-delete text-danger"></i> </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3 form-group">
                            <label> {{fa.NAME}} </label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="col-md-3 form-group">
                            <label> {{fa.LATIN_NAME}} </label>
                            <input type="text" class="form-control" name="latin_name" value="">
                        </div>
                        <div class="col-md-3 form-group">
                            <label> {{fa.VISA_TYPE}} </label>
                            <input type="text" class="form-control" name="type" value="">
                        </div>
                        <div class="col-md-3 form-group">
                            <label> {{fa.CHOOSE_QUIZ}} </label>
                            <input type="text" class="form-control" name="quiz" value="">
                        </div>
                        <div class="col-md-3 form-group">
                            <label> {{fa.FIRST_PICTURE}} </label>
                            <input type="file" class="form-control form-control-sm" name="first_picture" value="">
                        </div>
                        <div class="col-md-4 form-group">
                            <label> {{fa.AVAILABLE_COUNSELING}} </label>
                            <select class="select2" name="counselings" multiple dir="rtl">
                                <option value="1"> {{fa.IN_TEXT}} </option>
                                <option value="2"> {{fa.IN_TELEPHONE}} </option>
                                <option value="3"> {{fa.IN_VIDEO}} </option>
                                <option value="4"> {{fa.IN_PERSON}} </option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="cr-styled">
                                <input type="checkbox" name="online_sopping" value="1">
                                <i class="fa"></i>
                                {{fa.ONLINE_SOPPING}}
                            </label>
                        </div>
                        <div class="col-md-12 form-group">
                            <label> {{fa.DOCUMENTS}} </label>
                            <textarea name="documents" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label> {{fa.CONDITIONS}} </label>
                            <textarea name="conditions" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label> {{fa.ISSUANCE_TIME}} </label>
                            <textarea name="issuance_time" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label> {{fa.ISSUANCE_STEPS}} </label>
                            <textarea name="issuance_steps" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
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
    methods : {
        formSubmit : function () {
            var countryData = {};
            var visas = [];
            $('#country-data input, textarea').each(function() {
                var name = $(this).attr('name');
                countryData[name] = $(this).val();
            });
            $('#visas > .card').each(function() {
                var visaData = {};
                $(this).find('input, select, textarea').each(function() {
                    var type = $(this).attr('type');
            		var name = $(this).attr('name');
            		var value = type == 'checkbox' ? $(this).is(':checked') : $(this).val();
            		visaData[name] = value;
                });
                visas.push(visaData);
            });
            var formData = {
                country : countryData,
                visas : visas
            };
            axios.post('/api/visa/store', formData).then( res => {
                console.log(res);
                if (res.status == 200 && res.data.success) {
                    window.location.href = "/dashboard#/visa-list";
                    swalSuccess();
                }else {
                    swalError();
                }
            }).catch( err => {
                if (err.response.status == 422) { // validation error
                    swalValidationErrors(err.response.data.errors);
                }
            });
        }
    },
    mounted: function() {
        $('.dropify').dropify(window.DROPIFY_OPTIONS);
        $('.select2').select2(window.SELECT2_OPTIONS);
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
</style>
