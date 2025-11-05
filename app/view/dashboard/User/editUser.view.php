
<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <main>
            <div class="mx-auto max-w-4xl py-7 px-7">
                <form method="POST" action="<?= url('/user/update') ?>">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

                    <!-- First Name -->
                    <div class="mb-4">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name"
                               value="<?= htmlspecialchars($user['first_name']) ?>" required>
                    </div>

                    <!-- Last Name -->
                    <div class="mb-4">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name"
                               value="<?= htmlspecialchars($user['last_name']) ?>" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email">Email</label>
                        <input type="email" id="user_email" name="user_email"
                               value="<?= htmlspecialchars($user['user_email']) ?>" required>
                    </div>

                    <!-- Contact -->
                    <div class="mb-4">
                        <label for="contact_no">Contact</label>
                        <input type="text" id="contact_no" name="contact_no"
                               value="<?= htmlspecialchars($user['contact_no']) ?>">
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label for="address">Address</label>
                        <textarea id="address" name="address"><?= htmlspecialchars($user['address']) ?></textarea>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="active" <?= $user['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= $user['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>


                    <!-- Buttons: Update only -->
                    <div class="mt-6 flex items-center justify-end gap-x-4">
                        <a href="<?= url('/user') ?>">Cancel</a>
                        <button type="submit"
                            style="background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; border:none;"
                            onmouseover="this.style.backgroundColor='#15803d'"
                            onmouseout="this.style.backgroundColor='#16a34a'">
                            Update
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>


