<template>
  <v-container fluid>
    <v-card-text display-2>
      Рачок.ком - сервіс з пошуку спецтехніки.
    </v-card-text >   
    <v-layout row>
      <v-flex xs8 >
          <RequestForm/>
      </v-flex>
      <v-flex shrink>
        <v-card-text>
          Some help variant.
        </v-card-text>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import RequestForm from '../components/home/RequestForm';
import { mapGetters, mapMutations, mapActions } from 'vuex';

export default {
  name: 'Home',
  components: {
    RequestForm,
  },

  computed: {
    ...mapGetters(['isLoading']),
    ...mapGetters('auth', ['isLoggedIn'])
  },
}
</script>
