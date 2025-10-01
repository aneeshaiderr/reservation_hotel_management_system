
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const content = document.querySelector('.main-content');
    const navbar  = document.querySelector('.navbar');
    const footer  = document.querySelector('.footer'); 
    const overlay = document.querySelector('.overlay');
    const fsBtn   = document.querySelector('.js-fullscreen');

    // Sidebar toggle
    document.querySelector('.sidebar-toggle').onclick = () => {
      sidebar.classList.toggle('active');
      navbar.classList.toggle('active');
      content.classList.toggle('active');
      footer.classList.toggle('active');  
      if (window.innerWidth <= 768) overlay.classList.toggle('active');
    };

    // Overlay click
    overlay.onclick = () => {
      sidebar.classList.remove('active');
      navbar.classList.remove('active');
      content.classList.remove('active');
      footer.classList.remove('active'); 
      overlay.classList.remove('active');
    };

    // Fullscreen
    if (fsBtn) {
      fsBtn.onclick = e => {
        e.preventDefault();
        if (!document.fullscreenElement) {
          document.documentElement.requestFullscreen();
          fsBtn.innerHTML = '<i class="fas fa-compress"></i>';
        } else {
          document.exitFullscreen();
          fsBtn.innerHTML = '<i class="fas fa-expand"></i>';
        }
      };
    }

    // data table 
var table = 
 $('#example').DataTable({
     dom: '<"top d-flex justify-content-between align-items-center"<"filter-container">f>rt<"bottom d-flex justify-content-between align-items-center gap-3"lip>',
    pagingType: "simple_numbers", 
      paging: true,         
      searching: true,       
      info: false,           
      lengthChange: true,   
      language: {
        paginate: {
          previous: "Previous",
          next: "Next"
        }
      }
    });


  // Custom filter with Bootstrap icon dropdown
  $(".filter-container").html(`
    <div class="dropdown d-inline-block ms-2">
      <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterMenu" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-sliders"></i>
      </button>
      <ul class="dropdown-menu" aria-labelledby="filterMenu">
        <li><a class="dropdown-item filter-option" href="#" data-value="">All</a></li>
        <li><a class="dropdown-item filter-option" href="#" data-value="Lahore">Lahore</a></li>
        <li><a class="dropdown-item filter-option" href="#" data-value="Karachi">Karachi</a></li>
        <li><a class="dropdown-item filter-option" href="#" data-value="Islamabad">Islamabad</a></li>
        <li><a class="dropdown-item filter-option" href="#" data-value="Rawalpindi">Rawalpindi</a></li>
        <li><a class="dropdown-item filter-option" href="#" data-value="Faisalabad">Faisalabad</a></li>
      </ul>
    </div>
  `);
//   hotel filter 

  $(document).on('click', '.filter-option', function (e) {
      e.preventDefault();
      var val = $(this).data('value'); 
      if (val) {
        
          table.column(1).search(val, true, false).draw();
      } else {
         
          table.column(1).search('').draw();
      }
  });
  // Filter functionality
  $(document).on('click', '.filter-option', function (e) {
      e.preventDefault(); 
      var val = $(this).data('value');
      if (val) {
          table.column(5).search(val, true, false).draw();
      } else {
          table.column(5).search('').draw();
      }
  });

  Highcharts.chart('movementChart', {
    chart: { type: 'line', height: 250 },
    title: { text: null },
    xAxis: { categories: ['Week 1','Week 2','Week 3','Week 4'] },
    yAxis: { title: { text: 'Values' } },
    series: [
      { name: 'Sales', data: [5, 7, 3, 5] },
      { name: 'Earnings', data: [3, 2, 4, 6] }
    ]
  });

  Highcharts.chart('monthlyChart', {
    chart: { type: 'column', height: 250 },
    title: { text: null },
    xAxis: { categories: ['2021','2022','2023','2024'] },
    yAxis: { title: { text: 'Values' } },
    series: [
      { name: '2021', data: [3, 4, 5] },
      { name: '2022', data: [1, 4, 7] },
      { name: '2023', data: [2, 3, 6] },
      { name: '2024', data: [3, 4, 8, 4] }
    ]
  });
});