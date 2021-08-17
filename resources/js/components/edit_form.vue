<template>
   <div>      
      <v-sheet class="mt-3 pt-6 pb-2 px-8">
         <!-- Name: {{name}} <br>
         Email: {{email}} <br>
         Photo:{{photo}} <br>
         Gender: {{gender}} <br>
         Skills: {{skills}} <br>
         {{ errors }} -->
         <v-row class="mb-4 mx-sm-10">
            <v-col>
               <v-row>
                  <div class="mx-auto">
                     <v-card flat>
                        <v-card-title
                           class="
                              text-h5
                              font-weight-bold
                              blue-grey--text
                              text--darken-3
                           "
                        >
                           <v-icon large left color="blue-grey darken-3"
                              >mdi-user
                           </v-icon>
                           Form</v-card-title>
                     </v-card>
                  </div>
               </v-row>
               <v-row>
                  <v-col class="mb-3">
                     <!-- Contact us Form -->
                     <v-form ref="contact_us_form" :disabled="form_disabled" lazy-validation>

                     <!-- Snackbar For successful Form Submission -->
                     <v-snackbar
                        v-model="success_snackbar"
                        color="green"                        
                        :timeout="timeout"                             
                        top
                        right
                     >
                     <v-icon left>
                        mdi-check-circle
                     </v-icon>
                        Message Sent Successfully !!

                        <template v-slot:action="{ attrs }">
                        <v-btn
                           color="white"
                           text
                           v-bind="attrs"
                           @click="success_snackbar = false"
                        >
                           Close
                        </v-btn>
                        </template>
                     </v-snackbar>
                     <!-- End Snackbar For successful Form Submission -->

                     <!-- Snackbar For backend validation failure -->
                     <v-snackbar
                        v-model="error_snackbar"
                        color="red"
                        :timeout="timeout"                             
                        top
                        right
                     >
                     <v-icon left>
                        mdi-cancel
                     </v-icon>
                        {{error_message}}

                        <template v-slot:action="{ attrs }">
                        <v-btn
                           color="white"
                           text
                           v-bind="attrs"
                           @click="error_snackbar = false"
                        >
                           Close
                        </v-btn>
                        </template>
                     </v-snackbar>
                     <!-- End Snackbar For successful Form Submission -->

                     <!-- Name Field -->                        
                        <v-text-field
                           v-model="name"
                           @input = "name_alert = false"
                           :rules="nameRules"
                           :error="errors && errors.name"
                           :error-messages="errors.name"
                           label="Name"
                           placeholder="Enter Name Here"
                           prepend-inner-icon="mdi-account-details"
                           required
                           outlined
                        ></v-text-field>
                        <!-- End Name Field -->

                        <!-- Email Field With Alert -->                           
                        <v-text-field
                           v-model="email"
                           @input = "email_alert= false"
                           :rules="emailRules"
                           :error="errors && errors.email"
                           :error-messages="errors.email"
                           label="E-mail"
                           type="email"
                           placeholder="Enter Email Here"
                           prepend-inner-icon="mdi-email"
                           required
                           outlined
                        ></v-text-field>
                        <!-- End Email Field -->

                        <!-- File Upload -->
                        <v-file-input
                           truncate-length="15"
                           label="Select New Image"
                           @change="select_file"
                           :rules="photo_rules"
                           prepend-inner-icon="mdi-paperclip"
                           prepend-icon=""
                           :error="errors && errors.photo"
                           :error-messages="errors.photo"
                        ></v-file-input>
                        <!-- End File Upload -->

                        <!-- Gender Radio Buttons -->
                        <v-container fluid>
                           <v-radio-group
                              v-model="gender"
                              mandatory row
                              :error="errors && errors.gender"
                              :error-messages="errors.gender"
                           >
                              <template v-slot:label>
                                 <div> Gender</div>
                              </template>
                              <v-radio value="male">
                              <template v-slot:label>
                                 <div> Male </div>
                              </template>
                              </v-radio>
                              <v-radio value="female">
                              <template v-slot:label>
                                 <div>Female</div>
                              </template>
                              </v-radio>
                              <v-radio value="other">
                              <template v-slot:label>
                                 <div>Other</div>
                              </template>
                              </v-radio>
                           </v-radio-group>
                        </v-container>
                        <!-- End Gender Radio Buttons -->

                        <!-- Skills checkboxes -->
                        <v-container fluid>
                           <v-row>
                              <v-col>
                                 <v-checkbox
                                    v-model="skills"
                                    label="Laravel"
                                    value="laravel"
                                    :rules="skills_rules"
                                 ></v-checkbox>
                                 <v-checkbox
                                    v-model="skills"
                                    label="Codeigniter"
                                    value="codeigniter"
                                    :rules="skills_rules"
                                 ></v-checkbox>
                                 <v-checkbox
                                    v-model="skills"
                                    label="Ajax"
                                    value="ajax"
                                    :rules="skills_rules"
                                 ></v-checkbox>
                              </v-col>
                              <v-col>
                                 <v-checkbox
                                    v-model="skills"
                                    label="Vuejs"
                                    value="vuejs"
                                    :rules="skills_rules"
                                 ></v-checkbox>
                                 <v-checkbox
                                    v-model="skills"
                                    label="MySQL"
                                    value="mysql"
                                    :rules="skills_rules"
                                 ></v-checkbox>
                                 <v-checkbox
                                    v-model="skills"
                                    label="API"
                                    value="api"
                                    :rules="skills_rules"
                                 ></v-checkbox>
                              </v-col>
                           </v-row>
                        </v-container>
                        <!-- End Skills checkboxes -->

                        <!-- Validate and Submit -->
                        <v-row class="">
                           <div class="d-flex flex-row mx-auto">
                              <v-btn
                                 color="green"
                                 x-large                                 
                                 @click.prevent="submitForm"
                                 :loading="form_loading"
                                 class="white--text mt-3 mt-md-1"
                              >
                                 Submit
                              </v-btn>
                              <!-- Reset From -->
                              <!-- <v-btn color="error" class="mx-2" @click="reset">
                                 Reset Form
                              </v-btn> -->
                              <!-- Reset validation -->
                              <!-- <v-btn color="warning" class="mx-2" @click="resetValidation">
                                 Reset Validation
                              </v-btn> -->
                           </div>
                        </v-row>
                     </v-form>
                  </v-col>
               </v-row>

            </v-col>
         </v-row>
      </v-sheet>
   </div>
</template>

<script>
export default {
   data: () => ({
      errors:[],
      error_message: '',
      error_snackbar: false,
      form_disabled: false,
      form_loading: false,
      success_snackbar: false,
      timeout: 3000,
      name: "",
      nameRules: [(v) => !!v || "Name is required"],
      email: "",
      emailRules: [
         (v) => !!v || "E-mail is required",
         (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
      gender: "",
      photo: null,
      photo_rules: [ (v) => !!v || "Image is required" ],
      skills: [],
      // skillsRules: [(v) => !!v || "At least 1 skill is required"],
   }),

   methods: {
      select_file(file){
         // console.log(file)
         this.photo = file
      },

      submitForm() {         
         console.log("trigger 1")
         if (this.$refs.contact_us_form.validate()) {
            this.form_disabled = true
            this.form_loading = true
            
            console.log("trigger 2")
            if (!this.photo) {
               this.error_message = "Please select a file!";
               this.form_disabled = false
            this.form_loading = false
               return;
            }
         console.log("trigger 3")

            this.error_message = "";

            const formData  = new FormData()
            formData.append('name', this.name)
            formData.append('email', this.email)
            formData.append('photo', this.photo)
            formData.append('gender', this.gender)
            formData.append('_method', 'PATCH')
            formData.append('skills', this.skills.toString())

            console.log("trigger 3")
            // console.log(formData);

            axios.post("/api/form/update/" + this.$route.params.id, formData)
            .then((res) => {
               console.log(res.data)
               this.success_snackbar = true
               this.form_disabled = false
               this.form_loading = false
               this.$refs.contact_us_form.reset()
            })
            .catch((error) => {
               console.log(error)
               this.error_message = error.response.data.message
               this.error_snackbar = true
               this.errors = error.response.data.errors
               this.form_disabled = false
               this.form_loading = false
            });
         } else {
            //false
            this.$refs.contact_us_form.validate()
         }
      },
      // reset() {
      //    this.$refs.contact_us_form.reset()
      // },
      // resetValidation() {
      //    this.$refs.contact_us_form.resetValidation()
      // },
   },
   computed: {
    skills_rules() {
      return [
        this.skills.length > 0 || "At least one item should be selected"
      ];
    }
  },
  created(){
         axios.get("/api/form/show/" + this.$route.params.id)
            .then((res) => {
               console.log(res.data)
               this.name = res.data.name
               this.email = res.data.email               
               this.gender = res.data.gender
               this.skills = res.data.skills
               
               this.form_disabled = false
               this.form_loading = false
               // this.$refs.contact_us_form.reset()
            })
            .catch((error) => {
               console.log(error)
               this.error_message = error.response.data.message
               this.error_snackbar = true
               this.errors = error.response.data.errors
               this.form_disabled = false
               this.form_loading = false
            });
  }
};
</script>

<style></style>
