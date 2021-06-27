$(document).ready(function(){
    // document.body.scrollTop = 0; // For Safari
    // document.documentElement.scrollTop = 0;
});

socket.on?.("articleChanged", (idNews) => {
  console.log(`Article changed ${idNews}`);
  nanobar.go(80)
  $.get(location.href, function (data) {
    $("#articleDetail").html($(data).find('#articleDetail').html())
    getCategory()
    getRecentPost()
    getTags()
  }).fail(function (err) {
    $("#main").html(`${err.statusText}`)
    nanobar.go(100)
    console.log(err)
  }).done(function () {
    nanobar.go(100)
  })
})