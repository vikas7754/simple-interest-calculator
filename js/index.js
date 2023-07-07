function search() {
  let filter = document.getElementById("myInput").value.toUpperCase();

  let list = document.getElementsByClassName("list");
  for (var i = 0; i < list.length; i++) {
    let a = list[i].getElementsByTagName("a")[0];
    let textValue = a.textContent || a.innerHTML;
    if (textValue.toUpperCase().indexOf(filter) > -1) {
      list[i].style.display = "";
    } else {
      list[i].style.display = "none";
    }
  }
}

function csearch() {
  let filter = document.getElementById("mycInput").value.toUpperCase();

  let list = document.getElementsByClassName("c_list");
  for (var i = 0; i < list.length; i++) {
    let a = list[i].getElementsByTagName("a")[0];
    let textValue = a.textContent || a.innerHTML;
    if (textValue.toUpperCase().indexOf(filter) > -1) {
      list[i].style.display = "";
    } else {
      list[i].style.display = "none";
    }
  }
}

var closeButtons = $('.close_window');
var op = $('.modal');
closeButtons.on('click', function() {
  op.modal('hide');
});

$(document).ready(function () {
  $(".deletebtn").on("click", function () {
    $("#deletemodal").modal("show");

    $tr = $(this).closest("tr");

    var data = $tr
      .children("td")
      .map(function () {
        return $(this).text();
      })
      .get();

    console.log(data);

    $("#delete_id").val(data[0]);
  });
});
