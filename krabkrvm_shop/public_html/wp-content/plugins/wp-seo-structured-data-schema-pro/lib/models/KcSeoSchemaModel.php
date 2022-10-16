<?php

if (!class_exists('KcSeoSchemaModel')):
    class KcSeoSchemaModel
    {

        function __construct() {

        }

        function schemaOutput($schemaID, $metaData) {
            $html = null;

            if ($schemaID) {
                global $KcSeoWPSchema, $post;
                switch ($schemaID) {
                    case "article":
                        $article = array(
                            "@context" => "http://schema.org",
                            "@type"    => "Article"
                        );
                        if (!empty($metaData['headline'])) {
                            $article["headline"] = $KcSeoWPSchema->sanitizeOutPut($metaData['headline']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $article["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id"   => $KcSeoWPSchema->sanitizeOutPut($metaData["mainEntityOfPage"])
                            );
                        }
                        if (!empty($metaData['author'])) {
                            $article["author"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['publisher'])) {
                            if (!empty($metaData['publisherImage'])) {
                                $img = $KcSeoWPSchema->imageInfo(absint($metaData['publisherImage']));
                                $plA = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            } else {
                                $plA = array();
                            }
                            $article["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['publisher']),
                                "logo"  => $plA
                            );
                        }
                        if (!empty($metaData['alternativeHeadline'])) {
                            $article["alternativeHeadline"] = $KcSeoWPSchema->sanitizeOutPut($metaData['alternativeHeadline']);
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $article["image"] = array(
                                "@type"  => "ImageObject",
                                "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                "height" => $img['height'],
                                "width"  => $img['width']
                            );
                        }
                        if (!empty($metaData['datePublished'])) {
                            $article["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['dateModified'])) {
                            $article["dateModified"] = $KcSeoWPSchema->sanitizeOutPut($metaData['dateModified']);
                        }
                        if (!empty($metaData['description'])) {
                            $article["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['articleBody'])) {
                            $article["articleBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['articleBody'],
                                'textarea');
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_article', $article, $metaData));
                        break;

                    case "news_article":
                        $newsArticle = array();
                        $newsArticle["@context"] = "http://schema.org";
                        $newsArticle["@type"] = "NewsArticle";
                        if (!empty($metaData['headline'])) {
                            $newsArticle["headline"] = $KcSeoWPSchema->sanitizeOutPut($metaData['headline']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $newsArticle["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id"   => $KcSeoWPSchema->sanitizeOutPut($metaData["mainEntityOfPage"])
                            );
                        }
                        if (!empty($metaData['author'])) {
                            $newsArticle["author"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $newsArticle["image"] = array(
                                "@type"  => "ImageObject",
                                "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                "height" => $img['height'],
                                "width"  => $img['width']
                            );
                        }
                        if (!empty($metaData['datePublished'])) {
                            $newsArticle["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['dateModified'])) {
                            $newsArticle["dateModified"] = $KcSeoWPSchema->sanitizeOutPut($metaData['dateModified']);
                        }
                        if (!empty($metaData['publisher'])) {
                            if (!empty($metaData['publisherImage'])) {
                                $img = $KcSeoWPSchema->imageInfo(absint($metaData['publisherImage']));
                                $plA = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            } else {
                                $plA = array();
                            }
                            $newsArticle["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['publisher']),
                                "logo"  => $plA
                            );
                        }
                        if (!empty($metaData['description'])) {
                            $newsArticle["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['articleBody'])) {
                            $newsArticle["articleBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['articleBody'],
                                'textarea');
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_news_article', $newsArticle, $metaData));
                        break;

                    case "blog_posting":
                        $blogPosting = array(
                            "@context" => "http://schema.org",
                            "@type"    => "BlogPosting"
                        );
                        if (!empty($metaData['headline'])) {
                            $blogPosting["headline"] = $KcSeoWPSchema->sanitizeOutPut($metaData['headline']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $blogPosting["mainEntityOfPage"] = array(
                                "@type" => "WebPage",
                                "@id"   => $KcSeoWPSchema->sanitizeOutPut($metaData["mainEntityOfPage"])
                            );
                        }
                        if (!empty($metaData['author'])) {
                            $blogPosting["author"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $blogPosting["image"] = array(
                                "@type"  => "ImageObject",
                                "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                "height" => $img['height'],
                                "width"  => $img['width']
                            );
                        }
                        if (!empty($metaData['datePublished'])) {
                            $blogPosting["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['dateModified'])) {
                            $blogPosting["dateModified"] = $KcSeoWPSchema->sanitizeOutPut($metaData['dateModified']);
                        }
                        if (!empty($metaData['publisher'])) {
                            if (!empty($metaData['publisherImage'])) {
                                $img = $KcSeoWPSchema->imageInfo(absint($metaData['publisherImage']));
                                $plA = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            } else {
                                $plA = array();
                            }
                            $blogPosting["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['publisher']),
                                "logo"  => $plA
                            );
                        }
                        if (!empty($metaData['description'])) {
                            $blogPosting["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['articleBody'])) {
                            $blogPosting["articleBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['articleBody'],
                                'textarea');
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_blog_posting', $blogPosting, $metaData));
                        break;

                    case 'event':
                        $event = array(
                            "@context" => "http://schema.org",
                            "@type"    => "Event"
                        );
                        if (!empty($metaData['name'])) {
                            $event["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['startDate'])) {
                            $event["startDate"] = $KcSeoWPSchema->sanitizeOutPut($metaData['startDate']);
                        }
                        if (!empty($metaData['endDate'])) {
                            $event["endDate"] = $KcSeoWPSchema->sanitizeOutPut($metaData['endDate']);
                        }

                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $event["image"] = array(
                                "@type"  => "ImageObject",
                                "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                "height" => $img['height'],
                                "width"  => $img['width']
                            );
                        }

                        if (!empty($metaData['description'])) {
                            $event["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['performerName'])) {
                            $event["performer"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['performerName'])
                            );
                        }
                        if (!empty($metaData['locationName'])) {
                            $event["location"] = array(
                                "@type"   => "Place",
                                "name"    => $KcSeoWPSchema->sanitizeOutPut($metaData['locationName']),
                                "address" => $KcSeoWPSchema->sanitizeOutPut($metaData['locationAddress'])
                            );
                        }
                        if (!empty($metaData['price'])) {
                            $event["offers"] = array(
                                "@type" => "Offer",
                                "price" => $KcSeoWPSchema->sanitizeOutPut($metaData['price'])
                            );
                            if (!empty($metaData['priceCurrency'])) {
                                $event["offers"]['priceCurrency'] = $KcSeoWPSchema->sanitizeOutPut($metaData['priceCurrency']);
                            }
                            if (!empty($metaData['url'])) {
                                $event["offers"]['url'] = $KcSeoWPSchema->sanitizeOutPut($metaData['url'],
                                    'url');
                            }
                            if (!empty($metaData['availability'])) {
                                $event["offers"]['availability'] = $KcSeoWPSchema->sanitizeOutPut($metaData['availability']);
                            }
                            if (!empty($metaData['validFrom'])) {
                                $event["offers"]['validFrom'] = $KcSeoWPSchema->sanitizeOutPut($metaData['validFrom']);
                            }
                        }
                        if (!empty($metaData['url'])) {
                            $event["url"] = $KcSeoWPSchema->sanitizeOutPut($metaData['url'], 'url');
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_event', $event, $metaData));
                        if (isset($metaData['review_active'])) {
                            $event_review = array(
                                "@context" => "http://schema.org",
                                "@type"    => "Review"
                            );

                            if (isset($metaData['review_datePublished']) && !empty($metaData['review_datePublished'])) {
                                $event_review["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_datePublished']);
                            }
                            if (isset($metaData['review_body']) && !empty($metaData['review_body'])) {
                                $event_review["reviewBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_body'], 'textarea');
                            }
                            unset($event['@context']);
                            $event_review["itemReviewed"] = $event;
                            if (!empty($metaData['review_author'])) {
                                $event_review["author"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['review_author'])
                                );

                                if (isset($metaData['review_author_sameAs']) && !empty($metaData['review_author_sameAs'])) {
                                    $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['review_author_sameAs'], "textarea"));
                                    if (!empty($sameAs)) {
                                        $event_review["author"]["sameAs"] = $sameAs;
                                    }
                                }
                            }
                            if (isset($metaData['review_ratingValue'])) {
                                $event_review["reviewRating"] = array(
                                    "@type"       => "Rating",
                                    "ratingValue" => $KcSeoWPSchema->sanitizeOutPut($metaData['review_ratingValue'], 'number')
                                );
                                if (isset($metaData['review_bestRating'])) {
                                    $event_review["reviewRating"]["bestRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_bestRating'], 'number');
                                }
                                if (isset($metaData['review_worstRating'])) {
                                    $event_review["reviewRating"]["worstRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_worstRating'], 'number');
                                }
                            }


                            $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_event_review', $event_review, $metaData));
                        }
                        break;

                    case 'product':
                        $woo = class_exists('woocommerce') ? true : false;
                        $_product = $woo ? wc_get_product($post->ID) : null;

                        $product = array(
                            "@context" => "http://schema.org",
                            "@type"    => "Product"
                        );
                        if (!empty($metaData['name'])) {
                            $product["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['image'])) {

                            if ($_product && has_post_thumbnail($post->ID)) {
                                $metaData['image'] = get_post_thumbnail_id($post->ID);
                            }
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $product["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                        }
                        if (!empty($metaData['description'])) {
                            $product["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description']);
                        }
                        /* product identifier */
                        if (!empty($metaData['sku'])) {
                            $product["sku"] = $KcSeoWPSchema->sanitizeOutPut($metaData['sku']);
                        }
                        if (!empty($metaData['brand'])) {
                            $product["brand"] = $KcSeoWPSchema->sanitizeOutPut($metaData['brand']);
                        }
                        if (!empty($metaData['identifier_type']) && !empty($metaData['identifier'])) {
                            $product[$metaData['identifier_type']] = $KcSeoWPSchema->sanitizeOutPut($metaData['identifier']);
                        }
                        if (!empty($metaData['ratingValue'])) {
                            if ($_product) {
                                $metaData['ratingValue'] = ($count = $_product->get_average_rating()) ? $count : $metaData['ratingValue'];
                                $metaData['reviewCount'] = ($count = $_product->get_review_count()) ? $count : $metaData['reviewCount'];
                            }
                            $product["aggregateRating"] = array(
                                "@type"       => "AggregateRating",
                                "ratingValue" => !empty($metaData['ratingValue']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['ratingValue']) : null,
                                "reviewCount" => !empty($metaData['reviewCount']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['reviewCount']) : null
                            );
                        }
                        if (!empty($metaData['reviewRatingValue']) || !empty($metaData['reviewBestRating']) || !empty($metaData['reviewWorstRating'])) {
                            $product["review"] = array(
                                "@type"        => "Review",
                                "reviewRating" => array(
                                    "@type"       => "Rating",
                                    "ratingValue" => !empty($metaData['reviewRatingValue']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['reviewRatingValue']) : null,
                                    "bestRating"  => !empty($metaData['reviewBestRating']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['reviewBestRating']) : null,
                                    "worstRating" => !empty($metaData['reviewWorstRating']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['reviewWorstRating']) : null
                                ),
                                "author"       => array(
                                    "@type" => "Person",
                                    "name"  => !empty($metaData['reviewAuthor']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['reviewAuthor']) : null
                                )
                            );
                        }
                        if (!empty($metaData['price'])) {
                            if ($_product) {
                                $metaData['priceCurrency'] = $metaData['priceCurrency'] ? $metaData['priceCurrency'] : get_woocommerce_currency();
                                $availability = $_product->get_availability();
                                if (!empty($availability['class'])) {
                                    switch ($availability['class']) {
                                        case 'in-stock':
                                            $metaData['availability'] = 'http://schema.org/InStock';
                                            break;
                                        case 'out-of-stock':
                                            $metaData['availability'] = 'http://schema.org/OutOfStock';
                                            break;
                                        case 'available-on-backorder':
                                            $metaData['availability'] = 'http://schema.org/PreOrder';
                                            break;
                                    }
                                }
                            }
                            $product["offers"] = array(
                                "@type"           => "Offer",
                                "price"           => $KcSeoWPSchema->sanitizeOutPut($metaData['price']),
                                "priceValidUntil" => $KcSeoWPSchema->sanitizeOutPut($metaData['priceValidUntil']),
                                "priceCurrency"   => !empty($metaData['priceCurrency']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['priceCurrency']) : null,
                                "itemCondition"   => !empty($metaData['itemCondition']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['itemCondition']) : null,
                                "availability"    => !empty($metaData['availability']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['availability']) : null,
                                "url"             => !empty($metaData['url']) ? $KcSeoWPSchema->sanitizeOutPut($metaData['url']) : null
                            );
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_product', $product, $metaData));
                        break;

                    case 'video':
                        $video = array(
                            "@context" => "http://schema.org",
                            "@type"    => "VideoObject"
                        );
                        if (!empty($metaData['name'])) {
                            $video["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $video["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'], 'textarea');
                        }
                        if (!empty($metaData['thumbnailUrl'])) {
                            $video["thumbnailUrl"] = $KcSeoWPSchema->sanitizeOutPut($metaData['thumbnailUrl'], 'url');
                        }
                        if (!empty($metaData['uploadDate'])) {
                            $video["uploadDate"] = $KcSeoWPSchema->sanitizeOutPut($metaData['uploadDate']);
                        }
                        if (!empty($metaData['duration'])) {
                            $video["duration"] = $KcSeoWPSchema->sanitizeOutPut($metaData['duration']);
                        }
                        if (!empty($metaData['contentUrl'])) {
                            $video["contentUrl"] = $KcSeoWPSchema->sanitizeOutPut($metaData['contentUrl'], 'url');
                        }
                        if (!empty($metaData['embedUrl'])) {
                            $video["embedUrl"] = $KcSeoWPSchema->sanitizeOutPut($metaData['embedUrl'], 'url');
                        }
                        if (!empty($metaData['interactionCount'])) {
                            $video["interactionCount"] = $KcSeoWPSchema->sanitizeOutPut($metaData['interactionCount']);
                        }
                        if (!empty($metaData['expires'])) {
                            $video["expires"] = $KcSeoWPSchema->sanitizeOutPut($metaData['expires']);
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_video', $video, $metaData));
                        break;

                    case 'service':
                        $service = array(
                            "@context" => "http://schema.org",
                            "@type"    => "Service"
                        );
                        if (!empty($metaData['name'])) {
                            $service["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['serviceType'])) {
                            $service["serviceType"] = $KcSeoWPSchema->sanitizeOutPut($metaData['serviceType']);
                        }
                        if (!empty($metaData['award'])) {
                            $service["award"] = $KcSeoWPSchema->sanitizeOutPut($metaData['award']);
                        }
                        if (!empty($metaData['category'])) {
                            $service["category"] = $KcSeoWPSchema->sanitizeOutPut($metaData['category']);
                        }
                        if (!empty($metaData['providerMobility'])) {
                            $service["providerMobility"] = $KcSeoWPSchema->sanitizeOutPut($metaData['providerMobility']);
                        }
                        if (!empty($metaData['additionalType'])) {
                            $service["additionalType"] = $KcSeoWPSchema->sanitizeOutPut($metaData['additionalType']);
                        }
                        if (!empty($metaData['alternateName'])) {
                            $service["alternateName"] = $KcSeoWPSchema->sanitizeOutPut($metaData['alternateName']);
                        }
                        if (!empty($metaData['image'])) {
                            $service["image"] = $KcSeoWPSchema->sanitizeOutPut($metaData['image']);
                        }
                        if (!empty($metaData['mainEntityOfPage'])) {
                            $service["mainEntityOfPage"] = $KcSeoWPSchema->sanitizeOutPut($metaData['mainEntityOfPage']);
                        }
                        if (!empty($metaData['sameAs'])) {
                            $service["sameAs"] = $KcSeoWPSchema->sanitizeOutPut($metaData['sameAs']);
                        }
                        if (!empty($metaData['url'])) {
                            $service["url"] = $KcSeoWPSchema->sanitizeOutPut($metaData['url'], 'url');
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_service', $service, $metaData));
                        break;

                    case 'review':
                        $review = array(
                            "@context" => "http://schema.org",
                            "@type"    => "Review"
                        );
                        if (!empty($metaData['itemName'])) {
                            $review["itemReviewed"] = array(
                                "@type" => "product",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['itemName'])
                            );
                        }
                        if (!empty($metaData['ratingValue'])) {
                            $review["reviewRating"] = array(
                                "@type"       => "Rating",
                                "ratingValue" => $KcSeoWPSchema->sanitizeOutPut($metaData['ratingValue']),
                                "bestRating"  => $KcSeoWPSchema->sanitizeOutPut($metaData['bestRating']),
                                "worstRating" => $KcSeoWPSchema->sanitizeOutPut($metaData['worstRating'])
                            );
                        }
                        if (!empty($metaData['name'])) {
                            $review["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['author'])) {
                            $review["author"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['reviewBody'])) {
                            $review["reviewBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['reviewBody']);
                        }
                        if (!empty($metaData['datePublished'])) {
                            $review["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['publisher'])) {
                            $review["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['publisher'])
                            );
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_review', $review, $metaData));
                        break;

                    case 'aggregate_rating':
                        $aRating = array(
                            "@context" => "http://schema.org",
                            "@type"    => !empty($metaData['schema_type']) ? $metaData['schema_type'] : "LocalBusiness"
                        );
                        if (!empty($metaData['name'])) {
                            $aRating["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $aRating["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if ($aRating["@type"] != "Organization") {
                            if (!empty($metaData['image'])) {
                                $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                                $aRating["image"] = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            }
                            if (!empty($metaData['priceRange'])) {
                                $aRating["priceRange"] = $KcSeoWPSchema->sanitizeOutPut($metaData['priceRange']);
                            }
                            if (!empty($metaData['telephone'])) {
                                $aRating["telephone"] = $KcSeoWPSchema->sanitizeOutPut($metaData['telephone']);
                            }

                            if (!empty($metaData['address'])) {
                                $aRating["address"] = $KcSeoWPSchema->sanitizeOutPut($metaData['address']);
                            }
                        }

                        if (!empty($metaData['ratingValue'])) {
                            $rValue = array();
                            $rValue["@type"] = "AggregateRating";
                            $rValue["ratingValue"] = $KcSeoWPSchema->sanitizeOutPut($metaData['ratingValue']);
                            if (!empty($metaData['bestRating'])) {
                                $rValue["bestRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['bestRating']);
                            }
                            if (!empty($metaData['worstRating'])) {
                                $rValue["worstRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['worstRating']);
                            }
                            if (!empty($metaData['ratingCount'])) {
                                $rValue["ratingCount"] = $KcSeoWPSchema->sanitizeOutPut($metaData['ratingCount']);
                            }

                            $aRating["aggregateRating"] = $rValue;
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_aggregate_rating', $aRating, $metaData));
                        break;

                    case 'restaurant':
                        $restaurant = array(
                            "@context" => "http://schema.org",
                            "@type"    => "Restaurant"
                        );
                        if (!empty($metaData['name'])) {
                            $restaurant["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $restaurant["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['openingHours'])) {
                            $restaurant["openingHours"] = $KcSeoWPSchema->sanitizeOutPut($metaData['openingHours'],
                                'textarea');
                        }
                        if (!empty($metaData['telephone'])) {
                            $restaurant["telephone"] = $KcSeoWPSchema->sanitizeOutPut($metaData['telephone']);
                        }
                        if (!empty($metaData['address'])) {
                            $restaurant["address"] = $KcSeoWPSchema->sanitizeOutPut($metaData['address'], 'textarea');
                        }
                        if (!empty($metaData['priceRange'])) {
                            $restaurant["priceRange"] = $KcSeoWPSchema->sanitizeOutPut($metaData['priceRange']);
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $restaurant["image"] = array(
                                "@type"  => "ImageObject",
                                "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                "height" => $img['height'],
                                "width"  => $img['width']
                            );
                        }
                        if (!empty($metaData['servesCuisine'])) {
                            $restaurant["servesCuisine"] = explode("\r\n", $KcSeoWPSchema->sanitizeOutPut($metaData['servesCuisine'], 'textarea'));
                        }
                        if (!empty($metaData['menuName'])) {
                            $menu = array("@type" => "MenuSection");
                            if (!empty($metaData['menuName'])) {
                                $menu["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['menuName']);
                            }
                            if (!empty($metaData['menuDescription'])) {
                                $menu["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['menuDescription'], 'textarea');
                            }
                            if (!empty($metaData['menuImage'])) {
                                $img = $KcSeoWPSchema->imageInfo(absint($metaData['menuImage']));
                                $menu["image"] = array(
                                    "@type"  => "ImageObject",
                                    "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                    "height" => $img['height'],
                                    "width"  => $img['width']
                                );
                            }
                            $menu['offers'] = array(
                                "@type"              => "Offer",
                                "availabilityEnds"   => $metaData['menuOfferAvailabilityEnds'] ? $KcSeoWPSchema->sanitizeOutPut($metaData['menuOfferAvailabilityEnds']) : null,
                                "availabilityStarts" => $metaData['menuOfferAvailabilityEnds'] ? $KcSeoWPSchema->sanitizeOutPut($metaData['menuOfferAvailabilityEnds']) : null
                            );
                            if (isset($metaData['menu_items']) && is_array($metaData['menu_items']) && !empty($metaData['menu_items'])) {
                                $menu_items_schema = array();
                                foreach ($metaData['menu_items'] as $menu_item) {
                                    $menu_item_schema = array(
                                        "@type"       => "MenuItem",
                                        'name'        => $menu_item['name'] ? $KcSeoWPSchema->sanitizeOutPut($menu_item['name']) : null,
                                        'description' => $menu_item['description'] ? $KcSeoWPSchema->sanitizeOutPut($menu_item['description'], 'textarea') : null,
                                        "offers"      => array(
                                            "@type"         => "Offer",
                                            "price"         => $menu_item['offers_price'] ? $KcSeoWPSchema->sanitizeOutPut($menu_item['offers_price']) : null,
                                            "priceCurrency" => $menu_item['offers_priceCurrency'] ? $KcSeoWPSchema->sanitizeOutPut($menu_item['offers_priceCurrency']) : null
                                        )
                                    );
                                    $nutritious = array(
                                        'nutrition_calories',
                                        'nutrition_carbohydrateContent',
                                        'nutrition_cholesterolContent',
                                        'nutrition_fatContent',
                                        'nutrition_fiberContent',
                                        'nutrition_proteinContent',
                                        'nutrition_saturatedFatContent',
                                        'nutrition_servingSize',
                                        'nutrition_sodiumContent',
                                        'nutrition_sugarContent',
                                        'nutrition_transFatContent',
                                        'nutrition_unsaturatedFatContent'
                                    );
                                    $nutritiousA = array();
                                    foreach ($nutritious as $nutrition) {
                                        if (isset($menu_item[$nutrition]) && !empty($menu_item[$nutrition])) {
                                            $nId = str_replace('nutrition_', '', $nutrition);
                                            $nutritiousA[$nId] = $KcSeoWPSchema->sanitizeOutPut($menu_item[$nutrition]);
                                        }
                                    }
                                    if (!empty($nutritiousA)) {
                                        $nutritiousA = array("@type" => "NutritionInformation") + $nutritiousA;
                                        $menu_item_schema['nutrition'] = $nutritiousA;
                                    }
                                    array_push($menu_items_schema, $menu_item_schema);

                                }
                                if (count($menu_items_schema) == 1) {
                                    $menu['hasMenuItem'] = $menu_items_schema[0];
                                } else {
                                    $menu['hasMenuItem'] = $menu_items_schema;
                                }
                            }

                            $restaurant["menu"] = array(
                                "@type"          => "Menu",
                                'hasMenuSection' => $menu
                            );
                        }

                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_restaurant', $restaurant, $metaData));
                        break;

                    case 'localBusiness':
                        $local_business = array(
                            "@context" => "http://schema.org",
                            "@type"    => "LocalBusiness"
                        );
                        if (!empty($metaData['name'])) {
                            $local_business["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $local_business["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $local_business["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                        }
                        if (!empty($metaData['priceRange'])) {
                            $local_business["priceRange"] = $KcSeoWPSchema->sanitizeOutPut($metaData['priceRange']);
                        }
                        if (!empty($metaData['addressLocality']) || !empty($metaData['addressRegion'])
                            || !empty($metaData['postalCode']) || !empty($metaData['streetAddress'])) {
                            $local_business["address"] = array(
                                "@type"           => "PostalAddress",
                                "addressLocality" => $KcSeoWPSchema->sanitizeOutPut($metaData['addressLocality']),
                                "addressRegion"   => $KcSeoWPSchema->sanitizeOutPut($metaData['addressRegion']),
                                "postalCode"      => $KcSeoWPSchema->sanitizeOutPut($metaData['postalCode']),
                                "streetAddress"   => $KcSeoWPSchema->sanitizeOutPut($metaData['streetAddress'])
                            );
                        }

                        if (!empty($metaData['telephone'])) {
                            $local_business["telephone"] = $KcSeoWPSchema->sanitizeOutPut($metaData['telephone']);
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_local_business', $local_business, $metaData));
                        if (isset($metaData['review_active'])) {
                            $local_business_review = array(
                                "@context" => "http://schema.org",
                                "@type"    => "Review",
                            );
                            if (isset($metaData['review_datePublished']) && !empty($metaData['review_datePublished'])) {
                                $local_business_review["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_datePublished']);
                            }
                            if (isset($metaData['review_body']) && !empty($metaData['review_body'])) {
                                $local_business_review["reviewBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_body'], 'textarea');
                            }

                            unset($local_business['@context']);
                            if (isset($local_business["description"])) {
                                $local_business_review["description"] = KcSeoHelper::filter_content($local_business["description"], 200);
                                unset($local_business["description"]);
                            }
                            if (isset($metaData['review_sameAs']) && !empty($metaData['review_sameAs'])) {
                                $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['review_sameAs'], "textarea"));
                                if (!empty($sameAs)) {
                                    $local_business["sameAs"] = $sameAs;
                                }
                            }

                            $local_business_review["itemReviewed"] = $local_business;
                            if (!empty($metaData['review_author'])) {
                                $local_business_review["author"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['review_author'])
                                );

                                if (isset($metaData['review_author_sameAs']) && !empty($metaData['review_author_sameAs'])) {
                                    $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['review_author_sameAs'], "textarea"));
                                    if (!empty($sameAs)) {
                                        $local_business_review["author"]["sameAs"] = $sameAs;
                                    }
                                }
                            }
                            if (isset($metaData['review_ratingValue'])) {
                                $local_business_review["reviewRating"] = array(
                                    "@type"       => "Rating",
                                    "ratingValue" => $KcSeoWPSchema->sanitizeOutPut($metaData['review_ratingValue'], 'number')
                                );
                                if (isset($metaData['review_bestRating'])) {
                                    $local_business_review["reviewRating"]["bestRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_bestRating'], 'number');
                                }
                                if (isset($metaData['review_worstRating'])) {
                                    $local_business_review["reviewRating"]["worstRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_worstRating'], 'number');
                                }
                            }


                            $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_local_business_review', $local_business_review, $metaData));
                        }
                        break;

                    case 'software_application':
                        $app = array(
                            "@context" => "http://schema.org",
                            "@type"    => "SoftwareApplication"
                        );
                        if (!empty($metaData['name'])) {
                            $app["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $app["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $app["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                        }

                        if (!empty($metaData['applicationCategory'])) {
                            $app["applicationCategory"] = "http://schema.org/" . $KcSeoWPSchema->sanitizeOutPut($metaData['applicationCategory']);
                        }

                        if (!empty($metaData['operatingSystem'])) {
                            $app["operatingSystem"] = $KcSeoWPSchema->sanitizeOutPut($metaData['operatingSystem']);
                        }

                        if (!empty($metaData['price'])) {
                            $app["offers"] = array(
                                "@type" => 'Offer',
                                "price" => $KcSeoWPSchema->sanitizeOutPut($metaData['price'])
                            );
                            if (!empty($metaData['priceCurrency'])) {
                                $app["offers"]["priceCurrency"] = $KcSeoWPSchema->sanitizeOutPut($metaData['priceCurrency']);
                            }
                        }
                        if (isset($metaData['aggregate_ratingValue'])) {
                            $app["aggregateRating"] = array(
                                "@type"       => 'AggregateRating',
                                "ratingValue" => $KcSeoWPSchema->sanitizeOutPut($metaData['aggregate_ratingValue'], "number")
                            );
                            if (isset($metaData['aggregate_bestRating'])) {
                                $app["aggregateRating"]["bestRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['aggregate_bestRating'], "number");
                            }
                            if (isset($metaData['aggregate_worstRating'])) {
                                $app["aggregateRating"]["worstRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['aggregate_worstRating'], "number");
                            }
                            if (isset($metaData['aggregate_ratingCount'])) {
                                $app["aggregateRating"]["reviewCount"] = $KcSeoWPSchema->sanitizeOutPut($metaData['aggregate_ratingCount'], "number");
                            }
                        }

                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_software_application', $app, $metaData));
                        if (isset($metaData['review_active'])) {
                            $app_review = array(
                                "@context" => "http://schema.org",
                                "@type"    => "Review",
                            );
                            if (isset($metaData['review_datePublished']) && !empty($metaData['review_datePublished'])) {
                                $app_review["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_datePublished']);
                            }
                            if (isset($metaData['review_body']) && !empty($metaData['review_body'])) {
                                $app_review["reviewBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_body'], 'textarea');
                            }

                            unset($app['@context']);
                            if (isset($app["description"])) {
                                $app_review["description"] = KcSeoHelper::filter_content($app["description"], 200);
                                unset($app["description"]);
                            }
                            if (isset($metaData['review_sameAs']) && !empty($metaData['review_sameAs'])) {
                                $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['review_sameAs'], "textarea"));
                                if (!empty($sameAs)) {
                                    $app["sameAs"] = $sameAs;
                                }
                            }

                            $app_review["itemReviewed"] = $app;
                            if (!empty($metaData['review_author'])) {
                                $app_review["author"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['review_author'])
                                );

                                if (isset($metaData['review_author_sameAs']) && !empty($metaData['review_author_sameAs'])) {
                                    $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['review_author_sameAs'], "textarea"));
                                    if (!empty($sameAs)) {
                                        $app_review["author"]["sameAs"] = $sameAs;
                                    }
                                }
                            }
                            if (isset($metaData['review_ratingValue'])) {
                                $app_review["reviewRating"] = array(
                                    "@type"       => "Rating",
                                    "ratingValue" => $KcSeoWPSchema->sanitizeOutPut($metaData['review_ratingValue'], 'number')
                                );
                                if (isset($metaData['review_bestRating'])) {
                                    $app_review["reviewRating"]["bestRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_bestRating'], 'number');
                                }
                                if (isset($metaData['review_worstRating'])) {
                                    $app_review["reviewRating"]["worstRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_worstRating'], 'number');
                                }
                            }


                            $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_software_application_review', $app_review, $metaData));
                        }
                        break;

                    case 'JobPosting':
                        $jobPosting = array();
                        $jobPosting["@context"] = "http://schema.org";
                        $jobPosting["@type"] = "JobPosting";
                        if (!empty($metaData['title'])) {
                            $jobPosting["title"] = $KcSeoWPSchema->sanitizeOutPut($metaData['title']);
                        }
                        if (!empty($metaData['workHours'])) {
                            $jobPosting["workHours"] = $KcSeoWPSchema->sanitizeOutPut($metaData['workHours']);
                        }
                        if (!empty($metaData['salaryAmount']) || !empty($metaData['currency']) || !empty($metaData['salaryAt'])) {

                            $jobPosting["baseSalary"] = array(
                                "@type"    => "MonetaryAmount",
                                "currency" => $KcSeoWPSchema->sanitizeOutPut($metaData['currency']),
                                "value"    => array(
                                    "@type"    => "QuantitativeValue",
                                    "value"    => $KcSeoWPSchema->sanitizeOutPut($metaData['salaryAmount']),
                                    "unitText" => $KcSeoWPSchema->sanitizeOutPut($metaData['salaryAt'])
                                )
                            );
                        }
                        if (!empty($metaData['jobBenefits'])) {
                            $jobPosting["jobBenefits"] = $KcSeoWPSchema->sanitizeOutPut($metaData['jobBenefits']);
                        }
                        if (!empty($metaData['datePosted'])) {
                            $jobPosting["datePosted"] = $KcSeoWPSchema->sanitizeOutPut($metaData['datePosted']);
                        }
                        if (!empty($metaData['validThrough'])) {
                            $jobPosting["validThrough"] = $KcSeoWPSchema->sanitizeOutPut($metaData['validThrough']);
                        }
                        if (!empty($metaData['description'])) {
                            $jobPosting["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['educationRequirements'])) {
                            $jobPosting["educationRequirements"] = $KcSeoWPSchema->sanitizeOutPut($metaData['educationRequirements'],
                                'textarea');
                        }
                        if (!empty($metaData['employmentType'])) {
                            $jobPosting["employmentType"] = $KcSeoWPSchema->sanitizeOutPut($metaData['employmentType']);
                        }
                        if (!empty($metaData['experienceRequirements'])) {
                            $jobPosting["experienceRequirements"] = $KcSeoWPSchema->sanitizeOutPut($metaData['experienceRequirements']);
                        }
                        if (!empty($metaData['incentiveCompensation'])) {
                            $jobPosting["incentiveCompensation"] = $KcSeoWPSchema->sanitizeOutPut($metaData['incentiveCompensation']);
                        }
                        if (!empty($metaData['hiringOrganization'])) {
                            $jobPosting["hiringOrganization"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['hiringOrganization'])
                            );
                        }
                        if (!empty($metaData['industry'])) {
                            $jobPosting["industry"] = $KcSeoWPSchema->sanitizeOutPut($metaData['industry']);
                        }
                        if (!empty($metaData['addressLocality']) || !empty($metaData['addressRegion'])) {
                            $jobPosting["jobLocation"] = array(
                                "@type"   => "Place",
                                "address" => array(
                                    "@type"           => "PostalAddress",
                                    "addressLocality" => $KcSeoWPSchema->sanitizeOutPut($metaData['addressLocality']),
                                    "addressRegion"   => $KcSeoWPSchema->sanitizeOutPut($metaData['addressRegion']),
                                    "postalCode"      => $KcSeoWPSchema->sanitizeOutPut($metaData['postalCode']),
                                    "streetAddress"   => $KcSeoWPSchema->sanitizeOutPut($metaData['streetAddress'])
                                )
                            );
                        }
                        if (!empty($metaData['occupationalCategory'])) {
                            $jobPosting["occupationalCategory"] = $KcSeoWPSchema->sanitizeOutPut($metaData['occupationalCategory']);
                        }
                        if (!empty($metaData['qualifications'])) {
                            $jobPosting["qualifications"] = $KcSeoWPSchema->sanitizeOutPut($metaData['qualifications'],
                                'textarea');
                        }
                        if (!empty($metaData['responsibilities'])) {
                            $jobPosting["responsibilities"] = $KcSeoWPSchema->sanitizeOutPut($metaData['responsibilities'],
                                'textarea');
                        }
                        if (!empty($metaData['salaryCurrency'])) {
                            $jobPosting["salaryCurrency"] = $KcSeoWPSchema->sanitizeOutPut($metaData['salaryCurrency']);
                        }
                        if (!empty($metaData['skills'])) {
                            $jobPosting["skills"] = $KcSeoWPSchema->sanitizeOutPut($metaData['skills'], 'textarea');
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_job_posting', $jobPosting, $metaData));
                        break;

                    case 'recipe':
                        $recipe = array(
                            "@context" => "http://schema.org",
                            "@type"    => "Recipe"
                        );
                        if (!empty($metaData['name'])) {
                            $recipe["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['author'])) {
                            $recipe["author"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['author'])
                            );
                        }
                        if (!empty($metaData['datePublished'])) {
                            $recipe["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['keywords'])) {
                            $recipe["keywords"] = $KcSeoWPSchema->sanitizeOutPut($metaData['keywords']);
                        }
                        if (!empty($metaData['recipeCategory'])) {
                            $recipe["recipeCategory"] = $KcSeoWPSchema->sanitizeOutPut($metaData['recipeCategory']);
                        }
                        if (!empty($metaData['recipeCuisine'])) {
                            $recipe["recipeCuisine"] = $KcSeoWPSchema->sanitizeOutPut($metaData['recipeCuisine']);
                        }
                        if (!empty($metaData['video'])) {
                            $recipe["video"] = $KcSeoWPSchema->sanitizeOutPut($metaData['video'], 'url');
                        }
                        if (!empty($metaData['prepTime'])) {
                            $recipe["prepTime"] = $KcSeoWPSchema->sanitizeOutPut($metaData['prepTime']);
                        }
                        if (!empty($metaData['cookTime'])) {
                            $recipe["cookTime"] = $KcSeoWPSchema->sanitizeOutPut($metaData['cookTime']);
                        }
                        if (!empty($metaData['description'])) {
                            $recipe["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $recipe["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                        }

                        if (!empty($metaData['recipeIngredient'])) {
                            $recipe["recipeIngredient"] = explode("\r\n",
                                $KcSeoWPSchema->sanitizeOutPut($metaData['recipeIngredient'], 'textarea'));
                        }
                        if (!empty($metaData['userInteractionCount'])) {
                            $recipe["interactionStatistic"] = array(
                                "@type"                => "InteractionCounter",
                                "interactionType"      => "http://schema.org/Comment",
                                "userInteractionCount" => $KcSeoWPSchema->sanitizeOutPut($metaData['userInteractionCount'])
                            );
                        }
                        if (!empty($metaData['ratingValue']) || !empty($metaData['reviewCount'])) {
                            $recipe["aggregateRating"] = array(
                                "@type"       => "AggregateRating",
                                "ratingValue" => $KcSeoWPSchema->sanitizeOutPut($metaData['ratingValue'], 'number'),
                                "reviewCount" => $KcSeoWPSchema->sanitizeOutPut($metaData['reviewCount'], 'number'),
                                "bestRating"  => $KcSeoWPSchema->sanitizeOutPut($metaData['bestRating'], 'number'),
                                "worstRating" => $KcSeoWPSchema->sanitizeOutPut($metaData['worstRating'], 'number')
                            );
                        }
                        if (!empty($metaData['calories']) || !empty($metaData['fatContent'])) {
                            $recipe["nutrition"] = array(
                                "@type"      => "NutritionInformation",
                                "calories"   => $KcSeoWPSchema->sanitizeOutPut($metaData['calories']),
                                "fatContent" => $KcSeoWPSchema->sanitizeOutPut($metaData['fatContent'])
                            );
                        }

                        if (!empty($metaData['recipeInstructions'])) {
                            $recipe["recipeInstructions"] = $KcSeoWPSchema->sanitizeOutPut($metaData['recipeInstructions'],
                                'textarea');
                        }
                        if (!empty($metaData['recipeYield'])) {
                            $recipe["recipeYield"] = $KcSeoWPSchema->sanitizeOutPut($metaData['recipeYield']);
                        }
                        if (!empty($metaData['suitableForDiet'])) {
                            $recipe["suitableForDiet"] = $KcSeoWPSchema->sanitizeOutPut($metaData['suitableForDiet']);
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_recipe', $recipe, $metaData));
                        if (isset($metaData['review_active'])) {
                            $recipe_review = array(
                                "@context"     => "http://schema.org",
                                "@type"        => "Review",
                                "itemReviewed" => array(
                                    "@type" => "Recipe",
                                )
                            );

                            if (isset($metaData['review_datePublished']) && !empty($metaData['review_datePublished'])) {
                                $recipe_review["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_datePublished']);
                            } else if (isset($recipe['datePublished'])) {
                                $recipe_review["datePublished"] = $recipe['datePublished'];
                            }
                            if (isset($metaData['review_body']) && !empty($metaData['review_body'])) {
                                $recipe_review["reviewBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_body'], 'textarea');
                            }
                            unset($recipe['@context']);
                            unset($recipe['@context']);
                            $recipe_review["itemReviewed"] = $recipe;
                            if (!empty($metaData['review_author'])) {
                                $recipe_review["author"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['review_author'])
                                );

                                if (isset($metaData['review_author_sameAs']) && !empty($metaData['review_author_sameAs'])) {
                                    $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['review_author_sameAs'], "textarea"));
                                    if (!empty($sameAs)) {
                                        $recipe_review["author"]["sameAs"] = $sameAs;
                                    }
                                }
                            }
                            if (isset($metaData['review_ratingValue'])) {
                                $recipe_review["reviewRating"] = array(
                                    "@type"       => "Rating",
                                    "ratingValue" => $KcSeoWPSchema->sanitizeOutPut($metaData['review_ratingValue'], 'number')
                                );
                                if (isset($metaData['review_bestRating'])) {
                                    $recipe_review["reviewRating"]["bestRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_bestRating'], 'number');
                                }
                                if (isset($metaData['review_worstRating'])) {
                                    $recipe_review["reviewRating"]["worstRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_worstRating'], 'number');
                                }
                            }
                            $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_recipe_review', $recipe_review, $metaData));
                        }
                        break;

                    case 'book':
                        $book = array();
                        $book["@context"] = "http://schema.org";
                        $book["@type"] = "Book";
                        if (!empty($metaData['name'])) {
                            $book["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['author'])) {
                            $book["author"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['author'])
                            );

                            if (isset($metaData['author_sameAs']) && !empty($metaData['author_sameAs'])) {
                                $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['author_sameAs'], "textarea"));
                                if (!empty($sameAs)) {
                                    $book["author"]["sameAs"] = $sameAs;
                                }
                            }
                        }
                        if (!empty($metaData['bookFormat'])) {
                            $book["bookFormat"] = $KcSeoWPSchema->sanitizeOutPut($metaData['bookFormat']);
                        }
                        if (!empty($metaData['isbn'])) {
                            $book["isbn"] = $KcSeoWPSchema->sanitizeOutPut($metaData['isbn']);
                        }
                        if (!empty($metaData['workExample'])) {
                            $book["workExample"] = array(
                                "@type" => "CreativeWork",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['workExample'])
                            );
                        }
                        if (!empty($metaData['url'])) {
                            $book["url"] = $KcSeoWPSchema->sanitizeOutPut($metaData['url']);
                        }
                        if (!empty($metaData['sameAs'])) {
                            $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['sameAs'], "textarea"));
                            if (!empty($sameAs)) {
                                $book["sameAs"] = $sameAs;
                            }
                        }
                        if (!empty($metaData['publisher'])) {
                            $book["publisher"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['publisher'])
                            );
                        }
                        if (!empty($metaData['numberOfPages'])) {
                            $book["numberOfPages"] = $KcSeoWPSchema->sanitizeOutPut($metaData['numberOfPages']);
                        }
                        if (!empty($metaData['copyrightHolder'])) {
                            $book["copyrightHolder"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['copyrightHolder'])
                            );
                        }
                        if (!empty($metaData['copyrightYear'])) {
                            $book["copyrightYear"] = $KcSeoWPSchema->sanitizeOutPut($metaData['copyrightYear']);
                        }
                        if (!empty($metaData['description'])) {
                            $book["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description']);
                        }
                        if (!empty($metaData['genre'])) {
                            $book["genre"] = $KcSeoWPSchema->sanitizeOutPut($metaData['genre']);
                        }
                        if (!empty($metaData['inLanguage'])) {
                            $book["inLanguage"] = $KcSeoWPSchema->sanitizeOutPut($metaData['inLanguage']);
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_book', $book, $metaData));
                        if (isset($metaData['review_active'])) {
                            $book_review = array(
                                "@context"     => "http://schema.org",
                                "@type"        => "Review",
                                "itemReviewed" => array(
                                    "@type" => "Book",
                                )
                            );

                            if (isset($metaData['review_datePublished']) && !empty($metaData['review_datePublished'])) {
                                $book_review["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_datePublished']);
                            }
                            if (isset($metaData['review_body']) && !empty($metaData['review_body'])) {
                                $book_review["reviewBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_body'], 'textarea');
                            }
                            if (isset($book["url"])) {
                                $book_review["url"] = $book["url"];
                            }
                            if (isset($book["description"])) {
                                $book_review["description"] = KcSeoHelper::filter_content($book["description"], 200);
                            }
                            if (isset($book['author'])) {
                                $book_review['author'] = $book_review["itemReviewed"]["author"] = $book["author"];
                            }
                            if (isset($book["publisher"])) {
                                $book_review['publisher'] = $book["publisher"];
                            }
                            if (isset($book["name"])) {
                                $book_review["itemReviewed"]['name'] = $book["name"];
                            }
                            if (isset($book["isbn"])) {
                                $book_review["itemReviewed"]['isbn'] = $book["isbn"];
                            }
                            if (!empty($metaData['review_author'])) {
                                $book_review["author"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['review_author'])
                                );

                                if (isset($metaData['review_author_sameAs']) && !empty($metaData['review_author_sameAs'])) {
                                    $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['review_author_sameAs'], "textarea"));
                                    if (!empty($sameAs)) {
                                        $book_review["author"]["sameAs"] = $sameAs;
                                    }
                                }
                            }
                            if (isset($metaData['review_ratingValue'])) {
                                $book_review["reviewRating"] = array(
                                    "@type"       => "Rating",
                                    "ratingValue" => $KcSeoWPSchema->sanitizeOutPut($metaData['review_ratingValue'], 'number')
                                );
                                if (isset($metaData['review_bestRating'])) {
                                    $book_review["reviewRating"]["bestRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_bestRating'], 'number');
                                }
                                if (isset($metaData['review_worstRating'])) {
                                    $book_review["reviewRating"]["worstRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_worstRating'], 'number');
                                }
                            }
                            $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_book_review', $book_review, $metaData));
                        }
                        break;

                    case 'course':
                        $course = array();
                        $course["@context"] = "http://schema.org";
                        $course["@type"] = "Course";
                        $course["hasCourseInstance"] = array(
                            "@type" => "CourseInstance"
                        );
                        if (!empty($metaData['name'])) {
                            $course["name"] = $course["hasCourseInstance"]["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $course["description"] = $course["hasCourseInstance"]["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description']);
                        }
                        if (!empty($metaData['provider'])) {
                            $course["provider"] = array(
                                "@type" => "Organization",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['provider'])
                            );
                        }

                        if (!empty($metaData['courseMode'])) {
                            $course["hasCourseInstance"]["courseMode"] = explode("\r\n",
                                $KcSeoWPSchema->sanitizeOutPut($metaData['courseMode'], 'textarea'));

                        }
                        if (!empty($metaData['endDate'])) {
                            $course["hasCourseInstance"]["endDate"] = $KcSeoWPSchema->sanitizeOutPut($metaData['endDate']);
                        }
                        if (!empty($metaData['startDate'])) {
                            $course["hasCourseInstance"]["startDate"] = $KcSeoWPSchema->sanitizeOutPut($metaData['startDate']);
                        }
                        if (!empty($metaData['locationName']) && !empty($metaData['locationAddress'])) {
                            $course["hasCourseInstance"]["location"] = array(
                                "@type"   => "Place",
                                "name"    => $KcSeoWPSchema->sanitizeOutPut($metaData['locationName']),
                                "address" => $KcSeoWPSchema->sanitizeOutPut($metaData['locationAddress'])
                            );
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $course["hasCourseInstance"]["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'],
                                'url');
                        }
                        if (!empty($metaData['price']) && !empty($metaData['priceCurrency'])) {
                            $course["hasCourseInstance"]["offers"] = array(
                                "@type"         => 'Offer',
                                "price"         => $KcSeoWPSchema->sanitizeOutPut($metaData['price']),
                                "priceCurrency" => $KcSeoWPSchema->sanitizeOutPut($metaData['priceCurrency']),
                            );
                            if (!empty($metaData['availability'])) {
                                $course["hasCourseInstance"]["offers"]["availability"] = $KcSeoWPSchema->sanitizeOutPut($metaData['availability']);
                            }
                            if (!empty($metaData['url'])) {
                                $course["hasCourseInstance"]["offers"]["url"] = $KcSeoWPSchema->sanitizeOutPut($metaData['url']);
                            }
                            if (!empty($metaData['validFrom'])) {
                                $course["hasCourseInstance"]["offers"]["validFrom"] = $KcSeoWPSchema->sanitizeOutPut($metaData['validFrom']);
                            }
                        }
                        if (!empty($metaData['performerType']) && !empty($metaData['performerName'])) {
                            $course["hasCourseInstance"]["performer"] = array(
                                "@type" => $KcSeoWPSchema->sanitizeOutPut($metaData['performerType']),
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['performerName'])
                            );
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_course', $course, $metaData));
                        if (isset($metaData['review_active'])) {
                            $course_review = array(
                                "@context"     => "http://schema.org",
                                "@type"        => "Review",
                                "itemReviewed" => array(
                                    "@type" => "Course",
                                )
                            );

                            if (isset($metaData['review_datePublished']) && !empty($metaData['review_datePublished'])) {
                                $course_review["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_datePublished']);
                            }
                            if (isset($metaData['review_body']) && !empty($metaData['review_body'])) {
                                $course_review["reviewBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_body'], 'textarea');
                            }
                            if (isset($course["name"])) {
                                $course_review["itemReviewed"]['name'] = $course["name"];
                            }

                            if (isset($course["description"])) {
                                $course_review["itemReviewed"]["description"] = KcSeoHelper::filter_content($course["description"], 200);
                            }
                            if (isset($course["provider"])) {
                                $course_review["itemReviewed"]['provider'] = $course["provider"];
                            }
                            if (!empty($metaData['review_author'])) {
                                $course_review["author"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['review_author'])
                                );

                                if (isset($metaData['review_author_sameAs']) && !empty($metaData['review_author_sameAs'])) {
                                    $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['review_author_sameAs'], "textarea"));
                                    if (!empty($sameAs)) {
                                        $course_review["author"]["sameAs"] = $sameAs;
                                    }
                                }
                            }
                            if (isset($metaData['review_ratingValue'])) {
                                $course_review["reviewRating"] = array(
                                    "@type"       => "Rating",
                                    "ratingValue" => $KcSeoWPSchema->sanitizeOutPut($metaData['review_ratingValue'], 'number')
                                );
                                if (isset($metaData['review_bestRating'])) {
                                    $course_review["reviewRating"]["bestRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_bestRating'], 'number');
                                }
                                if (isset($metaData['review_worstRating'])) {
                                    $course_review["reviewRating"]["worstRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_worstRating'], 'number');
                                }
                            }
                            $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_course_review', $course_review, $metaData));
                        }
                        break;

                    case 'person':
                        $person = [
                            "@context" => "http://schema.org",
                            "@type"    => "Person"
                        ];
                        if (!empty($metaData['addressLocality'])) {
                            $person["address"] = [
                                "@type"         => "PostalAddress",
                                "addressLocality" => $KcSeoWPSchema->sanitizeOutPut($metaData['addressLocality'])
                            ];
                            if (!empty($metaData['addressRegion'])) {
                                $person["address"]["addressRegion"] = $KcSeoWPSchema->sanitizeOutPut($metaData['addressRegion']);
                            }
                            if (!empty($metaData['postalCode'])) {
                                $person["address"]["postalCode"] = $KcSeoWPSchema->sanitizeOutPut($metaData['postalCode']);
                            }
                            if (!empty($metaData['streetAddress'])) {
                                $person["address"]["streetAddress"] = $KcSeoWPSchema->sanitizeOutPut($metaData['streetAddress']);
                            }
                        }

                        if (!empty($metaData['email'])) {
                            $person["email"] = $KcSeoWPSchema->sanitizeOutPut($metaData['email']);
                        }

                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $person["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                        }

                        if (!empty($metaData['jobTitle'])) {
                            $person["jobTitle"] = $KcSeoWPSchema->sanitizeOutPut($metaData['jobTitle']);
                        }

                        if (!empty($metaData['name'])) {
                            $person["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }

                        if (!empty($metaData['birthPlace'])) {
                            $person["birthPlace"] = $KcSeoWPSchema->sanitizeOutPut($metaData['birthPlace']);
                        }

                        if (!empty($metaData['birthDate'])) {
                            $person["birthDate"] = $KcSeoWPSchema->sanitizeOutPut($metaData['birthDate']);
                        }

                        if (!empty($metaData['height'])) {
                            $person["height"] = $KcSeoWPSchema->sanitizeOutPut($metaData['height']);
                        }

                        if (!empty($metaData['gender'])) {
                            $person["gender"] = $KcSeoWPSchema->sanitizeOutPut($metaData['gender']);
                        }

                        if (!empty($metaData['memberOf'])) {
                            $person["memberOf"] = $KcSeoWPSchema->sanitizeOutPut($metaData['memberOf']);
                        }

                        if (!empty($metaData['nationality'])) {
                            $person["nationality"] = $KcSeoWPSchema->sanitizeOutPut($metaData['nationality']);
                        }

                        if (!empty($metaData['telephone'])) {
                            $person["telephone"] = $KcSeoWPSchema->sanitizeOutPut($metaData['telephone']);
                        }

                        if (!empty($metaData['url'])) {
                            $person["url"] = $KcSeoWPSchema->sanitizeOutPut($metaData['url'], 'url');
                        }
                        if (isset($metaData['sameAs']) && !empty($metaData['sameAs'])) {
                            $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['sameAs'], "textarea"));
                            if (!empty($sameAs)) {
                                $person["sameAs"] = $sameAs;
                            }
                        }


                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_course', $person, $metaData));
                        break;

                    case 'movie':
                        $movie = array();
                        $movie["@context"] = "http://schema.org";
                        $movie["@type"] = "Movie";
                        if (!empty($metaData['name'])) {
                            $movie["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $movie["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description']);
                        }
                        if (!empty($metaData['duration'])) {
                            $movie["duration"] = $KcSeoWPSchema->sanitizeOutPut($metaData['duration']);
                        }
                        if (!empty($metaData['dateCreated'])) {
                            $movie["dateCreated"] = $KcSeoWPSchema->sanitizeOutPut($metaData['dateCreated']);
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $movie["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                        }
                        if (!empty($metaData['director'])) {
                            $movie["director"] = array(
                                "@type" => "Person",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['director'])
                            );
                        }
                        if (!empty($metaData['author'])) {
                            $authorArray = explode("\r\n",
                                $KcSeoWPSchema->sanitizeOutPut($metaData['author'], 'textarea'));
                            $author = array();
                            if (!empty($authorArray) && is_array($authorArray) && count($authorArray)) {
                                foreach ($authorArray as $authorName) {
                                    $author[] = array(
                                        "@type" => "Person",
                                        "name"  => $authorName
                                    );
                                }
                            }
                            $movie["author"] = $author;
                        }
                        if (!empty($metaData['actor'])) {
                            $actorArray = explode("\r\n",
                                $KcSeoWPSchema->sanitizeOutPut($metaData['actor'], 'textarea'));
                            $actor = array();
                            if (!empty($actorArray) && is_array($actorArray) && count($actorArray)) {
                                foreach ($actorArray as $actorName) {
                                    $actor[] = array(
                                        "@type" => "Person",
                                        "name"  => $actorName
                                    );
                                }
                            }
                            $movie["actor"] = $actor;
                        }

                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $movie['image'] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                        }


                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_movie', $movie, $metaData));
                        if (isset($metaData['review_active'])) {
                            $movie_review = array(
                                "@context" => "http://schema.org",
                                "@type"    => "Review",
                            );
                            if (isset($metaData['review_datePublished']) && !empty($metaData['review_datePublished'])) {
                                $movie_review["datePublished"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_datePublished']);
                            }
                            if (isset($metaData['review_body']) && !empty($metaData['review_body'])) {
                                $movie_review["reviewBody"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_body'], 'textarea');
                            }

                            unset($movie['@context']);
                            $movie['@type'] = "Movie";
                            if (isset($movie["description"])) {
                                $movie_review["description"] = KcSeoHelper::filter_content($movie["description"], 200);
                                unset($movie["description"]);
                            }
                            if (isset($metaData['review_sameAs']) && !empty($metaData['review_sameAs'])) {
                                $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['review_sameAs'], "textarea"));
                                if (!empty($sameAs)) {
                                    $movie["sameAs"] = $sameAs;
                                }
                            }

                            $movie_review["itemReviewed"] = $movie;
                            if (!empty($metaData['review_author'])) {
                                $movie_review["author"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['review_author'])
                                );

                                if (isset($metaData['review_author_sameAs']) && !empty($metaData['review_author_sameAs'])) {
                                    $sameAs = KcSeoHelper::get_same_as($KcSeoWPSchema->sanitizeOutPut($metaData['review_author_sameAs'], "textarea"));
                                    if (!empty($sameAs)) {
                                        $movie_review["author"]["sameAs"] = $sameAs;
                                    }
                                }
                            }
                            if (isset($metaData['review_publisher']) && !empty($metaData['review_publisher'])) {
                                $movie_review["publisher"] = array(
                                    "@type" => "Organization",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['review_publisher'])
                                );
                                if (isset($metaData['review_publisherImage']) && !empty($metaData['review_publisherImage'])) {
                                    $img = $KcSeoWPSchema->imageInfo(absint($metaData['review_publisherImage']));
                                    $movie_review["review_publisher"]["logo"] = array(
                                        "@type"  => "ImageObject",
                                        "url"    => $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url'),
                                        "height" => $img['height'],
                                        "width"  => $img['width']
                                    );
                                }
                            }
                            if (isset($metaData['review_ratingValue'])) {
                                $movie_review["reviewRating"] = array(
                                    "@type"       => "Rating",
                                    "ratingValue" => $KcSeoWPSchema->sanitizeOutPut($metaData['review_ratingValue'], 'number')
                                );
                                if (isset($metaData['review_bestRating'])) {
                                    $movie_review["reviewRating"]["bestRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_bestRating'], 'number');
                                }
                                if (isset($metaData['review_worstRating'])) {
                                    $movie_review["reviewRating"]["worstRating"] = $KcSeoWPSchema->sanitizeOutPut($metaData['review_worstRating'], 'number');
                                }
                            }


                            $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_movie_review', $movie_review, $metaData));
                        }
                        break;

                    case 'TVEpisode':
                        $TVEpisode = array();
                        $TVEpisode["@context"] = "http://schema.org";
                        $TVEpisode["@type"] = "TVEpisode";
                        if (!empty($metaData['name'])) {
                            $TVEpisode["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['episodeNumber'])) {
                            $TVEpisode["episodeNumber"] = $KcSeoWPSchema->sanitizeOutPut($metaData['episodeNumber']);
                        }
                        if (!empty($metaData['seasonNumber'])) {
                            $TVEpisode["partOfSeason"] = array(
                                "@type"        => "TVSeason",
                                "seasonNumber" => $KcSeoWPSchema->sanitizeOutPut($metaData['seasonNumber'])
                            );
                        }
                        if (!empty($metaData['seriesName'])) {
                            $TVEpisode["partOfSeries"] = array(
                                "@type" => "TVSeries",
                                "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['seriesName'])
                            );
                            if (!empty($metaData['seriesURL'])) {
                                $TVEpisode["partOfSeries"]["sameAs"] = $KcSeoWPSchema->sanitizeOutPut($metaData['seriesURL'],
                                    'url');
                            }
                        }
                        if (!empty($metaData['startDate'])) {
                            $TVEpisode["releasedEvent"] = array(
                                "@type"     => "PublicationEvent",
                                "startDate" => $KcSeoWPSchema->sanitizeOutPut($metaData['startDate'])
                            );
                        }
                        if (!empty($metaData['actor'])) {
                            $actorArray = explode("\r\n",
                                $KcSeoWPSchema->sanitizeOutPut($metaData['actor'], 'textarea'));
                            $actor = array();
                            if (!empty($actorArray) && is_array($actorArray) && count($actorArray)) {
                                foreach ($actorArray as $actorName) {
                                    $actor[] = array(
                                        "@type" => "Person",
                                        "name"  => $actorName
                                    );
                                }
                            }
                            $TVEpisode["actor"] = $actor;
                        }

                        if (!empty($metaData['sameAs'])) {
                            $TVEpisode["sameAs"] = $KcSeoWPSchema->sanitizeOutPut($metaData['sameAs'], 'url');
                        }
                        if (!empty($metaData['url'])) {
                            $TVEpisode["url"] = $KcSeoWPSchema->sanitizeOutPut($metaData['url'], 'url');
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_tv_episode', $TVEpisode, $metaData));
                        break;

                    case 'music':
                        $music = array();
                        $music["@context"] = "http://schema.org";
                        $music["@type"] = $KcSeoWPSchema->sanitizeOutPut($metaData['musicType']);
                        if (!empty($metaData['name'])) {
                            $music["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $music["description"] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'],
                                'textarea');
                        }
                        if (!empty($metaData['image'])) {
                            $img = $KcSeoWPSchema->imageInfo(absint($metaData['image']));
                            $movie["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                        }
                        if (!empty($metaData['sameAs'])) {
                            $music["sameAs"] = $KcSeoWPSchema->sanitizeOutPut($metaData['sameAs'], 'url');
                        }
                        if (!empty($metaData['url'])) {
                            $music["url"] = $KcSeoWPSchema->sanitizeOutPut($metaData['url'], 'url');
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_music', $music, $metaData));
                        break;
                    case 'faq':
                        $faqSchema = array(
                            "@context" => "http://schema.org",
                            "@type"    => "FAQPage"
                        );
                        if (isset($metaData['faq_items']) && is_array($metaData['faq_items']) && !empty($metaData['faq_items'])) {
                            $faq_items_schema = array();
                            foreach ($metaData['faq_items'] as $position => $faq_item) {
                                $faq_item_schema = array(
                                    "@type"          => "Question",
                                    "name"           => $faq_item['question'] ? $KcSeoWPSchema->sanitizeOutPut($faq_item['question']) : null,
                                    "acceptedAnswer" => array(
                                        "@type" => "Answer",
                                        "text"  => isset($faq_item['answer']) ? $KcSeoWPSchema->sanitizeOutPut($faq_item['answer'], 'textarea') : null
                                    )
                                );
                                array_push($faq_items_schema, $faq_item_schema);

                            }
                            if (count($faq_items_schema) == 1) {
                                $faqSchema['mainEntity'] = $faq_items_schema[0];
                            } else {
                                $faqSchema['mainEntity'] = $faq_items_schema;
                            }
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_faq', $faqSchema, $metaData));
                        break;
                    case 'question':
                        $question = array();
                        $question["@context"] = "http://schema.org";
                        $type = $KcSeoWPSchema->sanitizeOutPut($metaData['type']);
                        if ($type === "AskAction" || $type === "AskActionReplay") {
                            $question["@type"] = "AskAction";
                            if (!empty($metaData['agent'])) {
                                $question["agent"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['agent'])
                                );
                            }
                            if (!empty($metaData['recipient'])) {
                                $question["recipient"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['recipient'])
                                );
                            }

                            if (!empty($metaData['ask_action_question'])) {
                                $q = array(
                                    "@type" => "Question",
                                    "text"  => $KcSeoWPSchema->sanitizeOutPut($metaData['ask_action_question'])
                                );
                                if ($type === "AskActionReplay") {
                                    $question["resultComment"] = array(
                                        "@type"      => "Answer",
                                        "parentItem" => $q
                                    );
                                    if (!empty($metaData['ask_action_answer'])) {
                                        $question["resultComment"]["text"] = $KcSeoWPSchema->sanitizeOutPut($metaData['ask_action_answer']);
                                    }
                                } else {
                                    $question["question"] = $q;
                                }
                            }
                        } else {
                            $question["@type"] = "QAPage";
                            $mainEntity = array(
                                "@type" => "Question"
                            );
                            if (!empty($metaData['question'])) {
                                $mainEntity["name"] = $KcSeoWPSchema->sanitizeOutPut($metaData['question']);
                            }
                            if (!empty($metaData['question_text'])) {
                                $mainEntity["text"] = $KcSeoWPSchema->sanitizeOutPut($metaData['question_text']);
                            }
                            if (!empty($metaData['question_dateCreated'])) {
                                $mainEntity["dateCreated"] = $KcSeoWPSchema->sanitizeOutPut($metaData['question_dateCreated']);
                            }
                            if (!empty($metaData['question_upvoteCount'])) {
                                $mainEntity["upvoteCount"] = $KcSeoWPSchema->sanitizeOutPut($metaData['question_upvoteCount']);
                            }
                            if (!empty($metaData['answerCount'])) {
                                $mainEntity["answerCount"] = $KcSeoWPSchema->sanitizeOutPut($metaData['answerCount']);
                            }
                            if (!empty($metaData['question_author'])) {
                                $mainEntity["author"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['question_author'])
                                );
                            }
                            $accept = array();
                            if (!empty($metaData['accepted_answer'])) {
                                $accept['text'] = $KcSeoWPSchema->sanitizeOutPut($metaData['accepted_answer']);
                            }
                            if (!empty($metaData['accepted_answer_dateCreated'])) {
                                $accept['dateCreated'] = $KcSeoWPSchema->sanitizeOutPut($metaData['accepted_answer_dateCreated']);
                            }
                            if (!empty($metaData['accepted_answer_upvoteCount'])) {
                                $accept['upvoteCount'] = $KcSeoWPSchema->sanitizeOutPut($metaData['accepted_answer_upvoteCount']);
                            }
                            if (!empty($metaData['accepted_answer_url'])) {
                                $accept['url'] = $KcSeoWPSchema->sanitizeOutPut($metaData['accepted_answer_url'], 'url');
                            }
                            if (!empty($metaData['accepted_answer_author'])) {
                                $accept["author"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['accepted_answer_author'])
                                );
                            }
                            if (!empty($accept)) {
                                $mainEntity["acceptedAnswer"] = array_merge(array("@type" => "Answer"), $accept);
                            }
                            // Suggested
                            $suggested = array();
                            if (!empty($metaData['suggested_answer'])) {
                                $suggested['text'] = $KcSeoWPSchema->sanitizeOutPut($metaData['suggested_answer']);
                            }
                            if (!empty($metaData['suggested_answer_dateCreated'])) {
                                $suggested['dateCreated'] = $KcSeoWPSchema->sanitizeOutPut($metaData['suggested_answer_dateCreated']);
                            }
                            if (!empty($metaData['suggested_answer_upvoteCount'])) {
                                $suggested['upvoteCount'] = $KcSeoWPSchema->sanitizeOutPut($metaData['suggested_answer_upvoteCount']);
                            }
                            if (!empty($metaData['suggested_answer_url'])) {
                                $suggested['url'] = $KcSeoWPSchema->sanitizeOutPut($metaData['suggested_answer_url'], 'url');
                            }
                            if (!empty($metaData['suggested_answer_author'])) {
                                $suggested["author"] = array(
                                    "@type" => "Person",
                                    "name"  => $KcSeoWPSchema->sanitizeOutPut($metaData['suggested_answer_author'])
                                );
                            }
                            if (!empty($suggested)) {
                                $mainEntity["suggestedAnswer"] = array_merge(array("@type" => "Answer"), $suggested);
                            }

                            $question['mainEntity'] = $mainEntity;

                        }


                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_question', $question, $metaData));
                        break;
                    case 'itemList':
                        $itemList = array(
                            "@context"      => "http://schema.org",
                            "@type"         => "ItemList",
                            "ItemListOrder" => 'https://schema.org/' . $KcSeoWPSchema->sanitizeOutPut($metaData['ItemListOrder']),
                            "numberOfItems" => $KcSeoWPSchema->sanitizeOutPut($metaData['numberOfItems'], 'number'),
                            "url"           => $KcSeoWPSchema->sanitizeOutPut($metaData['url'], 'url')
                        );
                        if (!empty($metaData['name'])) {
                            $itemList['name'] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['description'])) {
                            $itemList['description'] = $KcSeoWPSchema->sanitizeOutPut($metaData['description'], 'textarea');
                        }
                        if (isset($metaData['list_items']) && is_array($metaData['list_items']) && !empty($metaData['list_items'])) {
                            $items_schema = array();
                            foreach ($metaData['list_items'] as $position => $list_item) {
                                $img = $KcSeoWPSchema->imageInfo(absint($list_item['image']));
                                $item_schema = array(
                                    "@type"       => "ListItem",
                                    "name"        => $list_item['name'] ? $KcSeoWPSchema->sanitizeOutPut($list_item['name']) : null,
                                    "position"    => $KcSeoWPSchema->sanitizeOutPut($list_item['position']),
                                    "url"         => $list_item['url'] ? $KcSeoWPSchema->sanitizeOutPut($list_item['url'], 'url') : null,
                                    "image"       => $list_item['image'] ? $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url') : null,
                                    "description" => $list_item['description'] ? $KcSeoWPSchema->sanitizeOutPut($list_item['description'], 'textarea') : null,
                                );
                                array_push($items_schema, $item_schema);

                            }
                            if (count($items_schema) == 1) {
                                $itemList['itemListElement'] = $items_schema[0];
                            } else {
                                $itemList['itemListElement'] = $items_schema;
                            }
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_item_list', $itemList, $metaData));
                        break;
                    case 'specialAnnouncement':
                        $announcement = array(
                            "@context" => "http://schema.org",
                            "@type"    => "SpecialAnnouncement",
                            "category" => "https://www.wikidata.org/wiki/Q81068910"
                        );
                        if (!empty($metaData['name'])) {
                            $announcement['name'] = $KcSeoWPSchema->sanitizeOutPut($metaData['name']);
                        }
                        if (!empty($metaData['datePublished'])) {
                            $announcement['datePosted'] = $KcSeoWPSchema->sanitizeOutPut($metaData['datePublished']);
                        }
                        if (!empty($metaData['expires'])) {
                            $announcement['expires'] = $KcSeoWPSchema->sanitizeOutPut($metaData['expires']);
                        }
                        if (!empty($metaData['text'])) {
                            $announcement['text'] = $KcSeoWPSchema->sanitizeOutPut($metaData['text'], 'textarea');
                        }
                        if (!empty($metaData['url'])) {
                            $announcement['url'] = $KcSeoWPSchema->sanitizeOutPut($metaData['url'], 'url');
                        }
                        if (isset($metaData['locations']) && is_array($metaData['locations']) && !empty($metaData['locations'])) {
                            $locations_schema = [];
                            foreach ($metaData['locations'] as $position => $location) {
                                if ($location['type']) {
                                    $location_schema = array(
                                        "@type"   => $KcSeoWPSchema->sanitizeOutPut($location['type']),
                                        'name'    => !empty($location['name']) ? $KcSeoWPSchema->sanitizeOutPut($location['name']) : "",
                                        'url'     => !empty($location['url']) ? $KcSeoWPSchema->sanitizeOutPut($location['url'], 'url') : '',
                                        "address" => [
                                            "@type" => "PostalAddress",
                                        ]
                                    );
                                    if (!empty($location['id'])) {
                                        $location_schema['@id'] = $KcSeoWPSchema->sanitizeOutPut($location['id']);
                                    }
                                    if (!empty($location['image'])) {
                                        $img = $KcSeoWPSchema->imageInfo(absint($location['image']));
                                        $location_schema["image"] = $KcSeoWPSchema->sanitizeOutPut($img['url'], 'url');
                                    }
                                    if (!empty($location['url'])) {
                                        $location_schema['url'] = $KcSeoWPSchema->sanitizeOutPut($location['url'], 'url');
                                    }
                                    if (!empty($location['address_street'])) {
                                        $location_schema['address']['streetAddress'] = $KcSeoWPSchema->sanitizeOutPut($location['address_street']);
                                    }
                                    if (!empty($location['address_locality'])) {
                                        $location_schema['address']['addressLocality'] = $KcSeoWPSchema->sanitizeOutPut($location['address_locality']);
                                    }
                                    if (!empty($location['address_post_code'])) {
                                        $location_schema['address']['postalCode'] = $KcSeoWPSchema->sanitizeOutPut($location['address_post_code']);
                                    }
                                    if (!empty($location['address_region'])) {
                                        $location_schema['address']['addressRegion'] = $KcSeoWPSchema->sanitizeOutPut($location['address_region']);
                                    }
                                    if (!empty($location['address_country'])) {
                                        $location_schema['address']['addressCountry'] = $KcSeoWPSchema->sanitizeOutPut($location['address_country']);
                                    }
                                    if (!empty($location['priceRange'])) {
                                        $location_schema["priceRange"] = $KcSeoWPSchema->sanitizeOutPut($location['priceRange']);
                                    }
                                    if (!empty($location['telephone'])) {
                                        $location_schema["telephone"] = $KcSeoWPSchema->sanitizeOutPut($location['telephone']);
                                    }
                                    array_push($locations_schema, $location_schema);
                                }

                            }
                            if (count($locations_schema) === 1) {
                                $announcement['announcementLocation'] = $locations_schema[0];
                            } else {
                                $announcement['announcementLocation'] = $locations_schema;
                            }
                        }
                        $html .= $this->get_jsonEncode(apply_filters('kcseo_snippet_item_list', $announcement, $metaData));
                        break;
                    default:
                        break;
                }

            }

            return $html;
        }

        function get_field($data, $metaData = array()) {
            global $KcSeoWPSchema;
            $id = isset($data['id']) ? $data['id'] : '';
            $name = isset($data['name']) ? $data['name'] : '';
            $value = isset($data['value']) ? $data['value'] : '';

            $class = isset($data['class']) ? ($data['class'] ? $data['class'] : null) : null;
            $require = (isset($data['required']) ? ($data['required'] ? sprintf('<span data-kcseo-tooltip="%s" class="required">*</span>', __("Required", "wp-seo-structured-data-schema-pro")) : null) : null);
            $recommended = (isset($data['recommended']) ? ($data['recommended'] ? sprintf('<span data-kcseo-tooltip="%s" class="recommended">*</span>', __("Recommended", "wp-seo-structured-data-schema-pro")) : null) : null);
            $title = (isset($data['title']) ? ($data['title'] ? $data['title'] : null) : null);
            $desc = (isset($data['desc']) ? ($data['desc'] ? $data['desc'] : null) : null);
            $holderClass = (!empty($data['holderClass']) ? $data['holderClass'] : null);
            $attr = (!empty($data['attr']) ? $data['attr'] : null);
            $html = null;


            switch ($data['type']) {
                case 'checkbox':
                    $checked = ($value ? "checked" : null);
                    $html .= "<div class='kSeo-checkbox-wrapper'>";
                    $html .= "<label for='{$id}'><input type='checkbox' id='{$id}' class='{$class}' name='{$name}' {$checked} value='1' /> Enable</label>";
                    $html .= "</div>";
                    break;
                case 'text':
                    $html .= "<input type='text' id='{$id}' class='{$class}' {$attr} name='{$name}' value='" . esc_html($value) . "' />";
                    break;
                case 'number':
                    if ($data['fieldId'] == 'price') {
                        $html .= "<input type='number' step='any' id='{$id}' class='{$class}'  {$attr} name='{$name}' value='" . esc_attr($value) . "' />";
                    } else {
                        $html .= "<input type='number' id='{$id}' class='{$class}' name='{$name}'  {$attr} value='" . esc_attr($value) . "' />";
                    }
                    break;
                case 'textarea':
                    $html .= "<textarea id='{$id}' class='{$class}' {$attr} name='{$name}' >" . wp_kses($value,
                            array()) . "</textarea>";
                    break;
                case 'image':
                    $html .= '<div class="kSeo-image">';
                    $ImageId = !empty($value) ? absint($value) : 0;
                    $image = $ingInfo = null;
                    if ($ImageId) {
                        $image = wp_get_attachment_image($ImageId, "thumbnail");
                        $imgData = $KcSeoWPSchema->imageInfo($ImageId);
                        $ingInfo .= "<span><strong>URL: </strong>{$imgData['url']}</span>";
                        $ingInfo .= "<span><strong>Width: </strong>{$imgData['width']}px</span>";
                        $ingInfo .= "<span><strong>Height: </strong>{$imgData['height']}px</span>";
                    }
                    $html .= "<div class='kSeo-image-wrapper'>";
                    $html .= '<span class="kSeoImgAdd"><span class="dashicons dashicons-plus-alt"></span></span>';
                    $html .= '<span class="kSeoImgRemove ' . ($image ? null : "kSeo-hidden") . '"><span class="dashicons dashicons-trash"></span></span>';
                    $html .= '<div class="kSeo-image-preview">' . $image . '</div>';
                    $html .= "<input type='hidden' name='{$name}' value='" . absint($ImageId) . "' />";
                    $html .= "</div>";
                    $html .= "<div class='image-info'>{$ingInfo}</div>";
                    $html .= '</div>';
                    break;
                case 'select':
                    $html .= "<select name='{$name}'  {$attr} class='select2 {$class}' id='{$id}'>";
                    if (!empty($data['empty'])) {
                        $html .= "<option value=''>{$data['empty']}</option>";
                    }
                    if (!empty($data['options']) && is_array($data['options'])) {
                        if ($this->isAssoc($data['options'])) {
                            foreach ($data['options'] as $optKey => $optValue) {
                                $slt = ($optKey == $value ? "selected" : null);
                                $html .= "<option value='" . esc_attr($optKey) . "' {$slt}>" . esc_html($optValue) . "</option>";
                            }
                        } else {
                            foreach ($data['options'] as $optValue) {
                                $slt = ($optValue == $value ? "selected" : null);
                                $html .= "<option value='" . esc_attr($optValue) . "' {$slt}>" . esc_html($optValue) . "</option>";
                            }
                        }
                    }
                    $html .= "</select>";
                    break;
                case 'schema_type':
                    $html .= "<select name='{$name}' class='select2 {$class}' id='{$id}'>";
                    if (!empty($data['empty'])) {
                        $html .= "<option value=''>{$data['empty']}</option>";
                    }

                    foreach ($data['options'] as $key => $site) {
                        if (is_array($site)) {
                            $slt = ($key == $value ? "selected" : null);
                            $html .= "<option value='$key' $slt>&nbsp;&nbsp;&nbsp;$key</option>";
                            foreach ($site as $inKey => $inSite) {
                                if (is_array($inSite)) {
                                    $slt = ($inKey == $value ? "selected" : null);
                                    $html .= "<option value='$inKey' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inKey</option>";
                                    foreach ($inSite as $inInKey => $inInSite) {
                                        if (is_array($inInSite)) {
                                            $slt = ($inInKey == $value ? "selected" : null);
                                            $html .= "<option value='$inInKey' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inInKey</option>";
                                            foreach ($inInSite as $iSite) {
                                                $slt = ($iSite == $value ? "selected" : null);
                                                $html .= "<option value='$iSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$iSite</option>";
                                            }
                                        } else {
                                            $slt = ($inInSite == $value ? "selected" : null);
                                            $html .= "<option value='$inInSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inInSite</option>";
                                        }
                                    }
                                } else {
                                    $slt = ($inSite == $value ? "selected" : null);
                                    $html .= "<option value='$inSite' $slt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$inSite</option>";
                                }
                            }
                        } else {
                            $slt = ($site == $value ? "selected" : null);
                            $html .= "<option value='$site' $slt>$site</option>";
                        }
                    }
                    $html .= "</select>";
                    break;
                default:
                    $html .= "<input id='{$id}' type='{$data['type']}' {$attr} value='" . esc_attr($value) . "' name='$name' />";
                    break;

            }
            $label = "<label class='field-label' for='{$id}'>{$title}{$require}{$recommended}</label>";
            $field_html = sprintf('<div class="field-content" id="%s-content">%s<p class="description">%s</div>', $id, $html, $desc);
            if ($data['type'] == 'heading') {
                $holderClass .= ' kcseo-heading-container';
                $label = '';
                $field_html = sprintf('<div class="kcseo-section-title-wrap">%s%s</div>',
                    $title ? sprintf('<h5>%s</h5>', $title) : '',
                    $desc ? sprintf('<p class="description">%s</p>', $desc) : null
                );
            }

            $html = sprintf('<div class="field-container %s" id="%s-container">%s%s</div>',
                $holderClass,
                $id,
                $label,
                $field_html
            );

            return $html;
        }

        /**
         * Generate Schema
         *
         * @param array $data
         *
         * @return string|null
         */
        function get_jsonEncode($data = array()) {
            $json = null;
            if (is_array($data) && !empty($data)) {
                $json .= '<script type="application/ld+json">' . json_encode($data,
                        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>';
            }

            return $json;
        }

        function imgInfo($url = null) {
            $img = array();
            if ($url) {
                $imgA = @getimagesize($url);
                if (is_array($imgA) && !empty($imgA)) {
                    $img['width'] = $imgA[0];
                    $img['height'] = $imgA[1];
                } else {
                    $img['width'] = 0;
                    $img['height'] = 0;
                }
            }

            return $img;
        }

        function isAssoc($array) {
            $keys = array_keys($array);

            return $keys !== array_keys($keys);
        }

    }
endif;