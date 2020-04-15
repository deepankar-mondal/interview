<template>
  <div class="container">      
    <table class="table table-sm">
      <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(data,index) in datas" :key="index">
          <td>{{ 1 + index }}</td>
          <td>{{ data.name.toUpperCase() }}</td>
          <td>{{ data.created_at }}</td>
          <td>
            <div class="btn-group">
               <router-link class="btn btn-sm btn-info" :to="'/info/'+data.id">View</router-link> 
               <a @click="deleteData(data.id)" class="btn btn-sm btn-danger" href="javascript:void(0)">Delete</a>             
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  data(){
    return {
      datas:'',
      isBusy:true,
      
      
    }
  },
  mounted(){
    this.getData();
  },
  methods:{
    getData(){
      var vm =this;
      axios.get('http://127.0.0.1:8000/api/info')
      .then(resp => {      
        vm.datas = resp.data;
       
      })
    },
    deleteData(id){
        let vm = this;
        let resp = confirm("Are you sure you want to delete the data");
        if(resp){
             axios.delete(`http://127.0.0.1:8000/api/info/${id}`)
            .then(resp => {      
                vm.datas = resp.data;
               
            })
        }

    }
  }
}
</script>
