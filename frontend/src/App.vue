<template>
  <v-app>
    <v-content>
      <router-view />
    </v-content>

  <Loading></Loading>
      
  </v-app>
</template>

<script>

import { mapGetters, mapMutations } from 'vuex';
import { USER_LOGOUT } from './store/modules/auth/mutationTypes';
import { EventEmitter, TOKEN_EXPIRED_EVENT } from './services/EventEmitter';
import Loading from './components/common/Loading';


export default {
  name: 'App',
  components: {
    Loading
  },
  data: () => ({
   //
  }),
  computed: {
        ...mapGetters([
            'isLoading'
        ]),
  }
}
</script>


