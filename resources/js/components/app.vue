<template>
   <div>
      <v-app id="inspire">
         <v-app-bar app color="white" flat elevation="3" dense>
            <v-app-bar-nav-icon @click="toggleSidebar = !toggleSidebar" class="hidden-md-and-up"></v-app-bar-nav-icon>
            <v-tabs centered color="grey darken-1">
               <v-tab to="/all_data" exact class="deep-purple--text">
                  <v-icon left color="deep-purple">mdi-home</v-icon>
                  <!-- v-for="link in links" :key="link" -->
                  All Data
               </v-tab>
               <v-tab to="/">
                  <v-icon left>mdi-pencil</v-icon>New Form
               </v-tab>
            </v-tabs>
         </v-app-bar>
         <!-- v-main is the main content area e.g background -->
         <v-main class="grey lighten-3">
            <v-navigation-drawer v-model="toggleSidebar" absolute temporary>
               <v-list nav dense>
                  <v-list-item-group                     
                     active-class="deep-purple--text text--accent-4"
                  >
                     <v-list-item>
                        <v-list-item-title>Sidebar Item 1</v-list-item-title>
                     </v-list-item>

                     <v-list-item>
                        <v-list-item-title>Sidebar item 2</v-list-item-title>
                     </v-list-item>
                  </v-list-item-group>
               </v-list>
            </v-navigation-drawer>
            <v-container>
               <v-row>
                  <v-col cols="12">
                     <v-sheet rounded="lg" height="auto" class="purple lighten-4" elevation="5">
                        <router-view class="px-2 py-2"></router-view>
                     </v-sheet>
                  </v-col>
               </v-row>
            </v-container>
         </v-main>
         <!-- <v-footer app height="100px" color="white">
            <v-row justify="center">
               <v-col align="center" text="grey darken-1">
                  <h6 class="display-1">Footer</h6>
               </v-col>
            </v-row>
         </v-footer>-->
      </v-app>
   </div>
</template>
<script>
// import TopNav from './topnav'
export default {
   data: () => ({
      toggleSidebar: false,
   }),
   methods:{
      logout(){
         axios.post('/api/logout').then(()=>{
            this.$router.push('/login')
            //this.$router.push({name: 'Login'}) will work since Login is a named route
         })
      }
   }
};
</script>

<style scoped></style>
