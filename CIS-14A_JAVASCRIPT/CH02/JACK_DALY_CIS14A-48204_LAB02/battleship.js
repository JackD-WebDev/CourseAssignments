// CIS-14A-48204
// Jack Daly 🥷 
// CIS 14: Lab 2 - Battleship
// Updated 09/26/22

let randomLoc = Math.floor(Math.random() * 4) + 1;
let guess;
let hits = 0;
let guesses = 0;
let isSunk = false;

while(isSunk == false) {
  const guess = prompt('Ready, aim, fire! (enter a number 0-6):');
  if(guess < 0 || guess > 6) {
    alert('Please enter a valid cell number!');
  } else {
    guesses = guesses + 1;
    if(guess == randomLoc || guess == randomLoc + 1 || guess == randomLoc + 2) {
      alert('HIT!');
      hits = hits + 1;
      if(hits == 3) {
        isSunk = true;
        alert('You sank my battleship!');
      }
    } else {
      alert('MISS');
    }
  }
}
let stats = 'You took ' + guesses + ' guesses to sink the battleship, ' + 'which means your shooting accuracy was ' + ((3/guesses)*100) + '%';
alert(stats);