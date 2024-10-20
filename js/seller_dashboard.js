
var total_rev_p = document.getElementById("total_rev");
var total_sold_p = document.getElementById("total_sold");

async function fetch_data(){
    const response = await fetch('../db_api/db_statistics.php');
    return await response.json();
}

fetch_data().then(data=>{
    const labels = data.map(row => row.stat_date);
    const stat_qty = data.map(row => parseFloat(row.stat_qty));
    const stat_income = data.map(row => parseFloat(row.stat_income));

    const total_rev = Array.from(stat_qty).reduce((acc, val) => acc + val, 0);
    const total_sold = Array.from(stat_income).reduce((acc, val) => acc + val, 0);
    total_rev_p.innerText = "₱" + total_rev;
    total_sold_p.innerText = total_sold;

    const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Sales Over Time',
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
})
