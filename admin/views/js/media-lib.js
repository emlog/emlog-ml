// Insert resource list
let page = 1;
let sid = 0;

function loadImages() {
    $.ajax({
        type: 'GET',
        url: './media.php?action=lib',
        data: {
            page: page,
            sid: sid
        },
        success: function (resp) {
            $.each(resp.data.images, function (i, image) {
                var insertBtnHtml = '';
                if (image.media_type === 'image') {
                    insertBtnHtml = '<a href="javascript:insert_media_img(\'' + image.media_url + '\', \'' + image.media_icon + '\')" class="btn" title="' + lang('insert_to_article') + '"><i class="icofont-plus"></i></a>' +
                        '<a href="javascript:insert_cover(\'' + image.media_icon + '\')" class="btn" title="' + lang('set_cover') + '"><i class="icofont-image"></i></a>';
                } else if (image.media_type === 'video') {
                    insertBtnHtml = '<a href="javascript:insert_media_video(\'' + image.media_url + '\')" class="btn" title="' + lang('insert_to_article') + '"><i class="icofont-plus"></i></a>';
                } else if (image.media_type === 'audio') {
                    insertBtnHtml = '<a href="javascript:insert_media_audio(\'' + image.media_url + '\')" class="btn" title="' + lang('insert_to_article') + '"><i class="icofont-plus"></i></a>';
                } else {
                    insertBtnHtml = '<a href="javascript:insert_media(\'' + image.media_url + '\', \'' + image.media_name + '\')" class="btn" title="' + lang('insert_to_article') + '"><i class="icofont-plus"></i></a>';
                }
                var cardHtml = '<div class="col-md-4">' +
                    '<div class="card mb-2 shadow-sm">' +
                    '<a href="' + image.media_url + '" target="_blank"><img class="card-img-top" src="' + image.media_icon + '"/></a>' +
                    '<div class="card-body">' +
                    '<div class="card-text text-muted small">' + image.media_name + '<br>' + lang('file_size') + image.attsize + '</div>' +
                    '<p class="card-text d-flex justify-content-between">' + insertBtnHtml + '</p>' +
                    '</div></div></div>';
                $('#image-list').append(cardHtml);
            });
            if (resp.data.hasMore) {
                page++;
            } else {
                $('#load-more').hide();
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}

$('#mediaModal').on('show.bs.modal', function () {
    page = 1;
    $('#image-list').empty();
    loadImages();
    $('#load-more').show();
});
$('#media-sort-select').change(function () {
    sid = $(this).val();
    page = 1;
    $('#image-list').empty();
    loadImages();
    $('#load-more').show();
});
$('#load-more').click(function () {
    loadImages();
});
// Upload resources
Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("#mediaAdd", {
    url: "./media.php?action=upload",
    addRemoveLinks: false,
    method: 'post',
    maxFilesize: Number.MAX_SAFE_INTEGER,// Not limited
    filesizeBase: 1024,
    timeout: 3600000,// milliseconds
    previewsContainer: ".dropzone-previews",
    sending: function (file, xhr, formData) {
        formData.append("filesize", file.size);
        $('#mediaAdd').html("<?=lang('uploading')?>");
    },
    init: function () {
        this.on("error", function (file, response) {
            alert(response);
        });
        this.on("queuecomplete", function (file) {
            page = 1;
            sid = 0;
            $('#image-list').empty();
            loadImages();
            $('#load-more').show();
            $('#mediaAdd').html("<?=lang('upload_files')?>");
        });
    }
});