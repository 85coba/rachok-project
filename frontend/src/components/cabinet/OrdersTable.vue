<template>
    <v-list two-line>
          <template v-for="(item, index) in items">
            <v-list-tile
              :key="item.id + 'id'"
              avatar
              ripple
              @click="toggle(index)"
            >
              <v-list-tile-content>
                <v-list-tile-title><v-icon>mdi-forklift</v-icon>{{ item.title }}</v-list-tile-title>
                <v-list-tile-sub-title class="text--primary">{{ item.email }}</v-list-tile-sub-title>
                <v-list-tile-sub-title>{{ item.city }}</v-list-tile-sub-title>
              </v-list-tile-content>

              <v-list-tile-action>
                <v-list-tile-action-text>{{ item.created }}</v-list-tile-action-text>
                <v-icon
                  v-if="selected.indexOf(index) < 0"
                  color="grey lighten-1"
                >
                  star_border
                </v-icon>

                <v-icon
                  v-else
                  color="yellow darken-2"
                >
                  star
                </v-icon>
              </v-list-tile-action>

            </v-list-tile>
            <v-divider
              v-if="index + 1 < items.length"
              :key="index"
            ></v-divider>
          </template>
        </v-list>
      </template>
 <script>
  import { mapGetters, mapActions } from "vuex";
  import showStatusToast from '@/components/mixin/showStatusToast'
  export default {
    name: "OrdrsTables",

    mixins: [showStatusToast],

    data: () => ({
      selected: [],
    }),

    async created() {
      try {
        await this.fetchOrders({page: 1});
      } catch(error) {
        this.showErrorMessage(error.message);
      }
    },

    computed: {
      ...mapGetters("order",{
        items: "ordersSortedByCreatedDate"
      })
    },

    methods: {
      ...mapActions("order", ["fetchOrders"]),

      toggle (index) {
        const i = this.selected.indexOf(index)

        if (i > -1) {
          this.selected.splice(i, 1)
        } else {
          this.selected.push(index)
        }
      }
    }
  }
</script>