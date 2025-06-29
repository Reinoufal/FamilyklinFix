<form action="{{ route('contact.index') }}" method="POST">
    <div class="max-w-4xl mx-auto px-6">
      <h2 class="text-4xl font-bold text-center text-blue-800 mb-10">Hubungi Kami</h2>
      <form action="/contact" method="POST" class="grid gap-6 bg-gray-50 p-8 rounded-2xl shadow-xl">
        <div>
          <label class="block text-sm text-gray-700 font-medium mb-1">Nama</label>
          <input type="text" name="name" class="w-full border border-gray-300 rounded-xl px-4 py-2" required>
        </div>
        <div>
          <label class="block text-sm text-gray-700 font-medium mb-1">Email</label>
          <input type="email" name="email" class="w-full border border-gray-300 rounded-xl px-4 py-2" required>
        </div>
        <div>
          <label class="block text-sm text-gray-700 font-medium mb-1">Pesan</label>
          <textarea name="message" rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-2" required></textarea>
        </div>
        <div class="text-center">
          <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-3 rounded-full font-semibold shadow">Kirim Pesan</button>
        </div>
      </form>
    </div>
  </section>
</form>