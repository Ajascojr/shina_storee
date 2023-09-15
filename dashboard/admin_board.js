document.addEventListener('DOMContentLoaded', function () {
    const productForm = document.getElementById('product-form');
    const errorMsg = document.getElementById('error-msg');

    productForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const productName = document.getElementById('product_name').value;
        const productDescription = document.getElementById('product_description').value;
        const productPrice = document.getElementById('product_price').value;
        const productImage = document.getElementById('product_image').files[0];

        // Perform validation and further processing here
        // Example: You can use FormData to send the data to the server via AJAX
        // const formData = new FormData();
        // formData.append('product_name', productName);
        // formData.append('product_description', productDescription);
        // formData.append('product_price', productPrice);
        // formData.append('product_image', productImage);

        // Then, send the formData to the server using XMLHttpRequest or fetch

        // After successful submission, you can redirect or show a success message
    });
});
