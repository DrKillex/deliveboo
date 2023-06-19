import './bootstrap';
import Alpine from 'alpinejs';
import '~resources/scss/app.scss';
import.meta.glob([
    '../img/**'
]);

import * as bootstrap from 'bootstrap';

window.Alpine = Alpine;

Alpine.start();

// show preview upload image function Product
function showPreviewProduct(event) {
    if (event.target.files.length > 0) {
        const src = URL.createObjectURL(event.target.files[0]);
        const preview = document.getElementById("file-image-preview");
        preview.src = src;
        preview.style.display = "block";
    }
}
const imageInput = document.querySelector('#image');
imageInput.addEventListener('change', showPreviewProduct);

// show preview upload image function Restaurant
function showPreviewRestaurant(eventTwo) {
    if (eventTwo.target.files.length > 0) {
        const src = URL.createObjectURL(eventTwo.target.files[0]);
        const preview = document.getElementById("file-image-preview-restaurants");
        preview.src = src;
        preview.style.display = "block";
    }
}

const imageRestaurantInput = document.querySelector('#img-two');
imageRestaurantInput.addEventListener('change', showPreviewRestaurant);

// Condizione per Checkbox show Image Upload
// if (document.querySelector('.form-input-image')) {

//     const imageInputContainer = document.querySelector('#image-input-container');
//     const imageInput = document.querySelector('#image');
//     const setImageInput = document.getElementById('set_image');

//     imageInput.addEventListener('change', showPreview);
//     setImageInput.addEventListener('change', function () {
//         if (setImageInput.checked) {
//             //true
//             imageInputContainer.classList.remove('d-none');
//             imageInputContainer.classList.add('d-block');
//         } else {
//             //false
//             imageInputContainer.classList.remove('d-block');
//             imageInputContainer.classList.add('d-none');
//         }
//     });

// }