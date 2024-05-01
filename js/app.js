import Calculator from "./classes/Calculator.js";
import {
  createExpenseTable,
  addExpenseRow,
  updateDisplay,
} from "./functions.js";

$(document).ready(function () {
  const calculator = new Calculator(0);
  let tableCreated = false;

  $("#budget-form").submit(function (e) {
    e.preventDefault();
    let budget = parseFloat($("#budget-input").val()) || 0;

    if (budget == "" || budget < 0) {
      $(".budget-feedback").text("Value cannot be empty or negative").show();
      return;
    }

    $(".budget-feedback").hide();

    calculator.budget = budget;
    calculator.updateBalance();
    $("#budget").text(`$ ${calculator.getBudget()}`);
    $("#balance").text(`$ ${calculator.getBalance()}`);

    $("#budget-input").val("");
  });

  $("#expense-form").submit(function (e) {
    e.preventDefault();

    let expenseTitle = $("#expense-input").val().trim().toUpperCase();
    let expenseValue = parseFloat($("#amount-input").val());

    if (expenseTitle == "" || expenseValue < 0 || isNaN(expenseValue)) {
      $(".expense-feedback")
        .text(
          "Expense title cannot be empty, and expense value must not be empty or negative number"
        )
        .show();
      return;
    }

    $(".expense-feedback").hide();

    if (!tableCreated) {
      createExpenseTable();
      tableCreated = true;
    }

    let existingExpenseIndex = calculator.expenses.findIndex(
      (expense) => expense.title === expenseTitle
    );

    if (existingExpenseIndex !== -1) {
      $(".expense-feedback")
        .text("Expense with the same title already exists")
        .show();
      return;
    }

    calculator.addExpense({ title: expenseTitle, amount: expenseValue });
    addExpenseRow(calculator, expenseTitle, expenseValue);

    calculator.updateBalance();
    updateDisplay(calculator);

    $("#expense-input").val("");
    $("#amount-input").val("");
  });

  $("#budget-input").focus(function (e) {
    $(".budget-feedback").hide();
  });

  $("#expense-input").focus(function (e) {
    $(".expense-feedback").hide();
  });
});
