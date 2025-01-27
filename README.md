# About EduBridge
    - Setelah project di-pull, install npm dan composer dependencies (sanctum bila perlu)
    - install 'npm install sweetalert2'
    - lalu migrate (fresh bagi yang sudah pernah)
    - kemudian jalankan seeder (lagi bagi yang sudah pernah)

    *di MySQL kemungkinan akan bermasalah pada seeders, rekomendasi kami gunakan PostGre

    Setelah semua selesai, akan ada sejumlah akun yang siap dipakai untuk testing, yakni:
    1. admin@email.com dengan password 'test1234' sebagai admin
    2. mentor@email.com dengan password 'test1234' sebagai mentor FE
    3. student@email.com dengan password 'test1234' sebagai student FE


    Untuk mengaktifkan AI chat powered by Gemini, lakukan hal berikut:
    1. tambahkan variabel di env -> GEMINI_API_KEY=your_api_key_here
    2. API key gemini bisa didapat dari https://makersuite.google.com/app/ setelah membuat daftar dan buat project

    *informasi tambahan:
    -> fitur AI chat hanya bisa diakses oleh student di welcome page (layout setelah login)
    -> welcome page adalah page dengan layout yang pertama kali muncul setelah login
    -> setelah sampai di welcome page, setiap role perlu pergi ke dashboard terlebih dahulu dengan cara klik tombol 'Dashboard' di dropdown menu saat hover di username (kanan atas) untuk dapat mengakses fitur yang dimilikinya
    -> welcome page dan dashboard page seharusnya kosong karena tidak ada fitur pada page tersebut (tapi kami kasih sejumlah card sebagai hiasan agar page tidak terlihat kosong, karena ke depannya bisa saja diisi dengan data aktual yang ada. sedangkan di rewuirement belum ada membahas hal tersebut)
    -> saat sudah di dashboard page, setiap role bisa mengakses fitur miliknya dengan memilih opsi yang ada di navbar (samping kanan 'dashboard')
 
    Happy testing!

    *new update:
    - fitur AI chat sudah bisa mengakses chat dengan history per session (mengingat chat atasnya), tidak seperti sebelumnya hanya bisa per request
    - [bug fixed] semua data yg diakses sudah terhubung ke salah satu batch yang sedang aktif, sehingga tidak akan ada data yang tidak sesuai dengan batch yang aktif (pengelolaan batch sesuai dengan yang batch yang sedang aktif)

    *detail tambahan:
    - setiap button di welcome page bisa diakses (khususnya unauthenticated user)
    - opsi kursus, daftar, dan masuk pada footer akan hilang jika user sudah login
    - scroll ke section kursus sudah smooth
    - detail setiap kursus tampil dalam bentuk accordion yang baik
    - kontak di footer pada welcome page sudah langsung terhubung ke mailto dan telto
    - di page tentang kami tertera data tim, hingga ke akun instagram dan github
    - entrance animation sudah ada di semua page
    - dan masih banyak lagi :D
