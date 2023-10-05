<template>
  <q-page>
    <q-card>

      <q-card-section>
        <div class="row">
          <div class="col">
            Todos
          </div>
          <div class="col">
            <div style="text-align: right;">
              <q-btn icon="fas fa-plus" class="q-mr-sm" @click="addItem" />
              <q-btn icon="fas fa-sync" @click="sync" />
            </div>
          </div>
        </div>
      </q-card-section>
      <q-card-section>
        <div class = "row">
          <q-input type="text" v-model="filterInput" placeholder="Filter tasks" class="q-pa-sm"></q-input>
          <q-btn class="q-pa-sm q-ma-sm" color = " white "  text-color = " black "  label = " Search " @click="filterTasks(filter)"></q-btn>
          </div>
        <q-markup-table>
          
          <thead>
            <tr>
              <th style="text-align: left;">Title</th>   
              <th style="text-align: center;">Completed</th>
              <th>:::</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="item in items" :key="item.id">
              <tr>
                <td style="text-align: left; min-width: 50px; width: 50px">
                  <div class="text-primary cursor-pointer" :class="{'text-strike': item.completed}" @click="editItem(item)">
                    {{ item.title }}
                  </div>
                  <div style="text-align: center; " class="cursor-pointer q-mb-md" @click="descItem(item)">
                    {{item.description ? item.description:'Sem descrição'}}
                  </div>
                </td>
                <td style="text-align: center; min-width: 70px; width: 70px; max-width: 70px;">
                  <q-toggle v-model="item.completed" @update:model-value="v => onCompleteChange(item, v)" />
                </td>
                <td style="text-align: center; min-width: 100px; width: 100px; max-width: 100px;">
                  <q-btn icon="fas fa-calendar" class="q-mr-sm q-pa-sm" @click="icon = true"></q-btn>
                  <q-btn dense color="primary" icon="fas fa-pen" class="q-mr-sm" @click="editItem(item)" />
                  <q-btn dense color="negative" icon="fas fa-trash" @click="removeItem(item)" />
                </td>
              </tr>
            </template>
          </tbody>
        </q-markup-table>
        <q-dialog v-model="icon">
        <q-card>
          <q-card-section class="row items-center q-pb-none">
            <div class="text-h6">Final date</div>
            <q-space />
            <q-btn icon="fa fa-window-close" flat round dense v-close-popup />
          </q-card-section>

          <q-card-section>
            <div class="q-pa-md">
              <div class="q-gutter-md row items-start">
                <q-date v-model="date" minimal></q-date>
              </div>
              <q-btn icon="fa fa-check" class="q-mt-sm q-pa-sm" @click="calendar(item)"></q-btn>
            </div>
          </q-card-section>
        </q-card>
      </q-dialog>

      </q-card-section>
    </q-card>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'IndexPage',

  data() {
    return {
      items: [],
      filterInput: '',
      icon: false,
      date: null
    }
  },

  methods: {
    addItem() {
      this.$q.dialog({
        title: 'Add Todo',
        prompt: {
          model: ''
        },
        cancel: true,
        persistent: true
      }).onOk(title => {
        this.$api.post('/todos', {title}).then(res => {
          this.items.push(res.data);
        });
      })
    },
    descItem(item) {
      this.$q.dialog({
        title: 'Add Descrição',
        prompt: {
          model: item.description
        },
        cancel: true,
        persistent: true
      }).onOk(description => {
        this.$api.put(`/todos/${item.id}/description`, {description}).then(({data}) => {
          this.items = this.items.map(i=>{
            if(i.id == data.id){
              i.description = data.description
            }
            return i;
          })
        })
      })
    },
    calendar(item) {
      this.$api.put(`/todos/${item.id}/due_date`, {due_date}).then(({data}) => {
        this.items = this.items.map(d=>{
          if(d.id == data.id){
            d.due_date = data.due_date
          }
          return d;
        })
      })
    },
    editItem(item) {
      this.$q.dialog({
        title: 'Alterar Todo',
        prompt: {
          model: item.title
        },
        cancel: true,
        persistent: true
      }).onOk(title => {
        this.$api.put(`/todos/${item.id}`, { title }).then(res => {
          this.items = this.items.map(it => {
            if (it.id === item.id) {
              it.title = title
            }
            return it
          })
        });
      })
    },
    onCompleteChange(item, completed) {
      this.$api.put(`/todos/${item.id}/completed`, { completed }).then(res => {
        this.items = this.items.map(it => {
          if (it.id === item.id) {
            it.completed = completed
          }
          return it
        })
      });
    },
    removeItem(item) {
      this.$api.delete(`/todos/${item.id}`).then(res => {
        this.items = this.items.filter(it => it.id !== item.id)
      });
    },
    filterTasks() {
      this.items = this.filterInput.filter(item => {
        return item.search('');
      });
    },
    sync() {
      this.$api.get('/todos').then(res => {
        this.items = res.data
      })
    }
  },

  mounted() {
    this.sync()
  }
})
</script>
