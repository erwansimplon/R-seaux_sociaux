<?php
function ajax() {
?>
  <script type="text/javascript">
    $(function()
    {
    $(".view_comments").click(function()
    {

    var ID = $(this).attr("id");

    $.ajax({
    type: "POST",
    url: "../actu/viewajax.php",
    data: "msg_id="+ ID,
    cache: false,
    success: function(html){
    $("#view_comments"+ID).prepend(html);
    $("#view"+ID).remove();
    $("#two_comments"+ID).remove();
    }
    });

    return false;
    });
    });

  </script>
<?php
}
?>
