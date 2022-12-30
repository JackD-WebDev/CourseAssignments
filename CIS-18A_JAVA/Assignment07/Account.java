package JackDaly_Assignment07b;

import java.math.BigDecimal;

public class Account {

    private String name;
    private BigDecimal balance;

    public Account(String name, BigDecimal balance) {
        this.name = name;

        if (balance.compareTo(BigDecimal.ZERO) > 0) {
            this.balance = balance;
        }
    }

    public void deposit(BigDecimal depositAmount) {
        if (depositAmount.compareTo(BigDecimal.ZERO) > 0) {
            balance = balance.add(depositAmount);
        }
    }

    public BigDecimal getBalance() {
        return balance;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getName() {
        return name;
    }
}
