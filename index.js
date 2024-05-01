const booksData = [
  {
    title: "The Hobbit",
    author: "J.R.R. Tolkien",
    max_pages: 200,
    on_page: 60,
  },
  {
    title: "Harry Potter",
    author: "J.K. Rowling",
    max_pages: 250,
    on_page: 150,
  },
  {
    title: "50 Shades of Grey",
    author: "E.L. James",
    max_pages: 150,
    on_page: 150,
  },
  {
    title: "Don Quixote",
    author: "Miquel de Cervantes",
    max_pages: 350,
    on_page: 300,
  },
  {
    title: "Hamlet",
    author: "William Shakespeare",
    max_pages: 550,
    on_page: 550,
  },
];

class Book {
  constructor(data) {
    Object.keys(data).forEach((key) => {
      this[key] = data[key];
    });
    this.progress = parseInt((this.on_page / this.max_pages) * 100);
  }
}

const books = booksData.map((bookData) => new Book(bookData));

function bookInfo(books) {
  const container = document.getElementById("container");
  container.innerHTML = "";

  const ulInfo = document.createElement("ul");
  const ulStatus = document.createElement("ul");

  books.forEach((book) => {
    const liInfo = document.createElement("li");
    liInfo.textContent = `${book.title} by ${book.author}`;
    ulInfo.appendChild(liInfo);
    const liStatus = document.createElement("li");

    const isRead = book.max_pages === book.on_page;

    liStatus.textContent = isRead
      ? `You have already read ${book.title} by ${book.author}`
      : `You still need to read ${book.title} by ${book.author}`;
    liStatus.classList.add(isRead ? "text-success" : "text-danger");

    ulStatus.appendChild(liStatus);
  });

  container.appendChild(ulInfo);
  container.appendChild(ulStatus);
}

function createTable(books) {
  const tableContainer = document.querySelector("#tableContainer");
  const table = document.createElement("table");
  table.classList.add("table", "table-bordered", "table-hover");

  const headerRow = document.createElement("tr");
  const tableHeadings = Object.keys(books[0]);

  tableHeadings.forEach((heading) => {
    const th = document.createElement("th");
    const formattedHeading = formatTableHeadings(heading);
    th.textContent = formattedHeading;
    headerRow.appendChild(th);
  });

  table.appendChild(headerRow);

  books.forEach((book) => {
    const row = document.createElement("tr");

    tableHeadings.forEach((key) => {
      const td = document.createElement("td");
      if (key === "progress") {
        const percentageProgress = Math.min(100, Math.max(0, book.progress));
        td.style.background = `linear-gradient(to right, green ${percentageProgress}%, grey ${percentageProgress}%)`;
        td.classList.add("text-light");
        td.textContent = `${percentageProgress}%`;
      } else {
        td.textContent = book[key];
      }
      row.appendChild(td);
    });

    table.appendChild(row);
  });

  tableContainer.appendChild(table);
}

function formatTableHeadings(headings) {
  return headings
    .replace(/_/g, " ")
    .replace(/\b\w/g, (char) => char.toUpperCase());
}

const form = document.getElementById("form");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const table = document.querySelector(".table");
  const data = {
    title: form.elements["title"].value,
    author: form.elements["author"].value,
    max_pages: form.elements["maxPages"].value,
    on_page: form.elements["onPage"].value,
    progress: parseInt(
      (form.elements["onPage"].value / form.elements["maxPages"].value) * 100
    ),
  };

  let message = document.querySelector("#message");
  message.classList.add("text-danger");

  if (Object.values(data).some((value) => value === "")) {
    message.textContent = "Please fill up all the fields";
  } else if (parseInt(data.on_page) > parseInt(data.max_pages)) {
    message.textContent = "Current page cannot be higher than max pages";
  } else {
    const newBook = new Book(data);
    books.push(newBook);

    const newTr = document.createElement("tr");

    Object.keys(newBook).forEach((key) => {
      const td = document.createElement("td");

      if (key === "progress") {
        const percentageProgress = Math.min(100, Math.max(0, data.progress));
        td.style.background = `linear-gradient(to right, green ${percentageProgress}%, grey ${percentageProgress}%)`;
        td.classList.add("text-light");
        td.textContent = `${percentageProgress}%`;
      } else {
        td.textContent = key === "progress" ? `${data[key]}%` : data[key];
      }

      newTr.appendChild(td);
    });

    table.appendChild(newTr);
    message.textContent = "Book successfully added";
    message.classList.remove("text-danger");
    message.classList.add("text-success");

    bookInfo(books);
  }
});

window.onload = () => {
  bookInfo(books);
  createTable(books);
};
