window.addEventListener("load", async function () {
    const listContainer = document.querySelector(".list-container");
    const gridContainer = document.querySelector(".grid-container");
    const loading = document.querySelector(".loading");
    const paginationContainer = document.querySelector(".pagination-container");
    const searchInput = document.querySelector("#search");

    let currentPage = 1;
    let listPageSize = 10;
    let gridPageSize = 4;
    let savedData;
    let gridView = false;

    async function fetchElements() {
        try {
            const response = await axios.get(`/api/products`);

            if (response.data && response.data.list && response.data.grid) {
                savedData = response.data;

                await loadElements(savedData, currentPage);
            } else {
                throw new Error("Invalid data format");
            }
        } catch (error) {
            console.error("Error fetching elements:", error);
        }
    }

    async function loadElements(data, page) {
        try {
            const dataToPaginate = gridView ? data.grid : data.list;
            const filteredData =
                searchInput.value.trim() !== ""
                    ? filterData(dataToPaginate, searchInput.value.trim())
                    : dataToPaginate;
            const paginatedData = paginate(
                filteredData,
                gridView ? gridPageSize : listPageSize,
                page
            );

            listContainer.innerHTML = "";
            gridContainer.innerHTML = "";

            paginatedData.forEach((product) => {
                gridView ? createGridCard(product) : createListCard(product);
            });

            loading.classList.add("d-none");

            updatePaginationButtons(
                page,
                filteredData,
                gridView ? gridPageSize : listPageSize
            );
        } catch (error) {
            console.error("Error loading elements:", error);
        }
    }

    function filterData(data, query) {
        return data.filter((product) => {
            return product.name.toLowerCase().includes(query.toLowerCase());
        });
    }

    function paginate(array, pageSize, pageNumber) {
        try {
            --pageNumber;
            const startIndex = pageNumber * pageSize;
            const endIndex = startIndex + pageSize;

            return array.slice(startIndex, endIndex);
        } catch (error) {
            console.error("Error paginating:", error);
            return [];
        }
    }

    function updatePaginationButtons(page, data, pageSize) {
        paginationContainer.innerHTML = "";
        const totalPages = Math.ceil(data.length / pageSize);
        const maxVisiblePages = 5;
        const visiblePages = [];

        let startPage = Math.max(1, page - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

        if (endPage - startPage + 1 < maxVisiblePages) {
            if (startPage === 1) {
                endPage = Math.min(maxVisiblePages, totalPages);
            } else {
                startPage = Math.max(1, totalPages - maxVisiblePages + 1);
            }
        }

        const backwardArrow = document.createElement("button");
        backwardArrow.innerHTML =
            '<img src="../images/arrow-left-icon.svg" alt="">';
        backwardArrow.classList.add("page-button", "backward-arrow");
        backwardArrow.addEventListener("click", async function () {
            if (page > 1) {
                currentPage = page - 1;
                await loadElements(savedData, currentPage);
            }
        });
        paginationContainer.appendChild(backwardArrow);

        if (startPage > 1) {
            visiblePages.push(1);
            if (startPage > 2) {
                visiblePages.push("...");
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            visiblePages.push(i);
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                visiblePages.push("...");
            }
            visiblePages.push(totalPages);
        }

        visiblePages.forEach((pageNumber, index) => {
            const button = document.createElement("button");
            button.textContent = pageNumber;
            button.classList.add("page-button");
            if (pageNumber === page) {
                button.classList.add("active-text");
            }
            if (pageNumber === "...") {
                button.addEventListener("click", async function () {
                    let nextVisiblePage = endPage + 1;
                    let prevVisiblePage = startPage - 1;
                    if (nextVisiblePage > totalPages) {
                        nextVisiblePage = 1;
                    }
                    if (prevVisiblePage < 1) {
                        prevVisiblePage = totalPages;
                    }
                    if (
                        this.previousElementSibling.textContent !== "..." &&
                        this.previousElementSibling.textContent !== "1"
                    ) {
                        currentPage = nextVisiblePage;
                    } else {
                        currentPage = prevVisiblePage;
                    }
                    await loadElements(savedData, currentPage);
                });
            } else {
                button.addEventListener("click", async function () {
                    currentPage = pageNumber;
                    await loadElements(savedData, currentPage);
                });
            }
            paginationContainer.appendChild(button);

            if (
                pageNumber !== "..." &&
                index < visiblePages.length - 1 &&
                visiblePages[index + 1] !== "..."
            ) {
                const dot = document.createElement("span");
                dot.textContent = "•";
                paginationContainer.appendChild(dot);
            }
        });

        const forwardArrow = document.createElement("button");
        forwardArrow.innerHTML =
            '<img src="../images/arrow-right-icon.svg" alt="">';

        forwardArrow.classList.add("page-button", "forward-arrow");
        forwardArrow.addEventListener("click", async function () {
            if (page < totalPages) {
                currentPage = page + 1;
                await loadElements(savedData, currentPage);
            }
        });
        paginationContainer.appendChild(forwardArrow);
    }

    function createListCard(product) {
        let card = document.createElement("div");

        card.innerHTML = `
        <div class="product-item border rounded-3 mb-2 d-flex align-items-center justify-content-between custom-bg-white font-size-12 px-4">
        <span class="id h5 me-3 mb-0 color-fancy-olive font-size-15 font-weight-500">0${product.id}</span>
        <span class="brand me-3 font-size-13 font-weight-500">${product.name}</span>
        <div class="button-group">
            <div class="icon-wrapper">
                <a href="products/${product.id}/edit">
            <img src="../images/edit-icon.svg" alt="">
            </a>
            </div>
        </div>
    </div>

        `;
        listContainer.appendChild(card);
    }

    function createGridCard(product) {
        let card = document.createElement("div");
        card.classList.add("col-md-6", "mb-4", "gridProducts");
        let quantityText;
        if (product.quantity === 0) {
            quantityText = "Продадено";
        } else if (product.quantity === 1) {
            quantityText = "Само 1 парче";
        } else {
            quantityText = `${product.quantity} парчиња`;
        }

        let carouselId = `carouselExampleFade${product.id}`;

        let carouselItemsHtml = "";

        product.images.forEach((image, index) => {
            let imagePath = "/storage/" + image.image_path;
            carouselItemsHtml += `
            <div class="carousel-item ${index === 0 ? "active" : ""} w-100">
                <div class="grid-image-size w-100" style="background-image: url(${imagePath})"></div>
            </div>
        `;
        });

        let carouselHtml = "";
        if (product.images.length) {
            carouselHtml = `
                <div id="${carouselId}" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        ${carouselItemsHtml}
                    </div>
                    ${
                        product.images.length > 1
                            ? `
                    <button class="carousel-control-prev" type="button" data-bs-target="#${carouselId}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#${carouselId}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    `
                            : ""
                    }
                </div>
            `;
        }

        card.innerHTML = `                                             
                        <div class="card custom-bg-white p-3">                                
                            <p class="font-size-15 font-cormorant-garamond m-0 mb-2">*${quantityText}</p>                          
                            ${carouselHtml}
                            <div class="card-body p-0 mt-2">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-text fw-bold color-black font-cormorant-garamond fw-normal h4 mb-3">${product.name}</h5>
                                    <h5 class="card-text fw-bold font-weight-500 h4 color-fancy-olive font-size-18 mt-1 mb-3">0${product.id}</h5>
                                </div>
                                <p class="card-text font-size-13 color-dark-grey mb-1">Боја:                                       
                                ${product.colors
                                    .map(
                                        (color) => `
                                <span class="badge" style="background-color: ${color.hex_code}; width: 13px; height: 13px;" value=""> </span>
                            `
                                    )
                                    .join(
                                        ""
                                    )}                                         
                                </p>
                                <div class="d-flex justify-content-between">
                                <p class="card-text mt-2 font-size-13 color-dark-grey">Величина: <span class="text-dark font-weight-500"> ${product.sizes
                                    .map((size) => size.name)
                                    .join(", ")}  </span</p>
                                    <p class="card-text font-size-13 color-dark-grey m-0">Цена: <span class="text-dark font-weight-500 font-size-20 font-cormorant-garamond">${product.price} ден.</span></p>

                                </div>
                            </div>
                        </div>                                          
            `;
        gridContainer.appendChild(card);
    }

    const gridViewButton = document.querySelector(".grid-trigger");
    gridViewButton.addEventListener("click", async function () {
        if (!gridView) {
            gridView = true;
            currentPage = 1;
            await loadElements(savedData, currentPage);
            gridViewButton.closest("div").classList.toggle("active");
            listViewButton.closest("div").classList.toggle("active");
        }
    });

    const listViewButton = document.querySelector(".list-trigger");
    listViewButton.addEventListener("click", async function () {
        if (gridView) {
            gridView = false;
            currentPage = 1;
            await loadElements(savedData, currentPage);
            gridViewButton.closest("div").classList.toggle("active");
            listViewButton.closest("div").classList.toggle("active");
        }
    });

    searchInput.addEventListener("input", async function () {
        currentPage = 1; // Reset to first page when search query changes
        await loadElements(savedData, currentPage);
    });

    await fetchElements();
    listViewButton.classList.add("active-text");
});
