import '../css/app.css';
import '@tailwindplus/elements';
import { createPinia} from "pinia";
import { createApp } from "vue";
import Alpine from 'alpinejs';
import ProductReturnForm from "./components/ProductReturn/ProductReturnForm.vue";
import ProductReportForm from "./components/ProductReport/ProductReportForm.vue";
import QualificationForm from "./components/QualificationForm.vue";
import Editor from '@toast-ui/editor';
import '@toast-ui/editor/dist/toastui-editor.css';
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

    const NUMBER_OF_SNOWFLAKES = 100;
    const MAX_SNOWFLAKE_SIZE = 3;
    const MAX_SNOWFLAKE_SPEED = 1;
    const SNOWFLAKE_COLOR = "#eeeeee";
    const snowflakes = [];

    const canvas = document.createElement('canvas');
    canvas.style.position = 'absolute';
    canvas.style.top = '0px';
    canvas.style.pointerEvents = 'none';
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    document.body.appendChild(canvas)

    const ctx = canvas.getContext('2d');
    const createSnowflake = () => ({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        radius: Math.floor(Math.random() * MAX_SNOWFLAKE_SIZE + 1),
        colour: SNOWFLAKE_COLOR,
        speed: Math.random() * MAX_SNOWFLAKE_SPEED + 3,
        sway: Math.random() - 0.3,
        opacity: 0.01
    })

    const drawSnowflake = snowflake => {
        ctx.beginPath();
        ctx.arc(snowflake.x, snowflake.y, snowflake.radius, 0, Math.PI * 2);
        ctx.fillStyle = snowflake.colour;
        ctx.fill();
        ctx.closePath();
    }

    const updateSnowflake = snowflake => {
        snowflake.y += snowflake.speed;
        snowflake.x += snowflake.sway;
        snowflake.fillOpacity = 0.05;
        if (snowflake.y > canvas.height + 5) {
            Object.assign(snowflake, createSnowflake());
        }
    }

    const animate = () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        snowflakes.forEach(snowflake => {
            updateSnowflake(snowflake);
            drawSnowflake(snowflake);
        })
    }

    for (let i = 0; i < NUMBER_OF_SNOWFLAKES; i++) {
        snowflakes.push(createSnowflake())
    }

    window.addEventListener('resize', () => {
         canvas.width = window.innerWidth;
         canvas.height = window.innerHeight;
    })

    window.addEventListener('scroll', () => {
        canvas.style.top = `${window.scrollY}px`
    })

    setInterval(animate, 20)
})
