// Store quiz questions and correct answers
const questions = [
    {
        question: "Which of these is NOT a database management system (DBMS)?",
        options: ["MySQL", "PostgreSQL", "Oracle DB", "Node.js"],
        correctAnswer: "Node.js"
    },
    {
        question: "Which SQL clause is used to filter rows returned by a query?",
        options: ["SELECT", "WHERE", "GROUP BY", "HAVING"],
        correctAnswer: "WHERE"
    },
    {
        question: "Which of the following is NOT a programming language?",
        options: ["Python", "JavaScript", " HTML", "SQL"],
        correctAnswer: "HTML"
    },
    {
        question: "What does CSS stand for?",
        options: ["Creative Style Sheets", "Cascading Style Sheets", "Colorful Style Sheets", "Computer Style Sheets"],
        correctAnswer: "Cascading Style Sheets"
    },
    {
        question: "Which of the following HTTP methods is used to submit data to be processed to a server?",
        options: ["GET", "POST", "PUT", "DELETE"],
        correctAnswer: "POST"
    },
    {
        question: "Which one of the following is a back-end language?",
        options: ["HTML", "CSS", "JavaScript", "PHP"],
        correctAnswer: "PHP"
    },
    {
        question: "What is the main purpose of version control systems like Git?",
        options: ["To compile code", "To manage and track changes in source code", "To design UI/UX", "To debug code automatically"],
        correctAnswer: "To manage and track changes in source code"
    },
    {
        question: "What is the default port number for an HTTP server?",
        options: ["22", "80", "443", "8080"],
        correctAnswer: "80"
    },
    {
        question: "Which of the following is NOT a JavaScript framework?",
        options: ["React", "Angular", "Django", "Vue"],
        correctAnswer: "Django"
    },
    {
        question: "What is the purpose of the git commit command in Git?",
        options: ["To initialize a new repository", "To stage changes for commit", "To save staged changes to the repository with a message", "To push changes to a remote repository"],
        correctAnswer: "To save staged changes to the repository with a message"
    }
    // Add more questions if needed
];

let currentQuestionIndex = 0;
let score = 0;
let timer;
const timeLimit = 60; // 60 seconds for each question

// DOM Elements
const quizContainer = document.getElementById("quiz-container");
const questionContainer = document.getElementById("question-container");
const nextButton = document.getElementById("next-btn");
const timerElement = document.getElementById("timer");
const resultElement = document.getElementById("result");

// Load the current question
function loadQuestion() {
    if (currentQuestionIndex >= questions.length) {
        endQuiz();
        return;
    }

    const question = questions[currentQuestionIndex];
    document.querySelector("h1").textContent = `Question ${currentQuestionIndex + 1}`;
    questionContainer.innerHTML = `
        <p>${question.question}</p>
        <div class="options-container">
            ${question.options
                .map(
                    (option) => `
                <div class="option" data-answer="${option}">
                    ${option}
                </div>
            `
                )
                .join("")}
        </div>
    `;

    startTimer();
    attachOptionListeners();
}

// Start the timer
function startTimer() {
    let timeLeft = timeLimit;
    timerElement.textContent = `Time Left: ${timeLeft} seconds`;

    timer = setInterval(() => {
        timeLeft--;
        timerElement.textContent = `Time Left: ${timeLeft} seconds`;

        if (timeLeft <= 0) {
            clearInterval(timer);
            checkAnswer();
        }
    }, 1000);
}

// Attach click listeners to each option
function attachOptionListeners() {
    const options = document.querySelectorAll('.option');
    options.forEach(option => {
        option.addEventListener('click', () => {
            selectOption(option);
        });
    });
}

// Select an option
function selectOption(option) {
    const options = document.querySelectorAll('.option');
    options.forEach(o => o.classList.remove('selected')); // Remove previous selection
    option.classList.add('selected'); // Add selection class
}

// Check the user's answer
function checkAnswer() {
    clearInterval(timer);

    const selectedOption = document.querySelector('.option.selected');
    if (selectedOption && selectedOption.getAttribute('data-answer') === questions[currentQuestionIndex].correctAnswer) {
        score++;
    }

    currentQuestionIndex++;
    loadQuestion(); // Load the next question after checking the answer
}

// End the quiz
function endQuiz() {
    quizContainer.style.display = "none";

    // Store the result in sessionStorage to pass data to the next page
    sessionStorage.setItem('quiz_score', score);  // Store the score in sessionStorage for next page access

    // Update the server-side session using AJAX
    fetch('update_quiz_status.php', {
        method: 'POST',
        body: JSON.stringify({ score: score }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (score >= 7) {
            resultElement.textContent = "Congratulations! Proceed to the submission phase.";
            resultElement.style.display = "block";
            setTimeout(() => {
                window.location.href = "submission.php"; // Navigate to submission page
            }, 3000);
        } else {
            resultElement.textContent = "Thank you for participating.";
            resultElement.style.display = "block";
            setTimeout(() => {
                window.location.href = "thank_you.php"; // Navigate to Thank you page
            }, 3000);
        }
    })
    .catch(error => console.error('Error updating quiz status:', error));
}

// Next button event listener
nextButton.addEventListener("click", () => {
    checkAnswer();  // Check the answer before loading the next question
});

// Start the quiz
window.addEventListener('DOMContentLoaded', () => {
    loadQuestion();
});
