    <div class="item_wrapper" id="<?=$item["item_id"]?>">
        <div class="item_container">
            <div class="item_contents">
                <img src="<?=file_exists($item['item_img'])? $item['item_img']: '../assets/tmp.png'?>" alt="" class="item_img">
                <div class="item_info">
                    <p class="item_name"><?=$item['item_name']?></>
                    <p class="item_price">₱<?=$item['min_price']?></p>
                    <div class="item_stars">
                            <ul>
                                <li><i class="bi bi-star-fill"></i></li>
                                <li><i class="bi bi-star-fill"></i></li>
                                <li><i class="bi bi-star-fill"></i></li>
                                <li><i class="bi bi-star-fill"></i></li>
                                <li><i class="bi bi-star-fill"></i></li>
                            </ul>
                        <span class="star_splitter"></span>
                        <p class="item_respondents">(<?=$item["rate_count"]??0?>)</p>
                    </div>
                    <p class="item_sold"><?=$item["order_qty"]??0?> Sold</p>
                    <i class="bi bi-cart2 item_cart" data-item-id="<?=$item["item_id"]?>"></i>
                </div>
            </div>
        </div>
    </div>
