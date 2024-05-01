import * as UI from "./interfaces.js";
import { getQuestions, loadQuestion } from "./api.js";

function startQuiz() {
  if (
    UI.startBtn.innerText === "Start Over" ||
    UI.startBtn.innerText === "Try Again"
  ) {
    localStorage.clear();
    window.location.replace(window.location.pathname + window.location.search);
    return;
  }

  UI.loadingContainer.classList.remove("d-none");
  UI.welcomeContainer.classList.add("d-none");

  // window.location.hash = `question-`;

  getQuestions().then(() => {
    loadQuestion(0);

    UI.loadingContainer.classList.add("d-none");
    UI.welcomeContainer.classList.remove("d-none");
    UI.questionContainer.classList.remove("d-none");
    UI.questionTrackerContainer.classList.remove("d-none");
    UI.heading.innerText = "Good Luck!";
    UI.info.innerText = "Click on the button to start over";
    UI.startBtn.innerText = "Start Over";
    UI.startBtn.classList.add("bg-primary");
  });
}

UI.startBtn.addEventListener("click", startQuiz);
