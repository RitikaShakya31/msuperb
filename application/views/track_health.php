<?php $this->load->view('includes/header'); ?>
<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container">
    <form id="filterForm" class="row g-3">
        <div class="col-md-3">
            <label for="testName" class="form-label">Test Name</label>
            <input type="text" class="form-control" id="testName" name="testName">
        </div>
        <div class="col-md-3">
            <label for="appointmentDate" class="form-label">Appointment Date</label>
            <input type="date" class="form-control" id="appointmentDate" name="appointmentDate">
        </div>
        <div class="col-md-3">
            <label for="referenceRange" class="form-label">Reference Range</label>
            <input type="text" class="form-control" id="referenceRange" name="referenceRange">
        </div>
        <div class="col-md-3">
            <label for="result" class="form-label">Result</label>
            <input type="number" class="form-control" id="result" name="result">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <canvas id="scaleStackingGraph" class="mt-4"></canvas>
</div>

<script>
    var ctx = document.getElementById('scaleStackingGraph').getContext('2d');
    var scaleStackingGraph = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Results',
                data: [],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true
                }
            }
        }
    });

    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var testName = document.getElementById('testName').value;
        var appointmentDate = document.getElementById('appointmentDate').value;
        var referenceRange = document.getElementById('referenceRange').value;
        var result = document.getElementById('result').value;

        // Update the graph with the new data
        scaleStackingGraph.data.labels.push(appointmentDate);
        scaleStackingGraph.data.datasets[0].data.push(result);
        scaleStackingGraph.update();

        // Add your filtering logic here
        console.log('Test Name:', testName);
        console.log('Appointment Date:', appointmentDate);
        console.log('Reference Range:', referenceRange);
        console.log('Result:', result);
    });
</script>

<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
