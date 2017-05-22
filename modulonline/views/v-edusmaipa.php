<div class="page-title" style="background:#2b3036">

    <div class="grid-row">

        <h1>{judul_header2}</h1>

    </div>
</div>
<style type="text/css">
    /*.col-md-2{
        margin: 20px;
        padding: 0;
    }*/


.row{position: relative;}
.post-list{ 
    margin-bottom:20px;
}
div.list-item {
    border-bottom: 4px solid #7ad03a;
    margin: 25px 15px 2px;
    padding: 20px 12px;
    /*background-color:#F1F1F1;*/
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    min-height: 150px;
    /*width: 29%;*/
    float: left;
}
div.list-item p {
    margin: .5em 0;
    padding: 2px;
    font-size: 13px;
    line-height: 1.5;
}
.list-item a {
    text-decoration: none;
    padding-bottom: 2px;
    color: #0074a2;
    -webkit-transition-property: border,background,color;
    transition-property: border,background,color;-webkit-transition-duration: .05s;
    transition-duration: .05s;
    -webkit-transition-timing-function: ease-in-out;
    transition-timing-function: ease-in-out;
}
.list-item a:hover{text-decoration:underline;}
.list-item h2{font-size:25px; font-weight:bold;text-align: left;}

/* search & filter */
.post-search-panel input[type="text"]{
    width: 220px;
    height: 28px;
    color: #333;
    font-size: 16px;
}
.post-search-panel select{
    height: 34px;
    color: #333;
    font-size: 16px;
}

/* Pagination */
div.pagination {
    font-family: "Lucida Sans Unicode", "Lucida Grande", LucidaGrande, "Lucida Sans", Geneva, Verdana, sans-serif;
    padding:2px;
    margin: 20px 10px;
    float: right;
}

div.pagination a {
    margin: 2px;
    padding: 0.5em 0.64em 0.43em 0.64em;
    background-color: #FD1C5B;
    text-decoration: none; /* no underline */
    color: #fff;
}
div.pagination a:hover, div.pagination a:active {
    padding: 0.5em 0.64em 0.43em 0.64em;
    margin: 2px;
    background-color: #FD1C5B;
    color: #fff;
}
div.pagination span.current {
        padding: 0.5em 0.64em 0.43em 0.64em;
        margin: 2px;
        background-color: #f6efcc;
        color: #6d643c;
    }
div.pagination span.disabled {
        display:none;
    }
.pagination ul li{display: inline-block;}
.pagination ul li a.active{opacity: .5;}

/* loading */
.loading{position: absolute;left: 0; top: 0; right: 0; bottom: 0;z-index: 2;background: rgba(255,255,255,0.7);}
.loading .content {
    position: absolute;
    transform: translateY(-50%);
     -webkit-transform: translateY(-50%);
     -ms-transform: translateY(-50%);
    top: 50%;
    left: 0;
    right: 0;
    text-align: center;
    color: #555;
}

.clear{
    clear: both;
}

</style>
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/modulonline/ajaxPaginationDataSMAIPA/'+page_num,
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (html) {
            $('#postList').html(html);
            $('.loading').fadeOut("slow");
        }
    });
}
</script>
<div class="page-content woocommerce">
        <div class="container">
            <div class="">
                <div class="grid-col" style="width:70%">
                    <h2>Modul Sekolah Menengah Atas - IPA</h2>
                    <!-- Shop -->
                    <div id="page-meta" class="group">
                        <div class="woocommerce-result-count" style="width:40%;padding:10px">
                            <form>
                                    <label>
                                        <!-- <span class="screen-reader-text">Search for:</span> -->
                                        <input type="text" id="keywords" placeholder="Masukan judul file yang dicari" onkeyup="searchFilter()" style="background:white;"/>
                                    </label>
                                    <!-- <input type="submit" class="search-submit" value="GO"> -->
                            </form>
                        </div>
                        <form class="woocommerce-ordering" method="get">
                            <select id="sortBy" onchange="searchFilter()" class="orderby">
                                <option value="">Urutkan</option>
                                <option value="asc">Judul A-Z</option>
                                <option value="desc">Judul Z-A</option>
                                <option value="date_created">Terbaru</option>
                            </select>
                        </form>
                    </div>
                    <!-- <div class="row"> -->
                        <div id="postList">
                            <ul class="products">
                                <?php if(!empty($posts)): foreach($posts as $post): ?>
                                <li class="product">
                                <div class="list-item">
                                    <div class="center">
                                         <i class="fa fa-file-pdf-o fa-5x"></i>
                                    </div>
                                     <div class="product-name">
                                        <a href="#"><?= $post['judul']?></a>
                                    </div>
                                    <div class="product-description">
                                        <div class="short-description">
                                            <p><?= $post['deskripsi']?></p>
                                        </div>
                                    </div>
                                    <a href="<?= base_url("assets/modul/".$post['url_file'])?>" class="cws-button icon-left alt" target="_blank" style="padding:8" onclick="Approved('<?=$post['id']?>')"> <i class="fa fa-download"></i>Download</a>
                                </div>
                                </li>
                                <?php endforeach; else: ?>
                            <p>Post(s) not available.</p>
                            <?php endif; ?>
                            </ul>
                            <div class="clear"></div>
                            <?php echo $this->ajax_pagination->create_links(); ?>
                        </div>
                        <!-- <div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/images/loading.gif'; ?>"/></div></div> -->
                    <!-- </div> -->
                  
                </div>
                <div class="grid-col grid-col-3">
                    <!-- widget search -->
                    <!-- widget categories -->
                    <aside class="widget-categories">
                        <h2>Kategori</h2>
                        <hr class="divider-big" />
                        <ul>
                            <li class="cat-item cat-item-1 current-cat"><a href="<?= base_url('index.php/modulonline/modulsd') ?>">Sekolah Dasar<span> (SD) </span></a></li>
                            <li class="cat-item cat-item-1 current-cat"><a href="<?= base_url('index.php/modulonline/modulsmp') ?>">Sekolah Menengah Pertama<span> (SMP) </span></a></li>
                            <li class="cat-item cat-item-1 current-cat"><a href="<?= base_url('index.php/modulonline/modulsma') ?>">Sekolah Menengah Atas <span> (SMA) </span></a></li>
                            <li class="cat-item cat-item-1 current-cat"><a href="<?= base_url('index.php/modulonline/modulsmaipa') ?>">Sekolah Menengah Atas - IPA</a></li>
                            <li class="cat-item cat-item-1 current-cat"><a href="<?= base_url('index.php/modulonline/modulsmaips') ?>">Sekolah Menengah Atas - IPS</a></li>
                        </ul>
                    </aside>
                    <!-- widget categories -->
                    <!-- widget best seller -->
                    <aside class="widget-selers">
                        <h3>Download Teratas</h3>
                        <hr class="divider-big"/>
                            <div>
                                <?php foreach($downloads as $post){ ?>
                                    <article class="clear-fix" style="">
                                        <div style="width:30%;float:left">
                                            <i class="fa fa-file-pdf-o fa-4x"></i>
                                        </div>
                                        <div style="width:90%;background:black:posisition:relative">
                                        <h4><?= $post['judul']?></h4>
                                        <a href="<?= base_url("assets/modul/".$post['url_file'])?>" class="cws-button icon-left alt" target="_blank" style="padding:8" onclick="Approved('<?=$post['id']?>')"> <i class="fa fa-download"></i>Download</a>
                                        </div>
                                    </article>
                                <?php }; ?>
                            </div>
                    </aside>
                    <!-- / widget best seller -->
                </div>
            </div>
        </div>
    </div>
<hr class="divider-color">

<script>
function Approved(butId){
    $.ajax({
          method: "POST",
          url: base_url+"index.php/modulonline/tambahdownload/"+butId,
          data: { rowid: butId },
          dataType:"text",
          success:function(data){
              // alert(data);
          },
          error:function (data){
              // alert("failed");
          }
    });
}
</script>

