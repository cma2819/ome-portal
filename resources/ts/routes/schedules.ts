import Vue from 'vue';
import VueRouter from 'vue-router';

import ScheduleIndex from '../components/schedule/ScheduleIndexComponent.vue';
import ScheduleDetail from '../components/schedule/ScheduleDetailComponent.vue';

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/schedules/:id',
      component: ScheduleDetail,
      name: 'detail'
    },
    {
      path: '/schedules/',
      component: ScheduleIndex,
      name: 'index'
    }
  ]
});
