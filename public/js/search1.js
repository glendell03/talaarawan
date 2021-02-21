const showHide = () => {
  let search = document.getElementById("show");
  let body = document.querySelector("body");

  if (search.style.display === "none") {
    search.style.display = "flex";
    body.style.overflow = "hidden";
  } else {
    search.style.display = "none";
    body.style.overflow = "auto";
  }
};

$(document).ready(function () {
  $("#search").keyup(function () {
    var query = $(this).val();

    if (query != "") {
      $.ajax({
        url: "../server/search.php",
        method: "POST",
        data: {
          query: query,
        },
        success: function (data) {
          $("#result").html(data);
          $("#result").css("display", "flex");
        },
      });
    } else {
      $("#result").css("display", "none");
      $("#result").css("background-image", 'url("../img/nodata.svg")');
    }
  });
});
