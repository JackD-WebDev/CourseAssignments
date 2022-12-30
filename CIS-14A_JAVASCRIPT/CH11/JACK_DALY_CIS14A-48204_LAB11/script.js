// CIS-14A-48204
// Jack Daly 🥷
// CIS 14: Lab 11 - Click Me! Button Counter with Closure
// Updated 12/06/22

window.onload = () => {
	let count = 0;
	let message = 'You clicked me';
	const div = document.getElementById('message');
	const button = document.getElementById('clickme');
	button.onclick = () => {
		count++;
		div.innerHTML = `${message} ${count} times!`;
	};
};
