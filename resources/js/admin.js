window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // Confirm to delete data
    document.querySelectorAll('.btn-danger').forEach(el => {
        el.addEventListener('click', ev => {
            ev.preventDefault();
            const target_location = ev.target.href;

            if (window.confirm('Are you sure you want to do this action?')) {
                if (target_location) {
                    window.location.href = target_location;
                }
                ev.target.form.submit();
            }
        });
    });

});

function load_image_from_file_input(input_selector, output_image_selector, callback = function (){}) {

    const acceptableFileFormat = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'jfif', 'webp', 'tiff', 'svg', 'apng', 'avif', 'tif', 'ico'];

    document.querySelector(input_selector).onchange = function (evt) {
        const target = evt.target || window.event.srcElement;
        const files = target.files;
        const checkIfImageCanLoad = FileReader && files && files.length;

        if (!checkIfImageCanLoad) {
            alert('The FileReader API to read the image file is not available in this browser');
        }
        const fileReader = new FileReader();
        const extension = files[0].name.split('.').pop().toLowerCase();
        const isAcceptable = acceptableFileFormat.includes(extension);

        if (!isAcceptable) {
            alert('File type not permitted. Try again');
        }

        fileReader.onload = function (loadEvt) {
            const img_element = document.createElement('img');
            img_element.setAttribute('alt', 'Featured Image Preview');
            img_element.classList.add('img-thumbnail');

            img_element.onload = function () {
                const out_element = document.querySelector(output_image_selector);
                out_element.innerHTML = '';
                out_element.append(img_element);
            };

            img_element.src = loadEvt.target.result.toString();
        };

        fileReader.readAsDataURL(files[0]);
        callback();
    };
}

window.load_image_from_file_input = load_image_from_file_input;

