/**
 * Created by YOGA on 2017/7/17.
 */
/**
 * Created by YOGA on 2017/7/17.
 */
var xmlhttp;
var xmlhttp1;
var select;
/* var obj=document.getElementById("serch");
 obj.addEventListener("click",Serchuser,false);*/

function createXmlHttpRequest()
{
    if(window.ActiveXObject)
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if(window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    return xmlhttp;
}

function send_request(){

    select=document.getElementById("select").value;
    createXmlHttpRequest();
    if(select=="0")
        var url="?controller=User&action=list";
    else
        url="?controller=User&action=list&select="+select;
    xmlhttp.onreadystatechange=processRequest;
    xmlhttp.open("GET",url,true);
    xmlhttp.send(null)


    //alert(url);
}
function processRequest() {
    if (xmlhttp.readyState == 4){
        if (xmlhttp.status == 200) {
            window.location="?controller=User&action=list&select="+select;
        }

    }
}
function getQueryUrl(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return decodeURIComponent(r[2]); return null;
}

function tbody(data) {
    for (var i = 0; i < data.users.length; i++) {
        $(".tablebody").append(
            "<tr class='line'>" +
            "<td class='id'>" + data.users[i].id + "</td>" +
            "<td class='name' >" + data.users[i].name + "</td>" +
            "<td class='sex'>" + data.users[i].sex + "</td> " +
            "<td class='age'>" + data.users[i].age + "</td> " +
            "<td class='comment'>" + data.users[i].comment + "</td> " +
            "<td class='mange'> " +
            "<button  class='btn btn-primary' data-toggle='modal' id='mange1' data-target='#modal2' name=" + data.users[i].id + ">修改</button>" +
            "<button class='btn btn-danger' id='mange2' name=" + data.users[i].id + " > 删除</button> </td></tr> <hr>")
    }
    if ($(".tablebody").children("tr").length == 0 && getQueryUrl('page') >= 2)
        window.location = "?page=" + pagedel;
    if (data.page) {

        $("#page").append(
            "<span>总" + data.num + "用户</span> " +
            "<span>第" + data.page + "/" + data.pagenum + "页</span>" +
            " <a  name='１'>首页</a> ");
        if (data.pagelast)
            $("#page").append("<a  name=" + data.pagelast + ">上一页</a>&nbsp;&nbsp;");
        if (data.pagenext)
            $("#page").append("<a  name=" + data.pagenext + ">下一页</a>&nbsp;&nbsp;");
        $("#page").append("<a  name=" + data.pagenum + ">末页</a> " +
            "<label for='selectpage'></label> " +
            "<select name='page' id='selectpage'> </select>");
        for (i = 1; i <= data.pagenum; i++) {
            $("#page select").append("<option value=" + i + " >" + i + "</option>")

        }
    }
}



window.onload=function () {

    //alert(getQueryUrl('select'));
    if(getQueryUrl('select')=="女")
        document.getElementById("select").value="女";
    if(getQueryUrl('select')=="男")
        document.getElementById("select").value="男";
    var page=getQueryUrl('page');
    //alert(page);
    if(getQueryUrl('page'))
        document.getElementById("page").value=page;


};
$(document).ready(function () {
    $("#page").on("click","a",function (event) {
        var page = $(event.target).attr("name");
        window.location='?controller=User&action=serchuser&sex='+getQueryUrl('sex')+"&agel="+getQueryUrl('agel')+"&ager="+getQueryUrl('ager')+"&page="+page;
    });

    $(".tablebody").on("click",".mange button", function (event) {//修改  删除
        var clickNode = event.target;
        eventedit=$(clickNode).parent().parent(".line");
        var url = null;
        if ($(clickNode).attr("id") == "mange1") {
            url = "index.php?controller=User&action=modify&id=" + $(clickNode).attr("name");
            $.get(url, {}, function (data, stutas) {
                $(".edit #editid").val(data.id);
                $(".edit #editname").val(data.name);
                //alert(data.sex);
                if (data.sex == "男") {
                    $(".edit #editsex1").attr("checked", true);
                    $(".edit #editsex2").attr("checked", false);
                }
                if (data.sex == "女") {
                    $(".edit #editsex2").attr("checked", true);
                    $(".edit #editsex1").attr("checked", false);

                }
                $(".edit #editage").val(data.age);
                $(".edit #editcomment").val(data.comment);
            }, 'json');
        }
        if ($(clickNode).attr("id") == "mange2") {//删除
            url = "index.php?controller=User&action=del&id=" + $(clickNode).attr("name");
            $.get(url, {}, function () {
                $.post("index.php?controller=User&action=serchuser&sex="+getQueryUrl('sex')+"&agel="+getQueryUrl('agel')+"&ager="+getQueryUrl('ager')+"&page="+page,{delrequest:'del'},function (data) {
                    $(".tablebody").html("");
                    $("#page").html("");
                    var pagedel=getQueryUrl('page')-1;
                    tbody(data);

                },'json');
            })
        }
    });

    $("#submitedit").click(function () {
        var sex;
        if ($(".edit #editsex1").is(":checked"))
            sex = "男";
        if ($(".edit #editsex2").is(":checked"))
            sex = "女";
        $.post("index.php?controller=User&action=up", {
            id: $(".edit #editid").val(),
            name: $('.edit #editname').val(),
            sex: sex,
            age: $('.edit #editage').val(),
            comment: $('.edit #editcomment').val()

        },function (data) {
            var sex="";
            if ($(".edit #editsex1").is(":checked"))
                sex = "男";
            if ($(".edit #editsex2").is(":checked"))
                sex = "女";
            //alert(eventedit.children(".name").attr('class'));
            eventedit.children(".name").html($(".edit #editname").val());
            eventedit.children(".sex").html(sex);
            eventedit.children(".age").html($(".edit #editage").val());
            eventedit.children(".comment").html($(".edit #editcomment").val());
            $("#cancledit").click().trigger('click');

        })

    });
    $("#submitsele").click(function () {
        window.location='index.php?controller=User&action=sle&seledata='+$("#seledata").val();

    })

})
