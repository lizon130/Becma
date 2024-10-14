$(document).ready(function () {
    $(document).on('change', '#banner_input', function () {
        imagePreview('#banner_input', '#banner_preview');
        $('#banner_preview').show();
    });
    $(document).on('change', '.guest_image_input', function () {
        const id = $(this).data('id');
        const previewId = $(this).data('preview-id');
        imagePreview(`#${id}`, `#${previewId}`);
        $(`#${previewId}`).show();
    });
    $(document).on('click', '.category_btn', function () {
        const categoryId = $(this).data('id').toString();
        $(this).toggleClass('active');

        let previousCategories = $('#category_id').val();
        let categoriesArray = previousCategories ? previousCategories.split(',') : [];

        if (categoriesArray.includes(categoryId)) {
            categoriesArray = categoriesArray.filter(id => {
                if (id !== categoryId) {
                    return id;
                }
            });
        } else {
            categoriesArray.push(categoryId);
        }
        $('#category_id').val(categoriesArray.join(','));
    });

    /* Extra images script started here */
    let existingExtraImageFiles = [];

    function updateFileList(files) {
        const dataTransfer = new DataTransfer();
        existingExtraImageFiles.forEach(file => {
            dataTransfer.items.add(file);
        });
        Array.from(files).forEach(file => {
            dataTransfer.items.add(file);
        });
        $('#extra_images_input')[0].files = dataTransfer.files;
    }
    $('#extra_images_input').on('change', function (event) {
        const files = event.target.files;
        const previewContainer = $('#extra_images_preview_container');
        updateFileList(files);
        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imagePreview = $(`
            <div class="extra_images_preview">
                <img src="${e.target.result}" alt="Image Preview">
                <button type="button" class="remove-btn" data-index="${existingExtraImageFiles.length + index}">X</button>
            </div>
        `);
                previewContainer.append(imagePreview);
            };
            reader.readAsDataURL(file);
        });
        existingExtraImageFiles = Array.from($('#extra_images_input')[0].files);
    });
    $('#extra_images_preview_container').on('click', '.remove-btn', function () {
        const index = $(this).data('index');
        const filesInput = $('#extra_images_input')[0];
        const dataTransfer = new DataTransfer();
        existingExtraImageFiles.forEach((file, i) => {
            console.log("i", i);
            console.log("index", index);
            if ((i + 1) !== index) {
                dataTransfer.items.add(file);
            }
        });
        filesInput.files = dataTransfer.files;
        $(this).parent().remove();
        existingExtraImageFiles = Array.from(filesInput.files);
    });
    $(document).on('click', '.existing-image-remove-btn', function () {
        const path = $(this).data('path').toString();
        let previousRemoves = $('#removed_images').val();
        let previousRemovesArray = previousRemoves ? previousRemoves.split(',') : [];
        previousRemovesArray.push(path);
        $('#removed_images').val(previousRemovesArray.join(','));
        $(this).parent().remove();
    });
    /* Extra images script ended here */

    $(document).on('click', '.guest-add-btn', function () {
        const go_next_step = check_validation_Form('#guests-container');
        if (go_next_step) {
            const url = $(this).data('url');
            $.ajax({
                url: url,
                type: "get",
                dataType: "json",
                success: function (response) {
                    if (response?.status) {
                        $('#guests-container').append(response?.html);
                        initRichtextEditor();
                    }
                }
            })
        }
    });
    $(document).on('click', '.guest-remove-btn', function () {
        const containerId = $(this).data('container-id');
        $(`#${containerId}`).remove();
    });

    /* Ticket Type */
    $(document).on('click', '.ticket-type-add-btn', function () {
        const go_next_step = check_validation_Form('#tickets-container');
        if (go_next_step) {
            const url = $(this).data('url');
            $.ajax({
                url: url,
                type: "get",
                dataType: "json",
                success: function (response) {
                    if (response?.status) {
                        $('#tickets-container').append(response?.html);
                    }
                }
            })
        }
    });
    $(document).on('click', '.ticket-type-remove-btn', function () {
        const containerId = $(this).data('container-id');
        $(`#${containerId}`).remove();
    });
    $(document).on('change', '.have-discount-input', function () {
        const containerId = $(this).data('container-id');
        const valueId = $(this).data('value-id');
        if (this.checked) {
            $(`#${containerId}`).show();
            $(`#${containerId} input, #${containerId} select, #${containerId} textarea`).prop('required', true);
            $(`#${valueId}`).val(1);
        } else {
            $(`#${containerId}`).hide();
            $(`#${containerId} input, #${containerId} select, #${containerId} textarea`).prop('required', false);
            $(`#${valueId}`).val(0);
        }
    });

    $(document).on('change', '.have-free-input', function () {
        const containerId = $(this).data('container-id');
        const valueId = $(this).data('value-id');
        if (this.checked) {
            console.log(`#${containerId} input.price_input`);

            console.log($(`#${containerId} input.price_input`));

            $(`#${containerId} input.price_input`).attr('readonly', true);
            $(`#${containerId} input.price_input`).val(0);
            // $(`#${containerId}`).show();
            // $(`#${containerId} input, #${containerId} select, #${containerId} textarea`).prop('required', true);
            $(`#${valueId}`).val(1);
        } else {
            $(`#${containerId} input.price_input`).attr('readonly', false);
            // $(`#${containerId}`).hide();
            // $(`#${containerId} input, #${containerId} select, #${containerId} textarea`).prop('required', false);
            $(`#${valueId}`).val(0);
        }
    });

    /* Add Event */
    $(document).on('click', '#createUserBtn', function (e) {
        e.preventDefault();
        const url = $(this).data('url');
        const successUrl = $(this).data('success-url');
        var formData = new FormData(document.getElementById('createForm'));
        go_next_step = check_validation_Form('#createForm');
        if (go_next_step) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    showToast(response?.status, response?.msg);
                    if (response?.status) {
                        location.href = successUrl;
                    }
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON.msg;
                    $('#editForm .server_side_error').html(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + errorMessage +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    );
                },
            })
        }
    });
});
