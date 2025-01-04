<?php $this->load->view('admin/template/header', $title); ?>
<style>
    .dots-menu {
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
        display: inline-block;
        user-select: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: -111px;
        top: 10px;
        background-color: #f9f9f9;
        min-width: 130px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 10px 15px;
        text-decoration: none;
        display: block;
        font-size: 12px;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 ">
                            <?= $title ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 8%">S.n.</th>
                                        <th style="width: 20%">Patient Name</th>
                                        <th style="width: 12%">Test </th>
                                        <th style="width: 15%">Appointment Date</th>
                                        <th style="width: 15%">Appointment Time</th>
                                        <th style="width: 20%">Patient Address</th>
                                        <th style="width: 10%">Select Lab</th>
                                        <th style="width: 10%">Visit Status</th>
                                        <th style="width: 15%">More Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($all_appointments) {
                                        $i = 0;
                                        foreach ($all_appointments as $index => $all) {
                                            $id = encryptId($all['id']);
                                            ?>
                                            <tr>
                                                <td> <?= ++$i; ?></td>
                                                <td><?= htmlspecialchars($all['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <?php
                                                    if (!empty($productName[$index]) && is_array($productName[$index])) {
                                                        echo htmlspecialchars($productName[$index]['service_name'], ENT_QUOTES, 'UTF-8');
                                                    } else {
                                                        echo "Test not found";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $all['appointment_date']; ?></td>
                                                <td><?= $all['appointment_time']; ?> </td>
                                                <td><?= $all['address']; ?></td>
                                                <td>
                                                    <?php if ($all['sub_category_id']) {
                                                        $labName = $this->CommonModel->getSingleRowById('sub_category', ['sub_category_id' => $all['sub_category_id']]);
                                                        ?>
                                                        <p class="badge badge-pill badge-soft-success font-size-15 filter-status">
                                                            <?= $labName['sub_category_name'] ?>
                                                        </p>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                                            data-bs-target="#itemDetails<?= $i ?>">
                                                            View
                                                        </button>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="modal fade bs-example-modal-lg" id="itemDetails<?= $i ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background: #eff2f7;">
                                                                    <h5 class="modal-title" id="myLargeModalLabel">
                                                                        <?= $all['order_id'] ?>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="input-group">
                                                                                <span class="input-group-text"><i
                                                                                        class="fa fa-search"></i></span>
                                                                                <input type="text" id="searchBox<?= $i ?>"
                                                                                    class="form-control" placeholder="Search..."
                                                                                    value="<?= htmlspecialchars($all['address'], ENT_QUOTES, 'UTF-8'); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3" id="searchResults<?= $i ?>"></div>
                                                                    <div class="row mt-3" id="labResults<?= $i ?>">
                                                                        <?php foreach ($all_labs as $lab) { ?>
                                                                            <div class="col-lg-12">
                                                                                <div class="card mb-3">
                                                                                    <div
                                                                                        class="card-body d-flex justify-content-between align-items-center">
                                                                                        <div>
                                                                                            <h5 class="card-title">
                                                                                                <?= htmlspecialchars($lab['sub_category_name'], ENT_QUOTES, 'UTF-8'); ?>
                                                                                            </h5>
                                                                                            <p class="card-text">
                                                                                                <?= htmlspecialchars($lab['lab_location'], ENT_QUOTES, 'UTF-8'); ?>
                                                                                            </p>
                                                                                        </div>
                                                                                        <button class="btn btn-primary select-btn"
                                                                                            type="button"
                                                                                            data-sub-category-id="<?= $lab['sub_category_id'] ?>">Select</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        document.getElementById('searchBox<?= $i ?>').addEventListener('input', function () {
                                                            var searchValue = this.value.toLowerCase();
                                                            var searchResults = document.getElementById('searchResults<?= $i ?>');
                                                            var labResults = document.getElementById('labResults<?= $i ?>').querySelectorAll('.col-lg-12');
                                                            searchResults.innerHTML = '';
                                                            labResults.forEach(function (lab) {
                                                                if (lab.innerText.toLowerCase().includes(searchValue)) {
                                                                    var clone = lab.cloneNode(true);
                                                                    searchResults.appendChild(clone);
                                                                }
                                                            });
                                                        });

                                                        // Prevent hiding results when clicking on the search box
                                                        document.getElementById('searchBox<?= $i ?>').addEventListener('focus', function () {
                                                            var searchValue = this.value.toLowerCase();
                                                            var searchResults = document.getElementById('searchResults<?= $i ?>');
                                                            var labResults = document.getElementById('labResults<?= $i ?>').querySelectorAll('.col-lg-12');
                                                            searchResults.innerHTML = '';
                                                            labResults.forEach(function (lab) {
                                                                if (lab.innerText.toLowerCase().includes(searchValue)) {
                                                                    var clone = lab.cloneNode(true);
                                                                    searchResults.appendChild(clone);
                                                                }
                                                            });
                                                        });

                                                        // Prevent hiding results when clicking inside the search box
                                                        document.getElementById('searchBox<?= $i ?>').addEventListener('click', function (event) {
                                                            event.stopPropagation();
                                                        });
                                                        // Prevent hiding results when clicking inside the modal
                                                        document.getElementById('itemDetails<?= $i ?>').addEventListener('click', function (event) {
                                                            event.stopPropagation();
                                                        });
                                                        // Add event listener to the select buttons
                                                        document.querySelectorAll('.select-btn').forEach(function (button) {
                                                            button.addEventListener('click', function () {
                                                                const subCategoryId = this.getAttribute('data-sub-category-id');
                                                                const orderId = <?= json_encode($all['order_id']); ?>;  // Use `json_encode` for safe output
                                                                // Make an AJAX request to update the database
                                                                fetch('updateBookProduct', {
                                                                    method: 'POST',
                                                                    headers: {
                                                                        'Content-Type': 'application/x-www-form-urlencoded'
                                                                    },
                                                                    body: `order_id=${orderId}&sub_category_id=${encodeURIComponent(subCategoryId)}`
                                                                })
                                                                    .then(response => {
                                                                        if (response.redirected) {
                                                                            window.location.href = response.url;
                                                                        } else {
                                                                            return response.json();
                                                                        }
                                                                    })
                                                                    .then(data => {
                                                                        if (data.success) {
                                                                            alert(data.message || 'Lab selected successfully!');
                                                                        } else {
                                                                            alert(data.message || 'Failed to select lab.');
                                                                        }
                                                                    })
                                                                    .catch(error => console.error('Error:', error));
                                                            });
                                                        });

                                                    </script>
                                                </td>
                                                <td>
                                                    <strong>
                                                        <?php
                                                        if ($all['visit_status'] == '1') {
                                                            echo '<span class="badge badge-pill badge-soft-primary font-size-14 mb-2">Visited</span><br>';
                                                        } elseif ($all['visit_status'] == '0') {
                                                            echo '<span class="badge badge-pill badge-soft-danger font-size-14">Cancelled</span>';
                                                        } elseif ($all['visit_status'] == '2') {
                                                            echo '<span class="badge badge-pill badge-soft-warning font-size-14">Pending</span>';
                                                        } else {
                                                            echo '<span class="badge badge-pill badge-soft-secondary font-size-14">Unknown</span>';
                                                        }
                                                        ?>
                                                    </strong>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#patientDetailsModal<?= $i ?>">
                                                        View
                                                    </button>
                                                    <div class="modal fade" id="patientDetailsModal<?= $i ?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="patientDetailsModalLabel<?= $i ?>"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="patientDetailsModalLabel<?= $i ?>">Patient Details
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Patient Gender</th>
                                                                                <th>Patient Age</th>
                                                                                <th>Contact Number</th>
                                                                                <th>Email</th>
                                                                                <th>Service Type</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><?= $all['patient_gender']; ?></td>
                                                                                <td><?= $all['patient_age']; ?></td>
                                                                                <td><?= $all['contact_no']; ?></td>
                                                                                <td><?= $all['email']; ?></td>
                                                                                <td><?= $all['service_type']; ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/template/footer'); ?>

<!-- Modal -->
<div class="modal fade" id="appointmodal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $i ?>"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel<?= $i ?>">
                    Details of <?= $all['patient_name'] ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <button type="button" class="btn btn-primary btn-sm ms-3" id="copyBtn<?= $i ?>">Copy All Info</button>
            </div>
            <div class="modal-body" id="modalBody<?= $i ?>">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Patient Age</th>
                            <th>Patient Gender</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $all['patient_age'] ?></td>
                            <td><?= $all['patient_gender'] ?></td>
                            <td><?= $all['contact_no'] ?></td>
                            <td><?= $all['email'] ?></td>
                            <td><?= $all['email'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>