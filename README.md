# Simple-Expense-Tracker
A simple, minimalistic synchronized expense tracker

# Database Schema
```sql
CREATE TABLE users (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    create_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

```sql
CREATE TABLE expenses (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT NOT NULL,
    date        TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    amount      DECIMAL(10,2) NOT NULL,
    description VARCHAR(100) NOT NULL,
    type        ENUM(
                    'health',
                    'transport',
                    'clothing',
                    'service',
                    'food',
                    'maintainence',
                    'utilities',
                    'loan',
                    'fun',
                    'BS',
                    'inc',
                    'gfinc',
                    'debt',
                    'other'
                ) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```
