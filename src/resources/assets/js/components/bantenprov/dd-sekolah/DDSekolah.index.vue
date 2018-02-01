
<template>
  <div>
        <div class="col-md-12 col-lg-9 dashboard-main">
        <!-- ===================================================================== --> 
            <b-card header="Table PDRB Harga Dasar" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Data Jumlah PDRB Harga Dasar" :rows="tableData" :columns="columndata"></datatable>
                </div>
            </b-card> 
        <!-- ===================================================================== -->
        
      </div><!-- /col -->
    </div><!-- /.row --> 
</template> 


<script>
import Vue from 'vue';
import {
    ClientTable,
    Event
} from 'vue-tables-2'; 
import datatable from "./DDSekolahTable.vue";
Vue.use(ClientTable, {}, false);

//import miniToastr from 'mini-toastr';
//miniToastr.init();
export default {
    name: "PDRB Harga Dasar_list",
    components: {
        datatable
    },
    data() {
        return {
            tableData: [],
            columndata: [{
                label: 'ID',
                field: 'id',
                numeric: true,
                html: false,
            }, {
                label: 'Tahun',
                field: 'tahun',
                numeric: true,
                html: false,
            }, {
                label: 'Tanggal',
                field: 'tanggal',
                numeric: true,
                html: false,
            }, {
                label: 'Jumlah',
                field: 'count',
                numeric: true,
                html: false,
            }, {
                label: 'Kategori',
                field: 'get_category.name',
                numeric: true,
                html: false,
            }, {
                label: 'Kota',
                field: 'get_city.name',
                numeric: true,
                html: false,
            }, {
                label: 'User',
                field: 'user_id',
                numeric: false,
                html: false,
            }, {
                label: 'Via',
                field: 'via',
                numeric: false,
                html: false,
            }, {
                label: 'Created',
                field: 'created_at',
                numeric: true,
                html: false,
            }, {
                label: 'Updated',
                field: 'updated_at',
                numeric: true,
                html: false,
            }, {
                label: 'Actions',
                field: 'action',
                numeric: false,
                html: true,
            }]
        }
    },
    mounted() {
        axios.get("/PDRB Harga Dasar").then(response => {
            this.tableData = response.data.result;
            this.tableData.forEach((item, index) => {
                this.$set(item, "action", "<a class='btn btn-warning btn-sm' href='#/PDRB Harga Dasar/" + item.id + "/edit'><i class='leftmenu_icon ti-pencil-alt' class='icon'></i> Edit</a> <a class='btn btn-danger btn-sm' onclick='return confirm(\"Are Youu Sure?\")' href='#/PDRB Harga Dasar/" + item.id + "/destroy'><i class='leftmenu_icon ti-close' class='icon'></i> Delete</a>");
            });
        })
        .catch(function(error) {miniToastr.error(error, "Error")});
    }
}
</script>