<?php

class KcSeoOptions
{

    static function getSchemaTypes() {
        $schemas = array(
            'blog_posting'         => array(
                'title'  => __('Blog Posting', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'           => array(
                        'type' => 'checkbox'
                    ),
                    'headline'         => array(
                        'title'    => __('Headline', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'desc'     => __('Blog posting title', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'mainEntityOfPage' => array(
                        'title'    => __('Page URL', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'url',
                        'desc'     => __('The canonical URL of the article page', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'author'           => array(
                        'title'    => __('Author name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'desc'     => __('Author display name', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'image'            => array(
                        'title'    => __('Featured Image', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'image',
                        'desc'     => __("The representative image of the article. Only a marked-up image that directly belongs to the article should be specified.<br> Images should be at least 696 pixels wide. <br>Images should be in .jpg, .png, or. gif format.", "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'datePublished'    => array(
                        'title'    => __('Published date', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'class'    => 'kcseo-date',
                        'desc'     => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'dateModified'     => array(
                        'title'    => __('Modified date', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'class'    => 'kcseo-date',
                        'desc'     => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'publisher'        => array(
                        'title'    => __('Publisher', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'desc'     => __('Publisher name or Organization name', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'publisherImage'   => array(
                        'title'    => __('Publisher Logo', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'image',
                        'desc'     => __("Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>", "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'description'      => array(
                        'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'desc'  => __('Short description. New line is not supported.', "wp-seo-structured-data-schema-pro")
                    ),
                    'articleBody'      => array(
                        'title' => __('Article body', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'desc'  => __('Article content. New line is not supported.', "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'aggregate_rating'     => array(
                'title'  => __('Aggregate Ratings', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'      => array(
                        'type' => 'checkbox'
                    ),
                    'schema_type' => array(
                        'title'    => __('Schema type', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'schema_type',
                        'required' => true,
                        'options'  => self::getSiteTypes(),
                        'empty'    => "Select one",
                        'desc'     => __("Use the most appropriate schema type for what is being reviewed.", "wp-seo-structured-data-schema-pro")
                    ),
                    'name'        => array(
                        'title'    => __('Name of the item', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("The item that is being rated.", "wp-seo-structured-data-schema-pro")
                    ),
                    'image'       => array(
                        'title'       => 'Image',
                        'type'        => 'image',
                        'required'    => true,
                        'holderClass' => 'kSeo-hidden aggregate-except-organization-holder'
                    ),
                    'priceRange'  => array(
                        'title'       => 'Price Range (Recommended)',
                        'type'        => 'text',
                        'holderClass' => 'kSeo-hidden aggregate-except-organization-holder',
                        'desc'        => __("The price range of the business, for example $$$.", "wp-seo-structured-data-schema-pro")
                    ),
                    'telephone'   => array(
                        'title'       => 'Telephone (Recommended)',
                        'type'        => 'text',
                        'holderClass' => 'kSeo-hidden aggregate-except-organization-holder'
                    ),
                    'address'     => array(
                        'title'       => 'Address (Recommended)',
                        'type'        => 'text',
                        'holderClass' => 'kSeo-hidden aggregate-except-organization-holder',
                    ),
                    'description' => array(
                        'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'desc'  => __("Description for thr review", "wp-seo-structured-data-schema-pro")
                    ),
                    'ratingCount' => array(
                        'title'    => __('Rating Count', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'number',
                        'attr'     => 'step="any"',
                        'required' => true,
                        'desc'     => __("The total number of ratings for the item on your site. <span class='required'>* At least one of ratingCount or reviewCount is required.</span>", "wp-seo-structured-data-schema-pro")
                    ),
                    'reviewCount' => array(
                        'title'    => __('Review Count', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'number',
                        'attr'     => 'step="any"',
                        'required' => true,
                        'desc'     => __("Specifies the number of people who provided a review with or without an accompanying rating. At least one of ratingCount or reviewCount is required.", "wp-seo-structured-data-schema-pro")
                    ),
                    'ratingValue' => array(
                        'title'    => __('Rating Value', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'number',
                        'attr'     => 'step="any"',
                        'required' => true,
                        'desc'     => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'bestRating'  => array(
                        'title'    => __('Best Rating', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'number',
                        'attr'     => 'step="any"',
                        'required' => true,
                        'desc'     => __("The highest value allowed in this rating system. <span class='required'>* Required if the rating system is not a 5-point scale.</span> If bestRating is omitted, 5 is assumed.", "wp-seo-structured-data-schema-pro")
                    ),
                    'worstRating' => array(
                        'title'    => __('Worst Rating', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'number',
                        'attr'     => 'step="any"',
                        'required' => true,
                        'desc'     => __("The lowest value allowed in this rating system. <span class='required'>* Required if the rating system is not a 5-point scale.</span> If worstRating is omitted, 1 is assumed.", "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'article'              => array(
                'title'  => __("Article", "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'              => array(
                        'type' => 'checkbox'
                    ),
                    'headline'            => array(
                        'title'    => __('Headline', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'desc'     => __('Article title', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'mainEntityOfPage'    => array(
                        'title'    => __('Page URL', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'url',
                        'desc'     => __('The canonical URL of the article page', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'author'              => array(
                        'title'    => __('Author Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'desc'     => __('Author display name', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'image'               => array(
                        'title'    => __('Featured Image', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'image',
                        'required' => true,
                        'desc'     => __('Images should be at least 696 pixels wide.<br>Images should be in .jpg, .png, or. gif format.', "wp-seo-structured-data-schema-pro")
                    ),
                    'datePublished'       => array(
                        'title'    => __('Published date', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'class'    => 'kcseo-date',
                        'required' => true,
                        'desc'     => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'dateModified'        => array(
                        'title'    => __('Modified date', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'class'    => 'kcseo-date',
                        'required' => true,
                        'desc'     => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'publisher'           => array(
                        'title'    => __('Publisher', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'desc'     => __('Publisher name or Organization name', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'publisherImage'      => array(
                        'title'    => __('Publisher Logo', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'image',
                        'desc'     => __('Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'description'         => array(
                        'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'desc'  => __('Short description. New line is not supported.', "wp-seo-structured-data-schema-pro")
                    ),
                    'articleBody'         => array(
                        'title' => __('Article body', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'desc'  => __('Article content', "wp-seo-structured-data-schema-pro")
                    ),
                    'alternativeHeadline' => array(
                        'title' => __('Alternative headline', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('A secondary headline for the article.', "wp-seo-structured-data-schema-pro")
                    ),
                )
            ),
            'book'                 => array(
                'title'  => __('Book', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'               => array(
                        'type' => 'checkbox'
                    ),
                    'name'                 => array(
                        'title'    => __("Name", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'datePublished'        => array(
                        'title'    => __('Published date', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'class'    => 'kcseo-date',
                        'required' => true,
                        'desc'     => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'author'               => array(
                        'title'    => __("Author", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'author_sameAs'        => array(
                        'title'    => __("Author Same As profile link", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'attr'     => 'placeholder="https://facebook.com/example&#10;https://twitter.com/example"',
                        'required' => true,
                        'desc'     => __('A reference page that unambiguously indicates the item\'s identity; for example, the URL of the item\'s Wikipedia page, Freebase page, or official website.<br> Enter new line for every entry', "wp-seo-structured-data-schema-pro")
                    ),
                    'bookFormat'           => array(
                        'title'    => __("Book Format", "wp-seo-structured-data-schema-pro"),
                        'type'     => "select",
                        'options'  => array('EBook', 'Hardcover', 'Paperback', 'AudioBook'),
                        'required' => true
                    ),
                    'isbn'                 => array(
                        'title'    => __("ISBN", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __('The ISBN of the tome. Use the ISBN of the print book instead if there is no ISBN for that edition, such as for a Kindle edition.', "wp-seo-structured-data-schema-pro")
                    ),
                    'workExample'          => array(
                        'title'    => __("Work Example", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'url'                  => array(
                        'title'    => __("URL", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'url',
                        'required' => true,
                        'desc'     => __('URL to the page on your site about the book. The page may list all available editions.', "wp-seo-structured-data-schema-pro")
                    ),
                    'sameAs'               => array(
                        'title'    => __("Same As", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'attr'     => 'placeholder="https://example.com/example&#10;https://example.com/example"',
                        'required' => true,
                        'desc'     => __('A reference page that unambiguously indicates the item\'s identity; for example, the URL of the item\'s Wikipedia page, Freebase page, or official website.<br> Enter new line for every entry', "wp-seo-structured-data-schema-pro")
                    ),
                    'publisher'            => array(
                        'title' => __("Publisher", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ),
                    'numberOfPages'        => array(
                        'title' => __("Number of Pages", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                    ),
                    'copyrightHolder'      => array(
                        'title' => __("Copyright Holder", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('Holt, Rinehart and Winston', "wp-seo-structured-data-schema-pro")
                    ),
                    'copyrightYear'        => array(
                        'title' => __("Copyright Year", "wp-seo-structured-data-schema-pro"),
                        'attr'  => 'step="any"',
                        'type'  => 'number',
                    ),
                    'description'          => array(
                        'title' => __("Description", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                    ),
                    'genre'                => array(
                        'title' => __("Genre", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('Educational Materials', "wp-seo-structured-data-schema-pro")
                    ),
                    'inLanguage'           => array(
                        'title' => __("Language", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('en-US', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_section'       => array(
                        'title' => __('Review', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                        'desc'  => __("To add review schema for this type, complete fields below and enable, others live blank.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_active'        => array(
                        'type' => 'checkbox'
                    ),
                    'review_author'        => array(
                        'title'    => __("Author", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'review_author_sameAs' => array(
                        'title'    => __("Author Same As profile link", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'attr'     => 'placeholder="https://facebook.com/example&#10;https://twitter.com/example"',
                        'required' => true,
                        'desc'     => __('A reference page that unambiguously indicates the item\'s identity; for example, the URL of the item\'s Wikipedia page, Freebase page, or official website.<br> Enter new line for every entry', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_body'          => array(
                        'title'    => __('Review body', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'required' => true,
                        'desc'     => __("The actual body of the review.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_datePublished' => array(
                        'title' => __('Date of Published', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __("Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_ratingValue'   => array(
                        'title' => __('Rating value', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_bestRating'    => array(
                        'title' => __('Best rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The highest value allowed in this rating system.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_worstRating'   => array(
                        'title' => __('Worst rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The lowest value allowed in this rating system. * Required if the rating system is not on a 5-point scale. If worstRating is omitted, 1 is assumed.", "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'course'               => array(
                'title'  => __('Course', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'               => array(
                        'type' => 'checkbox'
                    ),
                    'name'                 => array(
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'description'          => array(
                        'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea'
                    ),
                    'provider'             => array(
                        'title' => __('Provider', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ),
                    'courseMode'           => array(
                        'title' => __('Course Mode', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'attr'  => 'placeholder="One item per line like bellow"',
                        'desc'  => __('MOOC<br>online', "wp-seo-structured-data-schema-pro")
                    ),
                    'startDate'            => array(
                        'title' => __('Start Date', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __('2017-10-16', "wp-seo-structured-data-schema-pro")
                    ),
                    'endDate'              => array(
                        'title' => __('End Date', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __('2017-10-16', "wp-seo-structured-data-schema-pro")
                    ),
                    'locationName'         => array(
                        'title'    => __('Location name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                    ),
                    'locationAddress'      => array(
                        'title'    => __('Location address', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                    ),
                    'image'                => array(
                        'title' => __('Course image', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'image'
                    ),
                    'price'                => array(
                        'title' => __('Price', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                    ),
                    'priceCurrency'        => array(
                        'title' => __('Price Currency', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("USD", "wp-seo-structured-data-schema-pro")
                    ),
                    'availability'         => array(
                        'title'   => 'Availability',
                        'type'    => 'select',
                        'empty'   => "Select one",
                        'options' => array(
                            'http://schema.org/InStock'             => 'InStock',
                            'http://schema.org/InStoreOnly'         => 'InStoreOnly',
                            'http://schema.org/OutOfStock'          => 'OutOfStock',
                            'http://schema.org/SoldOut'             => 'SoldOut',
                            'http://schema.org/OnlineOnly'          => 'OnlineOnly',
                            'http://schema.org/LimitedAvailability' => 'LimitedAvailability',
                            'http://schema.org/Discontinued'        => 'Discontinued',
                            'http://schema.org/PreOrder'            => 'PreOrder',
                        ),
                        'desc'    => __("Select a availability type", "wp-seo-structured-data-schema-pro")
                    ),
                    'url'                  => array(
                        'title' => __('Course Url', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'url'
                    ),
                    'validFrom'            => array(
                        'title' => __('Valid From', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __('The date when the item becomes valid. Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'performerType'        => array(
                        'title'   => 'Performer Type',
                        'type'    => 'select',
                        'options' => array('Organization', 'Person')
                    ),
                    'performerName'        => array(
                        'title' => __('Performer Name', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ),
                    'review_section'       => array(
                        'title' => __('Review', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                        'desc'  => __("To add review schema for this type, complete fields below and enable, others live blank.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_active'        => array(
                        'type' => 'checkbox'
                    ),
                    'review_author'        => array(
                        'title'    => __("Author", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'review_author_sameAs' => array(
                        'title'    => __("Author Same As profile link", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'attr'     => 'placeholder="https://facebook.com/example&#10;https://twitter.com/example"',
                        'required' => true,
                        'desc'     => __('A reference page that unambiguously indicates the item\'s identity; for example, the URL of the item\'s Wikipedia page, Freebase page, or official website.<br> Enter new line for every entry', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_body'          => array(
                        'title'    => __('Review body', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'required' => true,
                        'desc'     => __("The actual body of the review.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_datePublished' => array(
                        'title' => __('Date of Published', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __("Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_ratingValue'   => array(
                        'title' => __('Rating value', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_bestRating'    => array(
                        'title' => __('Best rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The highest value allowed in this rating system.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_worstRating'   => array(
                        'title' => __('Worst rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The lowest value allowed in this rating system. * Required if the rating system is not on a 5-point scale. If worstRating is omitted, 1 is assumed.", "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'person'               => [
                'title'  => esc_html__('Person', "wp-seo-structured-data-schema-pro"),
                'fields' => [
                    'active'          => [
                        'type' => 'checkbox'
                    ],
                    'name'            => [
                        'title'    => esc_html__("Name", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ],
                    'email'           => [
                        'title'    => esc_html__("Email", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'email',
                        'required' => true
                    ],
                    'jobTitle'        => [
                        'title' => esc_html__("Job Title", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ],
                    'image'           => [
                        'title' => esc_html__('Image', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'image'
                    ],
                    'birthPlace'      => [
                        'title' => esc_html__('Birth Place', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ],
                    'birthDate'       => [
                        'title' => esc_html__('Birth Date', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => esc_html__('Like this: 2015-12-25', "wp-seo-structured-data-schema-pro")
                    ],
                    'height'          => [
                        'title' => esc_html__('Height', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => esc_html__('eg. 72 inches', "wp-seo-structured-data-schema-pro")
                    ],
                    'gender'          => [
                        'title'   => esc_html__('Gender', "wp-seo-structured-data-schema-pro"),
                        'type'    => 'select',
                        'options' => ['male' => 'Male', 'female' => 'Female']
                    ],
                    'memberOf'        => [
                        'title' => esc_html__("Member Of", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => esc_html__('An Organization (or ProgramMembership) to which this Person or Organization belongs.', "wp-seo-structured-data-schema-pro")
                    ],
                    'nationality'     => [
                        'title' => esc_html__("Nationality", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => esc_html__('Eg. Albanian', 'wp-seo-structured-data-schema-pro')
                    ],
                    'telephone'       => [
                        'title' => esc_html__("Telephone", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => esc_html__('Eg. (123) 456-6789', 'wp-seo-structured-data-schema-pro')
                    ],
                    'url'             => [
                        'title' => esc_html__("URL", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'url',
                    ],
                    'sameAs'          => [
                        'title'    => esc_html__("Same As", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'attr'     => 'placeholder="https://example.com/example&#10;https://example.com/example"',
                        'required' => true,
                        'desc'     => __('A reference page that unambiguously indicates the item\'s identity; for example, the URL of the item\'s Wikipedia page, Freebase page, or official website.<br> Enter new line for every entry', "wp-seo-structured-data-schema-pro")
                    ],
                    'address_section' => [
                        'title' => __('Address', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                    ],
                    'addressLocality' => [
                        'title' => esc_html__("Address Locality", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ],
                    'addressRegion'   => [
                        'title' => esc_html__("Address Region", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ],
                    'postalCode'      => [
                        'title' => esc_html__("Postal Code", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ],
                    'streetAddress'   => [
                        'title' => esc_html__("Street Address", "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ]
                ]
            ],
            'event'                => array(
                'title'  => __('Event', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'               => array(
                        'type' => 'checkbox'
                    ),
                    'name'                 => array(
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("The name of the event.", "wp-seo-structured-data-schema-pro")
                    ),
                    'locationName'         => array(
                        'title'    => __('Location name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("Event Location name", "wp-seo-structured-data-schema-pro")
                    ),
                    'locationAddress'      => array(
                        'title'    => __('Location address', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("The location of for example where the event is happening, an organization is located, or where an action takes place.", "wp-seo-structured-data-schema-pro")
                    ),
                    'startDate'            => array(
                        'title'    => __('Start date', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'class'    => 'kcseo-date',
                        'required' => true,
                        'desc'     => __("Event start date, Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                    'endDate'              => array(
                        'title'       => __('End date', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'recommended' => true,
                        'class'       => 'kcseo-date',
                        'desc'        => __("Event end date, Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                    'description'          => array(
                        'title'       => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'textarea',
                        'recommended' => true,
                        'desc'        => __("Event description", "wp-seo-structured-data-schema-pro")
                    ),
                    'performerName'        => array(
                        'title'       => __('Performer Name', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'recommended' => true,
                        'desc'        => __("The performer's name.", "wp-seo-structured-data-schema-pro")
                    ),
                    'image'                => array(
                        'title'       => __('Image or logo for the event or tour', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'image',
                        'recommended' => true,
                        'desc'        => __("URL of an image or logo for the event or tour. We recommend that images are 1920px wide (the minimum width is 720px).", "wp-seo-structured-data-schema-pro")
                    ),
                    'price'                => array(
                        'title'       => __('Price', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'number',
                        'recommended' => true,
                        'attr'        => 'step="any"',
                        'desc'        => __("This is highly recommended. The lowest available price, including service charges and fees, of this type of ticket. <span class='required'>Not required but (Recommended)</span>", "wp-seo-structured-data-schema-pro")
                    ),
                    'priceCurrency'        => array(
                        'title' => __('Price currency', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("The 3-letter currency code. (USD)", "wp-seo-structured-data-schema-pro")
                    ),
                    'availability'         => array(
                        'title'       => 'Availability',
                        'type'        => 'select',
                        'recommended' => true,
                        'empty'       => "Select one",
                        'options'     => array(
                            'http://schema.org/InStock'  => 'InStock',
                            'http://schema.org/SoldOut'  => 'SoldOut',
                            'http://schema.org/PreOrder' => 'PreOrder',
                        ),
                    ),
                    'validFrom'            => array(
                        'title'       => __('Valid From', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'recommended' => true,
                        'class'       => 'kcseo-date',
                        'desc'        => __(sprintf("The date and time when tickets go on sale (only required on date-restricted offers), in <a href='%s' target='_blank'>ISO-8601 format</a> Like this: 2015-12-25 14:20:00", 'https://en.wikipedia.org/wiki/ISO_8601'), "wp-seo-structured-data-schema-pro")
                    ),
                    'url'                  => array(
                        'title'       => 'URL',
                        'recommended' => true,
                        'type'        => 'url',
                        'placeholder' => 'URL',
                        'desc'        => __("A link to the event's details page. <span class='required'>Not required but (Recommended)</span>", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_section'       => array(
                        'title' => __('Review', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                        'desc'  => __("To add review schema for this type, complete fields below and enable, others live blank.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_active'        => array(
                        'type' => 'checkbox'
                    ),
                    'review_author'        => array(
                        'title'    => __("Author", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'review_author_sameAs' => array(
                        'title'    => __("Author Same As profile link", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'attr'     => 'placeholder="https://facebook.com/example&#10;https://twitter.com/example"',
                        'required' => true,
                        'desc'     => __('A reference page that unambiguously indicates the item\'s identity; for example, the URL of the item\'s Wikipedia page, Freebase page, or official website.<br> Enter new line for every entry', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_body'          => array(
                        'title'    => __('Review body', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'required' => true,
                        'desc'     => __("The actual body of the review.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_datePublished' => array(
                        'title' => __('Date of Published', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __("Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_ratingValue'   => array(
                        'title' => __('Rating value', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_bestRating'    => array(
                        'title' => __('Best rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The highest value allowed in this rating system.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_worstRating'   => array(
                        'title' => __('Worst rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The lowest value allowed in this rating system. * Required if the rating system is not on a 5-point scale. If worstRating is omitted, 1 is assumed.", "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'JobPosting'           => array(
                'title'  => __('Job Posting', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'                 => array(
                        'type' => 'checkbox'
                    ),
                    'title'                  => array(
                        'title' => __('Title', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                    ),
                    'salaryAmount'           => array(
                        'title' => __('Base Salary', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __(50.00, "wp-seo-structured-data-schema-pro")
                    ),
                    'currency'               => array(
                        'title' => __('Currency', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('USD', "wp-seo-structured-data-schema-pro")
                    ),
                    'salaryAt'               => array(
                        'title'   => 'Salary at',
                        'type'    => 'select',
                        'options' => array('MONTH', 'HOUR', 'WEEK', 'YEAR')
                    ),
                    'datePosted'             => array(
                        'title' => __('Job posted date', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'validThrough'           => array(
                        'title' => __('Valid date through', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'description'            => array(
                        'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea'
                    ),
                    'employmentType'         => array(
                        'title'   => 'Employment Type',
                        'type'    => 'select',
                        'options' => array(
                            'full-time',
                            'part-time',
                            'contract',
                            'temporary',
                            'seasonal',
                            'internship'
                        )
                    ),
                    'workHours'              => array(
                        'title' => __('working Hours', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("40 hours per week", "wp-seo-structured-data-schema-pro")
                    ),
                    'hiringOrganization'     => array(
                        'title' => __('Hiring Organization', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                    ),
                    'addressLocality'        => array(
                        'title' => __('Job location address', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('Kirkland', "wp-seo-structured-data-schema-pro")
                    ),
                    'addressRegion'          => array(
                        'title' => __('Job location region', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("WA", "wp-seo-structured-data-schema-pro")
                    ),
                    'postalCode'             => array(
                        'title' => __('Location Postal code', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ),
                    'streetAddress'          => array(
                        'title' => __('Location street Address', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ),
                    'jobBenefits'            => array(
                        'title' => __('Job Benefits', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("Medical, Life, Dental", "wp-seo-structured-data-schema-pro")
                    ),
                    'educationRequirements'  => array(
                        'title' => __('Education Requirement', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea'
                    ),
                    'experienceRequirements' => array(
                        'title' => __('Experience Requirements', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('Minumum 3 years experience as a software engineer', "wp-seo-structured-data-schema-pro")
                    ),
                    'incentiveCompensation'  => array(
                        'title' => __('Incentive Compensation', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                    ),
                    'industry'               => array(
                        'title' => __('Industry', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                    ),
                    'occupationalCategory'   => array(
                        'title' => __('Occupational Category', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                    ),
                    'qualifications'         => array(
                        'title' => __('Qualifications', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                    ),
                    'responsibilities'       => array(
                        'title' => __('Responsibilities', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                    ),
                    'skills'                 => array(
                        'title' => __('Skills', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea'
                    ),
                )
            ),
            'localBusiness'        => array(
                'title'  => __('Local Business', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'               => array(
                        'type' => 'checkbox'
                    ),
                    'name'                 => array(
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'description'          => array(
                        'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                    ),
                    'image'                => array(
                        'title'    => __('Business Logo', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'image',
                        'required' => true
                    ),
                    'priceRange'           => array(
                        'title' => __('Price Range (Recommended)', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("The price range of the business, for example $$$.", "wp-seo-structured-data-schema-pro")
                    ),
                    'addressLocality'      => array(
                        'title' => __('Address locality', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('City (i.e Kansas city)', "wp-seo-structured-data-schema-pro")
                    ),
                    'addressRegion'        => array(
                        'title' => __('Address region', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('State (i.e. MO)', "wp-seo-structured-data-schema-pro")
                    ),
                    'postalCode'           => array(
                        'title' => __('Postal code', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                    ),
                    'streetAddress'        => array(
                        'title' => __('Street address', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                    ),
                    'telephone'            => array(
                        'title' => __('Telephone (Recommended)', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                    ),
                    'review_section'       => array(
                        'title' => __('Review', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                        'desc'  => __("To add review schema for this type, complete fields below and enable, others live blank.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_active'        => array(
                        'type' => 'checkbox'
                    ),
                    'review_author'        => array(
                        'title'    => __("Author", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'review_author_sameAs' => array(
                        'title'    => __("Author Same As profile link", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'attr'     => 'placeholder="https://facebook.com/example&#10;https://twitter.com/example"',
                        'required' => true,
                        'desc'     => __('A reference page that unambiguously indicates the item\'s identity; for example, the URL of the item\'s Wikipedia page, Freebase page, or official website.<br> Enter new line for every entry', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_body'          => array(
                        'title'    => __('Review body', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'required' => true,
                        'desc'     => __("The actual body of the review.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_datePublished' => array(
                        'title' => __('Date of Published', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __("Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_ratingValue'   => array(
                        'title' => __('Rating value', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_bestRating'    => array(
                        'title' => __('Best rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The highest value allowed in this rating system.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_worstRating'   => array(
                        'title' => __('Worst rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The lowest value allowed in this rating system. * Required if the rating system is not on a 5-point scale. If worstRating is omitted, 1 is assumed.", "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'software_application' => array(
                'title'  => __('Software App', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'                   => array(
                        'type' => 'checkbox'
                    ),
                    'name'                     => array(
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'description'              => array(
                        'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                    ),
                    'image'                    => array(
                        'title'    => __('Business Logo', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'image',
                        'required' => true
                    ),
                    'price'                    => array(
                        'title' => __('Price', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The lowest available price, including service charges and fees, of this type of ticket.", "wp-seo-structured-data-schema-pro")
                    ),
                    'priceCurrency'            => array(
                        'title' => __('Price currency', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("The 3-letter currency code.", "wp-seo-structured-data-schema-pro")
                    ),
                    'applicationCategory'      => array(
                        'title'    => __('Application Category', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'select',
                        'required' => true,
                        'options'  => self::getApplicationCategoryList(),
                        'desc'     => __("The type of app (for example, BusinessApplication or GameApplication). The value must be a supported app type.", "wp-seo-structured-data-schema-pro")
                    ),
                    'operatingSystem'          => array(
                        'title' => __('Operating System', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("The operating system(s) required to use the app (for example, Windows 7, OSX 10.6, Android 1.6)", "wp-seo-structured-data-schema-pro")
                    ),
                    'aggregate_rating_section' => array(
                        'title' => __('Aggregate Rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                    ),
                    'aggregate_ratingValue'    => array(
                        'title' => __('Rating value', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'aggregate_bestRating'     => array(
                        'title' => __('Best rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'aggregate_worstRating'    => array(
                        'title' => __('Worst rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'aggregate_ratingCount'    => array(
                        'title' => __('Rating Count', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_section'           => array(
                        'title' => __('Review', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                        'desc'  => __("To add review schema for this type, complete fields below and enable, others live blank.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_active'            => array(
                        'type' => 'checkbox'
                    ),
                    'review_author'            => array(
                        'title'    => __("Author", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'review_author_sameAs'     => array(
                        'title'    => __("Author Same As profile link", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'attr'     => 'placeholder="https://facebook.com/example&#10;https://twitter.com/example"',
                        'required' => true,
                        'desc'     => __('A reference page that unambiguously indicates the item\'s identity; for example, the URL of the item\'s Wikipedia page, Freebase page, or official website.<br> Enter new line for every entry', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_body'              => array(
                        'title'    => __('Review body', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'required' => true,
                        'desc'     => __("The actual body of the review.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_datePublished'     => array(
                        'title' => __('Date of Published', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __("Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_ratingValue'       => array(
                        'title' => __('Rating value', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_bestRating'        => array(
                        'title' => __('Best rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The highest value allowed in this rating system.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_worstRating'       => array(
                        'title' => __('Worst rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The lowest value allowed in this rating system. * Required if the rating system is not on a 5-point scale. If worstRating is omitted, 1 is assumed.", "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'movie'                => array(
                'title'  => __('Movie', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'                => array(
                        'type' => 'checkbox'
                    ),
                    'name'                  => array(
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'description'           => array(
                        'title'    => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'required' => true
                    ),
                    'duration'              => array(
                        'title' => __('Duration', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('Runtime of the movie in ISO 8601 format (for example, "PT2H22M" (142 minutes)).', "wp-seo-structured-data-schema-pro")
                    ),
                    'dateCreated'           => array(
                        'title' => __('Created Date', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'image'                 => array(
                        'title'    => __('Image', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'image',
                        'required' => true,
                    ),
                    'director'              => array(
                        'title' => __('Director', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ),
                    'author'                => array(
                        'title' => __('Author', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'attr'  => 'placeholder="One item per line like bellow"',
                        'desc'  => __('Ted Elliott<br>Terry Rossio', "wp-seo-structured-data-schema-pro")
                    ),
                    'actor'                 => array(
                        'title' => __('Actor', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'attr'  => 'placeholder="One item per line like bellow"',
                        'desc'  => __('Johnny Depp<br>Penelope Cruz<br>Ian McShane', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_section'        => array(
                        'title' => __('Review', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                        'desc'  => __("To add review schema for this type, complete fields below and enable, others live blank.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_active'         => array(
                        'type' => 'checkbox'
                    ),
                    'review_author'         => array(
                        'title'    => __("Author", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'review_author_sameAs'  => array(
                        'title'    => __("Author Same As profile link", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'attr'     => 'placeholder="https://facebook.com/example&#10;https://twitter.com/example"',
                        'required' => true,
                        'desc'     => __('A reference page that unambiguously indicates the item\'s identity; for example, the URL of the item\'s Wikipedia page, Freebase page, or official website.<br> Enter new line for every entry', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_body'           => array(
                        'title'    => __('Review body', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'required' => true,
                        'desc'     => __("The actual body of the review.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_datePublished'  => array(
                        'title' => __('Date of Published', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __("Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_publisher'      => array(
                        'title'    => __('Publisher', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'desc'     => __('Publisher name or Organization name', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'review_publisherImage' => array(
                        'title' => __('Publisher Logo', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'image',
                        'desc'  => __('Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_sameAs'         => array(
                        'title'    => __("Review same as link", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'attr'     => 'placeholder="https://example.com/example&#10;https://example.com/example"',
                        'required' => true,
                        'desc'     => __('A reference page that unambiguously indicates the item\'s identity; for example, the URL of the item\'s Wikipedia page, Freebase page, or official website.<br> Enter new line for every entry', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_ratingValue'    => array(
                        'title' => __('Rating value', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_bestRating'     => array(
                        'title' => __('Best rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The highest value allowed in this rating system.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_worstRating'    => array(
                        'title' => __('Worst rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The lowest value allowed in this rating system. * Required if the rating system is not on a 5-point scale. If worstRating is omitted, 1 is assumed.", "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'music'                => array(
                'title'  => __('Music', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'      => array(
                        'type' => 'checkbox'
                    ),
                    'musicType'   => array(
                        'title'    => __('Music Type', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'select',
                        'required' => true,
                        'options'  => array("MusicGroup" => 'Music Artist', "MusicAlbum" => 'MusicAlbum')
                    ),
                    'name'        => array(
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'description' => array(
                        'title'    => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'required' => true
                    ),
                    'image'       => array(
                        'title' => __('Image', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'image'
                    ),
                    'sameAs'      => array(
                        'title' => __('Same as URL', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'url',
                        'desc'  => __("URL of a page that unambiguously identifies the artist or album. Example: Wikipedia.", "wp-seo-structured-data-schema-pro")
                    ),
                    'url'         => array(
                        'title'    => __('URL', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'url',
                        'required' => true,
                        'desc'     => __("URL of the landing page of the artist or album on the partner site.", "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'news_article'         => array(
                'title'  => __('News Article', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'           => array(
                        'type' => 'checkbox'
                    ),
                    'headline'         => array(
                        'title'    => __('Headline', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'desc'     => __('Article title', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'mainEntityOfPage' => array(
                        'title'    => __('Page URL', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'url',
                        'desc'     => __('The canonical URL of the article page', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'author'           => array(
                        'title'    => __('Author', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'desc'     => __('Author display name', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'image'            => array(
                        'title'    => __('Image', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'image',
                        'desc'     => __("The representative image of the article. Only a marked-up image that directly belongs to the article should be specified.<br> Images should be at least 696 pixels wide. <br>Images should be in .jpg, .png, or. gif format.", "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'datePublished'    => array(
                        'title'    => __('Published date', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'class'    => 'kcseo-date',
                        'desc'     => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'dateModified'     => array(
                        'title'    => __('Modified date', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'class'    => 'kcseo-date',
                        'required' => true,
                        'desc'     => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'publisher'        => array(
                        'title'    => __('Publisher', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'desc'     => __('Publisher name or Organization name', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'publisherImage'   => array(
                        'title'    => __('Publisher Logo', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'image',
                        'desc'     => __('Logos should have a wide aspect ratio, not a square icon.<br>Logos should be no wider than 600px, and no taller than 60px.<br>Always retain the original aspect ratio of the logo when resizing. Ideally, logos are exactly 60px tall with width <= 600px. If maintaining a height of 60px would cause the width to exceed 600px, downscale the logo to exactly 600px wide and reduce the height accordingly below 60px to maintain the original aspect ratio.<br>', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ),
                    'description'      => array(
                        'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'desc'  => __('Short description, New line is not supported.', "wp-seo-structured-data-schema-pro")
                    ),
                    'articleBody'      => array(
                        'title' => __('Article body', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'desc'  => __('Article body content, New line is not supported.', "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'product'              => array(
                'title'  => __((class_exists('woocommerce')) ? "Product (Woocommerce)" : 'Product', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'             => array(
                        'type' => 'checkbox'
                    ),
                    'name'               => array(
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'image'              => array(
                        'title' => __('Image', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'image'
                    ),
                    'description'        => array(
                        'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'desc'  => __("Product description. ", "wp-seo-structured-data-schema-pro")
                    ),
                    'identifier_section' => array(
                        'title' => __('Product Identifier', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                        'desc'  => __("Add Product unique Identifier.", "wp-seo-structured-data-schema-pro")
                    ),
                    'sku'                => array(
                        'title'       => __('SKU', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'recommended' => true
                    ),
                    'brand'              => array(
                        'title'    => __('BRAND', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("The brand of the product (Used globally).", "wp-seo-structured-data-schema-pro")
                    ),
                    'identifier_type'    => array(
                        'title'    => __('Identifier Type', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'select',
                        'required' => true,
                        'options'  => array(
                            'mpn'    => 'MPN',
                            'isbn'   => 'ISBN',
                            'gtin8'  => 'GTIN-8 (UPC, JAN)',
                            'gtin12' => 'GTIN-12 (UPC)',
                            'gtin13' => 'GTIN-13 (EAN,JAN)'
                        ),
                        'desc'     => __("<strong>MPN</strong><br>
                                       &#8594; MPN(Manufacturer Part Number) Used globally, Alphanumeric digits (various lengths)<br>
                                       <strong>GTIN</strong><br>
                                       &#8594; UPC(Universal Product Code) Used in primarily North America. 12 numeric digits. eg. 892685001003.<br>
                                       &#8594; EAN(European Article Number) Used primarily outside of North America. Typically 13 numeric digits (can occasionally be either eight or 14 numeric digits). eg. 4011200296908<br>
                                       &#8594; ISBN(International Standard Book Number) Used globally, ISBN-13 (recommended), 13 numeric digits 978-0747595823<br>
                                       &#8594; JAN(Japanese Article Number) Used only in Japan, 8 or 13 numeric digits.", "wp-seo-structured-data-schema-pro")
                    ),
                    'identifier'         => array(
                        'title'    => __('Identifier', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("Enter product unique identifier", "wp-seo-structured-data-schema-pro")
                    ),
                    'rating_section'     => array(
                        'title' => __('Product Review & Rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                    ),
                    'reviewRatingValue'  => array(
                        'title'       => __('Review rating value', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'number',
                        'recommended' => true,
                        'attr'        => 'step="any"',
                        'desc'        => __("Rating value. (1 , 2.5, 3, 5 etc)", "wp-seo-structured-data-schema-pro")
                    ),
                    'reviewBestRating'   => array(
                        'title'       => __('Review Best rating', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'number',
                        'recommended' => true,
                        'attr'        => 'step="any"',
                    ),
                    'reviewWorstRating'  => array(
                        'title'       => __('Review Worst rating', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'number',
                        'recommended' => true,
                        'attr'        => 'step="any"',
                    ),
                    'reviewAuthor'       => array(
                        'title' => __('Review author', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ),
                    'ratingValue'        => array(
                        'title'       => __('Aggregate Rating value', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'number',
                        'recommended' => true,
                        'attr'        => 'step="any"',
                        'desc'        => __("Rating value. (1 , 2.5, 3, 5 etc)", "wp-seo-structured-data-schema-pro")
                    ),
                    'reviewCount'        => array(
                        'title' => __('Aggregate Total review count', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("Review Count. <span class='required'>This is required if (Rating value) is given</span>", "wp-seo-structured-data-schema-pro")
                    ),
                    'pricing_section'    => array(
                        'title' => __('Product Pricing', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                    ),
                    'priceCurrency'      => array(
                        'title' => __('Price currency', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("The 3-letter currency code.", "wp-seo-structured-data-schema-pro")
                    ),
                    'price'              => array(
                        'title' => __('Price', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The lowest available price, including service charges and fees, of this type of ticket.", "wp-seo-structured-data-schema-pro")
                    ),
                    'priceValidUntil'    => array(
                        'title'       => __('PriceValidUntil', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'recommended' => true,
                        'class'       => 'kcseo-date',
                        'desc'        => __("The date (in ISO 8601 date format) after which the price will no longer be available. Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                    'availability'       => array(
                        'title'   => 'Availability',
                        'type'    => 'select',
                        'empty'   => "Select one",
                        'options' => array(
                            'http://schema.org/InStock'             => 'InStock',
                            'http://schema.org/InStoreOnly'         => 'InStoreOnly',
                            'http://schema.org/OutOfStock'          => 'OutOfStock',
                            'http://schema.org/SoldOut'             => 'SoldOut',
                            'http://schema.org/OnlineOnly'          => 'OnlineOnly',
                            'http://schema.org/LimitedAvailability' => 'LimitedAvailability',
                            'http://schema.org/Discontinued'        => 'Discontinued',
                            'http://schema.org/PreOrder'            => 'PreOrder',
                        ),
                        'desc'    => __("Select a availability type", "wp-seo-structured-data-schema-pro")
                    ),
                    'itemCondition'      => array(
                        'title'   => 'Product condition',
                        'type'    => 'select',
                        'empty'   => "Select one",
                        'options' => array(
                            'http://schema.org/NewCondition'         => 'NewCondition',
                            'http://schema.org/UsedCondition'        => 'UsedCondition',
                            'http://schema.org/DamagedCondition'     => 'DamagedCondition',
                            'http://schema.org/RefurbishedCondition' => 'RefurbishedCondition',
                        ),
                        'desc'    => __("Select a condition", "wp-seo-structured-data-schema-pro")
                    ),
                    'url'                => array(
                        'title' => __('Product URL', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'url',
                        'desc'  => __("A URL to the product web page (that includes the Offer). (Don't use offerURL for markup that appears on the product page itself.)", "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'recipe'               => array(
                'title'  => __('Recipe', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'               => array(
                        'type' => 'checkbox'
                    ),
                    'name'                 => array(
                        'title' => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ),
                    'author'               => array(
                        'title' => __('Author', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ),
                    'datePublished'        => array(
                        'title' => __('Published Date', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'image'                => array(
                        'title'    => __('Image', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'image',
                        'required' => true,
                    ),
                    'description'          => array(
                        'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                    ),
                    'keywords'             => array(
                        'title'       => __('Recipe keywords', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'recommended' => true,
                        'desc'        => __("Pizza, Nice, Testy", "wp-seo-structured-data-schema-pro")
                    ),
                    'recipeCategory'       => array(
                        'title'       => __('Recipe Category', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'recommended' => true,
                        'desc'        => __("example, appetizer, entree, etc.", "wp-seo-structured-data-schema-pro")
                    ),
                    'recipeCuisine'        => array(
                        'title'       => __('Recipe Cuisine', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'recommended' => true,
                        'desc'        => __("example, French or Ethiopian", "wp-seo-structured-data-schema-pro")
                    ),
                    'video'                => array(
                        'title'       => __('Recipe video url', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'url',
                        'recommended' => true,
                    ),
                    'prepTime'             => array(
                        'title' => __('Prepare Time', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('PT15M', "wp-seo-structured-data-schema-pro")
                    ),
                    'cookTime'             => array(
                        'title' => __('Cook Time', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('PT1H', "wp-seo-structured-data-schema-pro")
                    ),
                    'recipeInstructions'   => array(
                        'title' => __('Recipe Instructions', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                    ),
                    'recipeIngredient'     => array(
                        'title' => __('Recipe Ingredient', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'attr'  => 'placeholder="One item per line like bellow"',
                        'desc'  => __('3 or 4 ripe bananas, smashed<br>1 egg<br> 3/4 cup of sugar', "wp-seo-structured-data-schema-pro")
                    ),
                    'calories'             => array(
                        'title' => __('Nutrition: calories', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('240 calories', "wp-seo-structured-data-schema-pro")
                    ),
                    'fatContent'           => array(
                        'title' => __('Nutrition: Fat Content', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('9 grams fat', "wp-seo-structured-data-schema-pro")
                    ),
                    'userInteractionCount' => array(
                        'title' => __('User Interaction Count', "wp-seo-structured-data-schema-pro"),
                        'attr'  => 'step="any"',
                        'type'  => 'number',
                    ),
                    'ratingValue'          => array(
                        'title' => __('Rating value', "wp-seo-structured-data-schema-pro"),
                        'attr'  => 'step="any"',
                        'type'  => 'number',
                    ),
                    'reviewCount'          => array(
                        'title' => __('Review Count', "wp-seo-structured-data-schema-pro"),
                        'attr'  => 'step="any"',
                        'type'  => 'number',
                    ),
                    'bestRating'           => array(
                        'title' => __('Best rating', "wp-seo-structured-data-schema-pro"),
                        'attr'  => 'step="any"',
                        'type'  => 'number',
                    ),
                    'worstRating'          => array(
                        'title' => __('Worst rating', "wp-seo-structured-data-schema-pro"),
                        'attr'  => 'step="any"',
                        'type'  => 'number',
                    ),
                    'recipeYield'          => array(
                        'title' => __('Recipe Yield', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                    ),
                    'suitableForDiet'      => array(
                        'title' => __('Suitable ForDiet', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('http://schema.org/LowFatDiet', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_section'       => array(
                        'title' => __('Review', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                        'desc'  => __("To add review schema for this type, complete fields below and enable, others live blank.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_active'        => array(
                        'type' => 'checkbox'
                    ),
                    'review_author'        => array(
                        'title'    => __("Author", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'review_author_sameAs' => array(
                        'title'    => __("Author Same As profile link", "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'attr'     => 'placeholder="https://facebook.com/example&#10;https://twitter.com/example"',
                        'required' => true,
                        'desc'     => __('A reference page that unambiguously indicates the item\'s identity; for example, the URL of the item\'s Wikipedia page, Freebase page, or official website.<br> Enter new line for every entry', "wp-seo-structured-data-schema-pro")
                    ),
                    'review_body'          => array(
                        'title'    => __('Review body', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'required' => true,
                        'desc'     => __("The actual body of the review.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_datePublished' => array(
                        'title' => __('Date of Published', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __("Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_ratingValue'   => array(
                        'title' => __('Rating value', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_bestRating'    => array(
                        'title' => __('Best rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The highest value allowed in this rating system.", "wp-seo-structured-data-schema-pro")
                    ),
                    'review_worstRating'   => array(
                        'title' => __('Worst rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The lowest value allowed in this rating system. * Required if the rating system is not on a 5-point scale. If worstRating is omitted, 1 is assumed.", "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'restaurant'           => array(
                'title'  => __('Restaurant', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'                      => array(
                        'type' => 'checkbox'
                    ),
                    'name'                        => array(
                        'title'    => __('Name of the Restaurant', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'description'                 => array(
                        'title' => __('Description of the Restaurant', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                    ),
                    'openingHours'                => array(
                        'title' => __('Opening Hours', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'desc'  => __('Mo,Tu,We,Th,Fr,Sa,Su 11:30-23:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'telephone'                   => array(
                        'title' => __('Telephone', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('+155501003333', "wp-seo-structured-data-schema-pro")
                    ),
                    'address'                     => array(
                        'title' => __('Address', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea'
                    ),
                    'priceRange'                  => array(
                        'title' => __('Price Range', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("The price range of the business, for example $$$.", "wp-seo-structured-data-schema-pro")
                    ),
                    'servesCuisine'               => array(
                        'title' => __('Serves Cuisine', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'attr'  => 'placeholder="One item per line like bellow"',
                    ),
                    'image'                       => array(
                        'title'    => __('Image', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'image',
                        'required' => true
                    ),
                    'menu_section'                => array(
                        'title' => __('Menu Section', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'heading',
                        'desc'  => __('Add your menu here.', "wp-seo-structured-data-schema-pro")
                    ),
                    'menuName'                    => array(
                        'title' => __('Menu Name', "wp-seo-structured-data-schema"),
                        'type'  => 'text'
                    ),
                    'menuDescription'             => array(
                        'title' => __('Menu description', "wp-seo-structured-data-schema"),
                        'type'  => 'textarea'
                    ),
                    'menuImage'                   => array(
                        'title' => __('Menu Image', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'image'
                    ),
                    'menuOfferAvailabilityEnds'   => array(
                        'title' => __('Menu Offer availabilityEnds', "wp-seo-structured-data-schema"),
                        'type'  => 'text',
                        'class' => 'kcseo-date'
                    ),
                    'menuOfferAvailabilityStarts' => array(
                        'title' => __('Menu Offer availabilityStarts', "wp-seo-structured-data-schema"),
                        'type'  => 'text',
                        'class' => 'kcseo-date'
                    ),
                    'menu_items'                  => array(
                        'title'     => __("Menu Item", "wp-seo-structured-data-schema-pro"),
                        'type'      => 'group',
                        'duplicate' => true,
                        'fields'    => array(
                            'menu_item_section'               => array(
                                'title' => __('Menu Item', "wp-seo-structured-data-schema-pro"),
                                'type'  => 'heading',
                                'desc'  => __('Add your menu item here.', "wp-seo-structured-data-schema-pro")
                            ),
                            'name'                            => array(
                                'title' => __("Name", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text'
                            ),
                            'description'                     => array(
                                'title' => __("Description", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'textarea'
                            ),
                            'pricing_section_heading'         => array(
                                'title' => __("Offer", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'heading'
                            ),
                            'offers_price'                    => array(
                                'title' => __("Price", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'number'
                            ),
                            'offers_priceCurrency'            => array(
                                'title' => __("Price Currency", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text'
                            ),
                            'nutrition_section_heading'       => array(
                                'title' => __("Nutrition", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'heading'
                            ),
                            'nutrition_calories'              => array(
                                'title' => __("Calories", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The number of calories.", "wp-seo-structured-data-schema-pro")
                            ),
                            'nutrition_carbohydrateContent'   => array(
                                'title' => __("Carbohydrates", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The number of grams of carbohydrates.", "wp-seo-structured-data-schema-pro")
                            ),
                            'nutrition_cholesterolContent'    => array(
                                'title' => __("Cholesterol", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The number of milligrams of cholesterol.", "wp-seo-structured-data-schema-pro")
                            ),
                            'nutrition_fatContent'            => array(
                                'title' => __("Fat", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The number of grams of fat.", "wp-seo-structured-data-schema-pro")
                            ),
                            'nutrition_fiberContent'          => array(
                                'title' => __("Fiber", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The number of grams of fiber.", "wp-seo-structured-data-schema-pro")
                            ),
                            'nutrition_proteinContent'        => array(
                                'title' => __("Protein", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The number of grams of protein.", "wp-seo-structured-data-schema-pro")
                            ),
                            'nutrition_saturatedFatContent'   => array(
                                'title' => __("Saturated Fat", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The number of grams of saturated fat.", "wp-seo-structured-data-schema-pro")
                            ),
                            'nutrition_servingSize'           => array(
                                'title' => __("Serving size", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The serving size, in terms of the number of volume or mass.", "wp-seo-structured-data-schema-pro")
                            ),
                            'nutrition_sodiumContent'         => array(
                                'title' => __("Sodium", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The number of milligrams of sodium.", "wp-seo-structured-data-schema-pro")
                            ),
                            'nutrition_sugarContent'          => array(
                                'title' => __("Sugar", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The number of grams of sugar.", "wp-seo-structured-data-schema-pro")
                            ),
                            'nutrition_transFatContent'       => array(
                                'title' => __("Trans fat", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The number of grams of trans fat.", "wp-seo-structured-data-schema-pro")
                            ),
                            'nutrition_unsaturatedFatContent' => array(
                                'title' => __("Cholesterol", "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __("The number of grams of unsaturated fat.", "wp-seo-structured-data-schema-pro")
                            )
                        )
                    )
                )
            ),
            'review'               => array(
                'title'  => __('Review', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'                => array(
                        'type' => 'checkbox'
                    ),
                    'review_notice_heading' => array(
                        'title' => sprintf('<span style="display:block;text-align:center;color: red">%s</span>', __('Notice</span>', "wp-seo-structured-data-schema-pro")),
                        'type'  => 'heading',
                        'desc'  => self::getReviewNotice()
                    ),
                    'itemName'              => array(
                        'title'    => __('Name of the reviewed item', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("The item that is being reviewed.", "wp-seo-structured-data-schema-pro")
                    ),
                    'reviewBody'            => array(
                        'title'    => __('Review body', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'required' => true,
                        'desc'     => __("The actual body of the review.", "wp-seo-structured-data-schema-pro")
                    ),
                    'name'                  => array(
                        'title'    => __('Review name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("A particular name for the review.", "wp-seo-structured-data-schema-pro")
                    ),
                    'author'                => array(
                        'title'    => __('Author', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'author'   => 'Author name',
                        'desc'     => __("The author of the review. The reviewer’s name needs to be a valid name.", "wp-seo-structured-data-schema-pro")
                    ),
                    'datePublished'         => array(
                        'title' => __('Date of Published', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __("Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                    'ratingValue'           => array(
                        'title' => __('Rating value', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("A numerical quality rating for the item.", "wp-seo-structured-data-schema-pro")
                    ),
                    'bestRating'            => array(
                        'title' => __('Best rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The highest value allowed in this rating system.", "wp-seo-structured-data-schema-pro")
                    ),
                    'worstRating'           => array(
                        'title' => __('Worst rating', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The lowest value allowed in this rating system. * Required if the rating system is not on a 5-point scale. If worstRating is omitted, 1 is assumed.", "wp-seo-structured-data-schema-pro")
                    ),
                    'publisher'             => array(
                        'title' => __('Name of the organization', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('The publisher of the review.', "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'service'              => array(
                'title'  => __('Service', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'           => array(
                        'type' => 'checkbox'
                    ),
                    'name'             => array(
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("The name of the Service.", "wp-seo-structured-data-schema-pro")
                    ),
                    'serviceType'      => array(
                        'title'    => __('Service type', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("The type of service being offered, e.g. veterans' benefits, emergency relief, etc.", "wp-seo-structured-data-schema-pro")
                    ),
                    'additionalType'   => array(
                        'title'       => 'Additional type(URL)',
                        'type'        => 'url',
                        'placeholder' => 'URL',
                        'desc'        => __("An additional type for the service, typically used for adding more specific types from external vocabularies in microdata syntax.", "wp-seo-structured-data-schema-pro")
                    ),
                    'award'            => array(
                        'title' => __('Award', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("An award won by or for this service.", "wp-seo-structured-data-schema-pro")
                    ),
                    'category'         => array(
                        'title' => __('Category', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("A category for the service.", "wp-seo-structured-data-schema-pro")
                    ),
                    'providerMobility' => array(
                        'title' => __('Provider mobility', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("Indicates the mobility of a provided service (e.g. 'static', 'dynamic').", "wp-seo-structured-data-schema-pro")
                    ),
                    'description'      => array(
                        'title'   => 'Description',
                        'type'    => 'textarea',
                        'require' => true,
                        'desc'    => __("A short description of the service. New line is not supported.", "wp-seo-structured-data-schema-pro")
                    ),
                    'image'            => array(
                        'title'   => 'Image URL',
                        'type'    => 'url',
                        'require' => false,
                        'desc'    => __("An image of the service. This should be a URL.", "wp-seo-structured-data-schema-pro")
                    ),
                    'mainEntityOfPage' => array(
                        'title'   => 'Main entity of page URL',
                        'type'    => 'url',
                        'require' => false,
                        'desc'    => __("Indicates a page (or other CreativeWork) for which this thing is the main entity being described.", "wp-seo-structured-data-schema-pro")
                    ),
                    'sameAs'           => array(
                        'title'       => 'Same as URL',
                        'type'        => 'url',
                        'placeholder' => 'URL',
                        'desc'        => __("URL of a reference Web page that unambiguously indicates the service's identity. E.g. the URL of the service's Wikipedia page, Freebase page, or official website.", "wp-seo-structured-data-schema-pro")
                    ),
                    'url'              => array(
                        'title'       => 'Url of the service',
                        'type'        => 'url',
                        'placeholder' => 'URL',
                        'desc'        => __("URL of the service.", "wp-seo-structured-data-schema-pro")
                    ),
                    'alternateName'    => array(
                        'title' => __('Alternate name', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __('An alias for the service.', "wp-seo-structured-data-schema-pro")
                    ),
                )
            ),
            'TVEpisode'            => array(
                'title'  => __('TVEpisode', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'        => array(
                        'type' => 'checkbox'
                    ),
                    'name'          => array(
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'author'        => array(
                        'title' => __('Author', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text'
                    ),
                    'actor'         => array(
                        'title' => __('Actor', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'attr'  => 'placeholder="One item per line like bellow"',
                        'desc'  => __('Justin Chambers<br>Jessica Capshaw', "wp-seo-structured-data-schema-pro")
                    ),
                    'episodeNumber' => array(
                        'title'    => __('Episode Number', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'number',
                        'attr'     => 'step="any"',
                        'required' => true,
                        'desc'     => __("Position of the episode within an ordered group of episodes for a given season.", "wp-seo-structured-data-schema-pro")
                    ),
                    'seasonNumber'  => array(
                        'title'    => __('Season Number', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'number',
                        'attr'     => 'step="any"',
                        'required' => true,
                        'desc'     => __("Position of the season within an ordered group of seasons.", "wp-seo-structured-data-schema-pro")
                    ),
                    'seriesName'    => array(
                        'title'    => __('Series name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("Name of the TV series.", "wp-seo-structured-data-schema-pro")
                    ),
                    'seriesURL'     => array(
                        'title' => __('Series URL', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'url',
                        'desc'  => __("URL to a reference web page that unambiguously identifies the series. Example: IMDB, Wikipedia.", "wp-seo-structured-data-schema-pro")
                    ),
                    'startDate'     => array(
                        'title' => __('Released Event (StartDate)', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'sameAs'        => array(
                        'title' => __('Episode URL', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'url',
                        'desc'  => __("URL to a reference web page that unambiguously identifies the work. Example: IMDB, Wikipedia.", "wp-seo-structured-data-schema-pro")
                    ),
                    'url'           => array(
                        'title' => __('URL', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'url',
                        'desc'  => __("URL to partner's landing page for the work.", "wp-seo-structured-data-schema-pro")
                    )
                )
            ),
            'video'                => array(
                'title'  => __('Video', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'           => array(
                        'type' => 'checkbox'
                    ),
                    'name'             => array(
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true,
                        'desc'     => __("The title of the video", "wp-seo-structured-data-schema-pro")
                    ),
                    'description'      => array(
                        'title'    => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'required' => true,
                        'desc'     => __("The description of the video. New line is not supported.", "wp-seo-structured-data-schema-pro")
                    ),
                    'thumbnailUrl'     => array(
                        'title'       => 'Thumbnail URL',
                        'type'        => 'url',
                        'placeholder' => "URL",
                        'required'    => true,
                        'desc'        => __("A URL pointing to the video thumbnail image file. Images must be at least 160x90 pixels and at most 1920x1080 pixels.", "wp-seo-structured-data-schema-pro")
                    ),
                    'uploadDate'       => array(
                        'title' => __('Updated date', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'duration'         => array(
                        'title' => __('Duration', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'desc'  => __("The duration of the video in ISO 8601 format.(PT1M33S)", "wp-seo-structured-data-schema-pro")
                    ),
                    'contentUrl'       => array(
                        'title'       => 'Content URL',
                        'type'        => 'url',
                        'placeholder' => 'URL',
                        'desc'        => __("A URL pointing to the actual video media file. This file should be in .mpg, .mpeg, .mp4, .m4v, .mov, .wmv, .asf, .avi, .ra, .ram, .rm, .flv, or other video file format.", "wp-seo-structured-data-schema-pro")
                    ),
                    'embedUrl'         => array(
                        'title'       => 'Embed URL',
                        'placeholder' => 'URL',
                        'type'        => 'url',
                        'desc'        => __("A URL pointing to a player for the specific video. Usually this is the information in the src element of an < embed> tag.Example: Dailymotion: http://www.dailymotion.com/swf/x1o2g.", "wp-seo-structured-data-schema-pro")
                    ),
                    'interactionCount' => array(
                        'title' => __('Interaction count', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                        'attr'  => 'step="any"',
                        'desc'  => __("The number of times the video has been viewed.", "wp-seo-structured-data-schema-pro")
                    ),
                    'expires'          => array(
                        'title' => __('Expires', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'text',
                        'class' => 'kcseo-date',
                        'desc'  => __("Like this: 2015-12-25 14:20:00", "wp-seo-structured-data-schema-pro")
                    ),
                )
            ),
            'faq'                  => array(
                'title'  => __('FAQ Page', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'            => array(
                        'type' => 'checkbox'
                    ),
                    'faq_items_heading' => array(
                        'type'  => 'heading',
                        'title' => __('FAQ Questions & Answer', "wp-seo-structured-data-schema-pro"),
                        'desc'  => __("Please use either QAPage or FAQ schema. Both schemas at a time will give an error by Google.", "wp-seo-structured-data-schema-pro")
                    ),
                    'faq_items'         => array(
                        'title'     => __('FAQ item', "wp-seo-structured-data-schema-pro"),
                        'type'      => 'group',
                        'duplicate' => true,
                        'fields'    => array(
                            'faq_item_heading' => array(
                                'type'  => 'heading',
                                'title' => __('FAQ item', "wp-seo-structured-data-schema-pro")
                            ),
                            'question'         => array(
                                'title'    => __('Question', "wp-seo-structured-data-schema-pro"),
                                'type'     => 'text',
                                'required' => true
                            ),
                            'answer'           => array(
                                'title' => __('Answer', "wp-seo-structured-data-schema-pro"),
                                'type'  => 'textarea',
                            )
                        )
                    )
                )
            ),
            'question'             => array(
                'title'  => __('QAPage', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'                       => array(
                        'type' => 'checkbox'
                    ),
                    'question_items_heading'       => array(
                        'type'  => 'heading',
                        'title' => __('Question & AskAction schema', "wp-seo-structured-data-schema-pro"),
                        'desc'  => __("Please use either QAPage or FAQ schema. Both schemas at a time will give an error by Google.", "wp-seo-structured-data-schema-pro")
                    ),
                    'type'                         => array(
                        'title'    => __('Type', "wp-seo-structured-data-schema-pro"),
                        'type'     => "select",
                        'options'  => array('Question', 'AskAction'),
                        'required' => true
                    ),
                    'question_author'              => array(
                        'title'       => __('Questionnaire author', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-question-holder',
                        'desc'        => __('Name of the questionnaire', "wp-seo-structured-data-schema-pro")
                    ),
                    'question'                     => array(
                        'title'       => __('Question', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-question-holder',
                        'desc'        => __('Short Question', "wp-seo-structured-data-schema-pro")
                    ),
                    'question_text'                => array(
                        'title'       => __('Question description', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'textarea',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-question-holder',
                        'desc'        => __("The description of the question. New line is not supported.", "wp-seo-structured-data-schema-pro")
                    ),
                    'question_dateCreated'         => array(
                        'title'       => __('Question created date', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'required'    => true,
                        'class'       => 'kcseo-date',
                        'holderClass' => 'kcseo-faq-question-holder',
                        'desc'        => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'question_upvoteCount'         => array(
                        'title'       => __('Question up vote count', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'number',
                        'holderClass' => 'kcseo-faq-question-holder',
                    ),
                    'answerCount'                  => array(
                        'title'       => __('Answer count', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'number',
                        'holderClass' => 'kcseo-faq-question-holder',
                        'class'       => 'kcseo-question-a',
                    ),
                    'accepted_answer'              => array(
                        'title'       => __('Accepted answer', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'textarea',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-question-holder',
                        'desc'        => __('Accepted answer', "wp-seo-structured-data-schema-pro")
                    ),
                    'accepted_answer_dateCreated'  => array(
                        'title'       => __('Accepted answer created Date', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'required'    => true,
                        'class'       => 'kcseo-date',
                        'holderClass' => 'kcseo-faq-question-holder',
                        'desc'        => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'accepted_answer_upvoteCount'  => array(
                        'title'       => __('Accepted answer up vote count', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'number',
                        'holderClass' => 'kcseo-faq-question-holder',
                    ),
                    'accepted_answer_author'       => array(
                        'title'       => __('Accepted answerer author', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-question-holder',
                        'desc'        => __('Name of the answerer', "wp-seo-structured-data-schema-pro")
                    ),
                    'accepted_answer_url'          => array(
                        'title'       => __('Accepted answerer URL', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'url',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-question-holder'
                    ),
                    'suggested_answer'             => array(
                        'title'       => __('Suggested answer', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'textarea',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-question-holder',
                        'desc'        => __('Suggested Answer', "wp-seo-structured-data-schema-pro")
                    ),
                    'suggested_answer_dateCreated' => array(
                        'title'       => __('Suggested answer created Date', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'required'    => true,
                        'class'       => 'kcseo-date',
                        'holderClass' => 'kcseo-faq-question-holder',
                        'desc'        => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro")
                    ),
                    'suggested_answer_upvoteCount' => array(
                        'title'       => __('Suggested answer up vote count', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'number',
                        'holderClass' => 'kcseo-faq-question-holder',
                    ),
                    'suggested_answer_author'      => array(
                        'title'       => __('Suggested answerer author', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-question-holder',
                        'desc'        => __('Name of the answerer', "wp-seo-structured-data-schema-pro")
                    ),
                    'suggested_answer_url'         => array(
                        'title'       => __('Suggested answerer URL', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'url',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-question-holder'
                    ),
                    'agent'                        => array(
                        'title'       => __('Agent Author', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-ask-action-holder',
                        'desc'        => __('Name of the questionnaire', "wp-seo-structured-data-schema-pro")
                    ),
                    'recipient'                    => array(
                        'title'       => __('Recipient Author', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-ask-action-holder',
                        'desc'        => __('Name of the recipient', "wp-seo-structured-data-schema-pro")
                    ),
                    'ask_action_question'          => array(
                        'title'       => __('Question', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-ask-action-holder',
                        'desc'        => __('Question of the AskAction', "wp-seo-structured-data-schema-pro")
                    ),
                    'ask_action_answer'            => array(
                        'title'       => __('Answer', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'required'    => true,
                        'holderClass' => 'kcseo-faq-ask-action-holder kcseo-faq-ask-action-answer-holder',
                        'desc'        => __('Answer of the AskAction', "wp-seo-structured-data-schema-pro")
                    ),
                )
            ),
            'itemList'             => array(
                'title'  => __('Item List', "wp-seo-structured-data-schema-pro"),
                'fields' => array(
                    'active'        => array(
                        'type' => 'checkbox'
                    ),
                    'ItemListOrder' => array(
                        'title'    => __('Item List Order Type', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'select',
                        'required' => true,
                        'options'  => array(
                            'ItemListOrderAscending'  => 'Ascending',
                            'ItemListOrderDescending' => 'Descending',
                            'ItemListUnordered'       => 'Unordered'
                        ),
                    ),
                    'numberOfItems' => array(
                        'title' => __('Number Of Items', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'number',
                    ),
                    'url'           => array(
                        'title'    => __('URL', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'url',
                        'required' => true
                    ),
                    'name'          => array(
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'required' => true
                    ),
                    'description'   => array(
                        'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                        'type'  => 'textarea',
                        'desc'  => esc_html__('New line is not supported.', "wp-seo-structured-data-schema-pro")
                    ),
                    'list_items'    => array(
                        'title'     => __('List items', "wp-seo-structured-data-schema-pro"),
                        'type'      => 'group',
                        'duplicate' => true,
                        'fields'    => array(
                            'list_item_heading' => array(
                                'type'  => 'heading',
                                'title' => __('List Item', "wp-seo-structured-data-schema-pro")
                            ),
                            'name'              => array(
                                'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                                'type'     => 'text',
                                'required' => true
                            ),
                            'position'          => array(
                                'title'    => __('Position', "wp-seo-structured-data-schema-pro"),
                                'type'     => 'number',
                                'required' => true
                            ),
                            'url'               => array(
                                'title'    => __('URL', "wp-seo-structured-data-schema-pro"),
                                'type'     => 'url',
                                'required' => true,
                                'desc'     => __("Every list url should be different url at same domain <br> 1. http://example.com/post/tv , 2. http://example.com/post/radio", "wp-seo-structured-data-schema-pro")
                            ),
                            'image'             => array(
                                'title'    => __('Image', "wp-seo-structured-data-schema-pro"),
                                'type'     => 'image',
                                'required' => true,
                            ),
                            'description'       => array(
                                'title' => __('Description', "wp-seo-structured-data-schema-pro"),
                                'type'  => 'textarea',
                                'desc'  => esc_html__('New line is not supported.', "wp-seo-structured-data-schema-pro")
                            )
                        )
                    ),
                )
            ),
            'specialAnnouncement'  => [
                'title'  => __('Special Announcement', "wp-seo-structured-data-schema-pro"),
                'fields' => [
                    'active'        => [
                        'type' => 'checkbox'
                    ],
                    'name'          => [
                        'title'    => __('Name', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'desc'     => __('SpecialAnnouncement.name: Name of the announcement. This text should be present on the underlying page.', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ],
                    'url'           => [
                        'title'    => __('Page URL', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'url',
                        'desc'     => __('SpecialAnnouncement.url: URL of the page containing the announcements. If present, this must match the URL of the page containing the information.', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ],
                    'datePublished' => [
                        'title'    => __('Published date', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'text',
                        'class'    => 'kcseo-date',
                        'desc'     => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ],
                    'expires'       => [
                        'title'       => __('Expires date', "wp-seo-structured-data-schema-pro"),
                        'type'        => 'text',
                        'class'       => 'kcseo-date',
                        'desc'        => __('Like this: 2015-12-25 14:20:00', "wp-seo-structured-data-schema-pro"),
                        'recommended' => true,
                    ],
                    'text'          => [
                        'title'    => __('Text', "wp-seo-structured-data-schema-pro"),
                        'type'     => 'textarea',
                        'desc'     => __('SpecialAnnouncement.text: Text of the announcements.', "wp-seo-structured-data-schema-pro"),
                        'required' => true
                    ],
                    'locations'     => [
                        'title'     => __('Announcement Locations', "wp-seo-structured-data-schema-pro"),
                        'type'      => 'group',
                        'duplicate' => true,
                        'fields'    => [
                            'location_heading'  => [
                                'type'  => 'heading',
                                'title' => __('Announcement Location', "wp-seo-structured-data-schema-pro")
                            ],
                            'type'              => [
                                'title'    => __('Type', "wp-seo-structured-data-schema-pro"),
                                'type'     => 'select',
                                'options'  => self::announcementLocationTypes(),
                                'required' => true
                            ],
                            'name'              => [
                                'title'       => __('Name', "wp-seo-structured-data-schema-pro"),
                                'type'        => 'text',
                                'desc'        => __("SpecialAnnouncement.announcementLocation.name: ", "wp-seo-structured-data-schema-pro"),
                                'recommended' => true,
                            ],
                            'url'               => [
                                'title'       => __('URL', "wp-seo-structured-data-schema-pro"),
                                'type'        => 'url',
                                'recommended' => true,
                                'desc'        => __("SpecialAnnouncement.announcementLocation.url: URL", "wp-seo-structured-data-schema-pro")
                            ],
                            'address_street'    => [
                                'title'       => __('Address: Street', "wp-seo-structured-data-schema-pro"),
                                'type'        => 'text',
                                'desc'        => __('SpecialAnnouncement.announcementLocation.address.streetAddress: The street address. For example, 1600 Amphitheatre Pkwy.', "wp-seo-structured-data-schema-pro"),
                                'recommended' => true,
                            ],
                            'address_locality'  => [
                                'title'       => __('Address: Locality', "wp-seo-structured-data-schema-pro"),
                                'type'        => 'text',
                                'desc'        => __('SpecialAnnouncement.announcementLocation.address.addressLocality: The locality in which the street address is, and which is in the region. For example, Mountain View.', "wp-seo-structured-data-schema-pro"),
                                'recommended' => true,
                            ],
                            'address_post_code' => [
                                'title'       => __('Address: Post Code', "wp-seo-structured-data-schema-pro"),
                                'type'        => 'text',
                                'desc'        => __('SpecialAnnouncement.announcementLocation.address.postalCode: The postal code. For example, 94043.', "wp-seo-structured-data-schema-pro"),
                                'recommended' => true,
                            ],
                            'address_region'    => [
                                'title'       => __('Address: Region', "wp-seo-structured-data-schema-pro"),
                                'type'        => 'text',
                                'desc'        => __('SpecialAnnouncement.announcementLocation.address.addressRegion: The region in which the locality is, and which is in the country. For example, California.', "wp-seo-structured-data-schema-pro"),
                                'recommended' => true,
                            ],
                            'address_country'   => [
                                'title'       => __('Address: Country', "wp-seo-structured-data-schema-pro"),
                                'type'        => 'text',
                                'desc'        => __('SpecialAnnouncement.announcementLocation.address.addressCountry: The country. For example, USA. You can also provide the two-letter ISO 3166-1 alpha-2 country code.', "wp-seo-structured-data-schema-pro"),
                                'recommended' => true,
                            ],
                            'id'                => [
                                'title' => __('ID', "wp-seo-structured-data-schema-pro"),
                                'type'  => 'text',
                                'desc'  => __('SpecialAnnouncement.announcementLocation.@id: An optional unique identifier so that you can reference pre-existing structured data for this location.', "wp-seo-structured-data-schema-pro"),
                            ],
                            'image'             => array(
                                'title' => __('Image', "wp-seo-structured-data-schema-pro"),
                                'type'  => 'image'
                            ),
                            'priceRange'        => array(
                                'title'       => 'Price Range (Recommended)',
                                'type'        => 'text',
                                'recommended' => true,
                                'desc'        => __("The price range of the business, for example $$$.", "wp-seo-structured-data-schema-pro")
                            ),
                            'telephone'         => array(
                                'title'       => 'Telephone (Recommended)',
                                'type'        => 'text',
                                'recommended' => true
                            )
                        ]
                    ],
                ]
            ]
        );

        return apply_filters('kcseo_schema_types', $schemas);
    }

    static function getSiteTypes() {
        $siteTypes = array(
            'Organization',
            'LocalBusiness'  => array(
                'AnimalShelter',
                'AutomotiveBusiness'          => array(
                    'AutoBodyShop',
                    'AutoDealer',
                    'AutoPartsStore',
                    'AutoRental',
                    'AutoRepair',
                    'AutoWash',
                    'GasStation',
                    'MotorcycleDealer',
                    'MotorcycleRepair'
                ),
                'ChildCare',
                'DryCleaningOrLaundry',
                'EmergencyService',
                'EmploymentAgency',
                'EntertainmentBusiness'       => array(
                    'AdultEntertainment',
                    'AmusementPark',
                    'ArtGallery',
                    'Casino',
                    'ComedyClub',
                    'MovieTheater',
                    'NightClub',

                ),
                'FinancialService'            => array(
                    'AccountingService',
                    'AutomatedTeller',
                    'BankOrCreditUnion',
                    'InsuranceAgency',
                ),
                'FoodEstablishment'           => array(
                    'Bakery',
                    'BarOrPub',
                    'Brewery',
                    'CafeOrCoffeeShop',
                    'FastFoodRestaurant',
                    'IceCreamShop',
                    'Restaurant',
                    'Winery',
                ),
                'GovernmentOffice',
                'HealthAndBeautyBusiness'     => array(
                    'BeautySalon',
                    'DaySpa',
                    'HairSalon',
                    'HealthClub',
                    'NailSalon',
                    'TattooParlor',
                ),
                'HomeAndConstructionBusiness' => array(
                    'Electrician',
                    'GeneralContractor',
                    'HVACBusiness',
                    'HousePainter',
                    'Locksmith',
                    'MovingCompany',
                    'Plumber',
                    'RoofingContractor',
                ),
                'InternetCafe',
                'LegalService'                => array(
                    'Attorney',
                    'Notary',
                ),
                'Library',
                'MedicalBusiness'             => array(
                    'CommunityHealth',
                    'Dentist',
                    'Dermatology',
                    'DietNutrition',
                    'Emergency',
                    'Geriatric',
                    'Gynecologic',
                    'MedicalClinic',
                    'Midwifery',
                    'Nursing',
                    'Obstetric',
                    'Oncologic',
                    'Optician',
                    'Optometric',
                    'Otolaryngologic',
                    'Pediatric',
                    'Pharmacy',
                    'Physician',
                    'Physiotherapy',
                    'PlasticSurgery',
                    'Podiatric',
                    'PrimaryCare',
                    'Psychiatric',
                    'PublicHealth',
                ),
                'LodgingBusiness'             => array(
                    'BedAndBreakfast',
                    'Campground',
                    'Hostel',
                    'Hotel',
                    'Motel',
                    'Resort',
                ),
                'ProfessionalService',
                'RadioStation',
                'RealEstateAgent',
                'RecyclingCenter',
                'SelfStorage',
                'ShoppingCenter',
                'SportsActivityLocation'      => array(
                    'BowlingAlley',
                    'ExerciseGym',
                    'GolfCourse',
                    'HealthClub',
                    'PublicSwimmingPool',
                    'SkiResort',
                    'SportsClub',
                    'StadiumOrArena',
                    'TennisComplex',
                ),
                'Store'                       => array(
                    'AutoPartsStore',
                    'BikeStore',
                    'BookStore',
                    'ClothingStore',
                    'ComputerStore',
                    'ConvenienceStore',
                    'DepartmentStore',
                    'ElectronicsStore',
                    'Florist',
                    'FurnitureStore',
                    'GardenStore',
                    'GroceryStore',
                    'HardwareStore',
                    'HobbyShop',
                    'HomeGoodsStore',
                    'JewelryStore',
                    'LiquorStore',
                    'MensClothingStore',
                    'MobilePhoneStore',
                    'MovieRentalStore',
                    'MusicStore',
                    'OfficeEquipmentStore',
                    'OutletStore',
                    'PawnShop',
                    'PetStore',
                    'ShoeStore',
                    'SportingGoodsStore',
                    'TireShop',
                    'ToyStore',
                    'WholesaleStore'
                ),
                'TelevisionStation',
                'TouristInformationCenter',
                'TravelAgency',
                'TaxiService'
            ),
            'CivicStructure' => array(
                "Museum"
            )
        );

        return apply_filters('kcseo_site_types', $siteTypes);
    }

    static function getCountryList() {
        $countryList = array(
            "AF" => "Afghanistan",
            "AX" => "Aland Islands",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AQ" => "Antarctica",
            "AG" => "Antigua and Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "BT" => "Bhutan",
            "BO" => "Bolivia, Plurinational State of",
            "BQ" => "Bonaire, Sint Eustatius and Saba",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BV" => "Bouvet Island",
            "BR" => "Brazil",
            "IO" => "British Indian Ocean Territory",
            "BN" => "Brunei Darussalam",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CV" => "Cape Verde",
            "KY" => "Cayman Islands",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos (Keeling) Islands",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo",
            "CD" => "Congo, the Democratic Republic of the",
            "CK" => "Cook Islands",
            "CR" => "Costa Rica",
            "CI" => "Côte d Ivoire",
            "HR" => "Croatia",
            "CU" => "Cuba",
            "CW" => "Curaçao",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands (Malvinas)",
            "FO" => "Faroe Islands",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GG" => "Guernsey",
            "GN" => "Guinea",
            "GW" => "Guinea-Bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard Island and McDonald Islands",
            "VA" => "Holy See (Vatican City State)",
            "HN" => "Honduras",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran, Islamic Republic of",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IM" => "Isle of Man",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JE" => "Jersey",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KP" => "Korea, Democratic People's Republic of",
            "KR" => "Korea, Republic of,",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Lao Peoples Democratic Republic",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macao",
            "MK" => "Macedonia, the former Yugoslav Republic of",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "MX" => "Mexico",
            "FM" => "Micronesia, Federated States of",
            "MD" => "Moldova, Republic of",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "ME" => "Montenegro",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            "MM" => "Myanmar",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "MP" => "Northern Mariana Islands",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS" => "Palestine, State of",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PN" => "Pitcairn",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RE" => "Reunion",
            "RO" => "Romania",
            "RU" => "Russian Federation",
            "RW" => "Rwanda",
            "BL" => "Saint Barthélemy",
            "SH" => "Saint Helena, Ascension and Tristan da Cunha",
            "KN" => "Saint Kitts and Nevis",
            "LC" => "Saint Lucia",
            "MF" => "Saint Martin (French part)",
            "PM" => "Saint Pierre and Miquelon",
            "VC" => "Saint Vincent and the Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "Sao Tome and Principe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "RS" => "Serbia",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SX" => "Sint Maarten (Dutch part)",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia and the South Sandwich Islands",
            "SS" => "South Sudan",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SD" => "Sudan",
            "SR" => "Suriname",
            "SJ" => "Svalbard and Jan Mayen",
            "SZ" => "Swaziland",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "SY" => "Syrian Arab Republic",
            "TW" => "Taiwan, Province of China",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania, United Republic of",
            "TH" => "Thailand",
            "TL" => "Timor-Leste",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad and Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks and Caicos Islands",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "AE" => "United Arab Emirates",
            "GB" => "United Kingdom",
            "US" => "United States",
            "UM" => "United States Minor Outlying Islands",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VE" => "Venezuela, Bolivarian Republic of",
            "VN" => "Viet Nam",
            "VG" => "Virgin Islands, British",
            "VI" => "Virgin Islands, U.S.",
            "WF" => "Wallis and Futuna",
            "EH" => "Western Sahara",
            "YE" => "Yemen",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe",
        );

        return apply_filters('kcseo_country_list', $countryList);
    }

    static function getContactTypes() {
        $contact_types = array(
            "customer service",
            "customer support",
            "technical support",
            "billing support",
            "bill payment",
            "sales",
            "reservations",
            "credit card support",
            "emergency",
            "baggage tracking",
            "roadside assistance",
            "package tracking"
        );

        return apply_filters('kcseo_contact_types', $contact_types);
    }

    static function getLanguageList() {
        $language_list = array(
            "Akan",
            "Amharic",
            "Arabic",
            "Assamese",
            "Awadhi",
            "Azerbaijani",
            "Balochi",
            "Belarusian",
            "Bengali",
            "Bhojpuri",
            "Burmese",
            "Cantonese",
            "Cebuano",
            "Chewa",
            "Chhattisgarhi",
            "Chittagonian",
            "Czech",
            "Deccan",
            "Dhundhari",
            "Dutch",
            "English",
            "French",
            "Fula",
            "Gan",
            "German",
            "Greek",
            "Gujarati",
            "Haitian Creole",
            "Hakka",
            "Haryanvi",
            "Hausa",
            "Hiligaynon",
            "Hindi / Urdu",
            "Hmong",
            "Hungarian",
            "Igbo",
            "Ilokano",
            "Italian",
            "Japanese",
            "Javanese",
            "Jin",
            "Kannada",
            "Kazakh",
            "Khmer",
            "Kinyarwanda",
            "Kirundi",
            "Konkani",
            "Korean",
            "Kurdish",
            "Madurese",
            "Magahi",
            "Maithili",
            "Malagasy",
            "Malay/Indonesian",
            "Malayalam",
            "Mandarin",
            "Marathi",
            "Marwari",
            "Min Bei",
            "Min Dong",
            "Min Nan",
            "Mossi",
            "Nepali",
            "Oriya",
            "Oromo",
            "Pashto",
            "Persian",
            "Polish",
            "Portuguese",
            "Punjabi",
            "Quechua",
            "Romanian",
            "Russian",
            "Saraiki",
            "Serbo-Croatian",
            "Shona",
            "Sindhi",
            "Sinhalese",
            "Somali",
            "Spanish",
            "Sundanese",
            "Swahili",
            "Swedish",
            "Sylheti",
            "Tagalog",
            "Tamil",
            "Telugu",
            "Thai",
            "Turkish",
            "Ukrainian",
            "Uyghur",
            "Uzbek",
            "Vietnamese",
            "Wu",
            "Xhosa",
            "Xiang",
            "Yoruba",
            "Zulu",
        );

        return apply_filters('kcseo_language_list', $language_list);
    }

    static function getSocialList() {
        $socialList = array(
            'facebook'    => __('Facebook', "wp-seo-structured-data-schema-pro"),
            'twitter'     => __('Twitter', "wp-seo-structured-data-schema-pro"),
            'google-plus' => __('Google+', "wp-seo-structured-data-schema-pro"),
            'instagram'   => __('Instagram', "wp-seo-structured-data-schema-pro"),
            'youtube'     => __('Youtube', "wp-seo-structured-data-schema-pro"),
            'linkedin'    => __('LinkedIn', "wp-seo-structured-data-schema-pro"),
            'myspace'     => __('Myspace', "wp-seo-structured-data-schema-pro"),
            'pinterest'   => __('Pinterest', "wp-seo-structured-data-schema-pro"),
            'soundcloud'  => __('SoundCloud', "wp-seo-structured-data-schema-pro"),
            'tumblr'      => __('Tumblr', "wp-seo-structured-data-schema-pro"),
            'wikidata'    => __('Wikidata', "wp-seo-structured-data-schema-pro"),
        );

        return apply_filters('kcseo_social_list', $socialList);
    }

    static function getApplicationCategoryList() {

        $list = array(
            "GameApplication",
            "SocialNetworkingApplication",
            "TravelApplication",
            "ShoppingApplication",
            "SportsApplication",
            "LifestyleApplication",
            "BusinessApplication",
            "DesignApplication",
            "DeveloperApplication",
            "DriverApplication",
            "EducationalApplication",
            "HealthApplication",
            "FinanceApplication",
            "SecurityApplication",
            "BrowserApplication",
            "CommunicationApplication",
            "DesktopEnhancementApplication",
            "EntertainmentApplication",
            "MultimediaApplication",
            "HomeApplication",
            "UtilitiesApplication",
            "ReferenceApplication",
        );
        return apply_filters('kcseo_application_category_list', $list);
    }

    static function announcementLocationTypes() {
        return apply_filters('kcseo_announcement_location_types', [
            'Airport',
            'Aquarium',
            'Beach',
            'Bridge',
            'BuddhistTemple',
            'BusStation',
            'BusStop',
            'Campground',
            'CatholicChurch',
            'Cemetery',
            'Church',
            'CivicStructure',
            'CityHall',
            'CollegeOrUniversity',
            'Courthouse',
            'CovidTestingFacility',
            'Crematorium',
            'DefenceEstablishment',
            'EducationalOrganization',
            'ElementarySchool',
            'Embassy',
            'EventVenue',
            'FireStation',
            'GovernmentBuilding',
            'HighSchool',
            'HinduTemple',
            'Hospital',
            'LegislativeBuilding',
            'MiddleSchool',
            'Mosque',
            'MovieTheater',
            'Museum',
            'MusicVenue',
            'Park',
            'ParkingFacility',
            'PerformingArtsTheater',
            'PlaceOfWorship',
            'Playground',
            'PoliceStation',
            'Preschool',
            'RVPark',
            'School',
            'StadiumOrArena',
            'SubwayStation',
            'Synagogue',
            'TaxiStand',
            'TrainStation',
            'Zoo',
        ]);
    }

    static function getReviewNotice() {
        $html = null;
        $html = '<span>As of September, Google made a major change to review snippet schema and structure data markup. Google no longer support "self-serving" independent markup tied to the general types and has narrow support to specific types.</span><br><br>
<span>You can read more about Google\'s change here:<br><a target="_blank" href="https://webmasters.googleblog.com/2019/09/making-review-rich-results-more-helpful.html">https://webmasters.googleblog.com/2019/09/making-review-rich-results-more-helpful.html</a></span><br><br>
<span style="font-weight: bold">If you are a user of our plugin prior to September 2019, you need to remove the review schema for this tab on all pages and  post where you\'ve it for reviews and add back to the supported types (such as: book, course, event, movie, product, recipe, etc):</span><br><br>
<span style="display: block;margin: 0 auto;max-width: 800px;">1. Simple uncheck the "enable" tab in this section<br>
2. Update the page or post to remove the review schema.<br>
3. Then re-add new review schema within the appropriet type tab(i.e. book, course, event, movie, product, recipe, etc)</span>
<br>To review Google\'s documentation on <a target="_blank" href="https://developers.google.com/search/docs/data-types/review-snippet">https://developers.google.com/search/docs/data-types/review-snippet</a>';

        return $html;
    }

}