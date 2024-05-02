document.addEventListener("DOMContentLoaded", function () {
  const editForms = document.querySelectorAll(".edit-table-form");

  editForms.forEach((form) => {
    validateInputs(form);
    form.addEventListener("submit", (e) => {
      e.preventDefault();

      const formData = {};

      Array.from(form.elements).forEach((element) => {
        if (
          (element.tagName === "INPUT" ||
            element.tagName === "TEXTAREA" ||
            element.tagName === "SELECT") &&
          element.name
        ) {
          formData[element.name] = element.value;
        }
      });

      let errorsExist = false;

      Object.entries(formData).forEach(([key, value]) => {
        const inputElement = form.elements[`${key}`];
        const td = inputElement.closest("td");
        const div = inputElement.closest("div");
        let error;

        td
          ? (error = td.querySelector(".input-error"))
          : (error = div.querySelector(".input-error"));

        if (!value.trim()) {
          error.textContent = `This field can't be empty`;
          errorsExist = true;
        }

        if (value.trim()) {
          if (error) {
            console.log(value.length);
            if (key === "author_bio" && value.length <= 20) {
              error.textContent = `This field must have more than 20 characters`;
              errorsExist = true;
            } else {
              error.textContent = ``;
            }
          }
        }
      });

      if (errorsExist) {
        return;
      }
      form.submit();
    });
  });
});
