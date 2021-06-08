$(document).ready(function(){
    (function() {

        // buat get detail article jangan pake id kalau memungkinkan, pake slug 
        // udah om 
        // http://192.168.1.25/web/public/api/public/get/article?slug=tutorial-sederhana-untuk-membuat-desain-sistem&detail=true
        
        var tagsAPI = `${API_PATH}/public/get/tags`;
        
        $.getJSON(tagsAPI, {
            format: 'json'
        }).done(function(response){
            let tags = '';
            $.each(response.data, function(i, items){
                tags += `
                    <li><a href="${API_PATH}/public/get/article?limit=5&page=1&tags=${items}">${items}</a></li>
                `;
                $('#newsTags').html(tags);
            });
            // console.log(response);
        });
        
        var categoryAPI = `${API_PATH}/public/get/category`;
        
        $.getJSON(categoryAPI, {
            format: 'json'
        }).done(function(response){
            let category = '';
            $.each(response.data, function(i, items){
                category += `
                    <li><a href="${API_PATH}/public/get/article?limit=5&page=1&category=${items.slug}">${items.name}<span>(${items.count})</span></a></li>
                `;
                $('#newsCategory').html(category);
            });
            // console.log(response);
        });
    })();
});