<div class="item_wrapper" id="<?=$item["item_id"]?>">
        <div class="item_container">
            <div class="item_contents">
                <img src="<?=file_exists($item['item_img'])? $item['item_img']: '../assets/tmp.png'?>" alt="" class="item_img">
                <div class="item_info">
                    <p class="item_name"><?=$item['item_name']?></>
                    <p class="item_price">₱<?=number_format($item['min_price'])?></p>
                    <div class="item_stars">
                        <ul>
                            <?php if ($item["avg_rate"]>=1){ ?>
                            <li><i class="bi bi-star-fill"></i></li> <?php }else{ ?><li><i class="bi bi-star"></i></li> <?php } ?>
                            <?php if ($item["avg_rate"]>=2){ ?>
                                <li><i class="bi bi-star-fill"></i></li> <?php }else{ ?><li><i class="bi bi-star"></i></li> <?php } ?>
                                <?php if ($item["avg_rate"]>=3){ ?>
                                    <li><i class="bi bi-star-fill"></i></li> <?php }else{ ?><li><i class="bi bi-star"></i></li> <?php } ?>
                                    <?php if ($item["avg_rate"]>=4){ ?>
                                        <li><i class="bi bi-star-fill"></i></li> <?php }else{ ?><li><i class="bi bi-star"></i></li> <?php } ?>
                                        <?php if ($item["avg_rate"]>=5){ ?>
                                            <li><i class="bi bi-star-fill"></i></li> <?php }else{ ?><li><i class="bi bi-star"></i></li> <?php } ?>
                        </ul>
                        <span class="star_splitter"></span>
                        <p class="item_respondents">(<?=$item["rate_count"]??0?>)</p>
                    </div>
                    <p class="item_sold"><?=$item["order_qty"]??0?> Sold</p>
                </div>
            </div>
        </div>
    </div>