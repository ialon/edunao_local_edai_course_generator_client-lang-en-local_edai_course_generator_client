define(['core/templates'], function(Templates) {
    const button = document.getElementById('generate_course');
    const loader = document.getElementById('loader');
    const coursedescription = document.getElementById('course_description');
    const successcontainer = document.getElementById('success_message_container');
    const coursefiles = document.getElementById('course_files');
    const filenamescontainer = document.getElementById('file_names');

    return {
        init: function() {
            coursefiles.addEventListener('change', () => this.displayFileNames());

            const initialheight = coursedescription.clientHeight;
            coursedescription.addEventListener('input', function() {
                const maxlines = 9;
                const lineheight = parseFloat(getComputedStyle(coursedescription).lineHeight);
                const lines = coursedescription.value.split('\n').length;

                let newheight;
                if (lines * lineheight < initialheight) {
                    newheight = initialheight;
                } else if (lines <= maxlines) {
                    newheight = lines * lineheight;
                    coursedescription.style.overflowY = 'hidden';
                } else {
                    newheight = maxlines * lineheight;
                    coursedescription.style.overflowY = 'scroll';
                }

                // Additional padding.
                newheight += newheight > initialheight ? 14 : 0;
                coursedescription.style.height = newheight + 'px';
            });

            button.addEventListener('click', function() {
                button.disabled = true;
                successcontainer.classList.replace('d-flex', 'd-none');
                loader.classList.replace('d-none', 'd-flex');

                const formdata = new FormData();
                formdata.append('description', coursedescription.value);
                for (let i = 0; i < coursefiles.files.length; i++) {
                    formdata.append('course_files[]', coursefiles.files[i]);
                }

                fetch(`${M.cfg.wwwroot}/local/edai_course_generator_client/ajax/generate_course.php`, {
                    method: 'POST',
                    body: formdata
                })
                .then(response => {
                    return response.json().then(data => {
                        if (!response.ok) {
                            throw new Error(
                                response.status === 402 ? data.error : 'Oops, error during course creation. Please try again.'
                            );
                        }
                        return data;
                    });
                })
                .then(courseid => {
                    let successcontainer = document.getElementById('success_message_container');
                    successcontainer.innerHTML = '';
                    Templates.renderForPromise('local_edai_course_generator_client/success_box', {courseid: courseid})
                    .then(({html, js}) => {
                        Templates.appendNodeContents('#success_message_container', html, js);
                        successcontainer.classList.replace('d-none', 'd-flex');
                    });
                })
                .catch(error => {
                    alert(error.message);
                })
                .finally(() => {
                    button.disabled = false;
                    loader.classList.replace('d-flex', 'd-none');
                });
            });
        },
        displayFileNames: function() {
            filenamescontainer.innerHTML = '';
            for (let i = 0; i < coursefiles.files.length; i++) {
                const file = coursefiles.files[i];
                const fileItem = document.createElement('div');
                fileItem.textContent = file.name;
                fileItem.style.fontWeight = 'bold';
                filenamescontainer.appendChild(fileItem);
            }
        }
    };
});
