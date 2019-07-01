<template>
    <v-toolbar home>
      <v-toolbar-title class="headline text-uppercase">
        <span>Рачок</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn
        v-if="isLoggedIn"
        flat
        @click="onSignOut()"
      >
        <span class="mr-2">Вихід</span>
      </v-btn>
    </v-toolbar>
</template>

<script>
    import { mapGetters, mapMutations, mapActions } from 'vuex';
    export default {
        name: 'Navibar',
        components: {

        },

        computed: {
            ...mapGetters('auth', ['isLoggedIn'])
        },

        methods: {
            ...mapActions('auth', [ 'signOut' ]),

            async onSignOut() {
                await this.signOut();
                this.$router.push({ name: 'auth.signIn' });
            },
        }
    }
</script>