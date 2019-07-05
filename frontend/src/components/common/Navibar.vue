<template>
    <v-toolbar home dark color="blue darken-3">
      <v-toolbar-title class="headline text-uppercase">
        <router-link :to="{name: 'home'}" class="tool-bar-link"><span>Рачок</span></router-link>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn
        flat
        to ="/cabinet"
      >
        <span class="mr-2">Мій кабінет</span>
      </v-btn>
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

<style scope>
    .tool-bar-link {   
        color:rgb(247, 215, 73);
        text-decoration: none;
    }
</style>
