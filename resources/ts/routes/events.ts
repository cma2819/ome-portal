import Vue from 'vue';
import VueRouter from 'vue-router';

import ScheduleIndex from '../components/schedule/ScheduleIndexComponent.vue';
import ScheduleDetail from '../components/schedule/ScheduleDetailComponent.vue';
import SubmissionDetail from '../components/submission/SubmissionDetailComponent.vue';

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/events/:id/schedules',
      component: ScheduleDetail,
      name: 'schedule.detail'
    },
    {
      path: '/events/:id/submissions',
      component: SubmissionDetail,
      name: 'submission.detail'
    },
    {
      path: '/events/',
      component: ScheduleIndex,
      name: 'index'
    },
  ]
});
