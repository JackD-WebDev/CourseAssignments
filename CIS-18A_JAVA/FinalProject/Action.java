package JackDaly_FinalProject;

public enum Action {
    ATTACK(0),
    DEFEND(1),
    HEAL(2),
    SPECIAL(3);

    private final int act;

    Action(int act) {
        this.act = act;
    }

    public int getAct() {
        return act;
    }
}
