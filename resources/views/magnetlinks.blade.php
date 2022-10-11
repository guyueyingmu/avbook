
<?php  foreach($res_mg as $key=>$val): ?>


<tr onmouseover="this.style.backgroundColor='#F4F9FD';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#FFFFFF'" style=" border-top:#DDDDDD solid 1px" height="35px"  >
    <td width="70%"  >
        <a style="color:#333" rel="nofollow" title="滑鼠右鍵點擊並選擇【複製連結網址】"
           href="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_link'] ?>">
            <?php echo $val['magnet_name']."{$val['have_down']}" ?></a>

        <?php  if($val['have_hd']==1):?>
        <a class="btn btn-mini-new btn-primary disabled" title="包含高清HD的磁力連結">高清</a>
        <?php endif; ?>
        <?php  if($val['have_sub']==1):?>
        <a class="btn btn-mini-new btn-warning disabled" title="包含字幕的磁力連結">字幕</a>
        <?php endif; ?>

    </td>
    <td style="text-align:center;white-space:nowrap" onclick=" ">
        <a style="color:#333" rel="nofollow" title="滑鼠右鍵點擊並選擇【複製連結網址】"
           href="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_link'] ?>">
            <?php echo $val['magnet_type'] ?>                	</a>
    </td>
    <td style="text-align:center;white-space:nowrap" onclick=" ">
        <a style="color:#333" rel="nofollow" title="滑鼠右鍵點擊並選擇【複製連結網址】"
           href="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_link'] ?>">
            <?php echo $val['magnet_date'] ?>              	</a>
    </td>
</tr>

<?php endforeach; ?>

<?php  if(count($res_mg)<1):?>
<tr style="color:#555;"><td colspan="4">暫時沒有磁力連結 <a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=f71f5d2e78338026311fd33917635a0de7e854f7133990902009fa2cae9bf1f4"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="秋名山居民委员会" title="秋名山居民委员会 317599191"></a> 317599191一起寻找稀有资源</td></tr>
<?php endif; ?>



<!--	  -->
<script type="text/javascript">
    function ajaxaddmg(s,h){
        var t = "../ajaxaddmg/?magnet_xt="+s+"&code_36="+code_36+"&have_down="+h   ;
        $.ajax({
            url: t,
            type: "GET",
            success: function(ree) {
                ShowMsg('成功');
                $("#magnet-table").html('');
                uncledatoolsbyajax();
                //location.href=location.href;
                //$("#magnet-table").append(e)
            }
        });
    };

    $('.gotodown').click(function (e) {
        ajaxaddmg( $(this).attr("v1"),2);
    });
    $('.gotodownnow').click(function (e) {
        ajaxaddmg( $(this).attr("v1"),3);
        //Components.classes["@mozilla.org/widget/clipboardhelper;1"].getService(Components.interfaces.nsIClipboardHelper).copyString($(this).attr("v2"));

    });
    $('.gotodownnowhave').click(function (e) {
        ajaxaddmg( $(this).attr("v1"),9);
        //Components.classes["@mozilla.org/widget/clipboardhelper;1"].getService(Components.interfaces.nsIClipboardHelper).copyString($(this).attr("v2"));

    });
    $('.notdown').click(function (e) {

        ajaxaddmg( $(this).attr("v1"),0);
    });

    $('#movie-loading').hide();
</script>