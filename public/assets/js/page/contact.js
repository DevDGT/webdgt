$(document).ready(function () {

    getFaq();

})

async function getFaq() {
    return new Promise((resolve) => {
        var faqAPI = `${API_PATH}/public/get/faq`;
        $.getJSON(faqAPI, {
            format: "json",
        }).done(function (response) {
            let faq = "";
            $.each(response.data, function (i, items) {
                console.log(items);
                faq += `
                    <li data-aos="zoom-out" data-aos-delay="${i+1}000">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a href="#" data-bs-toggle="collapse" data-bs-target="#faq-list-${i + 1}" class="collapsed">${items.question}
                            <i class="bx bx-chevron-down icon-show"></i>
                            <i class="bx bx-chevron-up icon-close"></i>
                        </a>
                        <div id="faq-list-${i + 1}" class="collapse ${i === 0 ? 'show' : ''}" data-bs-parent=".faq-list">
                            <p>
                                ${items.answers}
                            </p>
                            <a href="${BASE_URL}/faqs/${items.category_slugs}/${items.question_slugs}" class="p-0">More details<i class="bx bx-chevron-right"></i></a>
                        </div>
                    </li>
                    `;
                
                $("#faqData").html(faq);
                resolve(true);
            });
        });
    });
}