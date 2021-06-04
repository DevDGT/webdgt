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
            console.log(response);
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

        var newsAPI = `${API_PATH}/public/get/article?limit=5&page=1`;
        $.getJSON( newsAPI, {
            format: "json"
        })
        .done(function( response ) {
            let html = '';
            $.each( response.data, function( i, items ) {
                // $( "<img>" ).attr( "src", `${BASE_URL}/uploads/cover/${items.cover}`).addClass('img-fluid').appendTo( ".images" );
                // if ( i === 1 ) {
                // return false;
                // }
                // console.log(items.cover);
                html += `
                    <article class="entry">
                        <div class="entry-img images">
                        <img src="${BASE_URL}/uploads/cover/${items.cover}" alt="${items.cover}" class="img-fluid">
                        </div>

                        <h2 class="entry-title">
                            <a href="#">${items.title}</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">${items.author}</a></li>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#">${items.created_at}</a></li>
                                <!-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="#">12 Comments</a></li> -->
                            </ul>
                        </div>

                        <div class="entry-content">
                            <p>
                                ${items.content}
                            </p>
                            <div class="read-more">
                                <a href="${BASE_URL}/news/${items.slug}">Read More</a>
                            </div>
                        </div>
                    </article>
                `;
                // console.log(items); 
            });
            $("#articleSection").html(html);
        });
    })();
});