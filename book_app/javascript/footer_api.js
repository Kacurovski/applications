const updateParagraphWithRandomQuote = async () => {
  try {
    const response = await fetch("http://api.quotable.io/random");
    if (!response.ok) {
      throw new Error("Failed to fetch quote");
    }
    const quoteData = await response.json();

    document.querySelector("#footerQuote").textContent = quoteData.content;
  } catch (error) {
    console.error("Error updating paragraph:", error);
  }
};

updateParagraphWithRandomQuote();
