@extends('layout')


@section('content')
    <link rel="stylesheet" type="text/css" href="avbook/main.css">
    <script src="avbook/jquery.masonry.min.js"></script>


    <div class="container-fluid">
        <div class="row">

            <div id="waterfall" class="masonry" style="position: relative; height: 2173px; width: 1309px;">

                <?php  foreach($actresses as $res_star):  ?>
                <a href = 'censored?&st=<?php echo $res_star['code_36'] ?>'>
                    <div class="item masonry-brick" style="position: absolute; top: 0px; left: 0px;">
                        <div class="avatar-box">
                            <div class="photo-frame">
                                <img src="https://jp.netcdn.space/mono/actjpgs/<?php echo $res_star['star_pic'] ?>" title="<?php echo $res_star['star_name'] ?>">
                            </div>
                            <div class="photo-info">
                                <span class="pb10"><?php echo $res_star['star_name'] ?></span>


                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script language="JavaScript">
        (function($) {
            $('#waterfall').masonry({
                itemSelector: ".item",
                isAnimated: false,
                isFitWidth: true
            });
        })(jQuery);
    </script>


    <div class="text-center hidden-xs">
        {!! $actresses->links() !!}
    </div>

@endsection


