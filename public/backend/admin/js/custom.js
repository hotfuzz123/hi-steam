$(window).on("load", function () {
    $(".loader").fadeOut("slow");
});

// Đổi dữ liệu từ input qua slug tự động
function ChangeToSlug() {
    var slug;

    //Lấy text từ thẻ input title
    slug = document.getElementById("slug").value;
    slug = slug.toLowerCase();
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    document.getElementById('convert_slug').value = slug;
}

$(document).ready(function () {
    // Check Admin Password is correct or not
    $("#current_pwd").keyup(function () {
        var current_pwd = $("#current_pwd").val();
        //alert(current_pwd);
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                current_pwd: current_pwd
            },
            success: function (resp) {
                if (resp == "false") {
                    $("#chkCurrentPwd").html("<font color=red>Mật khẩu hiện tại sai rồi!!!</font>");
                } else if (resp == "true") {
                    $("#chkCurrentPwd").html("<font color=green>Mật khẩu hiện tại đúng rồi</font>");
                }
            },
            error: function () {
                alert("Bị lỗi !!!");
            }
        });
    });

    // Add effect to bs5 alert
    setTimeout(function () {
        $('#alert').slideUp();
    },4000);

    // Show SweetAlert from delete
    $('.dltBtn').click(function(e) {
        var form = $(this).closest('form');
        var dataID = $(this).data('id');
        e.preventDefault();
        swal({
            title: "Bạn có chắc không?",
            text: "Khi dữ liệu bị xoá thì không thể khôi phục lại được!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                form.submit();
                swal("Dữ liệu của bạn đã bị xoá!", {
                    icon: "success",
              });
            } else {
              swal("Dữ liệu của bạn an toàn!");
            }
          });
    });
});

