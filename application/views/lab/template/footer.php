</div>

<div class="rightbar-overlay"></div>
<!-- Modal Structure -->
<div class="modal fade" id="supportModal" tabindex="-1" aria-labelledby="supportModalLabel" aria-hidden="true"
    data-bs-backdrop="false" style="top: 10%;    text-align: justify;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="supportModalLabel">Support Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Support form content here -->
                <form method="post" action="<?= base_url('supportFormData')?>">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Your Name</label>
                        <input type="text" name="user_name" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Your Email</label>
                        <input type="email" name="user_email" class="form-control" placeholder="Enter your Email" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="userName" class="form-label">Your Lab Name</label>
                        <input type="text" name="business_name" class="form-control" placeholder="Enter Business name" required>
                    </div> -->
                    <div class="mb-3">
                        <label for="Message" class="form-label">Your Message </label>
                        <textarea name="message" class="form-control" placeholder="Enter Message" required></textarea>
                    </div>
                    <div class="modal-footer" style="margin: 0 auto; width: 300px;justify-content: center;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php include('footer_link.php') ?>
</body>

</html>