
 <?php require __DIR__ . '/../partial/head.php'; ?>
<?php require __DIR__ . '/../partial/navbar.php'; ?>
 <link href="Assets/frontend/contact.style.css" rel="stylesheet">
<section class="contact-section py-5">
  <div class="container">
    <div class="row g-5">
      <!-- Contact Info -->
      <div class="col-lg-4">
        <div class="contact-text">
          <h2>Contact Info</h2>
          <p class="text-muted">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua.
          </p>

          <ul class="list-unstyled">
            <li class="mb-2"><strong>Address:</strong> 856 Cordia Extension Apt. 356, Lake.</li>
            <li class="mb-2"><strong>Phone:</strong> (12) 345 67890</li>
            <li class="mb-2"><strong>Email:</strong> info.colorlib@gmail.com</li>
            <li><strong>Fax:</strong> +(12) 345 67890</li>
          </ul>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="col-lg-7 offset-lg-1">
        <form action="#" class="contact-form">
          <div class="row g-3">
            <div class="col-lg-6">
              <input type="text" class="form-control" placeholder="Your Name">
            </div>
            <div class="col-lg-6">
              <input type="email" class="form-control" placeholder="Your Email">
            </div>
            <div class="col-12">
              <textarea class="form-control" rows="5" placeholder="Your Message"></textarea>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-custom px-4 py-2">Submit Now</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Map -->
    <div class="map mt-5">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.0606825994123!2d-72.8735845851828!3d40.760690042573295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e85b24c9274c91%3A0xf310d41b791bcb71!2sWilliam%20Floyd%20Pkwy%2C%20Mastic%20Beach%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1578582744646!5m2!1sen!2sbd"
        class="w-100" height="470" allowfullscreen=""></iframe>
    </div>
  </div>
</section>
<?php 
require __DIR__ . '/../partial/footer.php';
?>
</body>
</html>


