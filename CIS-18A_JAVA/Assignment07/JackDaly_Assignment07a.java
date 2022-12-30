public class JackDaly_Assignment07a
{
    public static void main(String[] args) {

        System.out.println("---Traffic Signal Timing Cycles---");
        for(TrafficSignal trafficSignal : TrafficSignal.values()) {
            System.out.printf("%-23s %d seconds%n", trafficSignal, trafficSignal.getCycle());
        }
    }

    public enum TrafficSignal {
        RED(75),
        GREEN(65),
        YELLOW(10),
        WALK(45),
        DONT_WALK(30);

        private final int cycle;

        TrafficSignal(int cycle) {
            this.cycle = cycle;
        }

        public int getCycle() {
            return cycle;
        }
    }
}