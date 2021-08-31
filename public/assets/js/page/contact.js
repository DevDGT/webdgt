$(document).ready(function () {

    getCategoryFaq();
    getFaq();
    $("#portfolio-flters").on("click", ".options", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $("#coreCategory").removeClass("filter-active");
        $(".options").removeClass("filter-active");
        // $(".tab").addClass("active"); // instead of this do the below
        $(this).addClass("filter-active");
        getFaq(id);
    });

})

async function getCategoryFaq() {
    return new Promise((resolve) => {
        var faqAPI = `${API_PATH}/public/get/category-faq`;
        $.getJSON(faqAPI, {
            format: "json",
        }).done(function (response) {
            let categorys = ``;
            categorys += `<li data-filter="*" id="coreCategory" class="filter-active" onclick="getFaq()">All</li>`;
            $.each(response.data, function (i, items) {
                categorys += `<li data-filter=".filter-${items.name}" class="options" data-id="${items.name}" id="category${items.name}">${items.name}</li>`;
                $("#portfolio-flters").html(categorys);
                resolve(true);
            });
        });
    });
}


async function getFaq(ids = null) {
    return new Promise((resolve) => {
        var faqAPI = `${API_PATH}/public/get/faq`;
        if (ids == null) {
            var mark = true;
        } else {
            var mark = false;
        }
        $.getJSON(faqAPI, {
            format: "json",
        }).done(function (response) {
            let faq = "";
            $.each(response.data, function (i, items) {
                if (mark == false) {
                    if (ids.toLowerCase() != items.category) {
                        faq += ``;
                    } else {
                        faq += `
                        <li data-aos="zoom-out portfolio-item filter-${items.category}" data-aos-delay="${i + 1}000">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a href="#" data-bs-toggle="collapse" data-bs-target="#faq-list-${i + 1}" class="collapsed">${items.question}
                            <i class="bx bx-chevron-down icon-show"></i>
                            <i class="bx bx-chevron-up icon-close"></i>
                            </a>
                            <div id="faq-list-${i + 1}" class="collapse ${i === 0 ? 'show' : ''}" data-bs-parent=".faq-list">
                                <p>
                                    ${items.answers}
                                    </p>
                                    <a href="${BASE_URL}/faqs/${items.category}/${items.slug}" class="p-0" target="_blank">More details<i class="bx bx-chevron-right"></i></a>
                            </div>
                            </li>
                        `;
                    }
                } else {
                    faq += `
                    <li data-aos="zoom-out portfolio-item filter-${items.category}" data-aos-delay="${i + 1}000">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a href="#" data-bs-toggle="collapse" data-bs-target="#faq-list-${i + 1}" class="collapsed">${items.question}
                        <i class="bx bx-chevron-down icon-show"></i>
                        <i class="bx bx-chevron-up icon-close"></i>
                        </a>
                        <div id="faq-list-${i + 1}" class="collapse ${i === 0 ? 'show' : ''}" data-bs-parent=".faq-list">
                            <p>
                                ${items.answers}
                                </p>
                                <a href="${BASE_URL}/faqs/${items.category}/${items.slug}" class="p-0" target="_blank">More details<i class="bx bx-chevron-right"></i></a>
                        </div>
                        </li>
                        `;
                }

                $("#faqData").html(faq);
                resolve(true);
            });
        });
    });
}