<footer class="main-footer d-flex justify-content-between align-items-center">
    <div>
        <strong>Copyright &copy; <span id="currentYear"></span>
        <a href="https://youtube.com/@fahmiplts">Fahmi Shoib</a>. </strong>All Rights Reserved
    </div>
    <p id="currentDateTime" class="mb-0"></p>
</footer>

@push('script')
<script>
    function updateDateTime() {
        // Mendapatkan tanggal dan waktu saat ini
        var currentDate = new Date();

        // Menyimpan tanggal, bulan, tahun, jam, menit, dan detik dalam variabel
        var day = currentDate.getDate();
        var month = currentDate.getMonth() + 1; // Bulan dimulai dari 0, sehingga perlu ditambahkan 1
        var year = currentDate.getFullYear();
        var hours = currentDate.getHours();
        var minutes = currentDate.getMinutes();
        var seconds = currentDate.getSeconds();

        // Menambahkan 0 di depan jam, menit, dan detik jika kurang dari 10
        if (hours < 10) hours = '0' + hours;
        if (minutes < 10) minutes = '0' + minutes;
        if (seconds < 10) seconds = '0' + seconds;

        // Menampilkan tanggal/bulan/tahun jam:menit:detik di dalam elemen dengan id "currentDateTime"
        document.getElementById("currentDateTime").innerHTML = "Tanggal: " + day + "/" + month + "/" + year + " - " + hours + ":" + minutes + ":" + seconds;
    }

    // Panggil fungsi updateDateTime setiap detik
    setInterval(updateDateTime, 1000);

    // Menyimpan tahun saat ini ke elemen dengan id "currentYear"
    document.getElementById("currentYear").textContent = new Date().getFullYear();
</script>
@endpush
