window.addEventListener("load", async function () {
    const activeDiscountContainer = document.querySelector(".active-container");
    const archivedDiscountContainer = document.querySelector(
        ".archived-container"
    );

    const loading = document.querySelector(".loading");
    const searchInput = document.querySelector("#search");

    const param = window.location.pathname;
    const fetchRoute = param.replace("/", "");

    let savedData;

    async function fetchElements() {
        try {
            const response = await axios.get(`/api/${fetchRoute}`);
            const activeDiscounts = response.data.active;
            const archivedDiscounts = response.data.archived;

            return {
                activeDiscounts: activeDiscounts,
                archivedDiscounts: archivedDiscounts,
            };
        } catch (error) {
            console.error("Error fetching elements:", error);
        }
    }

    async function loadElements(data, container, searchText) {
        try {
            container.innerHTML = "";
            data.forEach((discount) => {
                const searchFilter =
                    typeof searchText === "string"
                        ? searchText.toLowerCase()
                        : "";

                if (
                    discount.name &&
                    discount.name.toLowerCase().includes(searchFilter)
                ) {
                    createListCard(discount, container);
                }
            });

            loading.classList.add("d-none");
        } catch (error) {
            console.error("Error loading elements:", error);
        }
    }

    function createListCard(discount, container) {
        let card = document.createElement("div");

        card.innerHTML = `             
        <div class="product-item border rounded-3 mb-2 d-flex align-items-center justify-content-between custom-bg-white font-size-12 px-4">
            <span class="dbrand me-3 font-size-13 font-weight-500">${discount.name}</span>
            <div class="button-group">
                <div class="edit-icon">
                    <a href="${fetchRoute}/${discount.id}/edit">
                        <img src="../images/edit-icon.svg" alt="">
                    </a>
                </div>
            </div>
        `;
        container.appendChild(card);
    }

    searchInput.addEventListener("input", async function () {
        const searchText = searchInput.value.trim();

        await loadElements(
            savedData.activeDiscounts,
            activeDiscountContainer,
            searchText
        );

        await loadElements(
            savedData.archivedDiscounts,
            archivedDiscountContainer,
            searchText
        );
    });

    savedData = await fetchElements();

    await loadElements(savedData.activeDiscounts, activeDiscountContainer);
    await loadElements(savedData.archivedDiscounts, archivedDiscountContainer);
});
