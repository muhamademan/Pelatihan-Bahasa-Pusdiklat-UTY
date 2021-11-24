const flashData = $('.alert').data('message');

if (flashData) {
    Swal.fire(
        'Data Kelas ',
        'Berhasil ' + flashData,
        'success'
    );
}