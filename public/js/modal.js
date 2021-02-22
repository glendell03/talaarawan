const modal = () => {
  let search = document.getElementById("showModal");
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
  var now = new Date();
  var month = now.getMonth() + 1;
  var day = now.getDate();
  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;
  var today = now.getFullYear() + "-" + month + "-" + day;
  $("#myDate").val(today);
});
