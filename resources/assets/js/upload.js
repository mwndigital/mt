$(document).ready(function () {
    const csrf_token = $('meta[name="csrf-token"]').attr("content");
    const id = $('input[name="id"]').val();
    let imageQueue = []; // Queue to hold images

    $("#addImageButton").click(function () {
        $("#upload-btn").removeClass("d-none");
        var newInput = '<div class="input-group mb-3">';
        newInput += '<input type="file" name="images[]" class="form-control">';
        newInput += '<div class="input-group-append">';
        newInput +=
            '<input type="button" class="btn btn-danger remove-image" value="Remove">';
        newInput += "</div></div>";
        $("#imageContainer").append(newInput);
    });

    $(document).on("click", ".remove-image", function () {
        $(this).closest(".input-group").remove();
    });

    $(document).on("click", "#uploadImageButton", function () {
        $('input[name^="images"]').each(function (index, element) {
            imageQueue.push(element.files[0]); // Add each image to the queue
        });

        uploadNext(); // Start uploading images from the queue
    });

    function uploadNext() {
        if (imageQueue.length > 0) {
            var formData = new FormData();
            var image = imageQueue.shift(); // Get the first image from the queue
            formData.append("image", image);
            formData.append("id", id);
            formData.append("_token", csrf_token);

            $.ajax({
                url: "/admin/upload-image",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                xhr: function () {
                    var xhr = new XMLHttpRequest();

                    // Listen to the progress event
                    xhr.upload.addEventListener(
                        "progress",
                        function (event) {
                            if (event.lengthComputable) {
                                var percentComplete =
                                    (event.loaded / event.total) * 100;
                                console.log(
                                    "Upload Progress: " + percentComplete + "%"
                                );
                            }
                        },
                        false
                    );

                    return xhr;
                },
                success: function (response) {
                    if (response.success) {
                        console.log(
                            "Image uploaded successfully: " + response.image
                        );
                    } else {
                        console.log("Error uploading image.");
                    }

                    uploadNext(); // Upload the next image in the queue
                },
                error: function () {
                    console.log("Error uploading image.");
                    uploadNext(); // Upload the next image in the queue even if there's an error
                },
            });
        } else {
            alert("All images uploaded successfully");
            $("#upload-btn").addClass("d-none");
            $('input[name^="images"]').remove();
            $(".remove-image").remove();
            // Add to gallery
        }
    }

    // Add event listener for delete buttons
    $(".delete-image").click(function () {
        var imageId = $(this).data("image");
        $("#image_id").val(imageId);
        if (confirm("Are you sure you want to delete this image?")) {
            const response = $.ajax({
                url: "/admin/remove-image",
                method: "DELETE",
                data: {
                    _token: csrf_token,
                    id: imageId,
                },
                success: function (data) {
                    if (data.success) {
                        $("#image-card-" + imageId).remove();
                        alert("Image deleted successfully");
                    } else {
                        alert("There was an error deleting the image");
                    }
                },
            });
        }
    });
});
