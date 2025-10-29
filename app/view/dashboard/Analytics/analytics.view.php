

<div class="main-content mt-4">
  <div class="container">
  
  <!-- Stats Cards + Recent Movement -->
  <section class="py-4">
    <div class="container-fluid">
      <div class="row g-4">
        
        <!-- 4 Cards -->
        <div class="col-lg-6">
          <div class="d-flex flex-wrap gap-3">
            
            <!-- Card 1 -->
            <div class="card shadow-sm card-sm flex-grow-1" style="flex:1 1 45%;">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <span class="text-muted">Sales</span>
                  <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
                    <i class="material-icons text-primary">local_shipping</i>
                  </div>
                </div>
                <h5 class="fw-bold mt-2">$2.382</h5>
                <div class="d-flex align-items-center">
                  <span class="badge bg-danger-subtle text-danger me-2">-3.65%</span>
                  <small class="text-muted">Since last week</small>
                </div>
              </div>
            </div>

            <!-- Card 2 -->
            <div class="card shadow-sm card-sm flex-grow-1" style="flex:1 1 45%;">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <span class="text-muted">Earnings</span>
                  <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
                    <span class="text-primary fw-bold">$</span>
                  </div>
                </div>
                <h5 class="fw-bold mt-2">$21.300</h5>
                <div class="d-flex align-items-center">
                  <span class="badge bg-success-subtle text-success me-2">6.65%</span>
                  <small class="text-muted">Since last week</small>
                </div>
              </div>
            </div>

            <!-- Card 3 -->
            <div class="card shadow-sm card-sm flex-grow-1" style="flex:1 1 45%;">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <span class="text-muted">Visitors</span>
                  <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
                    <i class="material-icons text-primary">people_alt</i>
                  </div>
                </div>
                <h5 class="fw-bold mt-2">$14.212</h5>
                <div class="d-flex align-items-center">
                  <span class="badge bg-success-subtle text-success me-2">5.25%</span>
                  <small class="text-muted">Since last week</small>
                </div>
              </div>
            </div>

            <!-- Card 4 -->
            <div class="card shadow-sm card-sm flex-grow-1" style="flex:1 1 45%;">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <span class="text-muted">Orders</span>
                  <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:32px;height:32px;">
                    <i class="material-icons text-primary">shopping_cart</i>
                  </div>
                </div>
                <h5 class="fw-bold mt-2">$64</h5>
                <div class="d-flex align-items-center">
                  <span class="badge bg-danger-subtle text-danger me-2">-2.25%</span>
                  <small class="text-muted">Since last week</small>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Recent Movement Chart -->
        <div class="col-lg-6">
          <div class="card shadow-sm card-sm">
            <div class="card-body">
              <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-3">
                <h5 class="fw-semibold text-dark mb-3 mb-sm-0">Recent Movement</h5>
                <div class="d-flex gap-2">
                  <select class="form-select form-select-sm">
                    <option>Jan</option>
                    <option>Feb</option>
                    <option>Mar</option>
                  </select>
                  <input type="text" class="form-control form-control-sm" placeholder="Search..."/>
                </div>
              </div>
              <div id="movementChart"></div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Latest Projects + Monthly Report -->
  <section class="py-4">
    <div class="container-fluid">
      <div class="row g-4">
        
        <!-- Latest Projects Table -->
        <div class="col-lg-8">
          <div class="card shadow-sm card-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 mb-0">Latest Projects</h2>
                <button class="btn btn-link text-muted p-0"><span class="material-icons">more_horiz</span></button>
              </div>
              <div class="table-responsive">
                <table class="table align-middle">
                  <thead class="text-uppercase text-muted small">
                    <tr>
                      <th>Name</th>
                      <th>Author</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="bg-pink text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width:36px; height:36px;">
                            <span class="material-icons">web</span>
                          </div>
                          <div>
                            <p class="mb-0 fw-semibold">Project Apollo</p>
                            <small class="text-muted">Web, UI/UX Design</small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 fw-medium">Vanessa Tucker</p>
                        <small class="text-muted">HTML, JS, React</small>
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <span class="text-success fw-semibold me-2">65%</span>
                          <div class="progress flex-grow-1 progress-custom">
                            <div class="progress-bar bg-success bar-custom" style="width:65%"></div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <button class="btn btn-secondary btn-sm">View</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Monthly Report Chart -->
        <div class="col-lg-4">
          <div class="card shadow-sm card-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 mb-0">Monthly Report</h2>
                <button class="btn btn-link text-muted p-0"><span class="material-icons">more_horiz</span></button>
              </div>
              <div id="monthlyChart"></div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

