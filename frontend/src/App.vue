<template>
  <v-app>
    
    <Navibar></Navibar>
    <router-view />

    <Loading></Loading>
  </v-app>
</template>

<script>

import { mapGetters, mapMutations } from 'vuex';
import { USER_LOGOUT } from './store/modules/auth/mutationTypes';
import { EventEmitter, TOKEN_EXPIRED_EVENT } from './services/EventEmitter';
import Loading from './components/common/Loading';
import Navibar from './components/common/Navibar';


export default {
  name: 'App',
  components: {
    Loading,
    Navibar
  },

  created() {
    EventEmitter.$on(TOKEN_EXPIRED_EVENT, () => {
            this.logout();
            this.$router.push({ name: 'auth.signIn' });
        });
  },


  data: () => ({
   //
  }),

  computed: {
        ...mapGetters([
            'isLoading'
        ]),
  },

   methods: {
    ...mapMutations('auth', {
      logout: USER_LOGOUT
    }),
   }
}
</script>


