<section class = "base_page_wrap px-2 mt-3">
    <form id="selec-base-form">
        <h4>Select your base page.</h4>
        <hr>
        <div class="row mt-4">
            <div class="col-md-8">
                <?php 
                    $cat = get_category_by_slug('atpbs');
                    $catID = $cat->term_id; 
                    $_page_args = array(
                        'post_type' => 'page',
                        'order' => 'ASC',
                        'category'  => $catID,
                    );
                    $pages = get_posts( $_page_args );
                    $base_page_id = get_option('_j_basepage_id');
                ?>
                <select id="base_page_select" name="base_page_select" class="j-select2 form-control">
                    <option value="0">Select a base page <?=$base_page_id ?></option>
                    <?php
                        if ($pages){
                            foreach ( $pages as $page ) {?>
                                <option value="<?=  $page->ID ?>" <?= $base_page_id && $page->ID == $base_page_id ? "selected": "" ?>><?= $page->post_title ?> (ID : <?=  $page->ID ?>) </option>
                                <?php 
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="j-apply-btn btn btn-success text-white ml-3 px-4" id="j-apply-btn" disabled>Apply</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="j-test-btn btn btn-info text-white ml-3 px-4" id="j-test-btn" <?= $base_page_id > 0 ? "" : "disabled" ?>>Test</button>
            </div>
        </div>
        <div class="el-row j-hide j-update-success j-update-result-msg">
            Applied Successfully.
        </div>
        <div class="el-row j-hide j-update-failed j-update-result-msg">
            Oops, Something Went Wrong.
        </div>
        <div class="el-row j-hide j-create-success j-update-result-msg">
            
        </div>
    </form>
</section>