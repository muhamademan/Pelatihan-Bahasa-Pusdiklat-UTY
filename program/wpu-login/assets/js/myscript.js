const flashData = $('.flash-data').data('message');

if (flashData) {
    Swal({
        title: 'Data Kelas ',
        text: 'Berhasil ' + flashData,
        type: 'success'
    });
}