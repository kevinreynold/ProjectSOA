Cara menjalankan api documentation:
1. Install ruby terlebih dahulu (file rubyinstaller-2.4.1-1-x64.exe)
2. Saat ruby nya terbuka, pilih component no 1,2,3, tunggu sampai selesai
3. Buka cmd, ketik "gem install bundler", tunggu sampai selesai
4. Jika sudah, arahkan ke folder slate, lalu ketik "bundle install", tunggu sampai selesai
5. Ketik "bundle exec middleman server", tunggu 1 menit
6. Jalankan localhost:4567, selamat dokumentasi telah jadi!


Notes: Ubah penjelasan documentation di "index.html.md", sesuai aturan

Kalau ada perubahan gunakan sintaks ini: "bundle exec middleman build"

INFO SOURCE: https://github.com/lord/slate
HOW TO: https://github.com/lord/slate/wiki/Markdown-Syntax