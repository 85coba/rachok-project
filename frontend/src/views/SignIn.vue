<template>
<v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                <v-form @submit.prevent>
                  <v-text-field 
                    prepend-icon="person" 
                    name="login" label="Email" 
                    type="text"
                    v-model="user.email"
                    >
                  </v-text-field>
                  <v-text-field id="password" 
                    prepend-icon="lock" 
                    name="password" 
                    label="Password" type="password" 
                    v-model="user.password" 
                    @keyup.native.enter="onLogin">
                  </v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="onLogin">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
                
</template>

<script>
import { mapActions } from "vuex";
import showStatusToast from "../components/mixin/showStatusToast";

export default {
  name: "SignInPage",

  mixins: [showStatusToast],

  data: () => ({
    user: {
      email: "",
      password: ""
    }
  }),

  methods: {
    ...mapActions("auth", ["signIn"]),

    onLogin() {
      this.signIn(this.user)
        .then(() => {
          this.showSuccessMessage("Welcome!");

          this.$router.push({ path: "/" });
        })
        .catch(error => this.showErrorMessage(error.message));
    }
  }
};
</script>

<style scoped>
</style>
