<template>
  <v-container fluid>
    <v-layout row>
      <v-flex grow>
          <RequestForm/>
      </v-flex>
      <v-flex xs3 hidden-xs-only>
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
