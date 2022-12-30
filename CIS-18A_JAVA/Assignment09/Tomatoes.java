package JackDaly_Assignment09;

public class Tomatoes extends Crops {

    Crops cropWater = new Crops();
    int water = cropWater.getGallonsPerHour();

    Crops cropAdmix = new Crops();
    int admix = cropAdmix.getCurrentAdmixLevel();

    public void simulateTomatoes() {
        water -= 100;
        this.setGallonsPerHour(water);

        admix -= 25;
        this.setCurrentAdmixLevel(admix);

        this.maintainTomatoes(this.getGallonsPerHour(), this.getCurrentAdmixLevel());
    }

    private void maintainTomatoes(int water, int feed) {
        if (water < 1000) {
            this.giveWater(500, "tomato");
        }
        if (feed < 100) {
            this.feed(50, "tomato");
        }
    }
}
