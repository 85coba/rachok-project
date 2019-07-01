<template>
  <v-card>
    <v-card-title class="headline blue-grey lighten-1">
      <span class="white--text">Заповніть форму для заявки</span>
    </v-card-title>
    <v-card-text>
      <v-autocomplete
        v-model="model"
        :items="items"
        :loading="isLoading"
        :search-input.sync="search"
        hide-no-data
        hide-selected
        item-text="Type"
        label="Назва техніки"
        placeholder="Start typing to Search"
        prepend-icon="mdi-magnify"
        return-object
      ></v-autocomplete>
    </v-card-text>
    <v-divider></v-divider>
    <v-expand-transition>
      <v-list v-if="model" class="grey lighten-3">
        <v-list-tile v-for="(field, i) in fields" :key="i">
          <v-text-field
              name="name"
              :label="field.value"
              id="id"
          ></v-text-field>
        </v-list-tile>
      </v-list>
    </v-expand-transition>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn :disabled="!model" color="blue-grey lighten-1" @click="model = null">
        Clear
        <v-icon right>mdi-close-circle</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    descriptionLimit: 60,
    entries: [],
    isLoading: false,
    model: null,
    search: null,
    entries: [
                {"Name":"Трактор","Type":"Рачок","param1":"Яке навісне обладнання потрібно", "param2":"Потужність", "param3":"Обєм ковша в куб. м."},
                {"Name":"Екскаватор","Type":"Екскаватор ковшовий","Instrument":"Обєм ковша","Parameters":"Довжина стріли"},
                {"Name":"Кран","Type":"Автокран","Instrument":"", "Parameters":"Висота підйому", "Aditional":"Вантажопідємність"},
                {"Name":"BobCat","Type":"BobCat","Instrument":"Ковш", "Parameters":"", "Aditional":""},
            ],
  }),

  computed: {
    fields() {
      if (!this.model) return [];
    
      return Object.keys(this.model)
      .filter(key => key !== 'Name' && key !== 'Type')
      .map(key => {
        return {
          key,
          value: this.model[key] || "n/a"
        };
      });
    },
    items() {
      return this.entries.map(entry => {
        const Type = entry.Type;
        return Object.assign({}, entry, { Type });
      });
    }
  },

  watch: {
    search(val) {
      // Items have already been loaded
      if (this.items.length > 0) return;

      // Items have already been requested
      if (this.isLoading) return;

      this.isLoading = true;

      // Lazily load input items
        // this.entries = [
        //     {"Name":"Трактор","Type":"Рачок","Instrument":"", "Parameters":"", "Aditional":""},
        //     {"Name":"Екскаватор","Type":"Екскаватор ковшовий","Instrument":"Обєм ковша","Parameters":"Довжина стріли"},
        //     {"Name":"Кран","Type":"Автокран","Instrument":"", "Parameters":"Висота підйому", "Aditional":"Вантажопідємність"},
        //     {"Name":"BobCat","Type":"BobCat","Instrument":"Ковш", "Parameters":"", "Aditional":""},
        // ];

        this.isLoading = false;
    }
  }
};
</script>