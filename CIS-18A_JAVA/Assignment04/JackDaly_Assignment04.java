import java.util.Scanner;

public class JackDaly_Assignment04
{
    public static void main(String[] args) {

        Scanner input = new Scanner(System.in);
        System.out.print("Enter the largest number to try to display: ");
        int enteredNumber = input.nextInt();

        if(enteredNumber < 1) {
            System.out.print("Number must be a positive integer. Please enter another number: ");
            enteredNumber = input.nextInt();
        }

        if(enteredNumber > 100000) {
            System.out.print("Please choose a number smaller than 100000: ");
            enteredNumber = input.nextInt();
        }

        int counter = 1;
        while(counter <= enteredNumber / 2) {
            String result = isPerfect(counter);
            int factorCheck = 1;
            if(result != null) {
                System.out.println(counter + isPerfect(counter));
                System.out.print("     Factors: ");

                while(factorCheck <= counter / 2) {
                    if(counter % factorCheck == 0) {
                        System.out.print(" " + factorCheck);
                    }
                    factorCheck++;
                }
                System.out.printf("%n");
            }
            counter++;
        }
    }

    public static String isPerfect(int number) {

        int iterator = 1;
        int sumOfFactors = 0;

        while(iterator <= (number / 2)) {
            if(number % iterator == 0) {
                sumOfFactors = sumOfFactors + iterator;
            }
            iterator++;
        }

        if(sumOfFactors == number) {
            return " is perfect!";
        } else {
            return null;
        }
    }
}