package JackDaly_Assignment09;

public class Goats extends Livestock {

    Livestock livestockWater = new Livestock();
    int water = livestockWater.getCurrentWaterLevel();

    Livestock livestockFeed = new Livestock();
    int feed = livestockFeed.getCurrentFeedLevel();

    public void simulateGoats() {
        water -= 10;
        this.setCurrentWaterLevel(water);

        feed -= 25;
        this.setCurrentFeedLevel(feed);
    }

    public void maintainGoats(int water, int feed) {
        if (water < 100) {
            this.giveWater(50, "goat");
        }
        if (feed < 500) {
            this.feed(100, "goat");
        }
    }
}
