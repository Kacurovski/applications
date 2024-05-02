const notesForms = document.querySelectorAll(".private-notes-form");

if (notesForms.length > 0) {
  notesForms.forEach((form) => {
    form.addEventListener("submit", async (e) => {
      e.preventDefault();

      let loading = form.querySelector(".loading");
      loading.classList.remove("d-none");
      clickedButton = e.submitter;

      const formData = {
        form,
        userId: form.elements["user_id"].value,
        noteId: form.elements["note_id"].value,
        noteText: form.elements["note_text"].value,
        action: (form.elements["action"].value = clickedButton.value),
        button: clickedButton,
        loading,
      };

      handleNote(formData);
    });
  });
}

async function handleNote(data) {
  try {
    const result = await $.ajax({
      url: "/book_app/api/handle_note",
      method: "POST",
      dataType: "json",
      data: {
        noteId: data.noteId,
        userId: data.userId,
        noteText: data.noteText,
        action: data.action,
      },
    });

    if (result.status === "success") {
      switch (data.button.value) {
        case "update":
          const noteDescription = data.form.querySelector(".note");
          const textArea = data.form.querySelector("textarea");

          noteDescription.innerText = data.noteText;
          noteDescription.classList.remove("d-none");
          textArea.classList.add("d-none");

          if (data.loading) {
            data.loading.classList.add("d-none");
          }

          data.button.onclick = function (event) {
            editNoteMode(event);
          };

          updateButton(data.button, "Edit", "button", "edit");
          break;

        case "delete":
          data.form.parentElement.remove();
          break;

        default:
          editNoteMode(data.button);
          return;
      }
    }
  } catch (error) {
    if (data.loading) {
      data.loading.classList.add("d-none");
    }
    console.error("Error updating note", error);
  }
}
