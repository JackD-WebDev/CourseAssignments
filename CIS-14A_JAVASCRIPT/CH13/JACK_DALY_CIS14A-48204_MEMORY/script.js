// CIS-14A-48204
// Jack Daly 🥷
// CIS 14: Memory Game Lab 🃏
// Updated: 12/15/2022

let lives = 4;
let match = 0;
let reset = false;

window.onload = () => {
	const grid = document.getElementById('game');
	for (let i = 0; i < 4; i++) {
		for (let j = 0; j < 3; j++) {
			grid.innerHTML += `<div class="tile"></div>`;
		}
	}

	let seq = '001122334455';
	let shuffle = '';
	const filenames = ['zero', 'one', 'two', 'three', 'four', 'five'];
	while (seq.length) {
		let random = Math.floor(Math.random() * seq.length);
		shuffle += seq.charAt(random);
		seq = seq.substring(0, random) + seq.substring(random + 1);
	}

	const tiles = document.querySelectorAll('.tile');
	if (tiles.length === 12) {
		for (tile in tiles) {
			tiles[tile].onclick = showAnswer;
			tiles[tile].innerHTML = `<img src="images/${
				filenames[shuffle.charAt(tile)]
			}.jpg" alt="card" />`;
		}
	}
};

showEndgame = () => {
	if (document.getElementById('endgame')) {
		const endgame = document.getElementById('endgame');
	}
	endgame.style.opacity = 1;
	endgame.style.margin = 'auto';
	endgame.style.top = '50%';
	endgame.style.left = '50%';
	endgame.style.width = '50%';
	endgame.style.visibility = 'visible';
	endgame.style.transform = 'translate(-50%, -50%)';
	endgame.style.webkitTextStroke = '2px black';
	endgame.style.textShadow = '2px 2px 3px black';
};

const winCondition = () => {
	showEndgame();
	endgame.innerHTML = '<h3>YOU WIN!</h3>';
	endgame.style.webkitTextFillColor = 'blue';
	endgame.style.color = 'blue';
};

const loseCondition = () => {
	showEndgame();
	endgame.innerHTML = '<h3>YOU LOSE!</h3>';
	endgame.style.color = 'red';
	endgame.style.webkitTextFillColor = 'red';
	endgame.style.fontWeight = 'bold';
};

const showAnswer = (eventObj) => {
	let tile = eventObj.target;
	if (tile.classList.contains('selected')) {
		return;
	}
	tile.classList.add('selected');
	let selected = document.querySelectorAll('.selected');
	if (selected.length === 2) {
		if (selected[0].attributes.src.value === selected[1].attributes.src.value) {
			match++;
			selected[0].classList.add('matched');
			selected[1].classList.add('matched');
			setTimeout(() => {
				selected[0].parentElement.classList.add('hidden');
				selected[1].parentElement.classList.add('hidden');
			}, 1000);
			selected[0].classList.remove('selected');
			selected[1].classList.remove('selected');
			if (match === 6) {
				winCondition();
				setTimeout(() => {
					location.reload();
				}, 5000);
			}
		} else {
			lives--;
			if (lives === 0) {
				loseCondition();
				setTimeout(() => {
					location.reload();
				}, 5000);
			} else {
				setTimeout(() => {
					selected[0].classList.remove('selected');
					selected[1].classList.remove('selected');
				}, 1000);
			}
		}
	}
};
