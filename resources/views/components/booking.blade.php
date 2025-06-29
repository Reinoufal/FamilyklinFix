<section id="booking" class="py-20 bg-blue-50" data-aos="fade-up">
  <div class="max-w-4xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-center text-blue-800 mb-10">Formulir Booking</h2>
    <form action="/booking" method="POST" class="grid gap-6 bg-white p-8 rounded-2xl shadow-xl">
      <div>
        <label class="block text-sm text-gray-700 font-medium mb-1">Nama Lengkap</label>
        <input type="text" name="name" class="w-full border border-gray-300 rounded-xl px-4 py-2" required>
      </div>
      <div>
        <label class="block text-sm text-gray-700 font-medium mb-1">Nomor Telepon</label>
        <input type="text" name="phone" class="w-full border border-gray-300 rounded-xl px-4 py-2" required>
      </div>
      <div>
        <label class="block text-sm text-gray-700 font-medium mb-1">Alamat</label>
        <input type="text" name="address" class="w-full border border-gray-300 rounded-xl px-4 py-2" required>
      </div>
      <div>
        <label class="block text-sm text-gray-700 font-medium mb-1">Pilih Layanan</label>
        <select name="service" class="w-full border border-gray-300 rounded-xl px-4 py-2">
          <option value="AC">Hydrocleaning AC</option>
          <option value="Kasur">Hydrocleaning Kasur</option>
          <option value="Sofa">Hydrocleaning Sofa</option>
        </select>
      </div>
      <div class="text-center">
        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-3 rounded-full font-semibold shadow">Kirim Booking</button>
      </div>
    </form>
  </div>
</section>