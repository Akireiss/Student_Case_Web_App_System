// document.addEventListener('DOMContentLoaded', function() {
//     const livingWithCheckboxes = document.querySelectorAll('input[name="living-with"]');
//     const planCheckboxes = document.querySelectorAll('input[name="plan"]');

//     function handleCheckboxChange(checkboxes, currentCheckbox) {
//         checkboxes.forEach((checkbox) => {
//             if (checkbox !== currentCheckbox) {
//                 checkbox.checked = false;
//             }
//         });
//     }

//     livingWithCheckboxes.forEach((checkbox) => {
//         checkbox.addEventListener('change', function() {
//             if (this.checked) {
//                 handleCheckboxChange(livingWithCheckboxes, this);
//             }
//         });
//     });

//     planCheckboxes.forEach((checkbox) => {
//         checkbox.addEventListener('change', function() {
//             if (this.checked) {
//                 handleCheckboxChange(planCheckboxes, this);
//             }
//         });
//     });
// });
