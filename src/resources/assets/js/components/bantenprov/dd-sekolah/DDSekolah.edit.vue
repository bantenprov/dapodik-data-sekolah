<template>
  <div>
    <dashboard-navbar></dashboard-navbar>
    <div class="row no-gutters">
      <div class="col-md-4 col-lg-3 dashboard-sidebar">
        <dashboard-sidebar></dashboard-sidebar>
      </div><!-- /col -->
      <div class="col-md-8 col-lg-9 admin-main"> 
          
        <!-- ===================================================================== -->
          <b-card header="Edit Jumlah Laporan" header-tag="h4" class="bg-success-card">
                
                        <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="tanggal">Tanggal</label>
                                        <input name="tanggal" type="date" required autofocus placeholder="Tanggal" class="form-control" v-model="model.tanggal" />
                                        <field-messages name="tanggal" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Tanggal Harus di isi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="category_id"> Kategori</label>
                                        <select v-model="model.category_id" name="category_id" required autofocus class="form-control">
                                          <option disabled value="">Please select one</option>
                                          <option v-for="datacategory in category" v-bind:key="datacategory.id" :value="datacategory.id">{{datacategory.name}}</option>
                                        </select>
                                        <field-messages name="category_id" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Kategori Harus diisi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="city_id"> Kota</label>
                                        <select v-model="model.city_id" name="city_id" required autofocus class="form-control">
                                          <option disabled value="">Please select one</option>
                                          <option v-for="datacity in city" v-bind:key="datacity.id" :value="datacity.id">{{datacity.name}}</option>
                                        </select>
                                        <field-messages name="city_id" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Kategori Harus diisi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="count">Jumlah</label>
                                        <input v-model="model.count" name="count" type="number" required autofocus placeholder="Jumlah" class="form-control" />
                                        <field-messages name="count" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Jumlah Harus diisi</div>
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

        <!-- ===================================================================== -->
        </div>
      </div><!-- /col -->
    </div><!-- /.row --> 
</template> 


<script>
import Vue from 'vue';
require("checkbox.css/dist/css/checkbox.min.css");
require("radiobox.css/dist/css/radiobox.min.css");
import miniToastr from 'mini-toastr';
miniToastr.init();
import VueForm from "vue-form";
import options from "../../../components/validations/validations.js";
Vue.use(VueForm, options);
export default {
    name: "edit_epormas",
    data() {
        return {
            category: [],
            city: [],
            formstate: {},
            model: {
                tanggal: "",
                category_id: "",
                city_id: "",
                count: ""
            },
            old_file: ""
        }
    },
    methods: {
        onSubmit: function() {
            if (this.formstate.$invalid) {
                return;
            } else {
              var id = this.$route.params.id;
              axios.put("/update/epormas/"+id, {
                  tanggal: this.model.tanggal,
                  category_id: this.model.category_id,
                  city_id: this.model.city_id,
                  count: this.model.count
              })
              .then(response => {
                  if(response.data.type == 'success'){
                    miniToastr.success(response.data.message, response.data.title)
                  }
                  else{
                    miniToastr.error(response.data.message, response.data.title)
                  }
                },window.location = '#/epormas')
              .catch((error) => miniToastr.error(error, "Error"));
            }
        },
        form_reset() {
            var id = this.$route.params.id;
            axios.get("/epormas/"+id+"/edit").then(response => {
                    this.model = {
                        tanggal: response.data.tanggal,
                        category_id: response.data.result.category_id,
                        city_id: response.data.result.city_id,
                        count: response.data.result.count
                    }
            })
            .catch(function(error) {miniToastr.error(error, "Error")});
        },
        back() {
            window.location = '#/epormas';
        }
    },
    mounted: function() {
        var id = this.$route.params.id;
        axios.get("/epormas/"+id+"/edit").then(response => {
                this.category = response.data.category;
                this.city = response.data.city;
                this.model = {
                    tanggal: response.data.tanggal,
                    category_id: response.data.result.category_id,
                    city_id: response.data.result.city_id,
                    count: response.data.result.count
                }
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
</style>