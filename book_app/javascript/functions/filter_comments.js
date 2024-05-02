document.addEventListener("DOMContentLoaded", function () {
    const showNonApprovedCheckbox = document.getElementById("show_non_approved_comments");
    const allCommentsDiv = document.getElementById("all_comments");
    const nonApprovedCommentsDiv = document.getElementById("non_approved_comments");
    const approvedCommentsDiv = document.getElementById("approved_comments");

    showNonApprovedCheckbox.addEventListener("change", function () {
      toggleVisibility(allCommentsDiv, !showNonApprovedCheckbox.checked);
      toggleVisibility(nonApprovedCommentsDiv, showNonApprovedCheckbox.checked);
      toggleVisibility(approvedCommentsDiv, false);
    });

    function toggleVisibility(element, isVisible) {
      element.classList.toggle("d-none", !isVisible);
    }
  });