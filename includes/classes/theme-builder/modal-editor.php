<div class="spel_theme_builder_wrapper spel-modal spel-fade" id="spel_theme_builder_modal" tabindex="-1" role="dialog" aria-labelledby="spel_theme_builder_modal_label">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <form action="" method="get" id="template-modal-input-form" data-open-editor="0" data-editor-url="<?php echo esc_url(get_admin_url()); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp_rest' )); ?>">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="spel_theme_builder_modal_label"><?php esc_html_e( 'Template Settings', 'spider-elements' ); ?></h4>
                </div>

                <div class="modal-body" id="spel_theme_builder_modal_body">
                    <div class="input-group">
                        <label class="input-label"><?php esc_html_e( 'Title:', 'spider-elements' ); ?></label>
                        <input type="text" name="title" class="template-modal-input-title form-control" required>
                    </div>
                    <br />
                    <div class="input-group">
                        <label class="input-label"><?php esc_html_e( 'Type:', 'spider-elements' ); ?></label>
                        <select name="type" class="template-modal-input-type form-control">
                            <option value="header"><?php esc_html_e( 'Header', 'spider-elements' ); ?></option>
                            <option value="footer"><?php esc_html_e( 'Footer', 'spider-elements' ); ?></option>
                        </select>
                    </div>
                    <br />

                    <div class="template-option-container">
                        <div class="input-group">
                            <label class="input-label"><?php esc_html_e( 'Conditions:', 'spider-elements' ); ?></label>
                            <select name="main_condition" class="template-modal-input-condition_a form-control">
                                <option value="entire_site"><?php esc_html_e( 'Entire Site', 'spider-elements' ); ?></option>
                                <option value="singular"><?php esc_html_e( 'All Singular Posts', 'spider-elements' ); ?></option>
                                <option value="archive"><?php esc_html_e( 'All Archive Pages', 'spider-elements' ); ?></option>
                            </select>
                        </div>
                        <br>

                        <!--<div class="template-modal-input-condition_singular-container">

                            <div class="input-group d-none">
                                <label class="input-label"></label>
                                <select name="condition_singular" class="template-modal-input-condition_singular form-control">
                                    <option value="all"><?php /*esc_html_e( 'All Singulars (Only Pro)', 'spider-elements' ); */?></option>
                                    <option value="front_page"><?php /*esc_html_e( 'Front Page (Only Pro)', 'spider-elements' ); */?></option>
                                    <option value="all_posts"><?php /*esc_html_e( 'All Posts (Only Pro)', 'spider-elements' ); */?></option>
                                    <option value="all_pages"><?php /*esc_html_e( 'All Pages (Only Pro)', 'spider-elements' ); */?></option>
                                    <option value="selective"><?php /*esc_html_e( 'Selective Singular (Only Pro)', 'spider-elements' ); */?></option>
                                    <option value="404page"><?php /*esc_html_e( '404 Page (Only Pro)', 'spider-elements' ); */?></option>
                                </select>
                            </div>

                            <br>

                            <div class="template-modal-input-condition_singular_id-container multiple-ajax-search-field">
                                <div class="input-group">
                                    <label class="input-label"></label>
                                    <select multiple name="condition_singular_id" class="template-modal-input-condition_singular_id form-control"></select>
                                </div>
                                <br />
                            </div>
                            <br>
                        </div>-->

                        <div class="switch-group">
                            <label class="input-label"><?php esc_html_e( 'Activate/Deactivate:', 'spider-elements' ); ?></label>
                            <div class="admin-input-switch">
                                <input checked="" type="checkbox" value="yes" class="admin-control-input template-modal-input-activation" name="activation" id="activation_modal_input">
                                <label class="admin-control-label" for="activation_modal_input">
                                    <span class="admin-control-label-switch" data-active="ON" data-inactive="OFF"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default template-save-btn-editor"><?php esc_html_e( 'Edit content', 'spider-elements' ); ?></button>
                    <button type="submit" class="btn btn-primary template-save-btn"><?php esc_html_e( 'Save changes', 'spider-elements' ); ?></button>
                </div>

                <div class="spinner"></div>

            </div>
        </form>
    </div>
</div>
