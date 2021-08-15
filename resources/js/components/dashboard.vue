<template>
  <div>
      Dashboard Component <br>    
      <div v-if="loading">
         Loading...
      </div>
      <div v-else>
         <div v-if="!user">
            You Are Not Logged.
         </div>
         <div v-else>
            Name: {{user.name}} <br>
            Email: {{user.email}}
         </div>
      </div>

  </div>
</template>

<script>
export default {
   data: () => ({
      loading: true,
      user: null,
   }),
   mounted(){
      axios.get('/api/user')
      .then((res)=>{         
         this.user = res.data
         this.loading = false
      }).catch((error)=>{         
         this.loading = false
      })      
   }
}
</script>

<style>

</style>