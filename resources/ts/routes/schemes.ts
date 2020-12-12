import Vue from 'vue';
import VueRouter from 'vue-router';

import SchemeIndex from '../components/scheme/SchemeIndexComponent.vue';
import SchemeApply from '../components/scheme/SchemeApplyComponent.vue';
import SchemeEdit from '../components/scheme/SchemeEditComponent.vue';
import { apiModule } from '../modules/api';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/schemes/apply',
      component: SchemeApply,
      name: 'apply',
    },
    {
      path: '/schemes/edit/:schemeId',
      component: SchemeEdit,
      name: 'edit',
    },
    {
      path: '/schemes/',
      component: SchemeIndex,
      name: 'index',
    }
  ]
});

router.beforeEach((to, from, next) => {
  if (to.name !== 'index' && !apiModule.isAuthenticated) {
    next({name: 'index'});
  } else {
    next();
  }
});

export default router;
