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
                <v-list-tile-title><v-icon>mdi-forklift</v-icon>{{ item.name }}</v-list-tile-title>
                <v-list-tile-sub-title class="text--primary">{{ item.email }}</v-list-tile-sub-title>
                <v-list-tile-sub-title>{{ item.city }}</v-list-tile-sub-title>
              </v-list-tile-content>

              <v-list-tile-action>
                <v-list-tile-action-text>{{ item.date }}</v-list-tile-action-text>
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
      </v-list>
    </v-data-iterator>
</template>
 <script>
  export default {
    data: () => ({
      selected: [],
      items: [
        {
          id: 1,
          name: 'Rachock',
          date: '05.07.2019',
          city: 'Луцьк',
          email: 'aaa@aaa.com',
        },
       {
          id: 2,
          name: 'Rachock',
          date: '05.07.2019',
          city: 'Луцьк',
          email: 'aaa@aaa.com',
        },
        {
          id: 3,
          name: 'Rachock',
          date: '05.07.2019',
          city: 'Луцьк',
          email: 'aaa@aaa.com',
        },
        {
          id: 4,
          name: 'Rachock',
          date: '05.07.2019',
          city: 'Луцьк',
          email: 'aaa@aaa.com',
        },
        {
          id: 5,
          name: 'Rachock',
          date: '05.07.2019',
          city: 'Луцьк',
          email: 'aaa@aaa.com',
        },
        {
          id: 6,
          name: 'Rachock',
          date: '05.07.2019',
          city: 'Луцьк',
          email: 'aaa@aaa.com',
        },
        {
          id: 7,
          name: 'Rachock',
          date: '05.07.2019',
          city: 'Луцьк',
          email: 'aaa@aaa.com',
        },
        {
          id: 8,
          name: 'Rachock',
          date: '05.07.2019',
          city: 'Луцьк',
          email: 'aaa@aaa.com',
        },
        {
          id: 9,
          name: 'Rachock',
          date: '05.07.2019',
          city: 'Луцьк',
          email: 'aaa@aaa.com',
        },
        {
          id: 10,
          name: 'Rachock',
          date: '05.07.2019',
          city: 'Луцьк',
          email: 'aaa@aaa.com',
        },
        {
          id: 11,
          name: 'Rachock',
          date: '05.07.2019',
          city: 'Луцьк',
          email: 'aaa@aaa.com',
        }
      ]
    }),
    methods: {
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