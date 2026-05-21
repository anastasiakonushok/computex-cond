<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package computex-cond
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1N1Z6F7HRV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1N1Z6F7HRV');
</script>
	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(99037394, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/99037394" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "LocalBusiness",
      "@id": "https://klimat.computex.by/contact",
      "name": "Computex Климат",
      "image": "https://klimat.computex.by/wp-content/uploads/2024/08/logo-computex.svg",
      "url": "https://klimat.computex.by/",
      "telephone": "+375 29 984-27-37",
      "email": "computex2013@mail.ru",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "ул. Кирова, 35",
        "addressLocality": "Гомель",
        "addressRegion": "Гомельская область",
        "postalCode": "246017",
        "addressCountry": "BY"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 52.4328897,
        "longitude": 31.0022577
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
          "opens": "09:00",
          "closes": "18:00"
        }
      ],
      "sameAs": [
        "https://www.instagram.com/klimat.computex.by/"
      ],
      "foundingDate": "2003",
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "reviewCount": "76"
      }
    },
    {
      "@type": "WebPage",
      "@id": "<?php echo get_permalink(); ?>#webpage",
      "url": "<?php echo get_permalink(); ?>",
      "name": "<?php echo wp_title('|', false, 'right'); ?>",
      "inLanguage": "ru-RU",
      "about": {
        "@id": "https://klimat.computex.by/#localbusiness"
      }
    }
  ]
}
</script>


<!-- /Yandex.Metrika counter -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=4db04c29-57a4-4ebd-af68-af6643fe7e68&amp;lang=ru_RU"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&amp;display=swap"
        rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header-main">
        <div class="header-top">
            <div class="container flex header-top__container">
                <?php
                $image = get_field('logotip', 'option');
                if ($image) {
                    echo '<a class="header-top__logo" href="' . esc_url(home_url()) . '"><img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '"></a>';
                }
                ?>

                <?php
                $adres = get_field('adres', 'option');

                if ($adres) {
                    $url = esc_url($adres['url']);
                    $title = esc_html($adres['title']);
                    $target = !empty($adres['target']) ? esc_attr($adres['target']) : '_self';
                    echo '<a class="flex header-top__info header-top__info--location" href="' . $url . '" target="' . $target . '">';
                    echo '<span class="icon flex">
              <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6C9.79086 6 8 7.79086 8 10C8 12.2091 9.79086 14 12 14C14.2091 14 16 12.2091 16 10C16 7.79086 14.2091 6 12 6ZM12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8Z" fill="currentColor"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0901 22.5958C11.2059 22.6753 11.2981 22.7366 11.3626 22.7788L11.4687 22.8472C11.7933 23.0504 12.2061 23.0508 12.5307 22.8476L12.6375 22.7788C12.7019 22.7366 12.7941 22.6753 12.9099 22.5958C13.1415 22.4367 13.4685 22.2041 13.8591 21.9041C14.6386 21.3054 15.6801 20.4322 16.7247 19.3336C18.7857 17.1661 21 13.9725 21 10.1818C21 7.75381 20.0571 5.42084 18.3719 3.69728C16.6859 1.97296 14.3943 1 12 1C9.60571 1 7.31415 1.97296 5.62814 3.69728C3.94288 5.42084 3 7.75381 3 10.1818C3 13.9725 5.21434 17.1661 7.27531 19.3336C8.31993 20.4322 9.36136 21.3054 10.1409 21.9041C10.5315 22.2041 10.8585 22.4367 11.0901 22.5958ZM12 3C10.1508 3 8.37273 3.75107 7.05815 5.09552C5.74283 6.44073 5 8.26992 5 10.1818C5 13.2007 6.78566 15.9162 8.72469 17.9554C9.68007 18.9602 10.6386 19.7646 11.3591 20.3179C11.6046 20.5065 11.8215 20.6651 12 20.7918C12.1785 20.6651 12.3954 20.5065 12.6409 20.3179C13.3614 19.7646 14.3199 18.9602 15.2753 17.9554C17.2143 15.9162 19 13.2007 19 10.1818C19 8.26992 18.2572 6.44073 16.9418 5.09552C15.6273 3.75107 13.8492 3 12 3Z" fill="currentColor"/>
            </svg>
          </span>';
                    echo '<span class="text">' . $title . '</span>';
                    echo '</a>';
                }
                ?>
                <div class="header-top__info header-top__info--phone flex"> <span class="icon flex">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.40894 3.94109C7.73727 3.44596 7.28496 3.33417 7.04226 3.38154C6.04101 3.57694 5.44749 3.96671 4.64337 4.77082C3.54575 5.86842 3.01318 6.68799 3.24513 7.93061C3.51219 9.36128 4.81689 11.5448 8.41291 15.1409C12.0087 18.7366 14.2054 20.0551 15.6441 20.3277C16.3108 20.4541 16.8185 20.3553 17.2741 20.1309C17.7612 19.891 18.2302 19.4872 18.7681 18.9258C19.2452 18.4279 19.5347 18.0804 19.7373 17.7385C19.9303 17.4128 20.0671 17.0527 20.1728 16.5118C20.2202 16.2691 20.1084 15.8168 19.6132 15.145C19.1513 14.5185 18.4997 13.8963 17.8973 13.3884C17.4998 13.0532 16.8848 13.0318 16.388 13.4037L14.8697 14.5404C13.5001 15.5656 11.5864 15.4188 10.3781 14.2104L9.34333 13.1757C8.13502 11.9674 7.98816 10.0537 9.0134 8.68411L10.15 7.16583C10.5219 6.66902 10.5005 6.05402 10.1653 5.65651C9.65746 5.05425 9.03533 4.40283 8.40894 3.94109ZM9.59567 2.33122C10.4051 2.9279 11.1441 3.71478 11.6943 4.3672C12.6971 5.55642 12.6153 7.20992 11.7511 8.3644L10.6145 9.88268C10.191 10.4483 10.2458 11.2497 10.7575 11.7615L11.7923 12.7962C12.3041 13.308 13.1054 13.3627 13.6711 12.9393L15.1894 11.8027C16.3439 10.9385 17.9973 10.8566 19.1865 11.8593C19.8391 12.4095 20.6262 13.1486 21.223 13.9582C21.7864 14.7225 22.3533 15.7809 22.1357 16.8953C21.9959 17.6108 21.7906 18.1965 21.4579 18.758C21.1348 19.3034 20.715 19.7848 20.2122 20.3095C19.6296 20.9176 18.9653 21.5274 18.1578 21.9251C17.3189 22.3383 16.3708 22.5011 15.2716 22.2928C13.1786 21.8961 10.6038 20.1601 6.99869 16.5551C3.39388 12.9502 1.66901 10.3864 1.27909 8.2976C0.854079 6.02071 2.03716 4.54859 3.22916 3.3566C4.21375 2.37202 5.14736 1.71361 6.65918 1.41857C7.7733 1.20114 8.83152 1.76792 9.59567 2.33122Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <?php
                    $telefon = get_field('telefon', 'option');

                    if ($telefon) {
                        echo '<a href="tel:' . esc_attr($telefon) . '">' . esc_html($telefon) . '</a>';
                    }

           
                    ?>
                </div>
                <div class="header-top__info header-top__info--time flex"><span class="icon flex">
                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.8284 6.75736C12.3807 6.75736 12.8284 7.20507 12.8284 7.75736V12.7245L16.3553 14.0653C16.8716 14.2615 17.131 14.8391 16.9347 15.3553C16.7385 15.8716 16.1609 16.131 15.6447 15.9347L11.4731 14.349C11.085 14.2014 10.8284 13.8294 10.8284 13.4142V7.75736C10.8284 7.20507 11.2761 6.75736 11.8284 6.75736Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <?php
                    $work_hours = get_field('raspisanie_raboty', 'option'); // Предположим, что поле называется 'work_hours'
                    
                    if ($work_hours) {
                        echo '<span class="text">' . wp_kses_post($work_hours) . '</span>';
                    }
                    ?>
                </div>
                <div class="burger-menu" id="nav-toggle"> <span> </span><span> </span><span> </span></div>
            </div>
        </div>
        <div class=" header-bottom">
            <div class="container header-bottom__container flex">
                <nav class="nav header-bottom__nav">
                    <?php
                    wp_nav_menu(
                        array(
                            'menu' => 'Главное меню',
                            'container' => '',
                            'theme_location' => 'Primary',
                            'items_wrap' => '<ul class= "nav__list flex">%3$s</ul>',
                        )
                    );
                    ?>
                </nav>
            </div>
        </div>
    </header>