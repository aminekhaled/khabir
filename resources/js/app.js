import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import Swal from 'sweetalert2';
import '../../public/style/style.css';
import '../../public/style/index.css';
import router from './router';
import store from './store';

const app = createApp(App);

app.use(store);

app.config.globalProperties.$swal = Swal;

axios.defaults.baseURL = "/";

app.use(router).mount('#app');

