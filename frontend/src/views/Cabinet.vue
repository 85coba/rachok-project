<template>
  <v-app>
    <v-content>
      Here will be user cabinet.
    </v-content>
  </v-app>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';

export default {
  name: 'Cabinet',
  components: {
  },

  computed: {
    ...mapGetters(['isLoading']),
    ...mapGetters('auth', ['isLoggedIn'])
  },
}
</script>