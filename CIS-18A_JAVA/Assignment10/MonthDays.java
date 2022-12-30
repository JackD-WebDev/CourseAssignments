package JackDaly_Assignment10;

import java.util.Scanner;

public class MonthDays {

    Scanner input = new Scanner(System.in);

    private int Month;
    private int Day;

    public MonthDays(int Month) {
        this.Month = Month;
    }


    protected void setMonth(int Month) {
        try {
            if(Month >= 1 && Month <= 12) {
                this.Month = Month;
            } else {
                throw new IllegalArgumentException("Month must be a value between 1 and 12.");
            }
        } catch(IllegalArgumentException err) {
            err.printStackTrace();
            System.out.println();
            System.out.print("Please enter another value: ");
            Month = input.nextInt();

            if(Month < 1) {
                System.out.print("Number must be a positive integer. Please enter another number: ");
                Month = input.nextInt();
            } else if(Month > 12) {
                System.out.print("Please choose a number smaller than 13: ");
                Month = input.nextInt();
            }
            this.Month = Month;
        }
    }

    protected int getMonth() {
        return Month;
    }


    protected void setDay(int Day) {
        try {
            if(Day >= 1 && Day <= 31) {
                this.Day = Day;
            } else {
                throw new RuntimeException("Value for number of Days is invalid.");
            }
        } catch (RuntimeException err) {
            err.printStackTrace();
        }
    }

    protected int getDay() {
        return Day;
    }


    public int getNumberOfDays(int enteredMonth, int enteredYear) {
        setMonth(enteredMonth);
        Month = getMonth();

        int[] MonthsWith31Days = {1,3,5,7,8,10,12};
        int[] MonthsWith30Days = {4,6,9,11};

        if(Month == 2 && enteredYear % 100 == 0 && enteredYear % 400 == 0) {
            this.setDay(29);
        } else if(Month == 2 && enteredYear % 4 == 0) {
            this.setDay(29);
        } else if(Month == 2) {
            this.setDay(28);
        } else {
            for(int i : MonthsWith31Days) {
                if(i == Month) {
                    this.setDay(31);
                }
            }

            for(int i: MonthsWith30Days) {
                if(i == Month) {
                    this.setDay(30);
                }
            }
        }
        return this.getDay();
    }
}
