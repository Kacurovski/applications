const addContainer = $(".add-note-container");
const noteForm = $("#add-note-form");

noteForm.submit(async function (e) {
  e.preventDefault();

  const userId = validateNoteEmpty(noteForm.find("[name='user_id']"));
  const bookId = validateNoteEmpty(noteForm.find("[name='book_id']"));
  const noteText = validateNoteEmpty(noteForm.find("[name='add_note_text']"));

  if (userId && bookId && noteText) {
    try {
      const response = await $.ajax({
        url: "/book_app/api/add_note",
        type: "POST",
        data: {
          bookId: bookId,
          userId: userId,
          noteText: noteText,
        },
        dataType: "json",
      });

      if (response.status === "success") {
        const noteId = response.note_id;
        await createNote(userId, noteText, noteId);
        addContainer.toggleClass("d-none");
      } else {
        console.error("Error in response:", response);
      }
    } catch (error) {
      console.error("Error updating note", error);
    }
  }
});

async function createNote(user, text, noteId) {
  const notesContainer = document.querySelector("#created-notes-container");

  const newNoteElement = document.createElement("div");
  newNoteElement.className = "border p-2 rounded shadow-sm mb-3";

  const slicedText = sliceNote(text);

  newNoteElement.innerHTML = `
      <form class="d-flex flex-column private-notes-form" method="POST">
        <span class="loading d-none mb-1">Loading...</span>        
        <p class="h6 mb-3 note break-word">${slicedText}</p>
        <textarea name="note_text" class="mb-2 d-none" value="${text}">${text}</textarea>
        <input type="hidden" name="user_id" value="${user}">
        <input type="hidden" name="note_id" value="${noteId}">
        <input type="hidden" name="action" value="">
        <div class="d-flex">
          <button type="submit" value="delete" class="btn-sm btn-outline-danger p-1 me-1 px-3 border-0">Delete</button>
          <button type="button" value="edit" class="btn-sm btn-outline-success p-1 me-1 px-3 border-0" data-state="Edit" onclick="editNoteMode(event)">Edit</button>
          <button type="button" class="btn-sm btn-outline-primary p-1 me-1 px-3 border-0" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="viewNoteDescription(event)">View</button>  
          </div>
      </form>
    `;
  notesContainer.appendChild(newNoteElement);
  updateListener(newNoteElement.querySelector("form"));
}

function updateListener(form) {
  form.addEventListener("submit", (e) => {
    e.preventDefault();

    let loading = form.querySelector(".loading");
    loading.classList.toggle("d-none");
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
}

function sliceNote(note) {
  return note.length > 50 ? note.slice(0, 50) + "..." : note;
}

function addPrivateNote() {
  addContainer.toggleClass("d-none");
}

function validateNoteEmpty(input) {
  const value = input.val();

  if (value) {
    return value;
  } else {
    switch (input.attr("name")) {
      case "user_id":
        alert("Error in submission, please reload");
        break;

      case "book_id":
        alert("Error in submission, please reload page");
        break;

      case "add_note_text":
        alert("Note can't be empty");
        break;

      default:
        alert("Something went wrong, please reload the page");
        break;
    }
    return false;
  }
}
