<template>
  <v-container >
    <v-list two-line>
      <transition-group name="slide-prev" tag="span">
        <template v-for="(item, index) in items" name="fade">
          <v-list-tile :key="item.id + 'id'" avatar ripple @click="toggle(index, item)">
            <v-list-tile-content>
              <v-list-tile-title>
                <v-icon>mdi-forklift</v-icon>
                {{ item.title }}
              </v-list-tile-title>
              <v-list-tile-sub-title class="text--primary">{{ item.email }}</v-list-tile-sub-title>
              <v-list-tile-sub-title>{{ item.city }}</v-list-tile-sub-title>
            </v-list-tile-content>

            <v-list-tile-action>
              <v-list-tile-action-text>{{ item.created | createdDate }}</v-list-tile-action-text>
              <!-- <v-icon v-if="!item.processed" color="grey lighten-1">star_border</v-icon>
              <v-icon v-else color="yellow darken-2">star</v-icon> -->
              <v-scroll-x-transition>
              <v-icon
                v-if="item.processed"
                color="success"
              >
                check
              </v-icon>
            </v-scroll-x-transition>
            </v-list-tile-action>
          </v-list-tile>
          <v-divider v-if="index + 1 < items.length" :key="index"></v-divider>
        </template>
      </transition-group>
    </v-list>

    <v-layout row justify-center>
      <v-dialog v-model="dialog" max-width="340">
        <v-card>
          <v-card-title class="headline justify-center">{{ item.title }}</v-card-title>
          <v-layout align-center justify-center>
            <v-icon color="red darken-2">mdi-map-marker</v-icon>
            <span>{{ item.city }}, {{ item.region }}</span>
          </v-layout>
          <v-card-text>
            <h4>Додаткова інформація</h4>
            <v-divider></v-divider>
            <p>{{ item.info }}</p>
            <p v-for="(val, key) in item.features" :key="key">{{ key }}: {{ val }}</p>
            <h4>Контактна інформація</h4>
            <v-divider></v-divider>

            <v-layout align-center wrap ma-3>
              <v-icon color="green darken-2">mdi-account</v-icon>
              <span>{{ item.pib }}</span>
            </v-layout>
            <v-layout align-center wrap ma-3>
              <v-icon color="green darken-2">mdi-phone</v-icon>
              <span>{{ item.phoneNumber }}</span>
            </v-layout>

            <v-layout align-center wrap ma-3>
              <v-icon color="green darken-2">mdi-email</v-icon>
              <span>{{ item.email }}</span>
            </v-layout>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="green darken-1" flat="flat" @click="onRemove(item.id)">
              <v-icon color="red large">mdi-trash-can-outline</v-icon>
            </v-btn>
            <v-btn
              v-if="!item.processed"
              color="green darken-1"
              flat="flat"
              @click="doProcessed(item.id)"
            >Оброблено</v-btn>
            <v-btn
              v-else
              color="green darken-1"
              flat="flat"
              @click="doNotProcessed(item.id)"
            >Не оброблено</v-btn>
            <v-btn flat="flat" @click="dialog = false">
              <v-icon color="grey">mdi-redo-variant</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-layout>
  </v-container>
</template>
 <script>
import { mapGetters, mapActions } from "vuex";
import showStatusToast from "@/components/mixin/showStatusToast";
export default {
  name: "OrdrsTables",

  mixins: [showStatusToast],

  data: () => ({
    item: {},
    selected: [],
    dialog: false
  }),

  async created() {
    try {
      await this.fetchOrders({ page: 1 });
    } catch (error) {
      this.showErrorMessage(error.message);
    }
  },

  computed: {
    ...mapGetters("order", {
      items: "ordersSortedByCreatedDate"
    })
  },

  methods: {
    ...mapActions("order", [
      "fetchOrders",
      "processed",
      "unProcessed",
      "removeOrder"
    ]),

    toggle(index, item) {
      this.item = item;
      this.dialog = true;
    },

    doProcessed(id) {
      this.processed(id);
      this.dialog = false;
    },

    doNotProcessed(id) {
      this.unProcessed(id);
      this.dialog = false;
    },

    onRemove(id) {
      this.removeOrder(id);
      this.dialog = false;
    }
  }
};
</script>
<style scope>

.slide-prev-enter-active, .slide-prev-leave-active {
  transition: all 0.5s;
}
.slide-prev-enter, .slide-prev-leave-to {
  opacity: 0;
  transform: translateX(230px);
}
</style>
