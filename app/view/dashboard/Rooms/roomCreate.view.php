
<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <main>
            <div class="mx-auto max-w-4xl py-7 px-7">
                <h2 class="mb-4">Create Room</h2>
                <form method="POST" action="<?= url('/rooms') ?>">

                    <div class="mb-4">
                        <label for="room_number">Room Number</label>
                        <input type="number" id="room_number" name="room_number" required>
                    </div>

                    <div class="mb-4">
                        <label for="floor">Floor</label>
                        <input type="number" id="floor" name="floor" required>
                    </div>

                    <div class="mb-4">
                        <label for="room_bed">Beds</label>
                        <input type="number" id="room_bed" name="room_bed" required>
                    </div>

                    <div class="mb-4">
                        <label for="Max_guests">Max Guests</label>
                        <input type="number" id="Max_guests" name="Max_guests" required>
                    </div>
   
    <!-- Hotel Select -->
    
<div class="mb-4 position-relative">
  <label for="hotelSearch" class="form-label fw-semibold">Select Hotel</label>
  <input type="text" class="form-control" id="hotelSearch" placeholder="Search or Select Hotel..." autocomplete="off">
  <input type="hidden" name="hotel_id" id="hotel_id">

  <ul class="list-group position-absolute w-100 shadow-sm mt-1" id="hotelList" style="display:none; max-height:200px; overflow-y:auto; z-index:1050;"></ul>
</div>


       

                    <div class="mb-4">
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="available">Available</option>
                            <option value="booked">Booked</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
 
                    <div class="mt-6 flex items-center justify-end gap-x-4">
                        <a href="<?= url('/rooms') ?>">Cancel</a>
                        <button type="submit" 
                                style="background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; border:none;">
                            Create
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function(){
  const hotels = [
    <?php foreach ($hotels as $hotel): ?>
      { id: <?= $hotel['id'] ?>, hotel_name: "<?= addslashes($hotel['hotel_name']) ?>" },
    <?php endforeach; ?>
  ];

  const $input = $('#hotelSearch');
  const $list = $('#hotelList');

  // Show all hotels on click
  $input.on('focus click', () => {
    $list.empty().show();
    hotels.forEach(h => $list.append(`<li class="list-group-item list-group-item-action" data-id="${h.id}">${h.hotel_name}</li>`));
  });

  // Filter on typing
  $input.on('input', function(){
    const query = this.value.toLowerCase();
    $list.empty();
    hotels
      .filter(h => h.hotel_name.toLowerCase().includes(query))
      .forEach(h => $list.append(`<li class="list-group-item list-group-item-action" data-id="${h.id}">${h.hotel_name}</li>`));
    $list.toggle($list.children().length > 0);
  });

  // Select hotel
  $list.on('click', 'li', function(){
    $input.val($(this).text());
    $('#hotel_id').val($(this).data('id'));
    $list.hide();
  });

  // Hide list on outside click
  $(document).on('click', e => {
    if (!$(e.target).closest('.mb-4').length) $list.hide();
  });
});
</script>



