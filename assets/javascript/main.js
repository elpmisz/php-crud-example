window.setTimeout(function () {
  $(".toast")
    .fadeTo(1000, 0)
    .slideUp(500, function () {
      $(this).remove();
    });
}, 3000);

let forms = document.getElementsByClassName("needs-validation");
let validation = Array.prototype.filter.call(forms, function (form) {
  form.addEventListener(
    "submit",
    function (event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add("was-validated");
    },
    false
  );
});

$(document).on("click", ".logout", function (e) {
  e.preventDefault();
  Swal.fire({
    title: "ยืนยันที่จะทำรายการ?",
    text: "ออกจากระบบ!",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "ยืนยัน",
    cancelButtonText: "ปิด",
  }).then((result) => {
    if (result.value) {
      window.location.href = "/auth/logout";
    } else {
      return false;
    }
  });
});
