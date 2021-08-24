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
                  <li data-aos="fade-up" data-aos-delay="${i}00">
                    <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                        data-bs-target="#faq-list-${i}}" class="collapsed">${items.question}<i
                            class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                    <div id="faq-list-${i}" class="collapse ${i === 0 ? 'show' : ''}}" data-bs-parent=".faq-list">
                        <p>
                            ${items.answers}
                        </p>
                    </div>
                </li>
                  `;
                $("#faqData").html(faq).removeClass('d-none');
                resolve(true);
            });
        });
    });
}