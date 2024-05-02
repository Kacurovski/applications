let lastEditedForm = null;
let lastEditedParagraph = null;
let lastEditedTextArea = null;

function editNoteMode(e) {
  const form = e.currentTarget.closest("form");
  const noteDescription = form.querySelector(".note");
  const textArea = form.querySelector("textarea");
  const editButton = e.target;

  document.querySelectorAll('[data-state="Edit"]').forEach((button) => {
    if (button !== editButton) {
      updateButton(button, "Edit", "button", "edit");
      button.onclick = function (event) {
        editNoteMode(event);
      };
    }
  });

  if (lastEditedForm && lastEditedForm !== form) {
    lastEditedTextArea.classList.add("d-none");
    lastEditedParagraph.classList.remove("d-none");
  }

  if (editButton.getAttribute("data-state") === "Edit") {
    e.preventDefault();

    noteDescription.classList.add("d-none");
    textArea.classList.remove("d-none");
    updateButton(editButton, "Update", "submit", "update");
    editButton.onclick = null;
  }

  lastEditedForm = form;
  lastEditedParagraph = noteDescription;
  lastEditedTextArea = textArea;
}

function closeNoteMode(target) {
  if (!target) return;
  updateButton(target, "Edit", "button", "edit");
}

function viewNoteDescription(e) {
  const form = e.target.closest("form");
  const noteDescription = form.querySelector("textarea");
  const modalNoteDescription = document.querySelector(
    "#modal-note-description"
  );

  modalNoteDescription.textContent = noteDescription.value;
}
