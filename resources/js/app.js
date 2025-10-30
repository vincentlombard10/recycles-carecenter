import './bootstrap';
import 'bootstrap';
import { createPinia} from "pinia";
import { createApp } from "vue";
import Alpine from 'alpinejs';
import ProductReturnForm from "./components/ProductReturn/ProductReturnForm.vue";
import ProductReportForm from "./components/ProductReport/ProductReportForm.vue";
window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', function() {
    Alpine.start();
    const pinia = createPinia()
    const productReturnFormElement = document.querySelector("#product-return-form")
    if (productReturnFormElement !== null) {
        const app = createApp(ProductReturnForm)
            .use(pinia)
            .mount(productReturnFormElement)
    }

    const productReportFormElement = document.querySelector("#product-report-form")
    if (productReportFormElement !== null) {
        createApp(ProductReportForm)
            .use(pinia)
            .mount(productReportFormElement)
    }
})
