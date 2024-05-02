$(".select2").select2();

document.addEventListener("DOMContentLoaded", function () {
    const submitForm = document.querySelector("#submit_form");
    let tagsInput = document.querySelector('input[name="tags[]"]');
    let categoriesSelect = document.getElementById("categories");
    const imageInput = document.querySelector("#images");

    const discountProducts = document.querySelector(
        'input[name="pre-products"]'
    );

    imageInput && handleImage();
    tagsInput && handleTags();
    categoriesSelect && handleSelect();
    discountProducts && handleDiscount();

    function handleTags() {
        console.log("handleTags funkcija");
        let input = document.querySelector(
            'input[name="input-custom-dropdown"]'
        );
        console.log(input);
        let loading = document.querySelector(".loading");
        let tagsArray = [];
        let tagify;

        loading.innerHTML = "Loading...";
        input.style.display = "none";

        tagsInput.value = input.value;

        axios
            .get("/api/tags")
            .then((response) => {
                loading.innerHTML = "";
                input.style.display = "block";

                const tags = response.data.map((tag) => tag.name);

                tagify = new Tagify(input, {
                    whitelist: tags,
                    maxTags: 10,
                    dropdown: {
                        maxItems: 20,
                        classname: "tags-look",
                        enabled: 0,
                        closeOnSelect: false,
                    },
                });

                tagify.on("add", updateTagsInput);
                tagify.on("remove", updateTagsInput);
            })
            .catch((error) => {
                console.error("Error fetching tags:", error);
                input.placeholder = "Error fetching tags";
            });

        function updateTagsInput() {
            tagsArray = tagify.value.map((tag) => tag.value);
            tagsInput.value = tagsArray.join(",");
        }
    }

    function handleSelect() {
        console.log("handleSelect funkcija");

        function formatStateWithCheckbox(state) {
            if (!state.id) {
                return state.text;
            }
            let checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "form-check-input";
            checkbox.checked = state.selected ? true : false;

            let label = document.createElement("label");
            label.innerHTML = state.text;
            label.prepend(checkbox);

            let wrapper = document.createElement("span");
            wrapper.appendChild(label);

            return wrapper;
        }

        $(categoriesSelect).select2({
            placeholder: "Избери категории",
            allowClear: true,
            width: "100%",
            templateResult: formatStateWithCheckbox,
            templateSelection: function (state) {
                return state.text;
            },
        });

        $(categoriesSelect).on("select2:open", function () {
            setTimeout(function () {
                $(".select2-results__option").each(function () {
                    const $result = $(this);
                    $result.find(".form-check-input").on("click", function (e) {
                        let $checkbox = $(this);
                        let $option = $(categoriesSelect)
                            .find("option")
                            .filter(function () {
                                return (
                                    $(this).html() ==
                                    $checkbox.parent().text().trim()
                                );
                            })
                            .first();
                        $option.prop("selected", !$option.prop("selected"));
                        $(categoriesSelect).trigger("change");
                        e.stopPropagation();
                    });
                });
            });
        });
    }

    function handleDiscount() {
        console.log("handleDiscount funkcija");
        const productsPromise = axios
            .get("/api/products")
            .then((response) => {
                return response.data;
            })
            .catch((error) => {
                console.error("Error fetching products:", error);
            });

        const discountInput = document.querySelector(
            'input[name="products[]"]'
        );

        productsPromise.then((products) => {
            products = products.list;

            let tagify = new Tagify(discountProducts, {
                enforceWhitelist: true,
                whitelist: products.map((product) => product.id.toString()),
            });

            tagify
                .on("add", onAddTag)
                .on("remove", onRemoveTag)
                .on("input", onInput);

            let mockAjax = (function mockAjax() {
                let timeout;
                return function (duration) {
                    clearTimeout(timeout); // abort last request
                    return new Promise(function (resolve, reject) {
                        timeout = setTimeout(
                            resolve,
                            duration || 700,
                            products.map((product) => product.id.toString())
                        );
                    });
                };
            })();

            function onAddTag() {
                updateProductInput();
            }

            function onRemoveTag() {
                updateProductInput();
            }

            function updateProductInput() {
                let values = tagify.value.map((tag) => tag.value);

                discountInput.value = values.join(",");

                if (
                    values.length === 0 ||
                    (values.length === 1 && values[0] === "")
                ) {
                    discountInput.value = "";
                }
            }

            function onInput(e) {
                tagify.whitelist = null;
                tagify.loading(true);

                mockAjax()
                    .then(function (result) {
                        tagify.settings.whitelist = result.concat(tagify.value);
                        tagify.loading(false).dropdown.show(e.detail.value);
                    })
                    .catch((err) => tagify.dropdown.hide());
            }
        });
    }

    const preUploadedImages = new DataTransfer();
    function handleImage() {
        const previewContainer = document.querySelector(".preview-container");
        const closeIcons = document.querySelectorAll(".close-icon");

        if (closeIcons) {
            const fetchPromises = Array.from(closeIcons).map(async (icon) => {
                const div = icon.closest("div");
                const imgData = div.getAttribute("data-image");
                const imgSrc = div.style.backgroundImage;

                const urlMatch = imgSrc.match(/url\("?(.+?)"?\)/);
                const imageUrl = urlMatch ? urlMatch[1] : null;

                if (imageUrl) {
                    console.log(imageUrl);
                    const file = await fetchPreUploaded(imageUrl, imgData);
                    return file;
                } else {
                    console.error("Unable to extract image URL:", imgSrc);
                    return null;
                }
            });

            Promise.all(fetchPromises)
                .then((files) => {
                    files.forEach((file) => {
                        preUploadedImages.items.add(file);
                    });
                })
                .catch((error) => {
                    console.error(
                        "Error fetching or processing images:",
                        error
                    );
                });

            closeIcons.forEach((icon) => {
                const div = icon.closest("div");
                const imgData = div.getAttribute("data-image");

                icon.addEventListener("click", () => {
                    closeFile(div, imgData);
                });
            });
        }

        async function fetchPreUploaded(imgSrc, imgData) {
            const response = await fetch(imgSrc);
            const blob = await response.blob();
            return new File([blob], imgData);
        }

        function closeFile(div, imgData) {
            const filesToKeep = Array.from(preUploadedImages.files).filter(
                (file) => file.name !== imgData
            );

            preUploadedImages.items.clear();

            filesToKeep.forEach((file) => {
                preUploadedImages.items.add(file);
            });

            div.remove();
        }

        imageInput.addEventListener("change", function (e) {
            const files = Array.from(e.target.files);

            files.forEach((file) => {
                preUploadedImages.items.add(file);
                const reader = new FileReader();

                reader.onload = function (e) {
                    const div = document.createElement("div");
                    const closeIcon = document.createElement("i");
                    const labelUploadIcon = document.querySelector(
                        ".custom-file-upload"
                    );

                    div.classList.add("position-relative");
                    div.classList.add("me-3");

                    closeIcon.classList.add("close-icon");
                    closeIcon.classList.add("fa-solid");
                    closeIcon.classList.add("fa-circle-xmark");
                    closeIcon.classList.add("position-absolute");
                    closeIcon.style.right = "2";
                    closeIcon.style.top = "2";
                    closeIcon.style.color = "red";

                    div.appendChild(closeIcon);

                    div.style.backgroundImage = `url(${e.target.result})`;
                    div.setAttribute("data-image", file.name);
                    div.classList.add("image-upload-view");

                    closeIcon.addEventListener("click", function () {
                        closeFile(div, file.name);
                    });

                    if (labelUploadIcon) {
                        if (labelUploadIcon.parentNode) {
                            labelUploadIcon.parentNode.insertBefore(
                                div,
                                labelUploadIcon
                            );
                        }
                    } else {
                        previewContainer.appendChild(div);
                    }
                };

                reader.readAsDataURL(file);
            });
        });
    }

    submitForm.addEventListener("submit", (e) => {
        imageInput.files = preUploadedImages.files;
    });
});
