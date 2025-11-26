import './bootstrap';
import 'bootstrap';
import '../css/app.css';
import { createPinia} from "pinia";
import { createApp } from "vue";
import Alpine from 'alpinejs';
import ProductReturnForm from "./components/ProductReturn/ProductReturnForm.vue";
import ProductReportForm from "./components/ProductReport/ProductReportForm.vue";
import QualificationForm from "./components/QualificationForm.vue";
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

    const qualificationFormElement = document.querySelector("#qualification-form")
    if (qualificationFormElement !== null) {
        createApp(QualificationForm)
            .use(pinia)
            .mount(qualificationFormElement)
    }
})
