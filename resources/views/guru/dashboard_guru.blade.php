<h1>Hallo {{ auth()->user()->username }}</h1>
<h5>{{ auth()->user()->keterangan }}</h5>
<button onclick="function5()">Logout</button>
<script>
    function function5() {
        swal({
                title: "Peringatan",
                text: "Apakah {{ auth()->user()->username }} ingin logout?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willLogout) => {
                if (willLogout) {
                    swal("Logout berhasil, sampai jumpa kembali", {
                        icon: "success",
                    }).then(() => {
                        window.location.href = "/logout_guru";
                    });
                }
            });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
