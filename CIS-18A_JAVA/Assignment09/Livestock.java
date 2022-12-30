package JackDaly_Assignment09;

public class Livestock implements FeedAndWater {

    private int currentWaterLevel;
    private int currentFeedLevel;

    public void giveWater(int gallons, String asset) {
        this.currentWaterLevel += gallons;
        System.out.printf("Diverting %d gallons of water to %s pen filtration system.%n", gallons, asset);
    }

    public void feed(int pounds, String asset) {
        this.currentFeedLevel += pounds;
        System.out.printf("Releasing %d pounds of feed to %s feeding trough.%n", pounds, asset);
    }

    public void setCurrentWaterLevel(int gallons) {
        this.currentWaterLevel += gallons;
    }

    public void setCurrentFeedLevel(int pounds) {
        this.currentFeedLevel += pounds;
    }

    public int getCurrentWaterLevel() {
        return this.currentWaterLevel;
    }

    public int getCurrentFeedLevel() {
        return this.currentFeedLevel;
    }
}
