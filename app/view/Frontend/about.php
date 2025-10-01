<?php require __DIR__ . '/../partial/head.php'; ?>
<?php require __DIR__ . '/../partial/navbar.php'; ?>

  <!-- <link href="../../Public/Assets/css/frontend/about.style.css" rel="stylesheet"> -->
<link rel="stylesheet" href="Assets/frontend/about.style.css">

  <!-- Breadcrumb -->
  <div class="breadcrumb-section py-4 text-center">
    <div class="container">
      <div class="breadcrumb-text">
        <h2 class="display-5 fw-semibold text-dark">About Us</h2>
        <div class="bt-option">
          <a href="/" class="fw-medium text-decoration-none text-heading">Home</a>
          <span class="mx-1 text-secondary">></span>
          <span class="text-secondary">About Us</span>
        </div>
      </div>
    </div>
  </div>

  <!-- About Section -->
  <section class="py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-12 mb-4">
          <div class="ap-title">
            <h3 class="fw-bold text-subheading">Welcome To Sona.</h3>
            <p class="mt-3 text-muted">
              Built in 1910 during the Belle Epoque period, this hotel is located in the center of
              Paris, with easy access to the city’s tourist attractions. It offers tastefully decorated rooms.
            </p>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <ul class="ap-services list-unstyled text-dark">
            <li>20% Off On Accommodation.</li>
            <li>Complimentary Daily Breakfast</li>
            <li>3 Pcs Laundry Per Day</li>
            <li>Free Wifi.</li>
            <li>Discount 20% On F&amp;B</li>
          </ul>
        </div>
      </div>

      <!-- Services -->
      <div class="row mt-5">
        <div class="col-md-4 col-sm-6 col-12">
          <div class="ap-service-item d-flex align-items-end rounded overflow-hidden mb-3" style="background-image: url('Assets/images/about/hero-1.jpg');">
            <div class="api-text"><h3>Restaurants Services</h3></div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
          <div class="ap-service-item d-flex align-items-end rounded overflow-hidden mb-3" style="background-image: url('Assets/images/about/hero-2.jpg');">
            <div class="api-text"><h3>Travel &amp; Camping</h3></div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
          <div class="ap-service-item d-flex align-items-end rounded overflow-hidden mb-3" style="background-image: url('Assets/images/hero/about-p3.jpg');">
            <div class="api-text"><h3>Event &amp; Party</h3></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h5 class="text-uppercase fw-medium small d-block mb-2 text-highlight">Our Gallery</h5>
        <h2 class="display-5 fw-semibold text-dark" >Discover Our Work</h2>
      </div>
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="gallery-item" style="background-image: url('Assets/images/room/room-b1.jpg');">
            <div class="gi-text"><h3>Room Luxury</h3></div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-12">
              <div class="gallery-item" style="background-image: url('Assets/images/room/room-b2.jpg');">
                <div class="gi-text"><h3>Room Luxury</h3></div>
              </div>
            </div>
            <div class="col-sm-6 col-12">
              <div class="gallery-item" style="background-image: url('Assets/images/room/room-b3.jpg');">
                <div class="gi-text"><h3>Room Luxury</h3></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="gallery-item large-item" style="background-image: url('Assets/images/room/gallery-2.jpg');">
            <div class="gi-text"><h3>Room Luxury</h3></div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php 
require __DIR__ . '/../partial/footer.php';
?>
</body>
</html>

