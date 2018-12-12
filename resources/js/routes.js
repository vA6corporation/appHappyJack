export const routes = [
  { path: '/machine', component: require('./views/machine/index.vue') },
  { path: '/machine/create', component: require('./views/machine/create.vue') },
  { path: '/machine/:machineId/edit', component: require('./views/machine/edit.vue') },
  { path: '/machine/:machineId/delete', component: require('./views/machine/delete') },
  //Salas
  { path: '/room/machines', component: require('./views/room/index.vue') },
  { path: '/room', component: require('./views/room/rooms.vue') },
  { path: '/room/create', component: require('./views/room/Create.vue') },
  { path: '/room/:roomId/edit', component: require('./views/room/Edit.vue') },
  { path: '/room/massive', component: require('./views/room/Massive.vue') },
  //reportes
  { path: '/report', component: require('./views/report/liquidacion.vue') },
  { path: '/report/sala', component: require('./views/report/sala.vue') },
  { path: '/report/relleno', component: require('./views/report/relleno.vue') },
  { path: '/report/retiro', component: require('./views/report/retiro.vue') },
  { path: '/report/pago', component: require('./views/report/pago.vue') },
  //users
  { path: '/user', component: require('./views/user') },
  { path: '/user/:userId/edit', component: require('./views/user/Edit.vue') },
]
