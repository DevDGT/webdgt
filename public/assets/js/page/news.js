$(document).ready(function(){
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
});

socket.on?.("articleChanged", (idNews) => {
  console.log(`Article changed ${idNews}`);
  nanobar.go(80)
  $.get(location.href, function (data) {
    $("#articleSection").html($(data).find('#articleSection').html())
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