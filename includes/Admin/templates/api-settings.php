<div id="api_settings" class="spe-tab-box">
    <div class="spe_elements_tab_menu">
        <div class="spe_tab_content api_title_color">
            <div class="icon">
                <i class="icon-api"></i>
            </div>
            <div class="content">
                <h3>Api Settings</h3>
            </div>
        </div>
        <div class="menu_right_content">
            <div class="plugin_active_switcher">
                <label class="toggler" id="disable">Disable All</label>
                <div class="toggle">
                    <input type="checkbox" id="switcher" class="check">
                    <label class="b switch" for="switcher"></label>
                </div>
                <label class="toggler" id="enabled">Enabled All</label>
            </div>
            <button type="submit" class="spe_dashboard_btn">
                Save Changes</button>
        </div>
    </div>

    <div class="spe_elements_tab" id="api_filter">
        <div class="spe_fiter_data active" data-filter="*">
            <i class="icon-star"></i>All
        </div>
        <div class="spe_fiter_data" data-filter=".api_free">
            <i class="icon-gift"></i>Free
        </div>
        <div class="spe_fiter_data" data-filter=".api_pro">
            <i class="icon-pro-badge"></i>Pro
        </div>
    </div>

    <div class="spe_filter_content ezd-d-flex" id="api_setting">
        <div class="ezd-colum-space-4 api_free">
            <div class="spe_element_box spe_api_box">
                <h3>Twitter Access</h3>
                <p>Go to https://developer.twitter.com/en for create your Consumer key and Access Token.</p>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>User Name</h5>
                        <input type="text" id="twitter-name" placeholder="-----------------">
                    </div>
                    <p>Please fill up below fields for enbled your social login feature in user login widget.</p>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Consumer Key</h5>
                        <input type="text" id="twitter-key" placeholder="-----------------">
                    </div>
                    <p>Go to https://developers.facebook.com for create your facebook APP ID.</p>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Consumer Secret</h5>
                        <input type="text" id="twitter-secret" placeholder="-----------------">
                    </div>
                    <p>Go to your Google developer > Account.</p>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Access Token</h5>
                        <input type="text" id="twitter-token" placeholder="-----------------">
                    </div>
                    <p>Go to your Google developer > Account.</p>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Access Token Secret</h5>
                        <input type="text" id="twitter-token-secret" placeholder="-----------------">
                    </div>
                    <p>Go to your Google developer > Account.</p>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 api_free">
            <div class="spe_element_box spe_api_box">
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Discus User Name</h5>
                        <input type="text" id="twitter-user-name" placeholder="-----------------">
                    </div>
                    <p>Go to https://help.disqus.com/ for know how to get user name of your disqus account.</p>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 api_free">
            <div class="spe_element_box spe_api_box">
                <h3>Social Login Access</h3>
                <p>Please fill up below fields for enbled your social login feature in user login widget.</p>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Facebook APP ID</h5>
                        <input type="text" id="facbook-id" placeholder="-----------------">
                    </div>
                    <p>Please fill up below fields for enbled your social login feature in user login widget.</p>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Facebook APP Secret</h5>
                        <input type="text" id="facebook-app" placeholder="-----------------">
                    </div>
                    <p>Go to https://developers.facebook.com for create your facebook APP ID.</p>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Google Client ID</h5>
                        <input type="text" id="google-id" placeholder="-----------------">
                    </div>
                    <p>Go to your Google developer > Account.</p>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 api_free">
            <div class="spe_element_box spe_api_box">
                <h3>Instagram Access</h3>
                <p>Go to https://developers.facebook.com/docs/instagram-basic-display-api/getting- started for create
                    your Consumer key and Access Token.</p>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Instagram App ID</h5>
                        <input type="text" id="instragram-id" placeholder="-----------------">
                    </div>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Instagram App Secret</h5>
                        <input type="text" id="instragram-app" placeholder="-----------------">
                    </div>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Instagram Access Token</h5>
                        <input type="text" id="instragram-token" placeholder="-----------------">
                    </div>
                    <p>Go to This Link and Generate the access token then copy and paste here.</p>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 api_pro">
            <div class="spe_element_box spe_api_box">
                <h3>Mailchimp Access</h3>
                <p>Go to your Mailchimp > Website > Domains > Extras > API Keys</p>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Mailchimp API Key</h5>
                        <input type="text" id="mail-api" placeholder="-----------------">
                    </div>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Audience ID</h5>
                        <input type="text" id="audience-id" placeholder="-----------------">
                    </div>
                </div>
            </div>
        </div>

        <div class="ezd-colum-space-4 api_pro">
            <div class="spe_element_box spe_api_box">
                <h3>Facebook Social Access</h3>
                <p>Go to your Facebook Developer Account to get access Page ID and Access Token. This credential need
                    for Social Feeds widget.</p>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Facebook Access Token</h5>
                        <input type="text" id="facebook-token" placeholder="-----------------">
                    </div>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Facebook Page ID</h5>
                        <input type="text" id="facebook-id" placeholder="-----------------">
                    </div>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 api_pro">
            <div class="spe_element_box spe_api_box">
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>MapBox Access Token</h5>
                        <input type="text" id="map-api" placeholder="-----------------">
                    </div>
                    <p>Click Here to get access token. This Access Token needs for show Open Street Map widget
                        correctly.</p>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 api_free">
            <div class="spe_element_box spe_api_box">
                <h3>reCAPTCHA Access</h3>
                <p>Go to your Google reCAPTCHA > Account > Generate Keys (reCAPTCHA V2 > Invisible) and Copy and Paste
                    here.</p>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Site key</h5>
                        <input type="text" id="site-key" placeholder="-----------------">
                    </div>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Secret key</h5>
                        <input type="text" id="site-id" placeholder="-----------------">
                    </div>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 api_pro">
            <div class="spe_element_box spe_api_box">
                <h3>Simple Contact Form</h3>
                <p>Set your simple contact form settings from here.</p>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Contact Form Email</h5>
                        <input type="text" id="contact-id" placeholder="-----------------">
                    </div>
                    <p>You can set alternative email for simple contact form.</p>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Spam Email List</h5>
                        <input type="text" id="spam-email" placeholder="-----------------">
                    </div>
                    <p>add spam email here for block spamming from your contact form. multiple email separated by comma
                        ().</p>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 api_pro">
            <div class="spe_element_box spe_api_box">
                <h3>Weather API Access</h3>
                <p>Please choose your Weather provider, both provider has the free and paid package.</p>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>WeatherStack Key</h5>
                        <input type="text" id="weather_key" placeholder="-----------------">
                    </div>
                    <p>Go to https://weatherstack.com/quickstart > Copy Key and Paste here.</p>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Open Weather Map Key</h5>
                        <input type="text" id="weather_nap_key" placeholder="-----------------">
                    </div>
                    <p>Go to https://home.openweathermap.org/api_keys > Copy Key and Paste here. This api key also works
                        for Air Pollution Widget</p>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 api_pro">
            <div class="spe_element_box spe_api_box">
                <h3>Yelp Access</h3>
                <p>Go to your Yelp Developer Account to get access client ID and Key. This credential need for Social
                    Proof widget.</p>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Yelp Client ID</h5>
                        <input type="text" id="weather_key" placeholder="-----------------">
                    </div>
                    <p>You can set alternative email for simple contact form.</p>
                </div>
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Yelp API Key</h5>
                        <input type="text" id="weather_nap_key" placeholder="-----------------">
                    </div>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 api_pro">
            <div class="spe_element_box spe_api_box">
                <div class="spe_api_panel">
                    <div class="spe_api_inner">
                        <h5>Google Map API Key</h5>
                        <input type="text" id="g_map_key" placeholder="-----------------">
                    </div>
                    <p>Go to https://developers.google.com and generate the API key and insert here. This API key needs
                        for show Advanced Google Map widget correctly.</p>
                </div>
            </div>
        </div>
    </div>
</div>