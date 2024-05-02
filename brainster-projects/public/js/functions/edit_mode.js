let lastEditedForm = null;
let lastEditedBox = null;

function editMode(event) {
    const holder = event.target.closest(".card-holder");
    const cardBox = holder.querySelector(".card-box");
    const form = holder.querySelector(".card-form");

    toggleVisibility(form, cardBox);

    if (lastEditedForm) {
        toggleVisibility(lastEditedForm, lastEditedBox);
        const closeButton = lastEditedForm.querySelector(".close-form");
        closeButton.removeEventListener("click", closeFormHandler);
    }

    lastEditedBox = cardBox;
    lastEditedForm = form;

    const closeButton = form.querySelector(".close-form");
    closeButton.addEventListener("click", closeFormHandler);
}

function closeFormHandler() {
    toggleVisibility(lastEditedForm, lastEditedBox);
    lastEditedForm = null;
    lastEditedBox = null;
}

function toggleVisibility(form, box) {
    form.classList.toggle("d-none");
    box.classList.toggle("d-none");
}
