$(document).ready(function(){
    (function() {

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
                        <img src="${BASE_URL}/uploads/cover/${items.cover}" alt="${items.cover}" class="img-fluid p-2">
                        </div>

                        <h2 class="entry-title">
                            <a href="${BASE_URL}/news/${items.slug}">${items.title}</a>
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