// CIS-14A-48204
// Jack Daly 🥷
// CIS 14: Lab 10 - Flying First Class
// Updated 12/03/22

// need an array of 4 or more passengers with name, paid status: true or false, and ticket type (firstclass, premium, and coach)
const passengers = JSON.parse(passengerList);

// need a function to process the passengers. Iterate over the length of the array and call the function on each passenger. If the passenger fails the test, they can't fly. (either they haven't paid or they are on the no fly list)
const processPassengers = (passengers, testFunction) => {
	for (passenger of passengers) {
		testFunction(passenger) ? false : true;
	}
};

// Put Dr. Evel on the No Fly List because he is Evil! Spelling and case must match the name that you put in the array. If you want to put me on the no fly list instead of Dr. Evel, go for it....
const checkNoFlyList = (passenger) => passenger.name === 'Dr. Evel';

// Check to see who hasn't paid... it will get that from the array.
const checkNotPaid = (passenger) => !passenger.paid;

// This will print out who has and has not paid using string concatenation into a var called message. If the passenger has paid then the message will read message + " has paid"
const printPassenger = (passenger) => {
	let message = passenger.name;
	passenger.paid ? (message += ' has paid') : (message += ' has not paid');
	console.log(message);
};

// plane can only fly if every passenger is on the fly list
let allCanFly = processPassengers(passengers, checkNoFlyList);
if (!allCanFly) {
	console.log(
		"The plane can't take off: we have a passenger on the no fly list."
	);
}

// plane can only fly if every passenger has paid
let allPaid = processPassengers(passengers, checkNotPaid);
if (!allPaid) {
	console.log("The plane can't take off: not everyone has paid.");
}

// we don't care about the result here; we're just using processPassengers to display the passenger list
processPassengers(passengers, printPassenger);

// first class gets a cocktail or wine, premium gets wine, cola, or water, and coach gets cola or water.
const createDrinkOrder = (passenger) => {
	let orderFunction;
	if (passenger.ticket === 'firstclass') {
		orderFunction = () => {
			alert('Would you like a cocktail or wine?');
		};
	} else if (passenger.ticket === 'premium') {
		orderFunction = () => {
			alert('Would you like wine, cola, or water?');
		};
	} else {
		orderFunction = () => {
			alert('Would you like cola or water?');
		};
	}
	return orderFunction;
};

// first class gets chicken or pasta, premium gets a snack box or cheese plate, and coach gets peanuts or pretzels.
const createDinnerOrder = (passenger) => {
	let orderFunction;
	if (passenger.ticket === 'firstclass') {
		orderFunction = () => {
			alert('Would you like chicken or pasta?');
		};
	} else if (passenger.ticket === 'premium') {
		orderFunction = () => {
			alert('Would you like a snack box or cheese plate?');
		};
	} else {
		orderFunction = () => {
			alert('Would you like peanuts or pretzels?');
		};
	}
	return orderFunction;
};

// alert window to pick up the trash
const pickupTrash = () => alert('Can I have your trash, please?');

// serve customer will serve drinks, get dinner order, and pick up trash.
const serveCustomer = (passenger) => {
	let getDrinkOrderFunction = createDrinkOrder(passenger);
	let getDinnerOrderFunction = createDinnerOrder(passenger);

	getDrinkOrderFunction();
	getDinnerOrderFunction();

	// These passengers get thirsty!
	getDrinkOrderFunction();
	getDrinkOrderFunction();
	getDrinkOrderFunction();

	pickupTrash();
};

// this will iterate over the customers, serving them one by one.
const servePassengers = (passengers) => {
	for (passenger of passengers) {
		serveCustomer(passenger);
	}
};

// of course we need to call servePassengers ( ) with passengers as a parameter below. I didn't include it, you have to write it.
servePassengers(passengers);
