<?php
global $KcSeoWPSchema;
$settings    = get_option( $KcSeoWPSchema->options['settings'] );
$schemaModel = new KcSeoSchemaModel;
?>
<div class="wrap">
    <div id="upf-icon-edit-pages" class="icon32 icon32-posts-page"><br/></div>
    <h2><?php _e( 'WP SEO Structured Data Schema', "wp-seo-structured-data-schema-pro" ); ?></h2>
    <form id="kcseo-settings">

        <h3><?php _e( 'General settings for WP SEO Structured Data Schema by <a href="https://wpsemplugins.com/">wpsemplugins.com</a>', "wp-seo-structured-data-schema-pro" ) ?></h3>
        <div class="setting-holder">
            <table width="40%" cellpadding="10" class="form-table">
                <tr class="default">
                    <th><?php _e( "Website Url", "wp-seo-structured-data-schema-pro" ) ?> <span
                                class="required">*</span>
                    </th>
                    <td align="left" scope="row">
                        <div class="with-tooltip">
                            <input type="text" class="regular-text" name="web_url"
                                   value="<?php echo( ! empty( $settings['web_url'] ) ? esc_attr( $settings['web_url'] ) : get_home_url() ); ?>"/>
                            <div class="schema-tooltip-holder">
                                <span class="schema-tooltip"></span>
                                <div class="hidden">
                                    <p>
                                        <b>Tip:</b> <?php _e( "For more detailed information on how to configure this plugin, please visit:", "wp-seo-structured-data-schema-pro" ) ?>
                                        <a href="https://wpsemplugins.com/wordpress-seo-structured-data-schema-plugin/">https://wpsemplugins.com/wordpress-seo-structured-data-schema-plugin/</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="default">
                    <th><?php _e( "Type", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <select id="site_type" name="site_type" class="select2">
                            <option value=""><?php _e( "Select one type", "wp-seo-structured-data-schema-pro" ) ?> </option>
							<?php
							$siteType = ! empty( $settings['site_type'] ) ? $settings['site_type'] : null;
							foreach ( KcSeoOptions::getSiteTypes() as $key => $site ) {
								if ( is_array( $site ) ) {
									$slt = ( $key == $siteType ? "selected" : null );
									echo "<option value='$key' $slt>&nbsp;&nbsp;&nbsp;$key</option>";
									foreach ( $site as $inKey => $inSite ) {
										if ( is_array( $inSite ) ) {
											$slt = ( $inKey == $siteType ? "selected" : null );
											echo "<option value='$inKey' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inKey</option>";
											foreach ( $inSite as $inInKey => $inInSite ) {
												if ( is_array( $inInSite ) ) {
													$slt = ( $inInKey == $siteType ? "selected" : null );
													echo "<option value='$inInKey' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inInKey</option>";
													foreach ( $inInSite as $iSite ) {
														$slt = ( $iSite == $siteType ? "selected" : null );
														echo "<option value='$iSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$iSite</option>";
													}
												} else {
													$slt = ( $inInSite == $siteType ? "selected" : null );
													echo "<option value='$inInSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inInSite</option>";
												}
											}
										} else {
											$slt = ( $inSite == $siteType ? "selected" : null );
											echo "<option value='$inSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inSite</option>";
										}
									}
								} else {
									$slt = ( $site == $siteType ? "selected" : null );
									echo "<option value='$site' $slt>$site</option>";
								}
							}
							?>
                        </select>
                    </td>
                </tr>
                <tr class="default">
                    <th><?php _e( "Organization or Business name", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="type_name"
                               value="<?php echo( ! empty( $settings['type_name'] ) ? $settings['type_name'] : null ); ?>"/>
                    </td>
                </tr>
                <tr class="default all-type-data">
                    <th><?php _e( "Site Image", "wp-seo-structured-data-schema-pro" ) ?> <span class="required">*</span>
                    </th>
                    <td align="left" scope="row">
                        <div class="kSeo-image">
                            <div class="kSeo-image-wrapper">
								<?php
								$siteImageId = ! empty( $settings['site_image'] ) ? absint( $settings['site_image'] ) : 0;
								$siteImage   = $ingInfo = null;
								if ( $siteImageId ) {
									$siteImage = wp_get_attachment_image( $siteImageId, "thumbnail" );
									$imgData   = $KcSeoWPSchema->imageInfo( $siteImageId );
									$ingInfo   .= "<span><strong>URL: </strong>{$imgData['url']}</span>";
									$ingInfo   .= "<span><strong>Width: </strong>{$imgData['width']}px</span>";
									$ingInfo   .= "<span><strong>Height: </strong>{$imgData['height']}px</span>";
								}
								?>
                                <span class="kSeoImgAdd"><span class="dashicons dashicons-plus-alt"></span></span>
                                <span class="kSeoImgRemove <?php echo( $siteImageId ? null : "kSeo-hidden" ); ?>"><span
                                            class="dashicons dashicons-trash"></span></span>
                                <div class="kSeo-image-preview"><?php echo $siteImage; ?></div>
                                <input type="hidden" name="site_image" value="<?php echo $siteImageId; ?>"/>
                            </div>
                            <div class='image-info'><?php echo $ingInfo; ?></div>
                        </div>
                    </td>
                </tr>
                <tr class="default all-type-data">
                    <th><?php _e( "Price Range", "wp-seo-structured-data-schema-pro" ) ?> <span
                                class="required">*</span>
                    </th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="site_price_range"
                               value="<?php echo( ! empty( $settings['site_price_range'] ) ? $settings['site_price_range'] : null ); ?>"/>
                        <div class="description"><?php _e( "The price range of the business, for example $$$.", "wp-seo-structured-data-schema-pro" ) ?></div>
                    </td>
                </tr>
                <tr class="default all-type-data">
                    <th><?php _e( "Site Telephone", "wp-seo-structured-data-schema-pro" ) ?> <span
                                class="required">*</span></th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="site_telephone"
                               value="<?php echo( ! empty( $settings['site_telephone'] ) ? $settings['site_telephone'] : null ); ?>"/>
                        <div class="description"><?php _e( "The telephone number.", "wp-seo-structured-data-schema-pro" ) ?></div>
                    </td>
                </tr>
                <tr class="default">
                    <th><?php _e( "Additional Type", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <div class="with-tooltip">
							<textarea name="additionalType"
                                      placeholder="http://example1.com&#10;http://example2.com&#10;http://example3.com"
                                      rows="6" cols="50"
                                      class="additional-type"><?php echo( ! empty( $settings['additionalType'] ) ? esc_attr( @$settings['additionalType'] ) : null ); ?></textarea>
                            <p class="description"><?php _e( "Add \"Additional Type\" URL(s) by separate ideas", "wp-seo-structured-data-schema-pro" ) ?></p>
                            <div class="schema-tooltip-holder">
                                <span class="schema-tooltip"></span>
                                <div class="hidden">
                                    <p><b>Tip:</b> <?php _e( "Product Ontology is an extension to schema using WikiPedia
                                        definitions that enables you to further define a type by adding an
                                        “AdditionalType” attribute.Example for a Tailor (which is not available as a
                                        schema “Type”): Pick LocalBusiness as a generic Type, then add additional type
                                        as follows:", "wp-seo-structured-data-schema-pro" ) ?>
                                        <a href="https://en.wikipedia.org/wiki/Tailor">https://en.wikipedia.org/wiki/<span>Tailor</span></a>
										<?php _e( "Change to this format and enter in Additional Type field:", "wp-seo-structured-data-schema-pro" ) ?>
                                        <a href="http://www.productontology.org/id/Tailor">http://www.productontology.org/id/<span>Tailor</span></a>
										<?php _e( "For more info visit:", "wp-seo-structured-data-schema-pro" ) ?><a
                                                href="https://wpsemplugins.com/product-ontology-schema/">https://wpsemplugins.com/product-ontology-schema/</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="default">
                    <th><?php _e( "Same As", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <textarea name="sameAs"
                                  placeholder="http://example1.com&#10;http://example2.com&#10;http://example3.com"
                                  rows="6" cols="50"
                                  class="additional-type"><?php echo( ! empty( $settings['sameAs'] ) ? esc_textarea( @$settings['sameAs'] ) : null ); ?></textarea>
                        <p class="description"><?php _e( "Ad additional url which are same as this site", "wp-seo-structured-data-schema-pro" ) ?></p>
                    </td>
                </tr>
                <tr class="default restaurant">
                    <th style="font-size: 18px; padding: 30px 0 5px;"><?php _e( "Restaurant Information", "wp-seo-structured-data-schema-pro" ) ?></th>
                </tr>
                <tr class="default restaurant">
                    <th><?php _e( "The cuisine of the restaurant.", "wp-seo-structured-data-schema-pro" ) ?> <span
                                class="required">*</span></th>
                    <td align="left" scope="row">
						<textarea cols="50" rows="6"
                                  name="restaurant[servesCuisine]"><?php echo( ! empty( $settings['restaurant']['servesCuisine'] ) ? esc_attr( $settings['restaurant']['servesCuisine'] ) : null ); ?></textarea>
                    </td>
                </tr>
                <tr class="default business-info">
                    <th style="font-size: 18px; padding: 30px 0 5px;"><?php _e( "Others local business info", "wp-seo-structured-data-schema-pro" ) ?></th>
                </tr>
                <tr class="default business-info">
                    <th><?php _e( "Description", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
						<textarea cols="50" rows="6"
                                  name="business_info[description]"><?php echo( ! empty( $settings['business_info']['description'] ) ? esc_attr( $settings['business_info']['description'] ) : null ); ?></textarea>
                    </td>
                </tr>
                <tr class="default business-info">
                    <th><?php _e( "Operation Hours", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <div class="with-tooltip">
							<textarea name="business_info[openingHours]"
                                      placeholder="Mo-Sa 11:00-14:30&#10;Mo-Th 17:00-21:30&#10;Fr-Sa 17:00-22:00"
                                      rows="4" cols="50"
                                      class="additional-type"><?php echo( ! empty( $settings['business_info']['openingHours'] ) ? esc_attr( $settings['business_info']['openingHours'] ) : null ); ?></textarea>
                            <p class="description">- Days are specified using the following two-letter combinations: Mo,
                                Tu, We, Th, Fr, Sa, Su.</br>
                                - Times are specified using 24:00 time. For example, 3pm is specified as 15:00. <br>
                                - Add Opening Hours by separate line</p>
                            <div class="schema-tooltip-holder">
                                <span class="schema-tooltip"></span>
                                <div class="hidden">
                                    <p>
                                        <b>Tip:</b> <?php _e( "Once you save these structured data schema settings, validate your
                                        home page url here:", "wp-seo-structured-data-schema-pro" ) ?>
                                        <a href="https://developers.google.com/structured-data/testing-tool/">https://developers.google.com/structured-data/testing-tool/</a>
                                    </p>
                                </div>
                            </div>
                    </td>
                </tr>
                <tr class="default business-info">
                    <th style="font-size: 16px;"><?php _e( "GeoCoordinates", "wp-seo-structured-data-schema-pro" ) ?></th>
                </tr>
                <tr class="default business-info">
                    <th style="text-align: right"><?php _e( "Latitude", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="business_info[latitude]"
                               value="<?php echo( ! empty( $settings['business_info']['latitude'] ) ? esc_attr( $settings['business_info']['latitude'] ) : null ); ?>"/>
                    </td>
                </tr>
                <tr class="default business-info">
                    <th style="text-align: right"><?php _e( "Longitude", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="business_info[longitude]"
                               value="<?php echo( ! empty( $settings['business_info']['longitude'] ) ? esc_attr( $settings['business_info']['longitude'] ) : null ); ?>"/>
                    </td>
                </tr>
                <tr class="default business-info">
                    <th style="text-align: right"><?php _e( "Radius", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <input type="number" class="regular-text" name="business_info[geo_radius]"
                               value="<?php echo( ! empty( $settings['business_info']['geo_radius'] ) ? esc_attr( $settings['business_info']['geo_radius'] ) : 50 ); ?>"/>
                    </td>
                </tr>
                <tr class="default person">
                    <th style="font-size: 18px; padding: 30px 0 5px;"><?php _e( "Person", "wp-seo-structured-data-schema-pro" ) ?></th>
                </tr>
                <tr class="default person">
                    <th><?php _e( "Name", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="person[name]"
                               value="<?php echo( ! empty( $settings['person']['name'] ) ? esc_attr( $settings['person']['name'] ) : null ); ?>"/>
                    </td>
                </tr>
                <tr class="default person">
                    <th><?php _e( "Work For", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="person[worksFor]"
                               value="<?php echo( ! empty( $settings['person']['worksFor'] ) ? esc_attr( $settings['person']['worksFor'] ) : null ); ?>"/>

                    </td>
                </tr>
                <tr class="default person">
                    <th><?php _e( "Job Title", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="person[jobTitle]"
                               value="<?php echo( @$settings['person']['jobTitle'] ? @$settings['person']['jobTitle'] : null ); ?>"/>

                    </td>
                </tr>
                <tr class="default person">
                    <th><?php _e( "Image", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="person[image]"
                               value="<?php echo( ! empty( $settings['person']['image'] ) ? esc_attr( $settings['person']['image'] ) : null ); ?>"/>
                        <p class="description">Add your personal photo here</p>
                    </td>
                </tr>
                <tr class="default person">
                    <th><?php _e( "Description", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text" name="person[description]"
                               value="<?php echo( ! empty( $settings['person']['description'] ) ? esc_attr( $settings['person']['description'] ) : null ); ?>"/>
                    </td>
                </tr>
                <tr class="default person">
                    <th><?php _e( "Birth date", "wp-seo-structured-data-schema-pro" ) ?></th>
                    <td align="left" scope="row">
                        <input type="text" class="regular-text kcseo-date" name="person[birthDate]"
                               value="<?php echo( ! empty( $settings['person']['birthDate'] ) ? esc_attr( $settings['person']['birthDate'] ) : null ); ?>"/>

                    </td>
                </tr>
            </table>
            <div class="kcseo-address-wrapper">
                <table width="40%" cellpadding="10" id="kcseo-main-address" class="address-table form-table">
                    <tr class="default kc-address-label">
                        <th style="font-size: 18px; padding: 30px 0 5px;"><?php _e( "Address", "wp-seo-structured-data-schema-pro" ) ?></th>
                    </tr>
                    <tr class="default">
                        <th><?php _e( "Address Country", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td align="left" scope="row">
                            <select class="select2" name="address[country]">
                                <option value=""><?php _e( "Select a country", "wp-seo-structured-data-schema-pro" ) ?></option>
								<?php
								$aCountry = ! empty( $settings['address']['country'] ) ? $settings['address']['country'] : null;
								foreach ( KcSeoOptions::getCountryList() as $country ) {
									$slt = ( $country == $aCountry ? "selected" : null );
									echo "<option value='$country' $slt>$country</option>";
								}
								?>
                            </select>
                        </td>
                    </tr>
                    <tr class="default">
                        <th><?php _e( "Address Locality", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="address[locality]"
                                   value="<?php echo( ! empty( $settings['address']['locality'] ) ? esc_attr( $settings['address']['locality'] ) : null ); ?>"/>
                            <p class="description"><?php _e( "City (i.e Kansas city)", "wp-seo-structured-data-schema-pro" ) ?></p>
                    </tr>
                    <tr class="default">
                        <th><?php _e( "Address Region", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="address[region]"
                                   value="<?php echo( ! empty( $settings['address']['region'] ) ? esc_attr( $settings['address']['region'] ) : null ); ?>"/>
                            <p class="description"><?php _e( "State (i.e. MO)", "wp-seo-structured-data-schema-pro" ) ?></p>
                    </tr>
                    <tr class="default">
                        <th><?php _e( "Postal Code", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="address[postalcode]"
                                   value="<?php echo( ! empty( $settings['address']['postalcode'] ) ? esc_attr( $settings['address']['postalcode'] ) : null ); ?>"/>
                    </tr>
                    <tr class="default">
                        <th><?php _e( "Street Address", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="address[street]"
                                   value="<?php echo( ! empty( $settings['address']['street'] ) ? esc_attr( $settings['address']['street'] ) : null ); ?>"/>
                    </tr>
                </table>
                <div class="kcseo-address-holder">
					<?php if ( isset( $settings['_multiple_address'] ) && ! empty( $settings['_multiple_address'] ) ) :
						$count = 0;
						foreach ( $settings['_multiple_address'] as $multiple_address ): ?>
                            <div class='multiple-address-item'>
                                <table width="40%" cellpadding="10" class="address-table form-table">
                                    <tr class="default kc-address-label">
                                        <th style="font-size: 18px; padding: 30px 0 5px;"><?php _e( "Address", "wp-seo-structured-data-schema-pro" ) ?>
											<?php echo $count + 1; ?>
                                        </th>
                                        <td>
                                            <span class='kc-remove-address'><span
                                                        class='dashicons dashicons-trash'></span><?php _e( "Remove", "wp-seo-structured-data-schema-pro" ) ?></span>
                                        </td>
                                    </tr>
                                    <tr class="default">
                                        <th><?php _e( "Address Country", "wp-seo-structured-data-schema-pro" ) ?></th>
                                        <td align="left" scope="row">
                                            <select class="select2"
                                                    name="_multiple_address[<?php echo $count; ?>][country]">
                                                <option value=""><?php _e( "Select a country", "wp-seo-structured-data-schema-pro" ) ?></option>
												<?php
												$aCountry = ! empty( $multiple_address['country'] ) ? $multiple_address['country'] : null;
												foreach ( KcSeoOptions::getCountryList() as $country ) {
													$slt = ( $country == $aCountry ? "selected" : null );
													echo "<option value='$country' $slt>$country</option>";
												}
												?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="default">
                                        <th><?php _e( "Address Locality", "wp-seo-structured-data-schema-pro" ) ?></th>
                                        <td align="left" scope="row">
                                            <input type="text" class="regular-text"
                                                   name="_multiple_address[<?php echo $count; ?>][locality]"
                                                   value="<?php echo( ! empty( $multiple_address['locality'] ) ? esc_attr( $multiple_address['locality'] ) : null ); ?>"/>
                                            <p class="description"><?php _e( "City (i.e Kansas city)", "wp-seo-structured-data-schema-pro" ) ?></p>
                                    </tr>
                                    <tr class="default">
                                        <th><?php _e( "Address Region", "wp-seo-structured-data-schema-pro" ) ?></th>
                                        <td align="left" scope="row">
                                            <input type="text" class="regular-text"
                                                   name="_multiple_address[<?php echo $count; ?>][region]"
                                                   value="<?php echo( ! empty( $multiple_address['region'] ) ? esc_attr( $multiple_address['region'] ) : null ); ?>"/>
                                            <p class="description"><?php _e( "State (i.e. MO)", "wp-seo-structured-data-schema-pro" ) ?></p>
                                    </tr>
                                    <tr class="default">
                                        <th><?php _e( "Postal Code", "wp-seo-structured-data-schema-pro" ) ?></th>
                                        <td align="left" scope="row">
                                            <input type="text" class="regular-text"
                                                   name="_multiple_address[<?php echo $count; ?>][postalcode]"
                                                   value="<?php echo( ! empty( $multiple_address['postalcode'] ) ? esc_attr( $multiple_address['postalcode'] ) : null ); ?>"/>
                                    </tr>
                                    <tr class="default">
                                        <th><?php _e( "Street Address", "wp-seo-structured-data-schema-pro" ) ?></th>
                                        <td align="left" scope="row">
                                            <input type="text" class="regular-text"
                                                   name="_multiple_address[<?php echo $count; ?>][street]"
                                                   value="<?php echo( ! empty( $multiple_address['street'] ) ? esc_attr( $multiple_address['street'] ) : null ); ?>"/>
                                    </tr>
                                </table>
                            </div>
							<?php $count ++;
						endforeach; ?>
					<?php endif; ?>
                </div>
                <div class="add-new-address-tools">
                    <a id="kcseo-add-address"
                       class="button button-primary"><?php _e( "Add New Address", "wp-seo-structured-data-schema-pro" ); ?></a>
                </div>
            </div>
        </div>
        <div id="tabs-kcseo-container" class="rt-tab-container">
            <ul class="rt-tab-nav">
                <li class="active" data-id="tab-logo-url"><a
                            href="#tab-logo-url"><?php _e( "Organization Logo", "wp-seo-structured-data-schema-pro" ) ?></a>
                </li>
                <li data-id="tab-social-profile"><a
                            href="#tab-social-profile"><?php _e( "Social Profile", "wp-seo-structured-data-schema-pro" ) ?></a>
                </li>
                <li data-id="tab-corporate-contract">
                    <a href="#tab-corporate-contract"><?php _e( "Corporate Contacts", "wp-seo-structured-data-schema-pro" ) ?></a>
                </li>
            </ul>
            <div id="tab-logo-url" class="rt-tab-content active">
                <table width="100%" cellpadding="10" class="form-table">
                    <tr class="field_logo">
                        <th><?php _e( "Select Organization Logo", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td scope="row" style="position: relative">
                            <div class="kSeo-image">
                                <div class="kSeo-image-wrapper">
									<?php
									$organizationLogoId = ! empty( $settings['organization_logo'] ) ? absint( $settings['organization_logo'] ) : null;
									$organizeImage      = $imgInfo = null;
									if ( $organizationLogoId ) {
										$organizeImage = wp_get_attachment_image( $organizationLogoId, "thumbnail" );
										$imgData       = $KcSeoWPSchema->imageInfo( $organizationLogoId );
										$imgInfo       .= "<span><strong>URL: </strong>{$imgData['url']}</span>";
										$imgInfo       .= "<span><strong>Width: </strong>{$imgData['width']}px</span>";
										$imgInfo       .= "<span><strong>Height: </strong>{$imgData['height']}px</span>";
									}
									?>
                                    <span class="kSeoImgAdd"><span class="dashicons dashicons-plus-alt"></span></span>
                                    <span
                                            class="kSeoImgRemove <?php echo( $organizationLogoId ? null : "kSeo-hidden" ); ?>"><span
                                                class="dashicons dashicons-trash"></span></span>
                                    <div class="kSeo-image-preview"><?php echo $organizeImage; ?></div>
                                    <input type="hidden" name="organization_logo"
                                           value="<?php echo $organizationLogoId; ?>"/>
                                </div>
                                <div class='image-info'><?php echo $imgInfo; ?></div>
                            </div>
                            <div class="schema-tooltip-holder" style="left: 200px">
                                <span class="schema-tooltip"></span>
                                <div class="hidden">
                                    <p><b>Tip:</b> <?php _e( "For some Rich Snippets that use the image property, no dimensions are
                                        specified, For other Rich Snippets that use the image property, Google specifies
                                        at least 160x90 pixels and at most 1920x1080 pixels. For Google Search, the
                                        documentation for their Rich Snippets is at", "wp-seo-structured-data-schema-pro" ) ?>
                                        <a href="https://developers.google.com/structured-data/rich-snippets/.">https://developers.google.com/structured-data/rich-snippets/.</a>
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="tab-social-profile" class="rt-tab-content">
                <table width="100%" cellpadding="10" class="form-table">
                    <tr class="field_social">
                        <th><?php _e( "Company Name", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="social_company_name"
                                   value="<?php echo( ! empty( $settings['social_company_name'] ) ? esc_attr( $settings['social_company_name'] ) : null ); ?>"/>
                        </td>
                    </tr>
                    <tr class="field_social_title">
                        <th style="font-size: 18px; padding: 10px 0;"><?php _e( "Social Profiles", "wp-seo-structured-data-schema-pro" ) ?></th>
                    </tr>
                    <tr class="social_field_link">
                        <th><?php _e( "Social Profile", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <th>
                            <div id="social-field-holder">
								<?php
								$socialP = ( ! empty( $settings['social'] ) ? $settings['social'] : array() );
								if ( is_array( $socialP ) && ! empty( $socialP ) ) {
									$html = null;
									$i    = 0;
									foreach ( $socialP as $socialD ) {
										$html .= "<div class='sfield'>";
										$html .= "<select name='social[$i][id]'>";
										foreach ( KcSeoOptions::getSocialList() as $sId => $social ) {
											$slt  = ( $sId == $socialD['id'] ? "selected" : null );
											$html .= "<option value='$sId' $slt>$social</option>";
										}
										$html .= "</select>";
										$html .= "<input type='text' name='social[$i][link]' value='{$socialD['link']}'>";
										$html .= '<span class="dashicons dashicons-trash social-remove"></span>';
										$html .= "</div>";
										$i ++;
									}
									echo $html;
								}
								?>
                            </div>
                            <a class="button button-primary add-new"
                               id="social-add"><?php _e( "Add Social Profile", "wp-seo-structured-data-schema-pro" ) ?></a>
                        </th>
                    </tr>
                </table>
            </div>
            <div id="tab-corporate-contract" class="rt-tab-content">
                <table width="100%" cellpadding="10" class="form-table">
                    <tr class="field_contact">
                        <th style="font-size: 18px; padding: 10px 0;"><?php _e( "Contacts", "wp-seo-structured-data-schema-pro" ) ?></th>
                    </tr>
                    <tr class="field_contact">
                        <th><?php _e( "Contact Type", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td scope="row">
                            <select name="contact[contactType]" class="select2" style="width: 200px">
								<?php
								$contactType = ! empty( $settings['contact']['contactType'] ) ? $settings['contact']['contactType'] : null;
								foreach ( KcSeoOptions::getContactTypes() as $cType ) {
									$slt = ( $cType == $contactType ? "selected" : null );
									echo "<option value='$cType' $slt>$cType</option>";
								}

								?>
                            </select>
                        </td>

                    </tr>
                    <tr class="field_contact">
                        <th><?php _e( "Contact Phone", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="contact[telephone]"
                                   value="<?php echo( ! empty( $settings['contact']['telephone'] ) ? esc_attr( $settings['contact']['telephone'] ) : null ); ?>"/>
                            <p class="description kco-telephone"><?php _e( "Please follow the format below", "wp-seo-structured-data-schema-pro" ) ?>
                                <span>+1-505-998-3793</span>
                                <span>+(Country Code) 123-4567</span>
                                <span>+(Country Code) 42 68 53 01</span>
                                <span>+44-2078225951</span>
                                <span>1 (855) 469-6378</span>
                            </p>
                        </td>
                    </tr>
                    <tr class="field_contact">
                        <th><?php _e( "Contact Email", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td align="left" scope="row">
                            <input type="text" class="regular-text" name="contact[email]"
                                   value="<?php echo( ! empty( $settings['contact']['email'] ) ? sanitize_email( $settings['contact']['email'] ) : null ); ?>"/>
                        </td>
                    </tr>
                    <tr class="field_contact">
                        <th><?php _e( "Contact Option", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td align="left" scope="row">
                            <select name="contact[contactOption]" class="select2 withEmptyOption" style="width: 200px">
                                <option value=""><?php _e( "Select an option", "wp-seo-structured-data-schema-pro" ) ?></option>
                                <option value="TollFree" <?php
								$cPtOpt = ! empty( $settings['contact']['contactOption'] ) ? $settings['contact']['contactOption'] : null;
								echo( $cPtOpt == "TollFree" ? "selected" : null ); ?>>TollFree
                                </option>
                                <option
                                        value="HearingImpairedSupported" <?php echo( isset($settings['contact']['contactOption']) && $settings['contact']['contactOption'] == "HearingImpairedSupported" ? "selected" : null ); ?>>
									<?php _e( "HearingImpairedSupported", "wp-seo-structured-data-schema-pro" ) ?>
                                </option>
                            </select>
                        </td>
                    </tr>
                    <tr class="field_contact">
                        <th><?php _e( "Area Served", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td align="left" scope="row">
                            <div class="area_served_wrapper">
                                <select id="area_served" class="select2" name="area_served[]" multiple="multiple"
                                        style="width: 50%">
									<?php
									$areaServed = ! empty( $settings['area_served'] ) ? $settings['area_served'] : array();
									foreach ( KcSeoOptions::getCountryList() as $countryId => $country ) {
										$slt = ( in_array( $countryId, $areaServed ) ? "selected" : null );
										echo "<option value='$countryId' $slt>$country</option>";
									}
									?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr class="field_contact">
                        <th><?php _e( "Available language", "wp-seo-structured-data-schema-pro" ) ?></th>
                        <td scope="row" class="lang">
                            <select class="select2" name="availableLanguage[]" style="width: 50%" multiple="multiple">
								<?php
								$lanAvailable = ! empty( $settings['availableLanguage'] ) ? $settings['availableLanguage'] : array();
								foreach ( KcSeoOptions::getLanguageList() as $language ) {
									$slt = ( in_array( $language, $lanAvailable ) ? "selected" : null );
									echo "<option value='$language' $slt>$language</option>";
								}
								?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <h2><?php _e( "Site Schema", "wp-seo-structured-data-schema-pro" ) ?></h2>
        <table width="100%" cellpadding="10" class="form-table">
            <tr class="default">
                <th><?php _e( "Disable Site Schema", "wp-seo-structured-data-schema-pro" ) ?></th>
                <td align="left" scope="row">
                    <input type="checkbox"
                           name="disable_site_schema" <?php echo( ! empty( $settings['disable_site_schema'] ) ? "checked" : null ); ?>
                           value="1"/>
                </td>
            </tr>
            <tr class="default">
                <th><?php _e( "Enable Site link Search Box", "wp-seo-structured-data-schema-pro" ) ?></th>
                <td align="left" scope="row">
                    <input type="checkbox"
                           name="homeonly" <?php echo( ! empty( $settings['homeonly'] ) ? "checked" : null ); ?>
                           value="1"/>
                    <p class="description"><?php _e( "Note: Preferred Name markup may no longer be supported by Google", "wp-seo-structured-data-schema-pro" ) ?></p>
                </td>
            </tr>
            <tr class="default">
                <th><?php _e( "Site Name:", "wp-seo-structured-data-schema-pro" ) ?></th>
                <td align="left" scope="row">
                    <input type="text" class="regular-text" name="sitename"
                           value="<?php echo( ! empty( $settings['sitename'] ) ? esc_attr( $settings['sitename'] ) : null ); ?>"/>
                </td>
            </tr>
            <tr class="default">
                <th><?php _e( "Site Alternative Name:", "wp-seo-structured-data-schema-pro" ) ?></th>
                <td align="left" scope="row">
                    <input type="text" class="regular-text" name="siteaname"
                           value="<?php echo( ! empty( $settings['siteaname'] ) ? esc_attr( $settings['siteaname'] ) : null ); ?>"/>
                </td>
            </tr>
            <tr class="default">
                <th><?php _e( "Site Url:", "wp-seo-structured-data-schema-pro" ) ?></th>
                <td align="left" scope="row">
                    <input type="text" class="regular-text" name="siteurl"
                           value="<?php echo( ! empty( $settings['siteurl'] ) ? esc_attr( $settings['siteurl'] ) : get_home_url() ); ?>"/>
                </td>
            </tr>
        </table>
        <p class="submit"><input type="submit" name="submit" id="tlpSaveButton" class="button button-primary"
                                 value="<?php _e( 'Save Changes', "wp-seo-structured-data-schema-pro" ); ?>"></p>

		<?php wp_nonce_field( $KcSeoWPSchema->nonceText(), '_kcseo_nonce' ); ?>
    </form>
    <div id="response"></div>
</div>
