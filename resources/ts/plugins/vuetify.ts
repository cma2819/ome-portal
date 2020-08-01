import Vue from 'vue';
import Vuetify from 'vuetify';

Vue.use(Vuetify)

export default new Vuetify({
  icons: {
    iconfont: 'fa'
  },
  theme: {
    dark: false,
    themes: {
      light: {
        primary: '#5f651e',
        secondary: '#717199',
        success: '#9999ff',
        info: '#4444c4',
        discord: '#7289da',
        twitch: '#6441a4'
      }
    }
  }
});
