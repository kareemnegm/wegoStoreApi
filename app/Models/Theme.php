<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;
    protected $fillable = [
        'favicon',
        'main_color',
        'secondary_color',
        'font',
        //header
        'top_bar_background_color',
        'header_background_color',
        'main_menu_color',
        'top_bar_text_color',
        'header_text_color',
        'menu_text_color',
        'header_logo',
        'header_logo_height',
        'show_top_bar',
        'top_bar_right_icon',
        //top bar toggle keys on and of
        'show_top_bar',
        'show_language_switcher',
        'show_currency_switcher',
        'enable_search_bar',
        //footer
        'footer_background_color',
        'bottom_footer_background_color',
        'footer_main_color',
        'bottom_footer_text_color',
        'footer_logo',
        'news_letter_title',
        'news_letter_paragraph',
        'copyrights_text',
        //footer toggle keys on and of
        'enable_links_to_legal_pages',
        'enable_news_letter_form',
        'enable_contact_info',
        'enable_footer_links',
        'enable_social_icons',
        //home page

    ];
}
