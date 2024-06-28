<div class="spel_theme_builder_wrapper spel-modal spel-fade" id="spel_theme_builder_modal" tabindex="-1" role="dialog" aria-labelledby="spel_theme_builder_modal_label">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <form action="" name="spel_template_form" id="spel_template_form" method="post"  data-open-editor="0" data-editor-url="<?php echo esc_url(get_admin_url()); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp_rest' )); ?>">

            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="spel_theme_builder_modal_label"><?php esc_html_e( 'Template Settings', 'spider-elements' ); ?></h4>
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="<?php esc_attr_e('Close', 'spider-elements'); ?>"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body" id="spel_theme_builder_modal_body">

                    <div class="input-group">
                        <label class="input-label"><?php esc_html_e( 'Title:', 'spider-elements' ); ?></label>
                        <input type="text" name="title" class="template-modal-input-title form-control" required>
                    </div>
                    <br />

                    <div class="input-group">
                        <label class="input-label"><?php esc_html_e( 'Type:', 'spider-elements' ); ?></label>
                        <select name="spel_template_type" id="spel_template_type" class="template-modal-input-type form-control">
                            <option value="header"><?php esc_html_e( 'Header', 'spider-elements' ); ?></option>
                            <option value="footer"><?php esc_html_e( 'Footer', 'spider-elements' ); ?></option>
                        </select>
                    </div>
                    <br />

                    <div class="template-option-container">
                        <div class="input-group">
                            <label class="input-label"><?php esc_html_e( 'Conditions:', 'spider-elements' ); ?></label>
                            <select name="spel_template_condition" id="spel_template_condition" class="template-modal-input-condition_a form-control">
                                <option value="entire_site"><?php esc_html_e( 'Entire Site', 'spider-elements' ); ?></option>
                                <option value="singular"><?php esc_html_e( 'All Singular Posts', 'spider-elements' ); ?></option>
                                <option value="archive"><?php esc_html_e( 'All Archive Pages', 'spider-elements' ); ?></option>
                            </select>
                        </div>
                        <br>

                        <div class="switch-group">
                            <label class="input-label"><?php esc_html_e( 'Activate/Deactivate:', 'spider-elements' ); ?></label>

                            <div class="admin-input-switch">
                                <input type="checkbox" value="yes" class="admin-control-input template-modal-input-activation" name="spel_template_status" id="spel_template_status">
                                <label class="admin-control-label" for="spel_template_status">
                                    <span class="admin-control-label-switch" data-active="ON" data-inactive="OFF"></span>
                                </label>
                            </div>

                        </div>

                    </div>
                    <br>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default template-save-btn-editor" id="spel_template_elementor_edit_mode_btn" target="_blank"><?php esc_html_e( 'Edit with Elementor', 'spider-elements' ); ?></button>
                    <button type="submit" class="btn btn-primary template-save-btn"><?php esc_html_e( 'Save changes', 'spider-elements' ); ?></button>
                </div>

                <div class="spinner"></div>

            </div>
        </form>



    </div>
</div>
