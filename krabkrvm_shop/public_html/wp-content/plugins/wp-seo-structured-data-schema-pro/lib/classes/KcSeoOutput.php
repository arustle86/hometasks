<?php

if ( ! class_exists( 'KcSeoOutput' ) ):

	class KcSeoOutput {

		function __construct() {
			add_action( 'wp_footer', array( $this, 'footer' ), 999 );
			add_action( 'amp_post_template_footer', array( $this, 'footer' ), 999 ); // AMP support
			add_action( 'kcseo_footer', array( $this, 'debug_mark' ), 2 );
			add_action( 'kcseo_footer', array( $this, 'load_schema' ), 3 );
		}

		private function head_product_name() {
			return 'WP SEO Structured Data pro plugin';
		}

		public function debug_mark( $echo = true ) {
			$marker = sprintf(
				'<!-- This site is optimized with Phil Singleton\'s ' . $this->head_product_name() . ' v%1$s - https://kcseopro.com/wordpress-seo-structured-data-schema-plugin/ -->',
				KCSEO_WP_SCHEMA_VERSION
			);

			if ( $echo === false ) {
				return $marker;
			} else {
				echo "\n${marker}\n";
			}
		}

		function footer() {

			global $wp_query;

			$old_wp_query = null;

			if ( ! $wp_query->is_main_query() ) {
				$old_wp_query = $wp_query;
				wp_reset_query();
			}
			wp_reset_postdata(); // TODO This is for wrong theme loop
			do_action( 'kcseo_footer' );

			echo "\n<!-- / ", $this->head_product_name(), ". -->\n\n";

			if ( ! empty( $old_wp_query ) ) {
				$GLOBALS['wp_query'] = $old_wp_query;
				unset( $old_wp_query );
			}

			return;
		}

		function load_schema() {
			global $KcSeoWPSchema;
			$schemaModel   = new KcSeoSchemaModel;
			$html          = null;
			$settings      = get_option( $KcSeoWPSchema->options['settings'] );
			$main_settings = get_option( $KcSeoWPSchema->options['main_settings'] );
			if ( empty( $settings['disable_site_schema'] ) ) {
				if ( is_home() || is_front_page() ) {
					$metaData = array();

					$metaData["@context"] = "http://schema.org/";
					$metaData["@type"]    = "WebSite";
					$author_url           = ( ! empty( $settings['siteurl'] ) ? $settings['siteurl'] : get_home_url() );
					if ( ! empty( $settings['homeonly'] ) && $settings['homeonly'] ) {
						$metaData["url"]             = $author_url;
						$metaData["potentialAction"] = array(
							"@type"       => "SearchAction",
							"target"      => trailingslashit( get_home_url() ) . "?s={query}",
							"query-input" => "required name=query"
						);
						$html                        .= $schemaModel->get_jsonEncode( $metaData );
					} else {
						$metaData["url"]           = $KcSeoWPSchema->sanitizeOutPut( $author_url, 'url' );
						$metaData["name"]          = ! empty( $settings['sitename'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['sitename'] ) : null;
						$metaData["alternateName"] = ! empty( $settings['siteaname'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['siteaname'] ) : null;
						$html                      .= $schemaModel->get_jsonEncode( $metaData );
					}
				}
			}

			// Generate SiteNavigationElement Schema
			if ( ! empty( $main_settings['site_nav'] ) ) {
				$items = wp_get_nav_menu_items( absint( $main_settings['site_nav'] ) );
				if ( ! empty( $items ) ) {
					$navData             = array();
					$navData["@context"] = "http://schema.org/";
					$itemData            = array();
					foreach ( $items as $item ) {
						$itemData[] = array(
							"@context" => "https://schema.org",
							"@type"    => "SiteNavigationElement",
							"@id"      => "#table-of-contents",
							"name"     => esc_html( $item->title ),
							"url"      => esc_url( $item->url )
						);
					}
					$navData["@graph"] = $itemData;
					$html              .= $schemaModel->get_jsonEncode( $navData );
				}
			}

			$webMeta             = array();
			$webMeta["@context"] = "http://schema.org";
			$siteType            = ! empty( $settings['site_type'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['site_type'] ) : null;
			$webMeta["@type"]    = $siteType;
			if ( $siteType != "Organization" ) {
				if ( ! empty( $settings['site_image'] ) && $imgID = absint( $settings['site_image'] ) ) {
					$image_url        = wp_get_attachment_url( $imgID, 'full' );
					$webMeta["image"] = $KcSeoWPSchema->sanitizeOutPut( $image_url, 'url' );
				} else {
					$webMeta["image"] = null;
				}
				$webMeta["priceRange"] = ! empty( $settings['site_price_range'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['site_price_range'] ) : null;
				$webMeta["telephone"]  = ! empty( $settings['site_telephone'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['site_telephone'] ) : null;
			}

			if ( ! empty( $settings['additionalType'] ) ) {
				$aType = explode( "\r\n", $settings['additionalType'] );
				if ( ! empty( $aType ) && is_array( $aType ) ) {
					if ( count( $aType ) == 1 ) {
						$webMeta["additionalType"] = $aType[0];
					} else if ( count( $aType ) > 1 ) {
						$webMeta["additionalType"] = $aType;
					}
				}
			}
			if ( ! empty( $settings['sameAs'] ) ) {
				$aType = explode( "\r\n", $settings['sameAs'] );
				if ( ! empty( $aType ) && is_array( $aType ) ) {
					if ( count( $aType ) == 1 ) {
						$webMeta["sameAs"] = $aType[0];
					} else if ( count( $aType ) > 1 ) {
						$webMeta["sameAs"] = $aType;
					}
				}
			}

			if ( $siteType == 'Person' ) {
				$webMeta["name"]        = ! empty( $settings['person']['name'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['person']['name'] ) : null;
				$webMeta["worksFor"]    = ! empty( $settings['person']['worksFor'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['person']['worksFor'] ) : null;
				$webMeta["jobTitle"]    = ! empty( $settings['person']['jobTitle'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['person']['jobTitle'] ) : null;
				$webMeta["image"]       = ! empty( $settings['person']['image'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['person']['image'], 'url' ) : null;
				$webMeta["description"] = ! empty( $settings['person']['description'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['person']['description'], 'textarea' ) : null;
				$webMeta["birthDate"]   = ! empty( $settings['person']['birthDate'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['person']['birthDate'] ) : null;
			} else {
				$webMeta["name"] = ! empty( $settings['type_name'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['type_name'] ) : null;
				if ( ! empty( $settings['organization_logo'] ) && $imgID = absint( $settings['organization_logo'] ) ) {
					$image_url       = wp_get_attachment_url( $imgID, 'full' );
					$webMeta["logo"] = $KcSeoWPSchema->sanitizeOutPut( $image_url, 'url' );
				} else {
					$webMeta["logo"] = null;
				}
			}
			if ( $siteType != "Organization" && $siteType != "Person" ) {
				$webMeta["description"] = ! empty( $settings['business_info']['description'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['business_info']['description'], 'textarea' ) : null;
				if ( ! empty( $settings['business_info']['openingHours'] ) ) {
					$aOhour = explode( "\r\n", $settings['business_info']['openingHours'] );
					if ( ! empty( $aOhour ) && is_array( $aOhour ) ) {
						if ( count( $aOhour ) == 1 ) {
							$webMeta["openingHours"] = $aOhour[0];
						} else if ( count( $aOhour ) > 1 ) {
							$webMeta["openingHours"] = $aOhour;
						}
					}
				}
				$webMeta["geo"] = array(
					"@type"       => "GeoCircle",
					"geoMidpoint" => array(
						"@type"     => "GeoCoordinates",
						"latitude"  => ! empty( $settings['business_info']['latitude'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['business_info']['latitude'] ) : null,
						"longitude" => ! empty( $settings['business_info']['longitude'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['business_info']['longitude'] ) : null,
					),
					"geoRadius"   => ! empty( $settings['business_info']['geo_radius'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['business_info']['geo_radius'] ) : 50,
				);
			}
			if ( in_array( $siteType, array(
				'FoodEstablishment',
				'Bakery',
				'BarOrPub',
				'Brewery',
				'CafeOrCoffeeShop',
				'FastFoodRestaurant',
				'IceCreamShop',
				'Restaurant',
				'Winery'
			) ) ) {
				$webMeta["servesCuisine"] = ! empty( $settings['restaurant']['servesCuisine'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['restaurant']['servesCuisine'], 'textarea' ) : null;
			}

			$webMeta["url"] = ! empty( $settings['web_url'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['web_url'], 'url' ) : $KcSeoWPSchema->sanitizeOutPut( get_home_url(), 'url' );
			if ( ! empty( $settings['social'] ) && is_array( $settings['social'] ) ) {
				$link = array();
				foreach ( $settings['social'] as $socialD ) {
					if ( $socialD['link'] ) {
						$link[] = $socialD['link'];
					}
				}
				if ( ! empty( $link ) ) {
					if ( ! empty( $webMeta["sameAs"] ) && is_array( $webMeta["sameAs"] ) ) {
						$webMeta["sameAs"] = array_merge( $webMeta["sameAs"], $link );
					} else {
						$webMeta["sameAs"] = $link;
					}
				}
			}

			$webMeta["contactPoint"] = array(
				"@type"             => "ContactPoint",
				"telephone"         => ! empty( $settings['contact']['telephone'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['contact']['telephone'] ) : '',
				"contactType"       => ! empty( $settings['contact']['contactType'] ) ? $KcSeoWPSchema->sanitizeOutPut( strtolower( $settings['contact']['contactType'] ) ) : '',
				"email"             => ! empty( $settings['contact']['email'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['contact']['email'] ) : '',
				"contactOption"     => ! empty( $settings['contact']['contactOption'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['contact']['contactOption'] ) : '',
				"areaServed"        => ! empty( $settings['area_served'] ) ? $settings['area_served'] : '',
				"availableLanguage" => ! empty( $settings['availableLanguage'] ) ? $settings['availableLanguage'] : null
			);
			$address                 = array(
				"@type"           => "PostalAddress",
				"addressCountry"  => ! empty( $settings['address']['country'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['address']['country'] ) : null,
				"addressLocality" => ! empty( $settings['address']['locality'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['address']['locality'] ) : null,
				"addressRegion"   => ! empty( $settings['address']['region'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['address']['region'] ) : null,
				"postalCode"      => ! empty( $settings['address']['postalcode'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['address']['postalcode'] ) : null,
				"streetAddress"   => ! empty( $settings['address']['street'] ) ? $KcSeoWPSchema->sanitizeOutPut( $settings['address']['street'] ) : null
			);
			if ( isset( $settings['_multiple_address'] ) && ! empty( $settings['_multiple_address'] ) ) {
				$address = array( $address );
				foreach ( $settings['_multiple_address'] as $mAddress ) {
					$address[] = array(
						"@type"           => "PostalAddress",
						"addressCountry"  => ! empty( $mAddress['country'] ) ? $KcSeoWPSchema->sanitizeOutPut( $mAddress['country'] ) : null,
						"addressLocality" => ! empty( $mAddress['locality'] ) ? $KcSeoWPSchema->sanitizeOutPut( $mAddress['locality'] ) : null,
						"addressRegion"   => ! empty( $mAddress['region'] ) ? $KcSeoWPSchema->sanitizeOutPut( $mAddress['region'] ) : null,
						"postalCode"      => ! empty( $mAddress['postalcode'] ) ? $KcSeoWPSchema->sanitizeOutPut( $mAddress['postalcode'] ) : null,
						"streetAddress"   => ! empty( $mAddress['street'] ) ? $KcSeoWPSchema->sanitizeOutPut( $mAddress['street'] ) : null
					);
				}
			}
			$webMeta["address"] = $address;

			if ( $siteType === 'TaxiService' ) {
				$webMeta["provider"] = array(
					"@type"      => "LocalBusiness",
					"name"       => $webMeta["name"],
					"priceRange" => $webMeta["priceRange"],
					"telephone"  => $webMeta["telephone"],
					"location"   => array(
						"@type" => "Place",
						"geo"   => $webMeta['geo']
					),
					"address"    => $webMeta["address"],
					"image"      => $webMeta["image"]
				);
				//$webMeta['providerMobility'] = "static";

				unset( $webMeta["name"] );
				unset( $webMeta["address"] );
				unset( $webMeta["contactPoint"] );
				unset( $webMeta["priceRange"] );
				unset( $webMeta["telephone"] );
				unset( $webMeta["image"] );
				unset( $webMeta['geo'] );
			} elseif ( $siteType == "Museum" ) {
				$webMeta["@type"] = [ "TouristAttraction", "Museum" ];
				unset( $webMeta["priceRange"] );
				unset( $webMeta["contactPoint"] );
			}

			$site_schema = ! empty( $main_settings['site_schema'] ) ? $main_settings['site_schema'] : 'home_page';
			if ( $site_schema !== 'off' ) {
				if ( $webMeta["@type"] ) {
					if ( $site_schema == 'home_page' ) {
						if ( is_home() || is_front_page() ) {
							$html .= $schemaModel->get_jsonEncode( $webMeta );
						}
					} elseif ( $site_schema == 'all' ) {
						$html .= $schemaModel->get_jsonEncode( $webMeta );
					}
				}
			}

			if ( is_single() || is_page() ) {
				$post = get_queried_object();
				foreach ( KcSeoOptions::getSchemaTypes() as $schemaID => $schema ) {
					$schemaMetaId = $KcSeoWPSchema->KcSeoPrefix . $schemaID;
					$metaData     = get_post_meta( $post->ID, $schemaMetaId, true );
					$metaData     = ( is_array( $metaData ) ? $metaData : array() );
					if ( ! empty( $metaData ) && ! empty( $metaData['active'] ) ) {
						$html       .= $schemaModel->schemaOutput( $schemaID, $metaData );
						$mDataArray = get_post_meta( $post->ID, $schemaMetaId . "_multiple", true );
						if ( ! empty( $mDataArray ) && is_array( $mDataArray ) ) {
							foreach ( $mDataArray as $mData ) {
								if ( ! empty( $mData ) && is_array( $mData ) ) {
									$html .= $schemaModel->schemaOutput( $schemaID, $mData );
								}
							}
						}
					}
				}
			}
			echo $html;
		}
	}
endif;