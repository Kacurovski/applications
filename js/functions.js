function createExpenseTable() {
  const table = $("<table>")
    .addClass("table text-center h5 font-weight-normal")
    .attr("id", "expenses-table");
  const thead = $("<thead>").append(
    $("<tr>").append(
      $("<th>").attr("scope", "col").addClass("col-4").text("Expense Title"),
      $("<th>").attr("scope", "col").addClass("col-4").text("Expense Value"),
      $("<th>").attr("scope", "col").addClass("col-4")
    )
  );
  const tbody = $("<tbody>");

  table.append(thead, tbody);
  $(".table-holder").append(table);
}

function addExpenseRow(calculator, title, value) {
  const tr = $("<tr>").addClass("showRed");
  const tdExpenseTitle = $("<td>").text(`- ${title}`);
  const tdExpenseValue = $("<td>").text(`${value}`);
  const tdActions = $("<td>");
  const btnExpenseUpdate = $("<button>").html(
    '<i class="fa-solid fa-pen-to-square fa-lg"></i>'
  );
  const btnExpenseDelete = $("<button>").html(
    '<i class="fa-solid fa-trash fa-lg"></i>'
  );
  btnExpenseUpdate.addClass("edit-icon");
  btnExpenseUpdate.css("border", "none");
  btnExpenseDelete.addClass("delete-icon");
  btnExpenseDelete.css("border", "none");

  $(btnExpenseUpdate).click(function () {
    const editedTitle = tr
      .find("td:nth-child(1)")
      .text()
      .substring(2)
      .toLowerCase();
    const editedValue = tr.find("td:nth-child(2)").text();

    $("#expense-input").val(editedTitle);
    $("#amount-input").val(editedValue);

    calculator.deleteExpense(tr.index());
    tr.remove();
    updateDisplay(calculator);
  });

  $(btnExpenseDelete).click(function () {
    calculator.deleteExpense(tr.index());
    tr.remove();
    updateDisplay(calculator);
  });

  tdActions.append(btnExpenseUpdate, btnExpenseDelete);
  tr.append(tdExpenseTitle, tdExpenseValue, tdActions);
  $("#expenses-table tbody").append(tr);
}

function updateDisplay(calculator) {
  $("#balance").text(`$ ${calculator.getBalance()}`);
  $("#expense-amount").text(`${calculator.getTotalExpenseAmount()}`);

  if (calculator.expenses.length === 0) {
    $("#expenses-table").hide();
  } else {
    $("#expenses-table").show();
  }
}

export { createExpenseTable, addExpenseRow, updateDisplay };
