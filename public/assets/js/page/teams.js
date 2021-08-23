$(document).ready(function () {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const uris = urlParams.get('name');
    // console.log(queryString);
    // console.log(urlParams);
    // console.log(uris);
    getTeamsName(uris);
});

function getTeamsName(uname) {
    var name = uname;
    return new Promise(resolve => {
        var unameAPI = `${API_PATH}/public/get/teams-page?username=` + name;
        $.getJSON(unameAPI, {
            format: 'json'
        }).done(res => {
            // console.log(res.data);
            let pageCss = res.data.css;
            let pageHtml = res.data.html;
            let pagejs = res.data.js;
            $('#pagesName').text(`${name}`);
            $('#crubsName').text(`${name}`);
            $('#myPagesCss').html(pageCss);
            $('#myPagesHtml').html(pageHtml);
            $('#myPagesJs').html(pagejs);

            resolve(true);
        });
    });

}