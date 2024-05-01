import * as UI from "./interfaces.js";
import {
  shuffleArray,
  replaceHTMLSymbols,
  sortQuestionsByDifficulty,
} from "./utils.js";

let questionsData = [];
let questionCounter = 0;
let correctAnswers = 0;

async function getQuestions() {
  try {
    const response = await fetch("https://opentdb.com/api.php?amount=20");
    if (!response.ok) {
      throw new Error("Failed to fetch questions");
    }
    const data = await response.json();

    if (data.results) {
      questionsData = sortQuestionsByDifficulty(data.results);
    } else {
      console.error("API response is missing 'results' property");
    }
  } catch (error) {
    throw error;
  }
}

function loadQuestion(questionNumber) {
  UI.questionAnswers.innerHTML = "";
  let question = questionsData[questionNumber];
  const allAnswers = [...question.incorrect_answers, question.correct_answer];

  shuffleArray(allAnswers);

  UI.questionText.innerText = replaceHTMLSymbols(question.question);
  UI.questionCategory.innerText = question.category;
  UI.questionTracker.innerText = `Completed ${questionCounter} / ${questionsData.length}`;
  console.log(question.correct_answer);

  UI.questionText.classList.toggle("animate__animated");
  UI.questionText.classList.toggle("animate__backInDown");

  allAnswers.forEach((answer, index) => {
    const answerButton = document.createElement("button");

    answerButton.textContent = replaceHTMLSymbols(answer);
    answerButton.className =
      "btn btn-outline-secondary me-5 fs-5 animate__animated animate__lightSpeedInRight";
    answerButton.addEventListener("click", () => {
      UI.questionText.classList.toggle("animate__animated");
      UI.questionText.classList.toggle("animate__backInDown");
      checkAnswer(index, question.correct_answer);
    });

    UI.questionAnswers.appendChild(answerButton);
  });
}

function checkAnswer(selectedIndex, correctAnswer) {
  const selectedAnswer = UI.questionAnswers.children[selectedIndex].textContent;

  selectedAnswer === correctAnswer && correctAnswers++;

  questionCounter++;

  if (questionCounter < questionsData.length) {
    window.location.hash = `#question-${questionCounter}`;

    UI.questionTracker.innerText = `Completed ${questionCounter} / ${questionsData.length}`;
  } else {
    UI.questionTracker.innerText = `You got ${correctAnswers} out of ${questionsData.length} correct.`;
    UI.heading.innerText = "Let's see your Score";
    UI.info.innerText = "Click on the button to start again.";
    UI.startBtn.innerText = "Try Again";
    UI.startBtn.classList.add("bg-info");
    UI.questionContainer.style.display = "none";
    UI.questionTrackerContainer.style.display = "block";

    if (correctAnswers == questionsData.length) {
      UI.questionTracker.innerText = `CONGRATULATIONS YOU ARE A MILLIONAIRE. You got ${correctAnswers} out of ${questionsData.length} correct.`;
      UI.questionTracker.className = "fw-bold text-success";
    }

    localStorage.setItem("quizScore", correctAnswers);
  }
}

window.addEventListener("hashchange", () => {
  const hash = window.location.hash;
  if (hash.startsWith("#question-")) {
    const questionNumber = parseInt(hash.substring(10));
    loadQuestion(questionNumber);
  }
});

export {
  questionsData,
  questionCounter,
  correctAnswers,
  getQuestions,
  loadQuestion,
  checkAnswer,
};
