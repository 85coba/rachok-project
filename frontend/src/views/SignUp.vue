<template>
  <v-app id="inspire">
    <v-layout align-center justify-center>
      <form class="registerForm" 
        @submit.prevent
        novalidate="true"
      >
      
        <v-text-field
          v-model="user.firstName"
          name="first_name"
          label="Ваше iмʼя"
          required
        ></v-text-field>
        <v-text-field
          v-model="user.lastName"
          name="last_name"
          label="Ваша фамілія"
          required
        ></v-text-field>
        <v-text-field
          v-model="user.email"
          name="email"
          label="E-mail"
          required
        ></v-text-field>
        <v-text-field
          v-model="user.nickname"
          name="nickname"
          label="Назва установи"
          required
        ></v-text-field>
        <v-text-field
          v-model="user.password"
          label="Пароль"
          type="password"
          required
        ></v-text-field>

        <v-btn @click="onSubmit">Зареєструватися</v-btn>
      </form>
    </v-layout>
  </v-app>
</template>

<script>
import { mapActions } from "vuex";
import showStatusToast from "../components/mixin/showStatusToast";

export default {
  name: "SignUpPage",

  mixins: [showStatusToast],

  data: () => ({
    user: {
      firstName: "",
      lastName: "",
      email: "",
      password: "",
      nickname: ""
    }
  }),

  methods: {
    ...mapActions("auth", ["signUp"]),

    onSubmit() {
      this.signUp(this.user)
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
.registerForm {
  width: 30pc;
}
</style>
