<template>
  <v-app>
    <v-toolbar home>
      <v-toolbar-title class="headline text-uppercase">
        <span>Vuetify</span>
        <span class="font-weight-light">MATERIAL DESIGN</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn
        flat
        @click="onSignOut()"
      >
        <span class="mr-2">Вихід</span>
      </v-btn>
    </v-toolbar>

    <v-content>
      <HelloWorld/>
    </v-content>
  </v-app>
</template>

<script>
import HelloWorld from '../components/HelloWorld'
import Loading from '../components/common/Loading'
import { mapGetters, mapMutations, mapActions } from 'vuex';
import { USER_LOGOUT } from '../store/modules/auth/mutationTypes';
import { EventEmitter, TOKEN_EXPIRED_EVENT } from '../services/EventEmitter';

export default {
  name: 'Home',
  components: {
    HelloWorld,
    Loading
  },

  computed: {
    ...mapGetters(['isLoading']),
    ...mapGetters('auth', ['isLoggedIn'])
  },

  created() {
    EventEmitter.$on(TOKEN_EXPIRED_EVENT, () => {
            this.logout();
            this.$router.push({ name: 'auth.signIn' });
        });
  },

  methods: {
    ...mapMutations('auth', {
      logout: USER_LOGOUT
    }),

    ...mapActions('auth', [ 'signOut' ]),

    async onSignOut() {
            await this.signOut();

            this.$router.push({ name: 'auth.signIn' });
        },

  }
}
</script>
