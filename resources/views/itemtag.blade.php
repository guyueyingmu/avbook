
<?php if ($movie_info['owned'] == 1): ?>
<!---  <button class="btn btn-xs btn-success " onclick="seturl('&file=3')"
                                        title="已拥有"><span class="glyphicon glyphicon-folder-open" style =" color: #fff;"></span></button>  -->

<span class="glyphicon glyphicon-folder-close" title="已拥有"  style =" font-size: 16px; color: green;"></span>
<?php endif; ?>

<?php if ($movie_info['favorite'] >0): ?>
<span   title="已收藏" class="glyphicon glyphicon-heart" style =" font-size: 16px; color: #fde16d;-webkit-text-stroke: 1px #777;
    text-shadow: 1px 1px #999;"></span>
<?php endif; ?>
<?php if (!isset($_GET['mg']) && $movie_info['have_mg'] == 0 ): ?>
<span title="暫時沒有磁力連結"  class="glyphicon glyphicon-ban-circle" style ="font-size: 16px; color: #FF0000 ;"></span>
<?php endif; ?>

<?php if ($movie_info['have_mg'] == 1 && !$movie_info['have_hd'] ): ?>
<span title="包含 磁力連結"  class="glyphicon glyphicon-magnet" style ="font-size: 16px; color: #e38d13;"></span>
<?php endif; ?>


<?php if ($movie_info['have_hd'] == 1): ?>
<span title="包含高清HD的磁力連結"  class="glyphicon glyphicon-hd-video" style ="font-size: 16px; color: #265a88;"></span>
<?php endif; ?>
<?php if ($movie_info['have_sub'] == 1): ?>
<span title="包含字幕的磁力連結"  class="glyphicon glyphicon-subtitles" style ="font-size: 16px; color: #eb9316;"></span>
<?php endif; ?>

<?php if (strrpos($movie_info['Genre'], '[4m]') !== false ): ?>
<span title="包含类别 主观视角"  class=" glyphicon glyphicon-eye-open " style ="font-size: 16px; color: #FF0000;"></span>

<?php endif; ?>

<?php if (strrpos($movie_info['Genre'], '[8]') !== false ): ?>
<span title="包含类别 眼镜"  class="glyphicon glyphicon-sunglasses" style ="font-size: 16px; color: #FF2400;"></span>
<?php endif; ?>

<?php if ($movie_info['wanted'] == 1  ): //&& $movie_info['owned'] == 0?>
<span title="想要的"  class="glyphicon glyphicon-search" style ="font-size: 16px; color: #337ab7;"></span>
<?php endif; ?>
