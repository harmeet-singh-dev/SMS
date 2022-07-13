<template>

                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">

                    <ul>
                        <li>
                            <a href="dashboard">Dashboard</a>
                        </li>
                        <li>Add Class Teacher</li>
                    </ul>

                </div>

                <!-- Breadcubs Area End Here -->
                <!-- Admit Form Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Add Class Teacher</h3>
                            </div>
                                  </div>


                       <form @submit.prevent="submit">

                                   <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Teacher Name *</label>
                                    <select class="select2" v-model="form.teacher_name">
                                        <option value="">Please Select Teacher *</option>
 <option v-for='(teacherdata,index) in teacherdata' :key="index" :value='teacherdata.id'>{{ teacherdata.first_name }} {{teacherdata.last_name}}</option>
                                    </select>
                                </div>

                                 <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Department Name *</label>
                                    <select class="select2" v-model="form.department_name">
                                        <option value="">Please Select Gender *</option>
  <option v-for='(departmentdata,index) in departmentdata' :key="index" :value='departmentdata.id'>{{ departmentdata.department_name }} </option>

                                    </select>
                                </div>

                                 <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Class Name *</label>
                                    <select class="select2" v-model="form.class_name">
                                        <option value="">Please Select *</option>
    <option v-for='(classdata,index) in classdata' :key="index" :value='classdata.id'>{{ classdata.class_name }} </option>


                                    </select>
                                </div>

                                 <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Section Name *</label>
                                    <select class="select2" v-model="form.section_name">
                                        <option value="">Please Select *</option>
<option v-for='(sectiondata,index) in sectiondata' :key="index" :value='sectiondata.id'>{{ sectiondata.section_name }} </option>

                                    </select>
                                </div>
                                   <div class="col-12 form-group mg-t-8">

      <button :type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
        <slot>Click Here</slot>
    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>


</template>

<script>



import Layout from "@/Shared/Layout";

export default {
     props:{
          errors: Object,
         'classdata':{},
         'sectiondata':{},
         'teacherdata':{},
         'departmentdata':{},
     },
    components: {
    },
    layout: Layout,

    data() {
        return {

              form:{
                    teacher_name:'',
                    department_name:'',
                    class_name:'',
                    section_name:''

                },
                errors:{},

        }
    },
          methods: {
            submit() {
              this.errors = {};
              axios.post('classteacherpost',this.form)
              .then(res=>{
                  console.log(res.data);
                  this.form={};
                  Toast.fire({
                    icon:'success',
                   title:'Class teacher is added !!!'
                 })
              }).catch((error) => {
                  this.errors = error.response.data.errors

                   });

           },



}
}

</script>


