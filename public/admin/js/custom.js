$(document).ready(function () {
    $(".select2").select2();
});

$(document).on("click", ".destroy", function () {
    let url = $(this).attr("route");
    let id = $(this).data("id");
console.log(url);
    url = url.replace("destroy", id);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    Swal.fire({
        title: "Do you want to delete this data?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancel",
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.isConfirmed) {
            pageLoader(true);
            $.ajax({
                type: "DELETE",
                url: url,
                data: { id: id },
                success: function (response) {
                    if (response.code == 200) {
                        dTReload();
                        pageLoader(false);
                    } else {
                        toastr.error(response.alert);
                        pageLoader(false);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("An error occurred while deleting the data.");
                    pageLoader(false);
                }
            });
        }
    });
});


$(document).on("click", ".atendent_delete", function () {
    let id = $(this).data("id");
    let task = $(this).data("task");
    let url = $(this).attr("route");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    Swal.fire({
        title: "İşci bu taskın təhim olunalarıdan çıxarılsın?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "İmtina et",
        confirmButtonText: "Təsdiqlə",
    }).then((result) => {
        if (result.isConfirmed) {
            if (result.isConfirmed) {
                $.ajax({
                    type: "Post",
                    url: url,
                    data: { id: id, task: task },
                    success: function (response) {
                        if (response.code == 200) {
                            toastr.success("Fayl silindi");
                            $("#task-peron-" + id).remove();
                            $(".data-tabe").DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                });
            }
        }
    });
});

$(document).on("click", "#file-delete", function () {
    let id = $(this).data("id");
    let task = $(this).data("task");
    let url = $(this).attr("route");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    Swal.fire({
        title: "Faylı silmək isətiyinizdən əminsiz?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "İmtina et",
        confirmButtonText: "Sil",
    }).then((result) => {
        if (result.isConfirmed) {
            if (result.isConfirmed) {
                $.ajax({
                    type: "Post",
                    url: url,
                    data: { id: id, task: task },
                    success: function (response) {
                        if (response.code == 200) {
                            toastr.success("Fayl silindi");
                            $("#file-box-" + id).remove();
                            $(".data-tabe").DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                });
            }
        }
    });
});

$(document).on("click", "#comment-delete", function () {
    let id = $(this).data("id");
    let task = $(this).data("task");
    let url = $(this).attr("route");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    Swal.fire({
        title: "Siz bu tapşırığın şərhini silmək istəyirsiniz?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "İmtina et",
        confirmButtonText: "Təsdiqlə",
    }).then((result) => {
        if (result.isConfirmed) {
            if (result.isConfirmed) {
                $.ajax({
                    type: "Post",
                    url: url,
                    data: { id: id, task: task },
                    success: function (response) {
                        if (response.code == 200) {
                            toastr.success("Şərh silindi");
                            $("#task-peron-" + id).remove();
                            $(".data-tabe").DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                });
            }
        }
    });
});

$(document).on("change", ".status", function (e) {
    let url = $(this).data("toggle-url");
    $.getJSON(url, function (data, textStatus, jqXHR) {
        toastr.success("Status dəyişdi");
    });
});

// assine user filter
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("span")[0];
        console.log(a);
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

// let
// localStorage.setItem('theme', 'dark');
// let sotore = localStorage.getItem('theme')

// mode.setAttribute('data-layout-mode',sotore)
$(document).on("click", ".light-dark-mode", function () {
    modes = ["dark", "light"];
    sessionStorage.setItem(
        "data-layout-mode",
        sessionStorage.getItem("data-layout-mode") == "light" ? "dark" : "light"
    );
});
// Create modal
// const profilFotografiGiris = document.getElementById("profil-fotografi");
// const profilFotografiGoster = document.getElementById(
//     "profil-fotografi-goster"
// );

// profilFotografiGiris.addEventListener("change", function () {
//     if (this.files && this.files[0]) {
//         var okuyucu = new FileReader();
//         okuyucu.onload = function (e) {
//             localStorage.setItem("profilFotografi", e.target.result);
//             profilFotografiGoster.setAttribute("src", e.target.result);
//         };
//         okuyucu.readAsDataURL(this.files[0]);
//     } else {
//         localStorage.removeItem("profilFotografi");
//         profilFotografiGoster.setAttribute(
//             "src",
//             "https://png.pngtree.com/png-vector/20191009/ourlarge/pngtree-user-icon-png-image_1796659.jpg"
//         );
//     }
// });

// const editprofilFotografiGiris = document.getElementById(
//     "edit-profil-fotografi"
// );
// const editprofilFotografiGoster = document.getElementById(
//     "edit-profil-fotografi-goster"
// );

//Edit modal
// editprofilFotografiGiris.addEventListener("change", function () {
//     if (this.files && this.files[0]) {
//         var editokuyucu = new FileReader();
//         editokuyucu.onload = function (e) {
//             localStorage.setItem("editprofilFotografi", e.target.result);
//             editprofilFotografiGoster.setAttribute("src", e.target.result);
//         };
//         editokuyucu.readAsDataURL(this.files[0]);
//     } else {
//         localStorage.removeItem("editprofilFotografi");
//         editprofilFotografiGoster.setAttribute(
//             "src",
//             "https://png.pngtree.com/png-vector/20191009/ourlarge/pngtree-user-icon-png-image_1796659.jpg"
//         );
//     }
// });

window.onload = function () {
    const kaydedilmisProfilFotografi = localStorage.getItem("profilFotografi");
    if (kaydedilmisProfilFotografi) {
        profilFotografiGoster.setAttribute("src", kaydedilmisProfilFotografi);
    }

    const editkaydedilmisProfilFotografi = localStorage.getItem(
        "editprofilFotografi"
    );
    if (editkaydedilmisProfilFotografi) {
        editprofilFotografiGoster.setAttribute(
            "src",
            editkaydedilmisProfilFotografi
        );
    }
};

// const toggleSwitch = document.querySelector('.header-item .light-dark-mode');

//     function switchTheme(e) {
//         if (e.target.checked) {
//             document.documentElement.setAttribute('data-layout-mode', 'dark');
//             localStorage.setItem('theme', 'dark');
//         } else {

//             document.documentElement.setAttribute('data-layout-mode', 'light');
//             localStorage.setItem('theme', 'light');
//         }
//     }

//     const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;

//     if (currentTheme) {
//         document.documentElement.setAttribute('data-layout-mode', currentTheme);

//         if (currentTheme === 'dark') {
//             toggleSwitch.checked = true;
//         }
//     }

//     toggleSwitch.addEventListener('change', switchTheme, false);

function phoneMask() {
    document.addEventListener("DOMContentLoaded", function () {
        var phoneInputs = document.querySelectorAll(".phone");
        var maskOptions = {
            mask: "+994 00 000 00 00",
        };
        for (var i = 0; i < phoneInputs.length; i++) {
            new IMask(phoneInputs[i], maskOptions);
        }
    });
}

phoneMask();
