<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandSetting extends Model
{
    protected $fillable = [
        'title', 
        'logo', 
        'favicon', 
        'banner_image', 
        'theme_colour', 
        'our_story', 
        'social_links', 
        'phone', 
        'email'
    ];

    public function getBrandSetting()
    {
        $App_URL_MEDIA = env('App_Media_URL');
        $brandSetting = $this->first();
        $brandSetting->banner_image =  $App_URL_MEDIA . $brandSetting->banner_image;
        $brandSetting->logo =  $App_URL_MEDIA . $brandSetting->logo;
        $brandSetting->favicon =  $App_URL_MEDIA . $brandSetting->favicon;
        $themeColour = str_replace(" ", "", $brandSetting->theme_colour);
        $themeColour = explode(",", $themeColour);

        $arrThemeColour = array(
            'main_colour'   => $themeColour[0],
            'sub_colour'    => $themeColour[1]
        );

        $brandSetting->theme_colour = $arrThemeColour;
        $socialLinks = str_replace(" ", "", $brandSetting->social_links);
        $socialLinks = explode(",", $socialLinks);
        
        for ($i = 0; $i < count($socialLinks); $i++) {
            
            $faceBook = strpos($socialLinks[$i], "https://www.facebook.com/");
            if ($faceBook !== false) {
                $arrSocialLinks['facebook'] = $socialLinks[$i];
            }

            $twitter = strstr($socialLinks[$i], "https://www.twitter.com/");
            if ($twitter !== false) {
                $arrSocialLinks['twitter'] = $socialLinks[$i];
            }

            $instagram = strstr($socialLinks[$i], "https://www.instagram.com/");
            if ($instagram !== false) {
                $arrSocialLinks['instagram'] = $socialLinks[$i];
            }

            $google = strstr($socialLinks[$i], "https://mail.google.com/");
            if ($google !== false) {
                $arrSocialLinks['google'] = $socialLinks[$i];
            }

            $linkedin = strstr($socialLinks[$i], "https://www.linkedin.com/");
            if ($linkedin !== false) {
                $arrSocialLinks['linkedin'] = $socialLinks[$i];
            }
        }

        $brandSetting->social_links = $arrSocialLinks;
        
        return $brandSetting;
    }
}
