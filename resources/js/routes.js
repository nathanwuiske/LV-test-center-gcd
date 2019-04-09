import VueRouter from 'vue-router'
Vue.use(VueRouter)


let routes = [
    { path: '/example', component: require('./components/ExampleComponent.vue').default },
    { path: '/test', component: require('./components/Test.vue').default }
  ];

  const router = new VueRouter({
    routes // short for `routes: routes`
  })