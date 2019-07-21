<template>
  <v-container fluid>
    <v-layout row>
        <VendorMenu></VendorMenu>
        <OrdersTable></OrdersTable>
    </v-layout>
  </v-container>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';
import OrdersTable from '../components/cabinet/OrdersTable';
import VendorMenu from '../components/cabinet/VendorMenu';

export default {
  name: 'Cabinet',
  components: {
    OrdersTable,
    VendorMenu
  },

  computed: {
    ...mapGetters(['isLoading']),
    ...mapGetters('auth', ['isLoggedIn'])
  },
}
</script>