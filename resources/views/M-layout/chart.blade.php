<!DOCTYPE html>
<html lang="en">
<head>
    <body> <!-- Set body background color and size -->
    <div class="container mt-100" style=" width: 100%; max-width: 2000px;"> <!-- Adjusted container size -->
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-6 mb-4"> <!-- Adjusted column width -->
                <div class="card" style="width: 100%; max-width: 400px; margin-left: 0;"> <!-- Increased card size and aligned left -->
                    <div class="card-header">
                        <h5>Sales Growth (Daily)</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart1" style="width: 100%; height: 200px;"></canvas> <!-- Adjusted chart size -->
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-6 mb-4"> <!-- Adjusted column width -->
                <div class="card" style="width: 100%; max-width: 400px; margin-right: 80px;"> <!-- Increased card size and aligned right -->
                    <div class="card-header">
                        <h5>Sales Growth (Weekly)</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart2" style="width: 100%; height: 200px;"></canvas> <!-- Adjusted chart size -->
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-12 mb-4"> <!-- Full-width column for the third card -->
                <div class="card" style="width: 100%; max-width: 1200px; margin: auto;"> <!-- Centered and larger card -->
                    <div class="card-header">
                        <h5>Sales Growth (Monthly)</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart3" style="width: 100%; height: 200px;"></canvas> <!-- Adjusted chart size -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js Script -->
    <script>
        const ctx1 = document.getElementById('salesChart1').getContext('2d');
        const salesChart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [{
                    label: 'Daily Sales',
                    data: [120, 150, 180, 200, 170, 220, 250],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 3,
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: { title: { display: true, text: 'Days' } },
                    y: { title: { display: true, text: 'Sales' }, beginAtZero: true }
                }
            }
        });

        const ctx2 = document.getElementById('salesChart2').getContext('2d');
        const salesChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Weekly Sales',
                    data: [500, 700, 800, 900],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 3,
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: { title: { display: true, text: 'Weeks' } },
                    y: { title: { display: true, text: 'Sales' }, beginAtZero: true }
                }
            }
        });

        const ctx3 = document.getElementById('salesChart3').getContext('2d');
        const salesChart3 = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Monthly Sales',
                    data: [2000, 2500, 3000, 3500, 4000, 4500, 5000],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 3,
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: { title: { display: true, text: 'Months' } },
                    y: { title: { display: true, text: 'Sales' }, beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>