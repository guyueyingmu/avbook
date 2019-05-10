<tbody><tr style="font-weight:bold;">
    <td>磁力名稱 1<span class="glyphicon glyphicon-magnet"></span></td>
    <td style="text-align:center;white-space:nowrap">檔案大小</td>
    <td style="text-align:center;white-space:nowrap">分享日期</td>
</tr>
</tbody>
<?php  foreach($res_mg as $key=>$val): ?>


<tr onmouseover="this.style.backgroundColor='#F4F9FD';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#FFFFFF'" style=" border-top:#DDDDDD solid 1px" height="35px"  >
    <td width="70%"  >
        <a style="color:#333" rel="nofollow" title="滑鼠右鍵點擊並選擇【複製連結網址】"
           href="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_link'] ?>">
            <?php echo $val['magnet_name']."__{$val['have_down']}" ?></a>
        <?php  if($val['have_hd']==1):?>
        <a class="btn btn-mini-new btn-primary disabled" title="包含高清HD的磁力連結">高清</a>
        <?php endif; ?>
        <?php  if($val['have_sub']==1):?>
        <a class="btn btn-mini-new btn-warning disabled" title="包含字幕的磁力連結">字幕</a>
        <?php endif; ?>
        <?php  if($val['have_down']==0):?>
        <a class="btn btn-mini-new btn-warning gotodown" v2="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_link']  ?>"  v1="<?php echo $val['magnet_xt'] ?>" title="标志为待下载">addto115无效</a>
        <a class="btn btn-mini-new btn-warning gotodownnow" v2="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_link'] ?>"  v1="<?php echo $val['magnet_xt'] ?>" title="addtothunder载">115会员</a>
        <a class="btn btn-mini-new btn-warning gotodownnowhave" v2="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_name'] ?>"  v1="<?php echo $val['magnet_xt'] ?>" title="addtothunder载">have file</a>

        <?php endif; ?>
        <?php  if($val['have_down']!=0):?>
        <a class="btn btn-mini-new btn-danger notdown"  v2="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_link'] ?>"  v1="<?php echo $val['magnet_xt'] ?>" title="取消已标志下载">取消标志</a>
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
<tr style="font-weight:bold;">
    <td>磁力名稱  btso<span class="glyphicon glyphicon-magnet"></span></td>
    <td style="text-align:center;white-space:nowrap">檔案大小</td>
    <td style="text-align:center;white-space:nowrap">分享日期</td>
</tr>
<?php  foreach($res_mgbtso as $key=>$val): ?>
<tr onmouseover="this.style.backgroundColor='#F4F9FD';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor='#FFFFFF'" style=" border-top:#DDDDDD solid 1px" height="35px"  >

    <td width="70%"  >
        <a style="color:#333" rel="nofollow" title="滑鼠右鍵點擊並選擇【複製連結網址】"
           href="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']. '&dn='.$val['magnet_name'] ;?>">
            <?php echo $val['magnet_name']."__{$val['have_down']}" ?></a>
        <?php  if($val['have_hd']==1):?>
        <a class="btn btn-mini-new btn-primary disabled" title="包含高清HD的磁力連結">高清</a>
        <?php endif; ?>
        <?php  if($val['have_sub']==1):?>
        <a class="btn btn-mini-new btn-warning disabled" title="包含字幕的磁力連結">字幕</a>
        <?php endif; ?>
        <?php  if($val['have_down']==0):?>
        <a class="btn btn-mini-new btn-warning gotodown" v2="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_name'] ?>"  v1="<?php echo $val['magnet_xt'] ?>" title="标志为待下载">addto 115无效</a>
        <a class="btn btn-mini-new btn-warning gotodownnow" v2="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_name'] ?>"  v1="<?php echo $val['magnet_xt'] ?>" title="addtothunder载">115会员</a>
        <a class="btn btn-mini-new btn-warning gotodownnowhave" v2="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_name'] ?>"  v1="<?php echo $val['magnet_xt'] ?>" title="addtothunder载">have file</a>

        <?php endif; ?>
        <?php  if($val['have_down']!=0):?>
        <a class="btn btn-mini-new btn-warning disabled" title=" ">待下</a>
        <a class="btn btn-mini-new btn-danger notdown"  v2="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_name'] ?>"  v1="<?php echo $val['magnet_xt'] ?>" title="取消已标志下载">取消标志</a>
        <?php endif; ?>

    </td>
    <td style="text-align:center;white-space:nowrap" onclick="">
        <a style="color:#333" rel="nofollow" title="滑鼠右鍵點擊並選擇【複製連結網址】"
           href="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_name'] ?>">
            <?php echo $val['magnet_type'] ?>                	</a>
    </td>
    <td style="text-align:center;white-space:nowrap" onclick="">
        <a style="color:#333" rel="nofollow" title="滑鼠右鍵點擊並選擇【複製連結網址】"
           href="<?php echo 'magnet:?xt=urn:btih:'.$val['magnet_xt']."&dn=" .$val['magnet_name'] ?>">
            <?php echo $val['magnet_date'] ?>              	</a>
    </td>
</tr>
<?php endforeach; ?>
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