<template lang="html">
  <div class="row">
    <div class="col-12">
      <h1>Salas</h1>
      <select class="custom-select" v-model='currentRoom' @change='pickRoom()'>
        <option :value="{}">Seleccione una sala...</option>
        <option :value="item" v-for='(item, index) in rooms'>{{ item.name }}</option>
      </select>
      <hr>
      <div class="row">
        <div class="col-10">
          <div class="row">
            <div class="col-4">
              <div class="card card-body">
                <div class="form-row form-group">
                  <template v-for='index in 24'>
                    <template v-if='fixArray[index-1]'>
                      <div class="col-3 d-flex justify-content-center form-group">
                        <icono :position='index' :state='fixArray[index-1].state' :machine='fixArray[index-1]' @pick='setMachine' data-target='#accountingModal' data-toggle='modal'></icono>
                      </div>
                    </template>
                    <template v-else>
                      <div class="col-3 d-flex justify-content-center form-group">
                        <icono :position='index' :state='2'></icono>
                      </div>
                    </template>
                  </template>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card card-body">
                <div class="form-row form-group">
                  <template v-for='index in 73'>
                    <template v-if='fixArray[index-1]'>
                      <div class="col-3 d-flex justify-content-center form-group" v-if='index > 24 && index <= 48'>
                        <icono :position='index' :state='fixArray[index-1].state' :machine='fixArray[index-1]' @pick='setMachine' data-target='#accountingModal' data-toggle='modal'></icono>
                      </div>
                    </template>
                    <div class="col-3 d-flex justify-content-center form-group" v-else-if='index > 24 && index <= 48'>
                      <icono :position='index' :state='2'></icono>
                    </div>
                  </template>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card card-body">
                <div class="form-row form-group">
                  <template v-for='index in 73'>
                    <template v-if='fixArray[index-1]'>
                      <div class="col-3 d-flex justify-content-center form-group" v-if='index > 48 && index <= 72'>
                        <icono :position='index' :state='fixArray[index-1].state' :machine='fixArray[index-1]' @pick='setMachine' data-target='#accountingModal' data-toggle='modal'></icono>
                      </div>
                    </template>
                    <div class="col-3 d-flex justify-content-center form-group" v-else-if='index > 48 && index <= 72'>
                      <icono :position='index' :state='2'></icono>
                    </div>
                  </template>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-2">
          <h5>Leyenda</h5>
          <div class="card p-2">
              <div class="d-flex"><div
                class="lead shadow-sm rounded border text-center align-items-center d-flex justify-content-center bg-success margin: 0; padding: 0;"
                style="width:30px; height:30px; cursor: pointer">
              </div><span class="">Activado</span></div>
              <div class="d-flex"><div
                class="lead shadow-sm rounded border text-center align-items-center d-flex justify-content-center bg-danger margin: 0; padding: 0;"
                style="width:30px; height:30px; cursor: pointer">
              </div> <span class="">Apagado</span></div>
              <div class="d-flex"><div
                class="lead shadow-sm rounded border text-center align-items-center d-flex justify-content-center bg-secondary margin: 0; padding: 0;"
                style="width:30px; height:30px; cursor: pointer">
              </div><span class="">No ay maquina</span></div>
          </div>
        </div>
      </div>
    </div>
    <accounting-modal @changeState='changeState' @update='pickRoom()'></accounting-modal>
  </div>
</template>

<script>
import Icono from '@/components/Icono.vue'
import AccountingModal from '@/components/machine/AccountingModal.vue'
import {mapMutations, mapState} from 'vuex'
export default {
  computed: {
    ...mapState(['machine']),
    fixArray() {
      var newArray =  [];
      this.machines.forEach(item => {
        newArray[item.position-1] =  item;
      });
      return newArray;
    }
  },
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      machines: [],
      rooms: [],
      currentRoom: {},
    }
  },
  methods: {
    ...mapMutations([
      'setMachine'
    ]),
    changeState() {
      this.$http.get('machines').then(response => {
        console.log(response);
        this.machines = response.body.machines
      }, response => {
        console.log(response);
      });
    },
    fetchData() {
      this.$http.get('rooms').then(response => {
        console.log(response);
        this.rooms = response.body.rooms;
      }, response => {
        console.log(response);
      });
    },
    pickRoom() {
      this.$http.get(`rooms/${this.currentRoom.id}/withMachines`).then(response => {
        console.log(response);
        this.machines = response.body.room.machines;
      }, response => {
        console.log(response);
      });
    }
  },
  components: {
    Icono,
    AccountingModal
  }
}
</script>

<style lang="css">
</style>
