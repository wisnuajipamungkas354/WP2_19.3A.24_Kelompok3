$(".delete-servis").on("click", function (e) {
	e.preventDefault();
	var getLink = $(this).attr("href");

	Swal.fire({
		title: "Hapus Data Servis?",
		text: "Pilih tombol 'Hapus' jika Anda yakin ingin menghapus data yang dipilih.",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#808080",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
		width: "400px",
	}).then((result) => {
		if (result.value) {
			window.location.href = getLink;
		}
	});
});

$(".delete-pembayaran").on("click", function (e) {
	e.preventDefault();
	var getLink = $(this).attr("href");

	Swal.fire({
		title: "Hapus Data Pembayaran?",
		text: "Pilih tombol 'Hapus' jika Anda yakin ingin menghapus data yang dipilih.",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#808080",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
		width: "400px",
	}).then((result) => {
		if (result.value) {
			window.location.href = getLink;
		}
	});
});

$(".delete-laporan").on("click", function (e) {
	e.preventDefault();
	var getLink = $(this).attr("href");

	Swal.fire({
		title: "Hapus Data Laporan?",
		text: "Pilih tombol 'Hapus' jika Anda yakin ingin menghapus data yang dipilih.",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#808080",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
		width: "400px",
	}).then((result) => {
		if (result.value) {
			window.location.href = getLink;
		}
	});
});

$(".delete-barang").on("click", function (e) {
	e.preventDefault();
	var getLink = $(this).attr("href");

	Swal.fire({
		title: "Hapus Data Barang?",
		text: "Pilih tombol 'Hapus' jika Anda yakin ingin menghapus data yang dipilih.",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#808080",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
		width: "400px",
	}).then((result) => {
		if (result.value) {
			window.location.href = getLink;
		}
	});
});

$(".delete-pengguna").on("click", function (e) {
	e.preventDefault();
	var getLink = $(this).attr("href");

	Swal.fire({
		title: "Hapus Data Pengguna?",
		text: "Pilih tombol 'Hapus' jika Anda yakin ingin menghapus data yang dipilih.",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#808080",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
		width: "400px",
	}).then((result) => {
		if (result.value) {
			window.location.href = getLink;
		}
	});
});

$(".delete-pegawai").on("click", function (e) {
	e.preventDefault();
	var getLink = $(this).attr("href");

	Swal.fire({
		title: "Hapus Data Pegawai?",
		text: "Pilih tombol 'Hapus' jika Anda yakin ingin menghapus data yang dipilih.",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#808080",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
		width: "400px",
	}).then((result) => {
		if (result.value) {
			window.location.href = getLink;
		}
	});
});

$(".logout").on("click", function (e) {
	e.preventDefault();
	var getLink = $(this).attr("href");

	Swal.fire({
		title: "Ingin Keluar?",
		text: "Pilih tombol 'Logout' jika Anda yakin ingin mengakhiri sesi.",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#808080",
		confirmButtonText: "Logout",
		cancelButtonText: "Batal",
		width: "400px",
	}).then((result) => {
		if (result.value) {
			window.location.href = getLink;
		}
	});
});
