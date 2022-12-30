// CIS-14A-48204
// Jack Daly 🥷
// CIS 14: Lab 13 - Inheritance
// Updated 12/16/22

let cars = [];

const fiatParams = {
	make: 'Fiat',
	model: '500',
	year: 1957,
	color: 'blue',
	passengers: 2,
	convertible: false,
	mileage: 88000
};

const cadiParams = {
	make: 'Cadillac',
	model: 'DeVille',
	year: 1955,
	color: 'tan',
	passengers: 5,
	convertible: false,
	mileage: 12892
};

const chevyParams = {
	make: 'Chevrolet',
	model: 'Malibu',
	year: 1964,
	color: 'red',
	passengers: 2,
	convertible: true,
	mileage: 90000
};

const toyotaParams = {
	make: 'Toyota',
	model: 'Corolla',
	year: 2014,
	color: 'black',
	passengers: 5,
	convertible: false,
	mileage: 17000
};

const fordParams = {
	make: 'Ford',
	model: 'Mustang',
	year: 1969,
	color: 'green',
	passengers: 2,
	convertible: true,
	mileage: 100000
};

const Car = function (params) {
	this.make = params.make;
	this.model = params.model;
	this.year = params.year;
	this.color = params.color;
	this.passengers = params.passengers;
	this.convertible = params.convertible;
	this.mileage = params.mileage;
	this.started = false;
	this.fuel = 0;
};

Car.prototype.start = function () {
	if (this.fuel > 0) {
		this.started = true;
		document.write(`<p>${this.make} ${this.model} started.</p>`);
	} else {
		document.write(
			`<p>The ${this.model} is on empty, fill up before starting!</p>`
		);
	}
};

Car.prototype.stop = function () {
	this.started = false;
	if (this.hatchback) {
		document.write(`<p>The ${this.hatchback} stopped.</p>`);
	} else if (this.coupe) {
		document.write(`<p>The ${this.coupe} stopped.</p>`);
	} else if (this.sedan) {
		document.write(`<p>The ${this.sedan} stopped.</p>`);
	} else if (this.muscle) {
		document.write(`<p>The ${this.muscle} car stopped.</p>`);
	} else {
		document.write('<p>The car stopped.</p>');
	}
};

Car.prototype.type = function (type) {
	return (this[type] = type);
};

Car.prototype.drive = function () {
	if (this.started) {
		if (this.fuel > 0) {
			document.write(`<p>${this.make} ${this.model} goes zoom zoom!</p>`);
			this.fuel--;
		} else {
			document.write('<p>Uh oh, out of fuel.</p>');
			this.stop();
		}
	} else {
		document.write('<p>You need to start the engine first.</p>');
	}
};

Car.prototype.addFuel = function (amount) {
	this.fuel = this.fuel + amount;
	document.write(`<p>Fuel added. Tank is now at ${this.fuel} gallons.</p>`);
};

const fiat = new Car(fiatParams);
fiat.type('hatchback');
cars.push(fiat);
const cadi = new Car(cadiParams);
cadi.type('sedan');
cars.push(cadi);
const chevy = new Car(chevyParams);
chevy.type('sedan');
cars.push(chevy);
const toyota = new Car(toyotaParams);
toyota.type('coupe');
cars.push(toyota);
const ford = new Car(fordParams);
ford.type('muscle');
cars.push(ford);

for (car in cars) {
	cars[car].drive();
	cars[car].start();
	cars[car].addFuel(2);
	cars[car].start();
	cars[car].drive();
	cars[car].drive();
	cars[car].drive();
}
