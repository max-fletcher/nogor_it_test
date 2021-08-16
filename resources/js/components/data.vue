<template>
   <div class="pt-3 pb-7 mx-6">
      <v-row>
         <v-col v-if="loading">
            <Loading />
         </v-col>

         <v-col v-else cols="12" class="pt-3">
            <v-simple-table dense>
               <template v-slot:default>
                  <thead>
                     <tr>
                        <th class="text-left">
                           ID
                        </th>
                        <th class="text-left">
                           Name
                        </th>
                        <th class="text-left">
                           Calories
                        </th>
                        <th class="text-left">
                           Gender
                        </th>
                        <th class="text-left">
                           Skills
                        </th>
                        <th class="text-left">
                           Edit/Delete
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr
                        v-for="(form, index) in forms"
                        :key="index"
                     >
                        <td>{{ form.id }}</td>
                        <td>{{ form.name }}</td>
                        <td>{{ form.email }}</td>
                        <td>{{ form.gender }}</td>
                        <td>{{ form.skills }}</td>
                        <td>
                           <!-- :loading="form_loading" -->
                           <v-btn
                                 color="success"
                                 small
                                 :to="'/edit_form/' + form.id"
                           >
                              Edit
                           </v-btn>
                           <v-btn
                                 color="error"
                                 small
                                 @click.prevent="delete_form(form.id)">
                              Delete
                           </v-btn>
                        </td>
                     </tr>
                  </tbody>
               </template>
            </v-simple-table>
         </v-col>
      </v-row>
   </div>
</template>

<script>
import Loading from "./loading_card";
export default {
   data: () => ({
      forms: [],
      loading: true
   }),
   components: {
      Loading
   },
   methods: {
      delete_form(id){
         console.log(id)
         axios
            .delete("/api/form/destroy/" + id)
            .then((res) => {
               console.log(res.data);
            }).catch(error => {
               alert('Internal Error ! Cannot Delete Contact !!');
            })

            this.forms = this.forms.filter(function(obj) {
               return obj.id !== id; // Or whatever value you want to use
            });
            console.log(this.forms);
      }
   },
   created() {
      axios
         .get("/api/form/index")
         .then((res) => {
            console.log(res.data);
            this.forms = res.data;
            this.loading = false
         })
   },
};
</script>

<style></style>
