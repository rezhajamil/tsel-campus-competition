function openModal(event) {
    document.getElementById("myModal").classList.remove('hidden');
    event.preventDefault();
}

function closeModal(event) {
    document.getElementById("myModal").classList.add('hidden');
    event.preventDefault();
}

function searchKampus(keyword) {
    $.ajax({
        url: "{{ route('get-kampus-by-keyword') }}",
        type: "GET",
        data: {
            keyword: keyword
        },
        success: function(response) {
            var kampusList = response.kampusList;
            var kampusDiv = $('#kampusList');
            kampusDiv.empty();

            kampusList.forEach(function(kampus) {
                var kampusItem = $(
                    '<div class="h-fit px-2 py-1 mb-2 border rounded flex flex-col kampus-item" data-npsn="' +
                    kampus.NPSN + '">');
                kampusItem.append('<p class="text-xs border-b">' + kampus.NAMA_SEKOLAH +
                    '</p>');
                kampusItem.append('<p class="text-xs">NPSN: ' + kampus.NPSN + '</p>');
                kampusDiv.append(kampusItem);
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

$(document).ready(function() {
    $('#searchInput').on('keypress', function(e) {
        console.log(e.keyCode);
        if (e.keyCode == 13) {
            var keyword = $(this).val();
            searchKampus(keyword);
        }
    });
});


$(document).ready(function() {
    $('#kampusList').on('click', '.kampus-item', function() {
        var npsn = $(this).attr('data-npsn');
        var namaSekolah = $(this).find('p:first')
            .text(); // Menggunakan find untuk mencari elemen pertama
        $('#npsn').val(npsn);
        $('#searchInput').val(namaSekolah);
        closeModal(event); // Memanggil fungsi closeModal
    });
});