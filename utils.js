function shuffleArray(array) {
  let i = array.length - 1;
  while (i > 0) {
    const random = Math.floor(Math.random() * (i + 1));
    [array[i], array[random]] = [array[random], array[i]];
    i--;
  }
}

function replaceHTMLSymbols(text) {
  const entityMap = {
    "&quot;": '"',
    "&amp;": "&",
    "&#039;": "'",
  };

  const entityRegex = /&quot;|&amp;|&#039;/g;

  return text.replace(entityRegex, (match) => entityMap[match]);
}

function sortQuestionsByDifficulty(data) {
  const difficulties = {
    easy: 0,
    medium: 1,
    hard: 2,
  };

  return data.sort((a, b) => {
    return difficulties[a.difficulty] - difficulties[b.difficulty];
  });
}

export { shuffleArray, replaceHTMLSymbols, sortQuestionsByDifficulty };
