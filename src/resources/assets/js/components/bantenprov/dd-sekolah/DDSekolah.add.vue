<template>
  <div>

      <div class="col-md-8 col-lg-9 admin-main">

        <!-- ===================================================================== -->
        <div class="row">
        <div class="col-md-12">
          <div class="card mb-3">
            <div class="card-header"><i class="fa fa-bar-chart" aria-hidden="true"></i>Tambah Data PDRB</div>
            <div class="card-body">
            <b-card header="Tambah PDRB Harga Dasar" header-tag="h4" class="bg-success-card">
                          <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="negara">Negara</label>
                                        <input name="negara" type="text" required autofocus placeholder="Negara" class="form-control" v-model="model.negara" />
                                        <field-messages name="negara" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Negara Harus di isi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="province_id"> Provinsi</label>
                                        <select v-model="model.province_id" name="province_id" required autofocus class="form-control">
                                          <option disabled value="">Please select one</option>
                                          <option v-for="province in provinces" v-bind:key="province.id" :value="province.id">{{province.name}}</option>
                                        </select>
                                        <field-messages name="province_id" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Provinsi Harus diisi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="regency_id"> Kota</label>
                                        <select v-model="model.regency_id" name="regency_id" required autofocus class="form-control">
                                          <option disabled value="">Please select one</option>
                                          <option v-for="regency in regencies" v-bind:key="regency.id" :value="regency.id">{{regency.name}}</option>
                                        </select>
                                        <field-messages name="regency_id" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Regency Harus diisi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                             <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="kab_kota">Kabupaten Kota</label>
                                        <input v-model="model.kab_kota" type="radio" name="kab_kota" value="1" />Kabupaten
                                        <input v-model="model.kab_kota" type="radio" name="kab_kota" value="0" />Kota
                                        <field-messages name="kab_kota" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Kabupaten Kota Harus diisi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-lg-12">

                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="tahun">Tahun</label>
                                        <input name="tahun" type="number" required autofocus placeholder="Tahun" class="form-control" v-model="model.tahun" />
                                        <field-messages name="tahun" show="$invalid && $submitted" class="text-danger">
                                           <div slot="required">Tahun Harus diisi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="data">Data</label>
                                        <input name="data" type="number" required autofocus placeholder="Data" class="form-control number" v-model="model.data" />
                                        <field-messages name="data" show="$invalid && $submitted" class="text-danger">
                                           <div slot="required">Data Harus diisi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-md-offset-4 col-md-8 m-t-25">
                                <button type="submit" class="btn btn-primary">Submit
                                </button>
                                <button type="reset" class="btn btn-effect-ripple btn-secondary  reset_btn1" @click="form_reset">
                                    Reset
                                </button>
                                <button type="reset" class="btn btn-danger" @click="back">
                                    Back
                                </button>
                            </div>
                          </vue-form>
            </b-card>
          </div> </div>  </div>
          </div>
        <!-- ===================================================================== -->

      </div><!-- /col -->
    </div><!-- /.row -->
</template>


<script>
import Vue from 'vue';
import VueForm from "vue-form";
import options from "../../../components/validations/validations.js";

Vue.use(VueForm, options);
import Datepicker from 'vuejs-datepicker';
import miniToastr from 'mini-toastr';
miniToastr.init();
export default {
    name: "dd_sekolah_add",
    components: {
        Datepicker
    },
    data() {
        return {
            dd_sekolahs: [],
            provinces: [],
            regencies: {},
            formstate: {},
            model: {
                negara: "",
                province_id: "",
                kab_kota: "",
                regency_id: "",
                tahun: "",
                data: ""
            },
            old_file: ""
        }
    },
    methods: {
        isNumber: function(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
            evt.preventDefault();;
          } else {
            return true;
          }
        },
        onSubmit: function() {
            if (this.formstate.$invalid) {
                return;
            } else {
              if(this.model.tahun >= 2000 && this.model.tahun <= (new Date()).getFullYear())
              {
                axios.post("/dd-sekolah/store", {
                  negara: this.model.negara,
                  province_id: this.model.province_id,
                  kab_kota: this.model.kab_kota,
                  regency_id: this.model.regency_id,
                  tahun: this.model.tahun,
                  data: this.model.data
                })
                .then(response => {
                  if(response.data.type == 'success'){
                    miniToastr.success(response.data.message, response.data.title)
                    window.location.href = '#/admin/dd-sekolah/'+response.data.id
                  }
                  else{
                    miniToastr.error(response.data.message, response.data.title)
                    window.location.href = '#/admin/dd-sekolah/create'
                  }
                },
                window.location.href = '#/admin/dd-sekolah/create')
                .catch((error) => miniToastr.error(error, "Error"));
              }else{
                miniToastr.error('Tahun tidak sesuai.', 'error');
              }
            }
        },
        form_reset() {
            this.model = {
                negara: "",
                province_id: "",
                kab_kota: "",
                regency_id: "",
                tahun: "",
                data: ""
            };
        },
        back() {
            window.location = '#/admin/dd-sekolah';
        }
    },
    mounted: function() {
        axios.get("/dd-sekolah/create").then(response => {

            this.provinces = response.data.provinces;
            this.regencies = response.data.regencies;
        })
        .catch(function(error) {miniToastr.error(error, "Error")});
    },
    destroyed: function() {

    }
}
</script>
<style scoped>
.dropzone_wrapper {
    width: 100%;
    height: 300px;
}
input {
    cursor: pointer;
}

.cur {
    cursor: not-allowed;
}
</style>
