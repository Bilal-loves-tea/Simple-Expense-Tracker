const container = document.getElementById("expense-list");
const loader = document.getElementById("loading-animation");

const TYPE_LABELS = {
    health:       "Health/Care",
    transport:    "Transport",
    clothing:     "Clothing",
    service:      "Subscription/Service",
    food:         "Food",
    maintainence: "Maintenance/Repair",
    utilities:    "Daily Utilities",
    loan:         "Loan Given",
    fun:          "Entertainment",
    BS:           "Shopping",
    inc:          "Income",
    gfinc:        "Gift Received",
    debt:         "Debt Repayment",
    other:        "Other"
};

function loadExpenses() {
    loader.classList.add("hidden");   // hide the loader in every case, including empty
    container.innerHTML = ""; 
    fetch("get_expenses.php")
        .then(res => res.json())
        .then(expenses => {

            container.innerHTML = "";

            if (!Array.isArray(expenses)) {
                console.error(expenses.error || "Unexpected response");
                return;
            }

            // Header row
            const header = document.createElement("div");
            header.className = "expense-row expense-header";
            ["Date", "Description", "Type", "Amount", ""].forEach(text => {
                const cell = document.createElement("span");
                cell.textContent = text;
                header.appendChild(cell);
            });
            container.appendChild(header);

            // Empty state
            if (expenses.length === 0) {
                const empty = document.createElement("div");
                empty.className = "expense-empty";
                empty.textContent = "No expenses yet.";
                container.appendChild(empty);
                return;
            }

            // Data rows
            expenses.forEach(exp => {
                const row = document.createElement("div");
                row.className = "expense-row";

                const date = document.createElement("span");
                date.className = "expense-date";
                date.textContent = new Date(exp.date.replace(" ", "T")).toLocaleDateString();

                const description = document.createElement("span");
                description.textContent = exp.description;

                const type = document.createElement("span");
                type.className = "expense-type";
                //type.textContent = exp.type;
                type.textContent = TYPE_LABELS[exp.type] || exp.type;

                const amount = document.createElement("span");
                amount.className = "expense-amount";
                amount.textContent = Number(exp.amount).toFixed(2);

                const del = document.createElement("button");
                del.className = "edit-btn delete-btn";   // edit-btn keeps your existing styling
                del.dataset.id = exp.id;
                del.textContent = "Delete";

                row.append(date, description, type, amount, del);
                container.appendChild(row);
            });
        })
        .catch(err => {
            loader.classList.add("hidden");
            console.error(err);
        });
}

// One listener on the list handles every delete button (works for rows added later too)
container.addEventListener("click", async (e) => {
    const btn = e.target.closest(".delete-btn");
    if (!btn) return;

    if (!confirm("Delete this expense?")) return;

    btn.disabled = true;
    try {
        const res = await fetch("delete_expenses.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({ id: btn.dataset.id })
        });
        const data = await res.json();

        if (data.success) {
            btn.closest(".expense-row").remove();
        } else {
            alert(data.error || "Could not delete.");
            btn.disabled = false;
        }
    } catch (err) {
        console.error(err);
        btn.disabled = false;
    }
});