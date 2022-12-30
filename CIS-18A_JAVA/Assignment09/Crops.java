package JackDaly_Assignment09;

public class Crops implements FeedAndWater{

    int gallonsPerHour;
    int currentAdmixLevel;

    public void giveWater(int gallons, String asset) {
        this.gallonsPerHour += gallons;
        System.out.printf("Diverting %d gallons of water to %s irrigation.%n%n", gallons, asset);
    }

    public void feed(int pounds, String asset) {
        this.currentAdmixLevel += pounds;
        System.out.printf("Adding %d pounds of nutrient admix to %s irrigation line.%n%n", pounds, asset);
    }

    public void setGallonsPerHour(int gallons) {
        this.gallonsPerHour += gallons;
    }

    public void setCurrentAdmixLevel(int pounds) {
        this.currentAdmixLevel += pounds;
    }

    public int getGallonsPerHour() {
        return this.gallonsPerHour;
    }

    public int getCurrentAdmixLevel() {
        return this.currentAdmixLevel;
    }
}
