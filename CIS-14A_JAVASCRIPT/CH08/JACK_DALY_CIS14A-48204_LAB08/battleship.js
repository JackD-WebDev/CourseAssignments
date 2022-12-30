// CIS-14A-48204
// Jack Daly 🥷
// CIS 14: Lab 8 - Battleship 2.0
// Updated 11/25/22

const model = {
	boardSize: 7,
	numShips: 3,
	shipLength: 3,
	shipsSunk: 0,
	ships: [
		{ locations: [0, 0, 0], hits: ['', '', ''] },
		{ locations: [0, 0, 0], hits: ['', '', ''] },
		{ locations: [0, 0, 0], hits: ['', '', ''] }
	],
	fire: function (guess) {
		for (let i = 0; i < this.numShips; i++) {
			let ship = this.ships[i];
			let index = ship.locations.indexOf(guess);

			if (ship.hits[index] === 'hit') {
				view.displayMessage('Oops, you already hit that location!');
				return true;
			} else if (index >= 0) {
				ship.hits[index] = 'hit';
				view.displayHit(guess);
				view.displayMessage('HIT!');
				if (this.isSunk(ship)) {
					view.displayMessage('You sank my battleship!');
					this.shipsSunk++;
				}
				return true;
			}
		}
		view.displayMiss(guess);
		view.displayMessage('You missed.');
		return false;
	},
	isSunk: function (ship) {
		for (let i = 0; i < this.shipLength; i++) {
			if (ship.hits[i] !== 'hit') {
				return false;
			}
		}
		return true;
	},
	generateShipLocations: function () {
		let locations;
		for (let i = 0; i < this.numShips; i++) {
			do {
				locations = this.generateShip();
			} while (this.collision(locations));
			this.ships[i].locations = locations;
		}
		// console.log('Ships array: ');
		// console.log(this.ships);
	},
	generateShip: function () {
		let direction = Math.floor(Math.random() * 2);
		let row, col;
		if (direction === 1) {
			row = Math.floor(Math.random() * this.boardSize);
			col = Math.floor(Math.random() * (this.boardSize - this.shipLength + 1));
		} else {
			row = Math.floor(Math.random() * (this.boardSize - this.shipLength + 1));
			col = Math.floor(Math.random() * this.boardSize);
		}
		let newShipLocations = [];
		for (let i = 0; i < this.shipLength; i++) {
			if (direction === 1) {
				newShipLocations.push(row + '' + (col + i));
			} else {
				newShipLocations.push(row + i + '' + col);
			}
		}
		return newShipLocations;
	},
	collision: function (locations) {
		for (let i = 0; i < this.numShips; i++) {
			let ship = this.ships[i];
			for (let l = 0; l < locations.length; l++) {
				if (ship.locations.indexOf(locations[l]) >= 0) {
					return true;
				}
			}
		}
		return false;
	}
};

const view = {
	displayMessage: (msg) => {
		const messageArea = document.getElementById('message-area');
		messageArea.innerHTML = msg;
	},
	displayHit: (location) => {
		const cell = document.getElementById(location);
		cell.setAttribute('class', 'hit');
	},
	displayMiss: (location) => {
		const cell = document.getElementById(location);
		cell.setAttribute('class', 'miss');
	}
};

const controller = {
	guesses: 0,
	processGuess: function (guess) {
		const location = parseGuess(guess);
		if (location) {
			this.guesses++;
			let hit = model.fire(location);
			if (hit && model.shipsSunk === model.numShips) {
				view.displayMessage(
					`You sank all my battleships, in ${this.guesses} turns!`
				);
			}
		}
	}
};

const parseGuess = (guess) => {
	const alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
	if (guess === null || guess.length !== 2) {
		alert('Oops, please enter a letter and a number on the board.');
	} else {
		const firstChar = guess.charAt(0);
		const row = alphabet.indexOf(firstChar);
		const column = guess.charAt(1);
		if (isNaN(row) || isNaN(column)) {
			alert("Oops, that isn't on the board.");
		} else if (
			row < 0 ||
			row >= model.boardSize ||
			column < 0 ||
			column >= model.boardSize
		) {
			alert("Oops, that's off the board!");
		} else {
			return row + column;
		}
	}
	return null;
};

const handleFireButton = () => {
	const guessInput = document.getElementById('guess-input');
	let guess = guessInput.value.toUpperCase();
	controller.processGuess(guess);
	guessInput.value = '';
};

const handleKeyPress = (e) => {
	const fireButton = document.getElementById('fire-button');
	e = e || window.event;
	if (e.keyCode === 13) {
		fireButton.click();
		return false;
	}
};
window.onload = init;

function init() {
	const fireButton = document.getElementById('fire-button');
	fireButton.onclick = handleFireButton;
	const guessInput = document.getElementById('guess-input');
	guessInput.onkeydown = handleKeyPress;
	model.generateShipLocations();
}
