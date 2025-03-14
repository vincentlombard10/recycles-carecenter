import './bootstrap';
import 'bootstrap';
import { createApp } from "vue";
import CreateProductReturnForm from "./components/CreateProductReturnForm.vue";
import Alpine from 'alpinejs';
window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', function() {
    Alpine.start();

    const productReturnFormElement = document.querySelector("#product-return-form")
    if (productReturnFormElement !== null) {
        createApp(CreateProductReturnForm).mount(productReturnFormElement)
    }
})
