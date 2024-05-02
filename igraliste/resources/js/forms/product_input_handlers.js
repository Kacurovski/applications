document.addEventListener("DOMContentLoaded", function () {
    const selectBrand = document.querySelector("#brand");
    const selectCategory = document.querySelector("#category");
    const categoryOptions = document.querySelectorAll(".category-option");

    const incrementButton = document.getElementById("button-increment");
    const decrementButton = document.getElementById("button-decrement");
    const quantityInput = document.getElementById("quantity");

    const sizeButtons = document.querySelectorAll("#sizes .btn-check");

    selectBrand.value && selectCategory.removeAttribute("disabled");

    selectBrand.addEventListener("change", (e) => {
        const selectedBrand = e.target.value;

        selectCategory.disabled = !selectedBrand;
        selectCategory.value = "";
        categoryOptions.forEach((option) => {
            const brandIds = option.dataset.brandIds.trim().split(/\s+/);

            if (brandIds.includes(selectedBrand)) {
                option.hidden = false;
            } else {
                option.hidden = true;
            }
        });
    });

    incrementButton.addEventListener("click", function () {
        quantityInput.value = parseInt(quantityInput.value, 10) + 1;
    });

    decrementButton.addEventListener("click", function () {
        if (parseInt(quantityInput.value, 10) > 1) {
            quantityInput.value = parseInt(quantityInput.value, 10) - 1;
        }
    });

    sizeButtons.forEach((sizeButton) => {
        sizeButton.addEventListener("change", (event) => {
            sizeButtons.forEach((btn) => {
                const label = document.querySelector(`label[for="${btn.id}"]`);
                label.classList.remove("btn-success");
                label.classList.add("bg-light");
            });
            if (event.target.checked) {
                const labelForChecked = document.querySelector(
                    `label[for="${event.target.id}"]`
                );
                labelForChecked.classList.remove("bg-light");
                labelForChecked.classList.add("btn-success");
            }
        });
    });
});
