import java.util.Scanner;
import java.util.Arrays;

public class JackDaly_Assignment05
{
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        System.out.print("How many numbers of the double type would you like to store in the array? ");

        int desiredLength = input.nextInt();
        double[] values = new double[desiredLength];

        int number = 1;
        double total = 0.0; int arrayLength = values.length;

        for (int i = 0; i < arrayLength; i++) {
            System.out.printf("Enter a value for #%d: ", number);
            values[i] = input.nextDouble();
            total += values[i];
            number++;
        }

        double maximum = maxValue(values),
            minimum = minValue(values),
            average = total / arrayLength,
            populationStandardDeviation = calcStandardDeviationForPopulation(arrayLength, average, values),
            sampleStandardDeviation = calcStandardDeviationForSample(arrayLength, average, values);

        System.out.println("Statistics for the array that you entered are:");
        System.out.println("-----------------------------------------------");

        System.out.printf("%33s%10.3f%n", "Minimum: ", minimum);
        System.out.printf("%33s%10.3f%n", "Maximum: ", maximum);
        System.out.printf("%33s%10.3f%n", "Average: ", average);
        System.out.printf("%33s%10.3f%n", "Standard deviation (population): ", populationStandardDeviation);
        System.out.printf("%33s%10.3f%n", "Standard deviation (sample): ", sampleStandardDeviation);
    }

    public static Double maxValue(double[] numbers) {
        Arrays.sort(numbers);
        return numbers[numbers.length - 1];
        }

    public static Double minValue(double[] numbers) {
        Arrays.sort(numbers);
        return numbers[0];
    }

    public static double calcStandardDeviationForPopulation(int l, double mean, double... numbers)
    {
        double standardDeviation = 0.0;

        for(double number : numbers) {
            standardDeviation += Math.pow(number - mean, 2);
        }

        return Math.sqrt(standardDeviation / (l - 1));
    }

    public static double calcStandardDeviationForSample(int l, double mean, double... numbers)
    {
        double standardDeviation = 0.0;

        for(double number : numbers) {
            standardDeviation += Math.pow(number - mean, 2);
        }

        return Math.sqrt(standardDeviation / l);
    }
}