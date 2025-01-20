<?php $this->load->view('includes/header'); ?>
<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Include jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<section class="single-banner">
    <div class="container">
        <h2>Generate Report Graph</h2>
    </div>
</section>
<div class="container mt-4">
    <form id="filterForm" class="row g-3" action="" method="post">
        <div class="col-md-6">
            <label for="testName" class="form-label">Test Name</label>
            <select class="form-control" name="test_name" id="testName">
                <option>Select Test</option>
                <?php if ($services) {
                    foreach ($services as $service) { ?>
                        <option value="<?= $service['service_name'] ?>" <?= $service['service_name'] == $product_name ? 'selected' : '' ?>>
                            <?= $service['service_name'] ?>
                        </option>
                    <?php }
                } ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="referenceRange" class="form-label">Reference Range</label>
            <input type="text" class="form-control" id="referenceRange" name="referenceRange"
                value="<?= isset($service['ref_range']) ? $service['ref_range'] : '' ?>" readonly>
        </div>
        <div id="testFieldsContainer" class="col-12">
            <div class="test-fields row g-3 mb-3">
                <div class="col-md-3">
                    <label for="appointmentDate" class="form-label">Appointment Date</label>
                    <input type="date" class="form-control" name="appointmentDate[]">
                </div>
                <div class="col-md-3">
                    <label for="result" class="form-label">Result</label>
                    <input type="number" class="form-control" name="result[]">
                </div>

            </div>
        </div>
        <div class="col-12">
            <button type="button" class="btn btn-success" id="addTest">Add </button>
            <button type="submit" class="btn btn-warning" id="filterButton">Filter</button>
            <button type="button" class="btn btn-secondary" id="downloadPdf">Download PDF</button>
        </div>
    </form>
    <canvas id="scaleStackingGraph" class="mt-4"></canvas>
</div>
<script>
    document.getElementById('addTest').addEventListener('click', function () {
        var container = document.getElementById('testFieldsContainer');
        var newTestFields = document.querySelector('.test-fields').cloneNode(true);
        newTestFields.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(newTestFields);
    });

    var ctx = document.getElementById('scaleStackingGraph').getContext('2d');
    var scaleStackingGraph = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: []
        },
        options: {
            scales: {
                x: {
                    stacked: false
                },
                y: {
                    stacked: false
                }
            }
        }
    });

    document.getElementById('filterForm').addEventListener('submit', function (event) {
        event.preventDefault();
        var testName = document.getElementById('testName').value;
        var appointmentDates = document.querySelectorAll('input[name="appointmentDate[]"]');
        var results = document.querySelectorAll('input[name="result[]"]');
        var referenceRanges = document.querySelectorAll('input[name="referenceRange"]');

        scaleStackingGraph.data.labels = Array.from(appointmentDates).map(input => input.value);
        scaleStackingGraph.data.datasets = [];
        var resultData = Array.from(results).map(input => input.value);

        scaleStackingGraph.data.datasets.push({
            label: testName,
            data: resultData,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            fill: false
        });
        scaleStackingGraph.update();
    });
    document.getElementById('downloadPdf').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();
        var testName = document.getElementById('testName').value;
        pdf.text(`Health Tracking Graph - ${testName}`, 10, 10);
        pdf.addImage(scaleStackingGraph.toBase64Image(), 'PNG', 10, 20, 180, 160);
        pdf.save("health_tracking_graph.pdf");
    });
    document.getElementById('filterButton').addEventListener('click', function () {
        document.getElementById('filterForm').submit();
    });
</script>
<script>
    // Store reference ranges in a JavaScript object
    var referenceRanges = {
        <?php foreach ($services as $service) { ?>
                    "<?= addslashes($service['service_name']) ?>": "<?= addslashes($service['ref_range']) ?>",
        <?php } ?>
    };

    // Add event listener to Test Name dropdown
    document.getElementById('testName').addEventListener('change', function () {
        var selectedTest = this.value;
        var referenceInput = document.getElementById('referenceRange');

        if (referenceRanges[selectedTest]) {
            referenceInput.value = referenceRanges[selectedTest]; // Set reference range
        } else {
            referenceInput.value = ''; // Clear if not found
        }
    });
</script>



<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>