// CIS-14A-48204
// Jack Daly 🥷
// CIS 14: Lab 12 - The Car Constructor
// Updated 12/09/22

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
	(this.start = function () {
		if (this.fuel > 0) {
			this.started = true;
			document.write(`<p>${this.make} ${this.model} started.</p>`);
		} else {
			document.write(
				`<p>The ${this.model} is on empty, fill up before starting!</p>`
			);
		}
	}),
		(this.stop = function () {
			this.started = false;
			document.write(`<p>The ${this.model} stopped.</p>`);
		}),
		(this.drive = function () {
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
		}),
		(this.addFuel = function (amount) {
			this.fuel = this.fuel + amount;
			document.write(`<p>Fuel added. Tank is now at ${this.fuel} gallons.</p>`);
		});
};

cars.push(new Car(fiatParams));
cars.push(new Car(cadiParams));
cars.push(new Car(chevyParams));
cars.push(new Car(toyotaParams));
cars.push(new Car(fordParams));

for (car in cars) {
	cars[car].drive();
	cars[car].start();
	cars[car].addFuel(2);
	cars[car].start();
	cars[car].drive();
	cars[car].drive();
	cars[car].drive();
}
