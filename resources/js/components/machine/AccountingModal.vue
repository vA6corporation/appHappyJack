<template lang="html">
  <div class="modal fade" id="accountingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ machine.game }} - N/S: {{ machine.series }} - POSICION {{ machine.position }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body bg-info">
          <div class="form-row">
            <div class="col-6">
              <div class="input-group form-group shadow">
                <input type="date" v-model='currentDate' class="form-control">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i data-feather="calendar" width="18" height="18"></i>
                  </span>
                </div>
              </div>
              <div class="card p-3 form-group shadow">
                <label for="">CONT. INICIALES</label>
                <!-- <div class="form-row" v-if='machine.count'>
                  <div class="col-6">
                    <label for="">Turnover</label>
                    <input id='inputTO' type="text" class="form-control" v-model='machine.count.initialTO' readonly>
                  </div>
                  <div class="col-6">
                    <label for="">Totalwin</label>
                    <input id='inputTW' type="text" class="form-control" v-model='machine.count.initialTW' readonly>
                  </div>
                  <div class="col-12">
                    <span class="text-muted mt-1">Iniciado: {{machine.count.created_at}}</span>
                  </div>
                </div> -->
                <div class="form-row form-group">
                  <div class="col-6">
                    <label for="">Turnover</label>
                    <input id='inputTO' type="text" class="form-control" :value='machine.lastTurnover' disabled required>
                  </div>
                  <div class="col-6">
                    <label for="">Totalwin</label>
                    <input id='inputTW' type="text" class="form-control" :value='machine.lastTotalwin' disabled required>
                  </div>
                </div>
              </div>
              <div class="card p-3 shadow form-group">
                <label for="">CONT. FINALES</label>
                <div class="form-row">
                  <div class="col-6">
                    <label for="">Turnover</label>
                    <input id='finalTO' type="text" class="form-control" v-model='finalTO' required>
                  </div>
                  <div class="col-6">
                    <label for="">Totalwin</label>
                    <input id='finalTW' type="text" class="form-control" v-model='finalTW' required>
                  </div>
                </div>
                <!-- <div class="form-row" v-else>
                  <div class="col-6">
                    <label for="">Turnover</label>
                    <input type="text" class="form-control" readonly>
                  </div>
                  <div class="col-6">
                    <label for="">Totalwin</label>
                    <input type="text" class="form-control" readonly>
                  </div>
                </div> -->
              </div>
              <div class="card p-3">
                <!-- <div class="form-row" v-if='machine.count'>
                  <div class="col-6">
                    <label for="">Inicial Billetes</label>
                    <input id='initialBilletes' type="text" class="form-control" v-model='initialBill' required>
                  </div>
                  <div class="col-6">
                    <label for="">Final Billetes</label>
                    <input id='finalBilletes' type="text" class="form-control" v-model='finalBill' required>
                  </div>
                </div> -->
                <div class="form-row">
                  <div class="col-6">
                    <label for="">Inicial Billetes</label>
                    <input id='initialBilletes' type="text" class="form-control" :value='machine.lastBill' disabled required>
                  </div>
                  <div class="col-6">
                    <label for="">Final Billetes</label>
                    <input id='finalBilletes' type="text" class="form-control" v-model='finalBill' required>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="card p-3 shadow form-group">
                <div class="form-row form-group">
                  <label for="input" class="col-12 col-form-label">Relleno</label>
                  <div class="col-12">
                    <form class='input-group' @submit.prevent='saveOperation()'>
                      <input class="form-control" type="number" placeholder='Cantidad' min="0" v-model.number='relleno' required>
                      <div class='input-group-append'>
                        <button class="btn btn-info btn-block" type="submit">Registrar</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="form-row form-group">
                  <label for="input" class="col-12 col-form-label">Retiro</label>
                  <div class="col-12">
                     <form class='input-group' @submit.prevent='saveOperation()'>
                      <input class="form-control" type="number" placeholder='Cantidad' min="0" v-model.number='retiro' required>
                      <div class='input-group-append'>
                        <button class="btn btn-info btn-block" type="submit">Registrar</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="form-row form-group">
                  <label for="input" class="col-12 col-form-label">Pago Manual</label>
                  <div class="col-12">
                    <form class='input-group' @submit.prevent='saveOperation()'>
                      <input class="form-control" type="number" placeholder='Cantidad' min="0" v-model.number='pago' required>
                      <div class='input-group-append'>
                        <button class="btn btn-info btn-block" type="submit">Registrar</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-12">
                    <button class="btn btn-secondary btn-block" type="button" name="button" data-dismiss='modal'>Salir</button>
                  </div>
                  <!-- <div class="col-6">
                    <button class="btn btn-info btn-block" type="button" @click='saveOperation()' name="button">Registrar</button>
                  </div> -->
                </div>
              </div>
              <div class="card p-3 form-group shadow">
                <div class="form-row form-group">
                  <div class="col">
                    <button
                      class="btn btn-success btn-block"
                      type="button"
                      v-if='!machine.state'
                      @click='changeState()'> Activar
                    </button>
                    <button
                      class="btn btn-danger btn-block"
                      type="button"
                      v-else
                      @click='changeState()'> Apagar
                    </button>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <!-- <button
                      class="btn btn-danger btn-block"
                      type="button"
                      v-if='machine.count'
                      @click='endCount()'> Finalizar Conteo
                    </button> -->
                    <button
                      class="btn btn-success btn-block"
                      type="button"
                      @click='startCount()'> Registrar Conteo
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  mounted() {
    console.log('hola mundo');
    // if (this.machine.count) {
    //   this.initialTO = this.machine.count.initialTO;
    //   this.initialTW = this.machine.count.initialTW;
    // }
    this.currentDate = this.date;
  },
  computed: {
    ...mapState(['machine'])
  },
  data() {
    return {
      relleno: '',
      retiro: '',
      pago: '',
      initialTO: '',
      initialTW: '',
      finalTO: '',
      finalTW: '',
      initialBill: '',
      finalBill: '',
      finalTW: '',
      currentDate: '',
    }
  },
  methods: {
    saveOperation() {
      this.$http.post('operations', {
        relleno: this.relleno,
        retiro: this.retiro,
        pago: this.pago,
        machine: this.machine.id,
        //count_id: this.machine.count.id,
      }).then(response => {
        console.log(response);
        this.pago = '';
        this.retiro = '';
        this.relleno = '';
        this.$snotify.success('Operacion registrada correctamente');
      }, response => {
        console.log(response);
      })
    },
    changeState() {
      var state = !this.machine.state;
      var id = this.machine.id;
      this.$http.get(`machines/changeState/${id}/${state}`).then(response => {
        console.log(response.body.machine);
        var machine = response.body.machine;
        this.$store.commit('setMachine', machine);
      }, response => {
        console.log(response);
      });
      this.$emit('changeState');
    },
    startCount() {
      if (finalTO.reportValidity() && finalTW.reportValidity() && finalBilletes.reportValidity()) {
        var count = {
          machine_id: this.machine.id,
          initialTO: this.machine.lastTurnover,
          initialTW: this.machine.lastTotalwin,
          finalTO: this.finalTO,
          finalTW: this.finalTW,
          initialBill: this.machine.lastBill,
          finalBill: this.finalBill,
          created_at: this.currentDate,
        };
        console.log(count);
        this.$http.post('counts', { count: count }).then(response => {
          // count =  response.body.count;
          // this.$store.commit('setCount', count);
          $('.modal').modal('hide');
          this.finalTO = '';
          this.finalTW = '';
          this.finalBill = '';
          this.$emit('update');
          console.log(response);
        }, response => {
          console.log(response);
        });
      }
    },
    endCount() {
      if (finalTO.reportValidity() && finalTW.reportValidity() && finalBilletes.reportValidity()) {
        var count = this.machine.count;
        count.finalTO = this.finalTO;
        count.finalTW =  this.finalTW;
        var bill = {
          initialBill: this.initialBill,
          finalBill: this.finalBill,
        }
        this.$http.post('counts/close', { count: count, bill: bill }).then(response => {
          console.log(response);
          this.finalTO = '';
          this.finalTW = '';
          this.initialTW = '';
          this.initialTO = '';
          this.$emit('changeState');
          $('.modal').modal('hide');
        }, response => {
          console.log(response);
        })
      }
    }
  }
}
</script>

<style lang="css">
</style>
