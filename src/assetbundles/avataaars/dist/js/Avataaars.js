/**
 * Avataaars plugin for Craft CMS
 *
 * Avataaars JS
 *
 * @author    remcoov
 * @copyright Copyright (c) 2020 remcoov
 * @link      https://github.com/remcoov
 * @package   Avataaars
 * @since     1.0.0
 */

/* getImagePreview */
function getImagePreview() {
    const form = document.querySelector('form');
    let options = new FormData(form);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'actions/avataaars/user-photo/get-image-preview');
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById("userPhoto-result-img").src = xhr.responseText;
        }
    };
    xhr.send(options);
}

/* add change event for all field inputs, to trigger getImagePreview()*/
const formElements = document.querySelectorAll('.formElement');
for (let i = 0; i < formElements.length; i++) {
    formElements[i].addEventListener('change', getImagePreview);
}

/* userPicSubmit */
let userPicSubmit = document.getElementById('userPhoto-submit');
userPicSubmit.addEventListener('click', function (e) {

    e.preventDefault();

    var confirmation = confirm('Are you sure you want to set your user photo?');
    if (!confirmation) {
        return false;
    }

    const form = document.querySelector('form');
    let options = new FormData(form);
    options.append("svg", true);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'actions/avataaars/user-photo/set-user-photo');
    xhr.onload = function () {
        if (xhr.status === 200) {
            window.dispatchEvent(new CustomEvent("userPhotoStatus", {
                detail: {
                    status: "success"
                }
            }));
        } else {
            window.dispatchEvent(new CustomEvent("userPhotoStatus", {
                detail: {
                    status: "error"
                }
            }));
        }
    };
    xhr.send(options);

});

/* window onload, load first preview */
window.addEventListener('load', function () {
    getImagePreview();
})