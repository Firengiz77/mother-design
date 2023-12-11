function delete_images(url, key) {
    // const form = document.getElementById('newform24');
    var value = document.getElementById('a_remove').value;
    const formData = new FormData();
    formData.append('key', key);

    const config = {
        title: 'Şəkil Silinsin?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Bəli',
    };

    // first variant
    sweetAlert.fire(config).then(callback);

    function callback(result) {
        if (result.value) {
            // second variant 

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'accept': 'application/json'
                },
                body: formData,
            })
                .then(response => response.text())
                .then(function (response) {
                    // console.log(response);
                    // console.log(response.message);
                    // console.log(value);
                    //  console.log(key);

                    $('.a_remove2_' + key).parent().fadeOut(150, function () {
                        $('a_remove2_' + key).remove();
                        removed++;
                    });

                    alertify.set('notifier', 'position', 'bottom-right');
                    alertify.success('Image Deleted Successfully', 'custom', 2);

                });

            SweetAlert.fire("Şəkil Silindi");

        } else {
            // second variant 
            SweetAlert.fire("Şəkil Silinmədi");
        }
    }

};
