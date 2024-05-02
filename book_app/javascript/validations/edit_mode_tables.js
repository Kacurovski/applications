document.addEventListener("DOMContentLoaded", function () {
  const editButtons = document.querySelectorAll(".edit-update-btn");
  let lastEditedElement = null;

  editButtons.forEach((editButton) => {
    editButton.addEventListener("click", (e) => {
      handleEditButtonClick(editButton, e);
    });
  });

  function handleEditButtonClick(editButton, event) {
    const tableRow = editButton.closest("tr");
    const tableTd = tableRow.querySelectorAll("td");

    lastEditedElement &&
      lastEditedElement !== editButton &&
      closeEditMode(lastEditedElement);

    if (editButton.textContent === "Edit") {
      event.preventDefault();
      tableTd.forEach((td) => {
        enterEditMode(td, editButton);
      });
    }

    lastEditedElement = editButton;
  }

  function enterEditMode(td, editButton) {
    editButton.textContent = "Update";
    editButton.classList.remove("btn-warning");
    editButton.classList.add("btn-success");

    toggleElementVisibility(td, true);
  }

  function closeEditMode(editButton) {
    if (!editButton) return;

    editButton.textContent = "Edit";
    editButton.classList.remove("btn-success");
    editButton.classList.add("btn-warning");

    const tableRow = editButton.closest("tr");
    const tableTd = tableRow.querySelectorAll("td");

    tableTd.forEach((td) => {
      toggleElementVisibility(td, false);
    });
  }

  function toggleElementVisibility(td, shouldHide) {
    const paragraphs = td.querySelectorAll("p");
    const inputs = td.querySelectorAll("input");
    const images = td.querySelectorAll("img");
    const selects = td.querySelectorAll("select");

    toggleElements(paragraphs, shouldHide);
    toggleElements(images, shouldHide);
    toggleElements(inputs, !shouldHide);
    toggleElements(selects, !shouldHide);
  }

  function toggleElements(elements, shouldHide) {
    elements.forEach((element) => {
      element.classList.toggle("d-none", shouldHide);
    });
  }
});
