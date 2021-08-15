<template>
<div>
   <v-form ref="form" lazy-validation>
      <v-text-field v-model="name" :rules="nameRules" label="Name" required></v-text-field>
      <span v-if="errors.name">{{ errors.name[0] }}</span>

      <v-text-field v-model="email" :rules="emailRules" label="E-mail" type="email" required></v-text-field>
      <span v-if="errors.email">{{ errors.email[0] }}</span>

      <v-text-field v-model="password" :rules="passwordRules" label="Password" type="password" required></v-text-field>

      <v-text-field
         v-model="password_confirmation"
         :rules="[confirmPasswordRules, passwordConfirmationRule]"
         label="Confirm Password"
         type="password"
         required
      ></v-text-field>

      <v-btn color="success" class="mt-4" @click.prevent="submitForm" type="submit">Register</v-btn>

      <v-btn color="success" class="mt-4" @click="validate">Validate</v-btn>

      <v-btn color="warning" class="mt-4" @click="reset">Reset Form</v-btn>

      <v-btn color="info" class="mt-4" @click="resetValidation">Reset Validation</v-btn>
      <br>
      <div>
         <span>{{ this.dummy }}</span><br>
         <span>{{ this.validation }}</span><br>
         <span>{{ this.name }}</span><br>
         <span>{{ this.email }}</span><br>
         <span>{{ this.password }}</span><br>
         <span>{{ this.password_confirmation }}</span>
      </div>
   </v-form>
</div>
</template>

<script>
export default {
   data: () => ({      
      name: "",
      nameRules: [
         (v) => !!v || "Name is required",
         (v) => (v && v.length >= 3) || "Name must be more than 3 characters",
      ],
      email: "",
      emailRules: [
         (v) => !!v || "E-mail is required",
         (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
      password: "",
      passwordRules: [
         (v) => !!v || "Password is required",
         (v) =>
            (v && v.length >= 8) || "Password must be more than 8 characters",
      ],
      password_confirmation: "",
      confirmPasswordRules: [
         (v) => !!v || "Password Confirmation is required",
         (v) => (!!v && password === v) || "Passwords do not match",
      ],
      errors: [],
      dummy: '',
      validation: ''
   }),
   methods: {
      validate() {
         this.$refs.form.validate();
      },
      reset() {
         this.$refs.form.reset();
         this.dummy = ''
      },
      resetValidation() {
         this.$refs.form.resetValidation();
         this.dummy = ''
      },
      submitForm() {
         this.validation = this.$refs.form.validate();
         if( this.$refs.form.validate() ){
            axios.post('/api/register', {
               name: this.name,
               email: this.email,
               password: this.password,
               password_confirmation: this.password_confirmation
               })
            .then(()=>{
               this.name = ''
               this.email = ''
               this.password = ''
               this.password_confirmation = ''
               this.$refs.form.resetValidation()
               this.dummy = 'Post Request Sent Successfully !!'
               console.log('Post Request Sent Successfully !!')
               //this.$router.push('/about')
               // same as this.$router.push({ name: 'About'}) where the name is defined in router.js so its a named
               // route
            })
            .catch((error)=> {
               this.errors = error.response.data.errors;
            })

            //this.$router.push()
         }
         else{
            //false
            //this.$refs.form.validate();
         }
      },
   },
   computed: {
      passwordConfirmationRule() {
         return () =>
            this.password === this.password_confirmation || "Password must match";
      },
   },
};
</script> 