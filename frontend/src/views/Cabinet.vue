<template>
  <v-container fluid>
    <v-layout row>
      <v-flex grow>
        r567890
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