import java.util.Scanner;

public class JackDaly_Assignment02
{
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        int indexA = 0;
        int indexB = 0;
        int indexC = 0;
        int indexD = 0;
        int minValue;
        int maxValue;

        System.out.print("Enter the first value: ");
        int firstValue = input.nextInt();

        System.out.print("Enter the second value: ");
        int secondValue = input.nextInt();

            if(firstValue >= secondValue) {
                indexA++;
            } else {
                indexB++;
            }

        System.out.print("Enter the third value: ");
        int thirdValue = input.nextInt();

            if(firstValue >= thirdValue) {
                indexA++;
            } else {
                indexC++;
            }

            if(secondValue >= thirdValue) {
                indexB++;
            } else {
                indexC++;
            }

        System.out.print("Enter the fourth value: ");
        int fourthValue = input.nextInt();

            if(firstValue >= fourthValue) {
                indexA++;
            } else {
                indexD++;
            }

            if(secondValue >= fourthValue) {
                indexB++;
            } else {
                indexD++;
            }

            if(thirdValue >= fourthValue) {
                indexC++;
            } else {
                indexD++;
            }

        if(indexA == 0) {
            minValue = firstValue;
        } else if(indexB == 0) {
            minValue = secondValue;
        } else if(indexC == 0) {
            minValue = thirdValue;
        } else {
            minValue = fourthValue;
        }

        if(indexA == 3) {
            maxValue = firstValue;
        } else if(indexB == 3) {
            maxValue = secondValue;
        } else if(indexC == 3) {
            maxValue = thirdValue;
        } else {
            maxValue = fourthValue;
        }

        // Value of indexD is not used implicitly, but I'm not sure how to this structure could work without it.

        System.out.printf(
                "The values entered %d, %d, %d and %d have a minimum value of %d and a maximum value of %d.",
                firstValue, secondValue, thirdValue, fourthValue, minValue, maxValue
        );
    }
}