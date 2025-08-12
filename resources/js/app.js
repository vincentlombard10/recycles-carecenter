import './bootstrap';
import 'bootstrap';
import { createApp } from "vue";
import ProductReturnForm from "./components/ProductReturn/ProductReturnForm.vue";
import Alpine from 'alpinejs';
import ProductReportForm from "./components/ProductReportForm.vue";
window.Alpine = Alpine;

import Sortable from 'sortablejs/modular/sortable.complete.esm.js';


document.addEventListener('DOMContentLoaded', function() {
    Alpine.start();

    const productReturnFormElement = document.querySelector("#product-return-form")
    if (productReturnFormElement !== null) {
        createApp(ProductReturnForm)
            .mount(productReturnFormElement)
    }

    const productReportFormElement = document.querySelector("#product-report-form")
    if (productReportFormElement !== null) {
        createApp(ProductReportForm)
            .mount(productReportFormElement)
    }

    const el = document.querySelector("#cfo-list")
    console.log(el)
    const sortable = Sortable.create(el, {
        handle: '.handle',
        animation: 150,
        ghostClass: 'cfo-ghost-item',
        onChoose: function(e) {
            console.log('onChoose')
        },
        onUnchoose: function(e) {
            //console.log('onUnchoose')
        },
        onStart: function(e) {
            //console.log('onStart')
        },
        onEnd: function(e) {
            //console.log(sortable)
        },
        onUpdate: function(e) {
            fetch('/customfields/options/sort', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({items: sortable.toArray()})
            }).then(r => console.log(r.json()));
        }
    })
})
