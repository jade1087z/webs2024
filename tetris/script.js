const gameBoard = document.getElementById("gameBoard");
const scoreElement = document.getElementById("score");

const ROWS = 20;
const COLS = 10;
const EMPTY_CELL = 0;

let gameGrid = Array.from({ length: ROWS }, () => Array(COLS).fill(EMPTY_CELL));

function drawGameBoard() {
  gameBoard.innerHTML = "";
  gameGrid.forEach((row) => {
    const rowElement = document.createElement("div");
    rowElement.classList.add("row");
    row.forEach((cell) => {
      const cellElement = document.createElement("div");
      cellElement.classList.add("cell", `cell-${cell}`);
      rowElement.appendChild(cellElement);
    });
    gameBoard.appendChild(rowElement);
  });
}

function updateScore(score) {
  scoreElement.textContent = `Score: ${score}`;
}

// Initialize game
let score = 0;
updateScore(score);
drawGameBoard();

// Your game logic here