function hideAllCards() {
  const bookCards = document.querySelectorAll(".book-card");

  bookCards.forEach(function (card) {
    card.style.display = "none";
  });
}

function updateButton(button, text, type, value) {
  button.innerText = text;
  button.type = type;
  button.value = value;
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

function validateInputs(form) {
  Array.from(form.elements).forEach((element) => {
    if (
      (element.tagName === "INPUT" ||
        element.tagName === "TEXTAREA" ||
        element.tagName === "SELECT") &&
      element.name
    ) {
      validateInput(element);
    }
  });
}

function validateInput(input) {
  input.addEventListener("input", () => {
    if (!input.value.trim()) {
      input.style.borderWidth = "2px";
      input.style.borderColor = "red";
    } else {
      input.style.borderWidth = "2px";
      input.style.borderColor = "green";
    }
  });
}

function sliceCardTitles() {
  const bookTitles = document.querySelectorAll(".card-title");

  bookTitles.forEach((title) => {
    let originalTitle = title.textContent;
    let slicedTitle =
      title.textContent.length > 20
        ? title.textContent.slice(0, 20) + "..."
        : title.textContent;
    title.textContent = slicedTitle;

    title.addEventListener("mouseover", (e) => {
      title.textContent = originalTitle;
    });

    title.addEventListener("mouseout", (e) => {
      title.textContent = slicedTitle;
    });
  });
}

sliceCardTitles();
function checkLength(input) {
  return input.length >= 20;
}

function addPrivateNote() {
  addContainer.toggleClass("d-none");
}
