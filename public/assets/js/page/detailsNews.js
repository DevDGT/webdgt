$(document).ready(function(){
    var detailApi = `${API_PATH}/public/get/article?slug=${SLUG}&detail=true`;
        
    $.getJSON(detailApi, {
        format: 'json'
    }).done(function(response){
        if (response.status == 'ok') {
            const newsData = response.data[0]
            $(".newsTitle").text(`${newsData.title}`)
            $(".webTitle").text(`${newsData.title}`)
            $(".newsTime").text(` ${moment(newsData.updated_at).format('MMMM D YYYY')}`)
            $(".newsContent").html(newsData.content)
            $(".ogDesc").html(newsData.description)
            $(".newsAuthor").html(` ${newsData.author}`)
            $(".newsCover").attr('src',`${BASE_URL}/uploads/cover/${newsData.cover.trim()}`)
            $(".newsRoti")
                .append(`<li><a href="${BASE_URL}/category/${newsData.category_slug}">${newsData.category}</a></li>`)
                .append(`<li><a href="${BASE_URL}">${newsData.title}</a></li>`)
        }
    });
});