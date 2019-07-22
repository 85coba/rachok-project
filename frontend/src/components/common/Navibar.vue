<template>
  <div>
    <v-toolbar app clipped-left dark color="blue darken-3">
      <v-toolbar-side-icon v-if="isLoggedIn" @click.native="drawer = ! drawer"></v-toolbar-side-icon>
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
    <v-navigation-drawer
      v-if="isLoggedIn"
      fixed
      clipped
      class="grey lighten-4"
      app
      v-model="drawer"
    >
      <v-list
        
        class="grey lighten-4"
      >
        <template v-for="(item, i) in items">
          <v-layout
            row
            v-if="item.heading"
            align-center
            :key="i"
          >
            <v-flex xs6>
              <v-subheader v-if="item.heading">
                {{ item.heading }}
              </v-subheader>
            </v-flex>
          </v-layout>
          <v-divider
            dark
            v-else-if="item.divider"
            class="my-3"
            :key="i"
          ></v-divider>
          <v-list-tile
            :key="i"
            v-else
            @click="onMenuClick(i)"
          >
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title class="grey--text">
                {{ item.text }}
              </v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
      </v-list>
    </v-navigation-drawer>
  </div>  
</template>

<script>
    import { mapGetters, mapMutations, mapActions } from 'vuex';
    export default {
        name: 'Navibar',
        components: {
        },

        data: () => ({
          drawer: true,
      items: [
        { icon: 'home', text: 'Home' },
        { divider: true },
        { heading: 'Filters' },
        { icon: 'check', text: 'Show processed orders',  },
        { icon: 'add', text: 'Show unprocessed orders' },
        { icon: 'delete', text: 'Show removed orders' },
        { divider: true },
        { heading: 'Sort' },
        { icon: 'mdi-sort-ascending', text: 'Sort order by date ascendig' },
        { icon: 'mdi-sort-descending', text: 'Sort order by date descending' },
        { divider: true },
        { icon: 'settings', text: 'Settings' },
      ]
    }),

        computed: {
            ...mapGetters('auth', ['isLoggedIn']),
        },

        methods: {
            ...mapActions('auth', [ 'signOut' ]),
            ...mapActions('order', 
            [
              'fetchProcessedOrders', 
              'fetchUnProcessedOrders',
              'fetchRemovedOrders',
              'fetchOrders'
            ]),

            async onSignOut() {
                await this.signOut();
                this.$router.push({ name: 'auth.signIn' });
            },

            onMenuClick(i) {
              switch (i) {
                case 0:
                  this.fetchOrders({ page: 1 });
                  break;
                case 3:
                  this.fetchProcessedOrders({ page: 1 });
                  break;
                case 4:
                  this.fetchUnProcessedOrders( { page: 1 } );
                  break;
                case 5:
                  this.fetchRemovedOrders( { page: 1 } );
                  break;
                default:
                  break;
              }
              
            }
        }


    }
</script>

<style scope>
    .tool-bar-link {   
        color:rgb(247, 215, 73);
        text-decoration: none;
    }
</style>
