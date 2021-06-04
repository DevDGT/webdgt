$(document).ready(function(){
    var tagsAPI = `${API_PATH}/public/get/article?slug=${SLUG}&detail=true`;
        
        $.getJSON(tagsAPI, {
            format: 'json'
        }).done(function(response){
            // let tags = '';
            // $.each(response.data, function(i, items){
            //     tags += `
            //         <li><a href="${API_PATH}/public/get/article?limit=5&page=1&tags=${items}">${items}</a></li>
            //     `;
            //     $('#newsTags').html(tags);
            // });
            console.log(response);
        });
});