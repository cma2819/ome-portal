import Vue from 'vue';
import VueRouter from 'vue-router';

import SchemeIndex from '../components/scheme/SchemeIndexComponent.vue';
import SchemeApply from '../components/scheme/SchemeApplyComponent.vue';

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/schemes/apply',
      component: SchemeApply,
      name: 'apply'
    },
    {
      path: '/schemes/',
      component: SchemeIndex,
      name: 'index'
    }
  ]
});
