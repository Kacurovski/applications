document.addEventListener("DOMContentLoaded", function () {
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  const bookCards = document.querySelectorAll(".book-card");
  const bookTitleInput = document.getElementById("book_title_input");

  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
      updateCardVisibility();
    });
  });

  bookTitleInput.addEventListener("input", function () {
    updateCardVisibility();
  });

  function updateCardVisibility() {
    const checkedCheckboxes = Array.from(checkboxes).filter((cb) => cb.checked);
    const searchTerm = bookTitleInput.value.toLowerCase();

    bookCards.forEach(function (card) {
      const cardId = card.id.trim();
      const title = card.querySelector("[data-searchable]");

      if (title) {
        const searchableValue = title
          .getAttribute("data-searchable")
          .toLowerCase();

        const isCheckboxMatch =
          checkedCheckboxes.length === 0 ||
          checkedCheckboxes.some((cb) => cb.value === cardId);

        const isTitleMatch = searchableValue.includes(searchTerm);

        if (isCheckboxMatch && isTitleMatch) {
          card.style.display = "block";
        } else {
          card.style.display = "none";
        }
      } else {
        console.error("Value not found");
      }
    });
  }
});