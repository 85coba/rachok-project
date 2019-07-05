<template>
  <v-content>
  <v-card>
    <v-card-title class="headline blue darken-3">
      <span class="white--text">Заповніть форму для заявки</span>
    </v-card-title>
    <v-card-text>
      <v-combobox
          v-model="model"
          :items="items"
          item-text="Type"
          :search-input.sync="search"
          label="Select a favorite activity or create a new one"
          return-object
          prepend-icon="mdi-magnify"
          hide-no-data
          hide-selected
      ></v-combobox>
    </v-card-text>
    <v-divider></v-divider>
    <v-expand-transition>
      <v-card-text v-if="model && !next" >
        <v-flex v-for="(field, i) in fields" :key="i">
            <v-text-field
              name="name"
              :label="field.value"
              placeholder=" "
              outline
              ma-5
          ></v-text-field>
        </v-flex>
      </v-card-text>
    </v-expand-transition>
  </v-card>
  <v-expand-transition>
  <v-card v-if="next">
    <v-card-title class="headline blue darken-3">
      <span class="white--text">Введіть контактні дані</span>
    </v-card-title>
    <v-card-text>
        <v-flex>
          <v-text-field
              label="ПІБ"
              placeholder=" "
              outline
              ma-5
              :rules="[rules.required, rules.counter]"
          ></v-text-field>

          <v-text-field
              label="Email"
              placeholder=" "
              outline
              :rules="[rules.required, rules.email]"
              ma-5
          ></v-text-field>
          <v-text-field
              label="Номер телефону"
              placeholder=" "
              prefix="+38 "
              mask="phone"
              outline
              ma-5
          ></v-text-field>
          <vue-google-autocomplete
              types="(cities)"
              id="map"
              classname="form-control"
              placeholder="Start typing"
              v-on:placechanged="getAddressData"
              country="ua"              
          ></vue-google-autocomplete>
        </v-flex>
      </v-card-text>
  </v-card>
  </v-expand-transition>
  <v-card>
  <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn :disabled="!model" color="green lighten-1" @click="next = true">
        OK
        <v-icon right>mdi-check-circle</v-icon>
      </v-btn>
      <v-btn :disabled="!model" color="blue-grey lighten-1" @click="onClear">
        Clear
        <v-icon right>mdi-close-circle</v-icon>
      </v-btn>
    </v-card-actions>
    </v-card>
  </v-content>
</template>
<script>
import VueGoogleAutocomplete from '../common/VueGoogleAutocomplete'

export default {
  components: {
    VueGoogleAutocomplete
  },

  data: () => ({
    address: "",
    descriptionLimit: 60,
    isLoading: false,
    model: null,
    search: null,
    rules: {
          required: value => !!value || 'Required.',
          counter: value => value.length <= 30 && value.length >= 3 || 'Min 3 Max 30 characters',
          email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'Invalid e-mail.'
          }
    },
    entries: [
                // {"Name":"Трактор","Type":"Рачок","param1":"Яке навісне обладнання потрібно", "param2":"Потужність", "param3":"Обєм ковша в куб. м."},
                // {"Name":"Екскаватор","Type":"Екскаватор ковшовий","Instrument":"Обєм ковша","Parameters":"Довжина стріли"},
                // {"Name":"Кран","Type":"Автокран","Instrument":"", "Parameters":"Висота підйому", "Aditional":"Вантажопідємність"},
                // {"Name":"BobCat","Type":"BobCat","Instrument":"Ковш", "Parameters":"", "Aditional":""},
            ],
    next: false,
  }),

  computed: {

    fields() {
      if (!this.model) return [];
      if (typeof this.model === 'string') {
        return [{"value":"Додаткова інформація"}];
      } 
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
  methods: {

    onClear() {
      this.model = null;
      this.next = false;
    },

    getAddressData: function (addressData, placeResultData, id) {
      this.address = addressData;
    }

  },

  watch: {
    search(val) {
      // Items have already been loaded
      // if (this.items.length > 0) return;

      // Items have already been requested
      // if (this.isLoading) return;

      // this.isLoading = true;

      // Lazily load input items
        this.entries = [
            {"Name":"Трактор","Type":"Рачок","Instrument":"", "Parameters":"", "Aditional":""},
            {"Name":"Екскаватор","Type":"Екскаватор ковшовий","Instrument":"Обєм ковша","Parameters":"Довжина стріли"},
            {"Name":"Кран","Type":"Автокран","Instrument":"", "Parameters":"Висота підйому", "Aditional":"Вантажопідємність"},
            {"Name":"BobCat","Type":"BobCat","Instrument":"Ковш", "Parameters":"", "Aditional":""},
        ];

        // this.isLoading = false;
    }
  }
};
</script>