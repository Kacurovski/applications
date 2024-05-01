class Calculator {
  constructor(budget) {
    this.budget = budget;
    this.expenses = [];
    this.updateBalance();
  }

  addExpense(expense) {
    this.expenses.push(expense);
    this.updateBalance();
  }

  deleteExpense(index) {
    this.expenses.splice(index, 1);
    this.updateBalance();
  }

  updateBalance() {
    const totalExpenses = this.expenses.reduce(
      (acc, expense) => acc + expense.amount,
      0
    );
    this.balance = this.budget - totalExpenses;
  }

  getBudget() {
    return this.budget;
  }

  getBalance() {
    return this.balance;
  }

  getTotalExpenseAmount() {
    return this.expenses.reduce((acc, expense) => acc + expense.amount, 0);
  }
}

export default Calculator;
