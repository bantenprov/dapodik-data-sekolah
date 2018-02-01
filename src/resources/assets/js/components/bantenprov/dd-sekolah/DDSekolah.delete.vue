
<script>
import Vue from 'vue';
import miniToastr from 'mini-toastr';
miniToastr.init();
import VueForm from "vue-form";
import options from "../../../components/validations/validations.js";
Vue.use(VueForm, options);
export default {
    name: "destroy",
    mounted: function() {
        var id = this.$route.params.id;
        //var data = this.$route.params.data;
        var url = window.location.hash;
        var res = url.split("/");
        var data = res[1];
        // var path = data;
        // if(data == 'role-users'){
        //   path = 'advancetrust/role';
        // }
        axios.get("/"+data+"/"+id+"/destroy").then(response => {miniToastr.success(response.data.message, "Success")},window.location = '#/'+data)
        .catch(function(error) {miniToastr.error(error, "Error")});
    },
    destroyed: function() {

    }
}
</script>
