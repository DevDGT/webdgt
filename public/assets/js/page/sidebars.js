$(document).ready(function () {
    getCategory();
    getRecentPost();
    getTags();
});

function getTags() {
    var tagsAPI = `${API_PATH}/public/get/tags`;
    $.getJSON(tagsAPI, {
        format: 'json'
    }).done(function (response) {
        let tags = '';
        $.each(response.data, function (i, items) {
            tags += `
                <li><a href="${BASE_URL}/news/tags/${items}">${items}</a></li>
            `;
            $('#newsTags').html(tags);
        });
    });
}

function getCategory() {
    var categoryAPI = `${API_PATH}/public/get/category`;
    $.getJSON(categoryAPI, {
        format: 'json'
    }).done(function (response) {
        let category = '';
        $.each(response.data, function (i, items) {
            category += `
            <li><a href="${BASE_URL}/news/category/${items.slug}">${items.name}<span>(${items.count})</span></a></li>
            `;
            $('#newsCategory').html(category);
        });
    });
}

function getRecentPost() {
    var recentAPI = `${API_PATH}/public/get/article?limit=5`;
    $.getJSON(recentAPI, {
        format: 'json'
    }).done(function (response) {
        let recent = '';
        $.each(response.data, function (i, items) {
            var localeDate = new Date(items.created_at);
            var newDate = localeDate.toISOString().substring(0, 10);
            recent += `
            <div class="post-item clearfix">
                <img src="${BASE_URL}/uploads/cover/${items.cover}" alt="${items.cover}">
                <h4><a href="${BASE_URL}/news/${items.slug}">${items.title}</a></h4>
                <time>${newDate}</time>
            </div>
            `;
            $('#recentPost').html(recent);
        });
    });
}
