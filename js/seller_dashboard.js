var total_rev_p = document.getElementById("total_rev");
var total_sold_p = document.getElementById("total_sold");
let salesChart;

async function fetch_data(time_frame) {
    const response = await fetch(`../db_api/db_statistics.php?frame=${time_frame}`);
    return await response.json();
}

document.getElementById('statistics-filter').addEventListener('change', function() {
    get_stats(this.value);
});

function get_stats(frame) {
    fetch_data(frame).then(data => {
        if (salesChart) {
            salesChart.destroy(); // Destroy previous chart instance if it exists
        }

        let labels, stat_qty, stat_income;
        stat_qty = data.map(row => parseFloat(row.stat_qty));
        stat_income = data.map(row => parseFloat(row.stat_income));

        const total_rev = stat_qty.reduce((acc, val) => acc + val, 0);
        const total_sold = stat_income.reduce((acc, val) => acc + val, 0);
        total_rev_p.innerText = "₱" + total_rev;
        total_sold_p.innerText = total_sold;

        // Determine labels based on time frame
        switch (frame) {
            case "year":
                labels = [
                    "January", "February", "March", "April", 
                    "May", "June", "July", "August", 
                    "September", "October", "November", "December"
                ];
                break;

            case "month":
                labels = [
                    "Week 1", "Week 2", "Week 3", "Week 4", "Week 5"
                ];
                break;

            case "week":
                labels = [
                    "Monday", "Tuesday", "Wednesday", 
                    "Thursday", "Friday", "Saturday", "Sunday"
                ];
                break;
        }
        const ctx = document.getElementById('salesChart').getContext('2d');
        salesChart = new Chart(ctx, {
            type: 'line', 
            data: {
                labels: labels,
                datasets: [{
                    label: frame === 'year' ? 'Total Quantity Sold (Monthly)' : 
                           frame === 'month' ? 'Total Quantity Sold (Weekly)' : 
                           'Total Quantity Sold (Daily)',
                    data: stat_qty,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
}

// Initial chart display
get_stats('year'); // Default to "This Year"
