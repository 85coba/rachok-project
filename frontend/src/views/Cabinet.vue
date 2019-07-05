<template>
  <v-container fluid>
    <v-layout row>
      <v-flex grow>
        <OrdersTable></OrdersTable>
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
import OrdersTable from '../components/cabinet/OrdersTable';

export default {
  name: 'Cabinet',
  components: {
    OrdersTable
  },

  computed: {
    ...mapGetters(['isLoading']),
    ...mapGetters('auth', ['isLoggedIn'])
  },
}
</script>