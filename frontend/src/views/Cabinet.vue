<template>
  <v-container fluid>
    <v-layout row>
        <OrdersTable></OrdersTable>
    </v-layout>
  </v-container>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';
import OrdersTable from '../components/cabinet/OrdersTable';

export default {
  name: 'Cabinet',
  components: {
    OrdersTable,
  },

  computed: {
    ...mapGetters(['isLoading']),
    ...mapGetters('auth', ['isLoggedIn'])
  },
}
</script>