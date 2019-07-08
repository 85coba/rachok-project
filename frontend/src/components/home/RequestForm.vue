<template>
  <v-content>
  <v-card>
    <v-card-title class="headline blue darken-3">
      <span class="white--text">Заповніть форму для заявки</span>
    </v-card-title>
    <v-card-text>
      <v-combobox
          v-model="title"
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
      <v-card-text v-if="title && !next" >
        <v-flex v-for="(field, i) in fields" :key="i">
            <v-text-field
              v-model="order.features[field.value]"
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
              v-model="order.pib"
              label="ПІБ"
              placeholder=" "
              outline
              ma-5
              :rules="[rules.required]"
          ></v-text-field>

          <v-text-field
              v-model="order.email"
              label="Email"
              placeholder=" "
              outline
              :rules="[rules.required, rules.email]"
              ma-5
          ></v-text-field>
          <v-text-field
              v-model="order.phoneNumber"
              label="Номер телефону"
              placeholder=" "
              prefix="+38 "
              mask="phone"
              :rules="[rules.required]"
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
      <v-btn :disabled="isOk" color="green lighten-1" @click="onOk">
        OK
        <v-icon right>mdi-check-circle</v-icon>
      </v-btn>
      <v-btn :disabled="!title" color="blue-grey lighten-1" @click="onClear">
        Clear
        <v-icon right>mdi-close-circle</v-icon>
      </v-btn>
    </v-card-actions>
    </v-card>
  </v-content>
</template>
<script>
import VueGoogleAutocomplete from '../common/VueGoogleAutocomplete'
import { mapActions } from 'vuex';
import showStatusToast from '@/components/mixin/showStatusToast'

export default {
  name: 'RequestForm',

  mixins: [showStatusToast],

  components: {
    VueGoogleAutocomplete
  },

  data: () => ({
    order: {
      title:'',
      info:'',
      features:{},
      pib:'',
      region:'',
      city:'',
      email:'',
      phoneNumber:''
    },
    title: null,
    search: null,
    rules: {
          required: value => !!value || 'Required.',
          counter: value => value.length <= 30 && value.length >= 3 || 'Min 3 Max 30 characters',
          email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'Invalid e-mail.'
          }
    },
    entries: [],   
    next: false,
  }),

  computed: {

    fields() {
      if (!this.title) return [];
      if (typeof this.title === 'string') {
        return [{"value":"Додаткова інформація"}];
      } 
      return Object.keys(this.title)
      .filter(key => key !== 'Name' && key !== 'Type')
      .map(key => {
        return {
          key,
          value: this.title[key] || "n/a"
        };
      });
    },

    items() {
      return this.entries.map(entry => {
        const Type = entry.Type;
        return Object.assign({}, entry, { Type });
      });
    },

    isOk(){
      if (!this.title) { 
        return true;
        } else {
          return false;
        }
    }

  },
  methods: {

    async onOk() {
      if (this.next === false ) {
        this.next = true;
      } else {
        this.order.title = (this.title.Name) ? this.title.Name : this.title;
        try {
          await this.addOrder(this.order);
          this.showSuccessMessage("Ваш запит додано!");
          this.onClear();
        } catch(error) {
          this.showErrorMessage(error.message);
        }
        
      }
    },
    
    onClear() {
      this.title = null;
      this.next = false;
    },

    getAddressData: function (addressData, placeResultData, id) {
      this.order.region = addressData.administrative_area_level_1;
      this.order.city = addressData.locality;
    },

    ...mapActions('order',['addOrder']),

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