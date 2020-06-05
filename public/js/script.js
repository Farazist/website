$(document).ready(function () {
    $('#btn-toogle-sidebar').click(function () {
        $('#sidebar').toggle("slide");
    });

    $('#search_toggle').click(function () {
        $('.search').css({"display": "flex"});
    });

    $('.search_close').click(function () {
        $('.search').fadeOut();
    });

    $('#contact-us').click(function() {
        $.scrollTo('#section-contact-us', 1000);
    });

    $('#download-app').click(function() {
        $.scrollTo('#section-download-app', 1000);
    });

    $('#ckf').click(function() {
        selectFileWithCKFinder('img-address', 'img-preview');
    });


    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
})

// ckfinder

function selectFileWithCKFinder(inputId, imgId) {
    CKFinder.popup({
        chooseFiles: true,
        language: 'fa',
        width: 800,
        height: 600,
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                document.getElementById(inputId).value = file.getUrl();
                document.getElementById(imgId).src = file.getUrl();
            });

            finder.on('file:choose:resizedImage', function (evt) {
                document.getElementById(inputId).value = evt.data.resizedUrl;
            });
        }
    });
}