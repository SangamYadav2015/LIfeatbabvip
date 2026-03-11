<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'section_id',
        'section_style_id',
        'page_section_data',
        'status',
    ];


    public static function validateRules($id = null)
    {
        $rules = [
            'page_id' => 'required|exists:page,id',
            'section_id' => 'required|integer|exists:section,id',
            'section_style_id' => 'required|integer|exists:section_styles,id',
            'page_section_data' => 'nullable|array',
            'status' => 'required',
        ];
        return $rules;
    }

    public static function validateMessages()
    {
        return [
            'page_id.required' => 'The Page Id required.',
            'section_id.required' => 'The section required.',
            'section_style_id.required' => 'Section Style is required.',
            'status.required' => 'The Status is required.',

        ];
    }

    //herostyle1 validationrules//
    public static function validateHeroStyle1($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1920,height=380';
        }
        return $rules;
    }
    public static function validateHeroStyle2($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'trusted_title' => 'required',
            'banner_description' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=744,height=717';
        }
        return $rules;
    }

    public static function validateHeroStyle3($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'banner_description' => 'required',
            'button_text1' => 'required',
            'button_url1' => 'required',
            'button_text2' => 'required',
            'button_url2' => 'required',
            'review_title' => 'required|array',
            'review_title.*' => 'required',
            'link_text' => 'required|array',
            'link_text.*' => 'required',
            'link_url' => 'required|array',
            'link_url.*' => 'required',
            'review_description' => 'required|array',
            'review_description.*' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1892,height=591';
            $rules['banner_image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=220,height=261';
            $rules['banner_image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1280,height=965';
            $rules['banner_image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=280,height=376';
            $rules['review_image'] = 'required';
            $rules['review_image.*'] = 'required';
        }
        return $rules;
    }


    public static function validateHeroStyle4($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'banner_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=433,height=871';
            $rules['banner_image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1234,height=720';
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1340,height=250';
        }
        return $rules;
    }


    public static function validateHeroStyle5($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'banner_description' => 'required',
            'button_text1' => 'required',
            'button_url1' => 'required',
            'button_text2' => 'required',
            'button_url2' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=620,height=646';
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=876,height=690';
        }
        return $rules;
    }

    public static function validateHeroStyle6($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'banner_subtitle' => 'required',
            'button_text1' => 'required',
            'button_url1' => 'required',
            'button_text2' => 'required',
            'button_url2' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=573,height=339';
            $rules['banner_image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=670,height=476';
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1440,height=376';
        }
        return $rules;
    }

    public static function validateHeroStyle7($id = null)
    {
        return [
            'banner_title' => 'required',
            'trusted_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=433,height=871';
            $rules['banner_image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1234,height=720';
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1340,height=250';
        }
        return $rules;
    }

    public static function validateHeroStyle8($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'trusted_title' => 'required',
            'banner_description' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1058,height=982';
        }
        return $rules;
    }


    public static function validateHeroStyle9($id = null)
    {
        $rules = [
            'title' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=2628,height=690';
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=753,height=507';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
        }
        return $rules;
    }

    public static function validateHeroStyle10($id = null)
    {
        $rules = [
            'title' => 'required',
            'icon_1_url' => 'required',
            'icon_2_url' => 'required',
            'icon_3_url' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1920,height=450';
        }
        return $rules;
    }


    public static function validateHeroStyle11($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];


        return $rules;
    }

    public static function validateHeroStyle12($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'sub_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1920,height=690';
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=305,height=615';
        }


        return $rules;
    }
    public static function validateHeroStyle13($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1920,height=1080';
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=649,height=649';
        }


        return $rules;
    }

    public static function validateHeroStyle14($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1920,height=906';
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=636,height=428';
        }


        return $rules;
    }

    public static function validateHeroStyle15($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=796,height=757';
        }


        return $rules;
    }

    public static function validateHeroStyle16($id = null)
    {


        $rules['title'] = 'required|array';
        $rules['title.*'] = 'required';
        $rules['highlighted_title'] = 'required|array';
        $rules['highlighted_title.*'] = 'required';
        $rules['description'] = 'required|array';
        $rules['description.*'] = 'required';
        if (is_null($id) || $id === '') {
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    public static function validateHeroStyle17($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'highlighted_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1920,height=858';
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=722,height=754';
            $rules['banner_image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=264,height=116';
        }


        return $rules;
    }

    public static function validateHeroStyle18($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'sub_title' => 'required',
            'highlighted_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=510,height=545';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=265,height=270';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=451,height=389';
            $rules['image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=82,height=82';
            $rules['image4'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=441,height=291';
        }


        return $rules;
    }


    public static function validateHeroStyle19($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'sub_title' => 'required',
            'highlighted_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=584,height=584';
        }


        return $rules;
    }

    public static function validateHeroStyle20($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'highlighted_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=506,height=512';
        }


        return $rules;
    }

    public static function validateHeroStyle21($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'highlighted_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1230,height=804';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=423,height=433';
        }


        return $rules;
    }

    public static function validateHeroStyle22($id = null)
    {
        $rules = [
            'banner_title1' => 'required',
            'banner_title2' => 'required',
            'banner_title3' => 'required',
            'sub_title' => 'required',
            'subscription_title' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=968,height=1037';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=436,height=244';
        }


        return $rules;
    }


    public static function validateHeroStyle23($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'highlighted_title' => 'required',
            'subscription_title' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=511,height=465';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=725,height=507';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=115,height=109';
        }


        return $rules;
    }

    public static function validateHeroStyle24($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'sub_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1073,height=897 ';
        }


        return $rules;
    }

    public static function validateHeroStyle25($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=448,height=573';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=154,height=50';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=80,height=105';
        }


        return $rules;
    }
    public static function validateHeroStyle26($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'highlighted_title' => 'required',
            'banner_description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=832,height=492';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=152,height=70';
        }


        return $rules;
    }

    public static function validateHeroStyle27($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'sub_title' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1096,height=593';
        }

        return $rules;
    }

    public static function validateHeroStyle28($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'bottom_title' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=745,height=620';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=450,height=381';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=401,height=336';
            $rules['image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=231,height=231';
            $rules['image4'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=260,height=260';
            $rules['image5'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=154,height=50';
        }

        return $rules;
    }


    public static function validateHeroStyle29($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'highlighted_title' => 'required',
            'banner_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=717,height=502';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=354,height=374';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_sub_title'] = 'required|array';
            $rules['step_sub_title.*'] = 'required';
        }

        return $rules;
    }

    public static function validateHeroStyle30($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'banner_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1332,height=702';
            $rules['step_image_alt_tag'] = 'required|array';
            $rules['step_image_alt_tag.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }

        return $rules;
    }

    public static function validateHeroStyle31($id = null)
    {
        $rules = [
            'banner_title1' => 'required',
            'banner_title2' => 'required',
            'banner_title3' => 'required',
            'banner_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=554,height=656';
            $rules['step_image_alt_tag'] = 'required|array';
            $rules['step_image_alt_tag.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }

        return $rules;
    }

    public static function validateHeroStyle32($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'sub_title' => 'required',
            'banner_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=619,height=672';
            $rules['step_image_alt_tag'] = 'required|array';
            $rules['step_image_alt_tag.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }

        return $rules;
    }

    public static function validateHeroStyle33($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'highlighted_title' => 'required',
            'banner_description' => 'required',
            'step_title' => 'required',
            'step_sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1920,height=1133';
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1320,height=607';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=112,height=112';
        }

        return $rules;
    }

    public static function validateHeroStyle34($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'highlighted_title' => 'required',
            'banner_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1920,height=1150';
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1231,height=734';
        }

        return $rules;
    }

    public static function validateHeroStyle35($id = null)
    {
        $rules = [
            'banner_title' => 'required',
            'highlighted_title' => 'required',
            'bottom_title' => 'required',
            'bottom_highlighted_title' => 'required',
            'banner_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image_alt_tag'] = 'required|array';
            $rules['step_image_alt_tag.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }

        return $rules;
    }

    public static function validateHeroStyle36($id = null)
    {
        $rules = [
            'banner_title1' => 'required',
            'banner_title2' => 'required',
            'bottom_title' => 'required',
            'bottom_highlighted_title' => 'required',
            'crousal_title' => 'required',
            'crousal_highlighted_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=639,height=804';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=138,height=138';

            $rules['step_image_alt_tag'] = 'required|array';
            $rules['step_image_alt_tag.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }

        return $rules;
    }

    public static function validateHeroStyle37($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=294,height=313';
        }

        return $rules;
    }

    public static function validateHeroStyle38($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'step1_title' => 'required',
            'step1_sub_title' => 'required',
            'step2_title' => 'required',
            'step2_sub_title' => 'required',
            'step3_title' => 'required',
            'step3_sub_title' => 'required',

        ];
        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1917,height=578';
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=719,height=540';
        }

        return $rules;
    }


    public static function validateHeroStyle39($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',


        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=478,height=665';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=134,height=133';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=148,height=161';
            $rules['image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=336,height=89';
            $rules['image4'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=73,height=56';
        }

        return $rules;
    }


    public static function validateHeroStyle40($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'title1' => 'required',
            'highlighted_title' => 'required',
            'description' => 'required',
            'button1_text' => 'required',
            'button1_url' => 'required',
            'button2_text' => 'required',
            'button2_url' => 'required',



        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=537,height=537';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=341,height=341';
        }

        return $rules;
    }

    public static function validatetestimoniStyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['client_image'] = 'required|array';
            $rules['client_image.*'] = 'required';
            $rules['client_name'] = 'required|array';
            $rules['client_name.*'] = 'required';
            $rules['designation'] = 'required|array';
            $rules['designation.*'] = 'required';
            $rules['review_title'] = 'required|array';
            $rules['review_title.*'] = 'required';
            $rules['review_description'] = 'required|array';
            $rules['review_description.*'] = 'required';
        }

        return $rules;
    }
    public static function validatetestimoniStyle2($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['client_image'] = 'required|array';
            $rules['client_image.*'] = 'required';
            $rules['client_name'] = 'required|array';
            $rules['client_name.*'] = 'required';
            $rules['designation'] = 'required|array';
            $rules['designation.*'] = 'required';
            $rules['review_title'] = 'required|array';
            $rules['review_title.*'] = 'required';
            $rules['review_description'] = 'required|array';
            $rules['review_description.*'] = 'required';
            $rules['video_link'] = 'required|array';
            $rules['video_link.*'] = 'required';
        }

        return $rules;
    }
    public static function validatetestimoniStyle3($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['client_image'] = 'required|array';
            $rules['client_image.*'] = 'required';
            $rules['client_name'] = 'required|array';
            $rules['client_name.*'] = 'required';
            $rules['designation'] = 'required|array';
            $rules['designation.*'] = 'required';
            $rules['review_title'] = 'required|array';
            $rules['review_title.*'] = 'required';
            $rules['review_description'] = 'required|array';
            $rules['review_description.*'] = 'required';
        }

        return $rules;
    }

    public static function validatetestimoniStyle4($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['client_image'] = 'required|array';
            $rules['client_image.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
            $rules['client_name'] = 'required|array';
            $rules['client_name.*'] = 'required';
            $rules['designation'] = 'required|array';
            $rules['designation.*'] = 'required';
            $rules['review_description'] = 'required|array';
            $rules['review_description.*'] = 'required';
        }

        return $rules;
    }

    public static function validatetestimoniStyle5($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'description' => 'required',

        ];
        if (is_null($id) || $id === '') {
            $rules['client_image'] = 'required|array';
            $rules['client_image.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
            $rules['client_name'] = 'required|array';
            $rules['client_name.*'] = 'required';
            $rules['review_description'] = 'required|array';
            $rules['review_description.*'] = 'required';
        }

        return $rules;
    }


    public static function validatetestimoniStyle6($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',

        ];
        if (is_null($id) || $id === '') {
            $rules['client_image'] = 'required|array';
            $rules['client_image.*'] = 'required';
            $rules['client_name'] = 'required|array';
            $rules['client_name.*'] = 'required';
            $rules['review_description'] = 'required|array';
            $rules['review_description.*'] = 'required';
        }

        return $rules;
    }

    public static function validatetestimoniStyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];

        if (is_null($id) || $id === '') {
            $rules['client_image'] = 'required|array';
            $rules['client_image.*'] = 'required';
            $rules['client_name'] = 'required|array';
            $rules['client_name.*'] = 'required';
            $rules['designation'] = 'required|array';
            $rules['designation.*'] = 'required';
            $rules['review_title'] = 'required|array';
            $rules['review_title.*'] = 'required';
            $rules['review_description'] = 'required|array';
            $rules['review_description.*'] = 'required';
        }

        return $rules;
    }

    public static function validatetestimoniStyle9($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['client_image'] = 'required|array';
            $rules['client_image.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
            $rules['client_name'] = 'required|array';
            $rules['client_name.*'] = 'required';
            $rules['review_description'] = 'required|array';
            $rules['review_description.*'] = 'required';
        }

        return $rules;
    }

    public static function validatecalltoactionStyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'button_text1' => 'required',
            'button_url1' => 'required',
            'button_text2' => 'required',
            'button_url2' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1280,height=965';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
        }

        return $rules;
    }

    public static function validatecalltoactionStyle2($id = null)
    {
        $rules = [
            'title' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }

        return $rules;
    }


    public static function validatecalltoactionStyle3($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1280,height=965';
        }

        return $rules;
    }

    public static function validatecalltoactionStyle4($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
        }
        return $rules;
    }

    public static function validatecalltoactionStyle5($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
        }
        return $rules;
    }

    public static function validatecalltoactionStyle6($id = null)
    {
        $rules = [
            'video_url' => 'required',

        ];
        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=950,height=633';
        }
        return $rules;
    }

    public static function validatecalltoactionStyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'button_url' => 'required',
            'button_text' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=516,height=350';
        }

        return $rules;
    }

    public static function validatecalltoactionStyle8($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'button_url' => 'required',
            'button_text' => 'required',
        ];
        return $rules;
    }

    public static function validatecalltoactionStyle9($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'sub_title' => 'required',
            'button_url' => 'required',
            'button_text' => 'required',
        ];
        return $rules;
    }

    public static function validatetabStyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['tab_title'] = 'required|array';
            $rules['tab_title.*'] = 'required';
            $rules['tab_image'] = 'required|array';
            $rules['tab_image.*'] = 'required';
            $rules['button_text'] = 'required|array';
            $rules['button_text.*'] = 'required';
            $rules['button_url'] = 'required|array';
            $rules['button_url.*'] = 'required';
            $rules['tab_description'] = 'required|array';
            $rules['tab_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validatetabStyle2($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['tab_title'] = 'required|array';
            $rules['tab_title.*'] = 'required';
            $rules['tab_image'] = 'required|array';
            $rules['tab_image.*'] = 'required';
            $rules['button_text'] = 'required|array';
            $rules['button_text.*'] = 'required';
            $rules['button_url'] = 'required|array';
            $rules['button_url.*'] = 'required';
            $rules['tab_description'] = 'required|array';
            $rules['tab_description.*'] = 'required';
        }
        return $rules;
    }


    public static function validatetabStyle3($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['tab_main_title'] = 'required|array';
            $rules['tab_main_title.*'] = 'required';
            $rules['tab_title'] = 'required|array';
            $rules['tab_title.*'] = 'required';
            $rules['tab_image'] = 'required|array';
            $rules['tab_image.*'] = 'required';
            $rules['button_text'] = 'required|array';
            $rules['button_text.*'] = 'required';
            $rules['button_url'] = 'required|array';
            $rules['button_url.*'] = 'required';
            $rules['tab_description'] = 'required|array';
            $rules['tab_description.*'] = 'required';
            $rules['step1_text'] = 'required|array';
            $rules['step1_text.*'] = 'required';
            $rules['step2_text'] = 'required|array';
            $rules['step2_text.*'] = 'required';
            $rules['step3_text'] = 'required|array';
            $rules['step3_text.*'] = 'required';
        }
        return $rules;
    }



    public static function validatetabStyle4($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['tab_main_title'] = 'required|array';
            $rules['tab_main_title.*'] = 'required';
            $rules['tab_title'] = 'required|array';
            $rules['tab_title.*'] = 'required';
            $rules['tab_image'] = 'required|array';
            $rules['tab_image.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['tab_description'] = 'required|array';
            $rules['tab_description.*'] = 'required';
            $rules['step1_text'] = 'required|array';
            $rules['step1_text.*'] = 'required';
            $rules['step2_text'] = 'required|array';
            $rules['step2_text.*'] = 'required';
            $rules['step3_text'] = 'required|array';
            $rules['step3_text.*'] = 'required';
        }
        return $rules;
    }


    public static function validatetabStyle5($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1320 ,height=557';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=112,height=112';

            $rules['tab_main_title'] = 'required|array';
            $rules['tab_main_title.*'] = 'required';
            $rules['tab_title'] = 'required|array';
            $rules['tab_title.*'] = 'required';
            $rules['tab_image'] = 'required|array';
            $rules['tab_image.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['tab_description'] = 'required|array';
            $rules['tab_description.*'] = 'required';
            $rules['step1_text'] = 'required|array';
            $rules['step1_text.*'] = 'required';
            $rules['step2_text'] = 'required|array';
            $rules['step3_text.*'] = 'required';
            $rules['button_text'] = 'required|array';
            $rules['button_text.*'] = 'required';
            $rules['button_url'] = 'required|array';
            $rules['button_url.*'] = 'required';
        }
        return $rules;
    }


     public static function validatetabStyle6($id = null)
    {
        $rules = [
            'main_title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {

            $rules['title'] = 'required|array';
            $rules['title.*'] = 'required';
            $rules['tab_title'] = 'required|array';
            $rules['tab_title.*'] = 'required';
            $rules['tab_description'] = 'required|array';
            $rules['tab_description.*'] = 'required';
            $rules['button_text'] = 'required|array';
            $rules['button_text.*'] = 'required';
            $rules['button_url'] = 'required|array';
            $rules['button_url.*'] = 'required';
        }
        return $rules;
    }

     public static function validatetabStyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
        ];
        if (is_null($id) || $id === '') {

            $rules['tab_title'] = 'required|array';
            $rules['tab_title.*'] = 'required';
            $rules['tab_image'] = 'required|array';
            $rules['tab_image.*'] = 'required';
            $rules['tab_description'] = 'required|array';
            $rules['tab_description.*'] = 'required';
        }
        return $rules;
    }


       public static function validatetabStyle8($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {

            $rules['tab_title'] = 'required|array';
            $rules['tab_title.*'] = 'required';
            $rules['tab_image'] = 'required|array';
            $rules['tab_image.*'] = 'required';
            $rules['tab_description'] = 'required|array';
            $rules['tab_description.*'] = 'required';
        }
        return $rules;
    }

        public static function validatetabStyle10($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1600 ,height=1000';
            $rules['tab_main_title_'] = 'required|array';
            $rules['tab_main_title_.*'] = 'required';
            $rules['tab_title'] = 'required|array';
            $rules['tab_title.*'] = 'required';
            $rules['button_text'] = 'required|array';
            $rules['button_text.*'] = 'required';
            $rules['button_url'] = 'required|array';
            $rules['button_url.*'] = 'required';
            $rules['tab_image'] = 'required|array';
            $rules['tab_image.*'] = 'required';
            $rules['tab_description'] = 'required|array';
            $rules['tab_description.*'] = 'required';
        }
        return $rules;
    }


    public static function validateserviceStyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['service_title'] = 'required|array';
            $rules['service_title.*'] = 'required';
            $rules['service_image_icon'] = 'required|array';
            $rules['service_image_icon.*'] = 'required';
            $rules['service_description'] = 'required|array';
            $rules['service_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validateserviceStyle4($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=720,height=525';
            $rules['icon_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=65,height=65';
        }
        return $rules;
    }

    public static function validateserviceStyle5($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=720,height=525';
            $rules['icon_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=65,height=65';
        }
        return $rules;
    }

    public static function validateserviceStyle6($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image*'] = 'required';
        }
        return $rules;
    }


    public static function validateserviceStyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }


    public static function validateserviceStyle8($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['service_image_icon'] = 'required|array';
            $rules['service_image_icon.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['service_title'] = 'required|array';
            $rules['service_title.*'] = 'required';
            $rules['service_description'] = 'required|array';
            $rules['service_description.*'] = 'required';
        }
        return $rules;
    }


    public static function validateserviceStyle9($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
        }
        return $rules;
    }


    public static function validateworktyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_subtitle'] = 'required|array';
            $rules['step_subtitle.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validateworktyle2($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
        }
        return $rules;
    }


    public static function validateworktyle4($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=700,height=826';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_subtitle.*'] = 'required';
            $rules['step_subtitle.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
        }
        return $rules;
    }


    public static function validateworktyle5($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=553,height=671';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validateworktyle6($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }


     public static function validateworktyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_link_text.*'] = 'required';
            $rules['step_link_text.*'] = 'required';
            $rules['step_link_url.*'] = 'required';
            $rules['step_link_url.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    
     public static function validateworktyle8($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=197,height=227';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }

     public static function validateworktyle9($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
            $rules['step_sub_title'] = 'required|array';
            $rules['step_sub_title.*'] = 'required';
        }
        return $rules;
    }

      public static function validateworktyle10($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null(value: $id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }


    public static function validatepricestyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['plan_title'] = 'required|array';
            $rules['plan_title.*'] = 'required';
            $rules['plan_type.*'] = 'required';
            $rules['plan_type.*'] = 'required';
            $rules['plan_button_text'] = 'required|array';
            $rules['plan_button_text.*'] = 'required';
            $rules['plan_button_url'] = 'required|array';
            $rules['plan_button_url.*'] = 'required';
            $rules['plan_price'] = 'required|array';
            $rules['plan_price.*'] = 'required';
        }
        return $rules;
    }

    public static function validatepricestyle2($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['plan_title'] = 'required|array';
            $rules['plan_title.*'] = 'required';
            $rules['plan_type.*'] = 'required';
            $rules['plan_type.*'] = 'required';
            $rules['plan_button_text'] = 'required|array';
            $rules['plan_button_text.*'] = 'required';
            $rules['plan_button_url'] = 'required|array';
            $rules['plan_button_url.*'] = 'required';
            $rules['plan_price'] = 'required|array';
            $rules['plan_price.*'] = 'required';
            $rules['plan_description'] = 'required|array';
            $rules['plan_description.*'] = 'required';
        }
        return $rules;
    }


      public static function validatepricestyle4($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['plan_title'] = 'required|array';
            $rules['plan_title.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['plan_sub_title'] = 'required|array';
            $rules['plan_sub_title.*'] = 'required';
            $rules['plan_button_text'] = 'required|array';
            $rules['plan_button_text.*'] = 'required';
            $rules['plan_button_url'] = 'required|array';
            $rules['plan_button_url.*'] = 'required';
            $rules['plan_description'] = 'required|array';
            $rules['plan_description.*'] = 'required';
        }
        return $rules;
    }


      public static function validatepricestyle5($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['plan_title'] = 'required|array';
            $rules['plan_title.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['plan_button_text'] = 'required|array';
            $rules['plan_button_text.*'] = 'required';
            $rules['plan_button_url'] = 'required|array';
            $rules['plan_button_url.*'] = 'required';
            $rules['plan_description'] = 'required|array';
            $rules['plan_description.*'] = 'required';
            $rules['plan_type'] = 'required|array';
            $rules['plan_type.*'] = 'required';
            $rules['plan_price'] = 'required|array';
            $rules['plan_price.*'] = 'required';

        }
        return $rules;
    }

      public static function validatepricestyle6($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['plan_title'] = 'required|array';
            $rules['plan_title.*'] = 'required';
            $rules['plan_button_text'] = 'required|array';
            $rules['plan_button_text.*'] = 'required';
            $rules['plan_button_url'] = 'required|array';
            $rules['plan_button_url.*'] = 'required';
            $rules['plan_description'] = 'required|array';
            $rules['plan_description.*'] = 'required';
            $rules['plan_type'] = 'required|array';
            $rules['plan_type.*'] = 'required';
            $rules['plan_price'] = 'required|array';
            $rules['plan_price.*'] = 'required';
            $rules['bottom_title'] = 'required|array';
            $rules['bottom_title.*'] = 'required';

        }
        return $rules;
    }

     public static function validatepricestyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['plan_title'] = 'required|array';
            $rules['plan_title.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['plan_button_text'] = 'required|array';
            $rules['plan_button_text.*'] = 'required';
            $rules['plan_button_url'] = 'required|array';
            $rules['plan_button_url.*'] = 'required';
            $rules['plan_description'] = 'required|array';
            $rules['plan_description.*'] = 'required';
            $rules['plan_type'] = 'required|array';
            $rules['plan_type.*'] = 'required';
            $rules['plan_price'] = 'required|array';
            $rules['plan_price.*'] = 'required';

        }
        return $rules;
    }


      public static function validatepricestyle8($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['plan_title'] = 'required|array';
            $rules['plan_title.*'] = 'required';
            $rules['plan_button_text'] = 'required|array';
            $rules['plan_button_text.*'] = 'required';
            $rules['plan_button_url'] = 'required|array';
            $rules['plan_button_url.*'] = 'required';
            $rules['plan_description'] = 'required|array';
            $rules['plan_description.*'] = 'required';
            $rules['plan_type'] = 'required|array';
            $rules['plan_type.*'] = 'required';
            $rules['plan_price'] = 'required|array';
            $rules['plan_price.*'] = 'required';

        }
        return $rules;
    }

         public static function validatepricestyle9($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['plan_title'] = 'required|array';
            $rules['plan_title.*'] = 'required';
            $rules['offer_title'] = 'required|array';
            $rules['offer_title.*'] = 'required';
            $rules['sub_title'] = 'required|array';
            $rules['sub_title.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image'] = 'required';
            $rules['plan_button_text'] = 'required|array';
            $rules['plan_button_text.*'] = 'required';
            $rules['plan_button_url'] = 'required|array';
            $rules['plan_button_url.*'] = 'required';
            $rules['plan_description'] = 'required|array';
            $rules['plan_description.*'] = 'required';
            $rules['plan_type'] = 'required|array';
            $rules['plan_type.*'] = 'required';
            $rules['plan_price'] = 'required|array';
            $rules['plan_price.*'] = 'required';

        }
        return $rules;
    }


          public static function validatepricestyle10($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['plan_title'] = 'required|array';
            $rules['plan_title.*'] = 'required';
            $rules['sub_title'] = 'required|array';
            $rules['sub_title.*'] = 'required';
            $rules['plan_button_text'] = 'required|array';
            $rules['plan_button_text.*'] = 'required';
            $rules['plan_button_url'] = 'required|array';
            $rules['plan_button_url.*'] = 'required';
            $rules['plan_type'] = 'required|array';
            $rules['plan_type.*'] = 'required';
            $rules['plan_price'] = 'required|array';
            $rules['plan_price.*'] = 'required';

        }
        return $rules;
    }


    public static function validatefaqstyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=183,height=150';
            $rules['faq_question'] = 'required|array';
            $rules['faq_question.*'] = 'required';
            $rules['faq_answer'] = 'required|array';
            $rules['faq_answer.*'] = 'required';
        }
        return $rules;
    }


    public static function validatefaqstyle2($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['faq_question'] = 'required|array';
            $rules['faq_question.*'] = 'required';
            $rules['faq_answer'] = 'required|array';
            $rules['faq_answer.*'] = 'required';
        }
        return $rules;
    }
    public static function validatefaqstyle3($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=336,height=671';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=210,height=80';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=240,height=80';
            $rules['image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=300,height=160';
            $rules['faq_question'] = 'required|array';
            $rules['faq_question.*'] = 'required';
            $rules['faq_answer'] = 'required|array';
            $rules['faq_answer.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefaqstyle4($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlited_title' => 'required',
            'title1' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=670,height=493';
            $rules['faq_question'] = 'required|array';
            $rules['faq_question.*'] = 'required';
            $rules['faq_answer'] = 'required|array';
            $rules['faq_answer.*'] = 'required';
        }
        return $rules;
    }


    public static function validatefaqstyle5($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=570,height=450';
            $rules['faq_question'] = 'required|array';
            $rules['faq_question.*'] = 'required';
            $rules['faq_answer'] = 'required|array';
            $rules['faq_answer.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefaqstyle6($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
            'bottom_title' => 'required',
            'bottom_description' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }


    public static function validatefaqstyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=560,height=560';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefaqstyle8($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'image_title' => 'required',
            'image_sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=970 ,height=749';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefaqstyle9($id = null)
    {
        $rules = [
            'title' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=288 ,height=436';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=288 ,height=436';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefaqstyle10($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'question_title' => 'required',
            'answer_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }
    public static function validatefeaturetyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1250,height=936';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle2($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=493,height=662';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle3($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1920,height=943';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle4($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1440,height=900';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_subtitle'] = 'required|array';
            $rules['step_subtitle.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle5($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
        }
        return $rules;
    }
    public static function validatefeaturetyle6($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1280,height=965';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle9($id = null)
    {
        $rules = [
            'title' => 'required',
            'title2' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=750,height=1624';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }
    public static function validatefeaturetyle11($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=666,height=673';
            $rules['step_title'] = 'required|array';
        }
        return $rules;
    }


    public static function validatefeaturetyle12($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'image_1_title' => 'required',
            'image_2_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=523,height=626';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=90,height=90';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=90,height=90';
        }
        return $rules;
    }

    public static function validatefeaturetyle13($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title1' => 'required',
            'sub_title2' => 'required',
            'description1' => 'required',
            'description2' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=511,height=511';
        }
        return $rules;
    }

    public static function validatefeaturetyle14($id = null)
    {
        $rules = [
            'title1' => 'required',
            'title2' => 'required',
            'description1' => 'required',
            'description2' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=279,height=558';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=178,height=99';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=154,height=154';
            $rules['image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=66,height=66';
            $rules['image4'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=66,height=66';
            $rules['image5'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=76,height=76';
        }
        return $rules;
    }

    public static function validatefeaturetyle15($id = null)
    {
        $rules = [
            'title' => 'required',
            'title1' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=862,height=736';
        }
        return $rules;
    }

    public static function validatefeaturetyle16($id = null)
    {
        $rules = [
            'title' => 'required',
            'title1' => 'required',
            'sub_title' => 'required',
            'description1' => 'required',
            'description2' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1188,height=1082';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1222,height=965';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle17($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }


    public static function validatefeaturetyle18($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'title1' => 'required',
            'title2' => 'required',
            'title3' => 'required',
            'description1' => 'required',
            'description2' => 'required',
            'description3' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=392,height=361';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=338,height=304';
            $rules['image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=328,height=225';
        }
        return $rules;
    }


    public static function validatefeaturetyle19($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=672,height=700';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=774,height=447';
        }
        return $rules;
    }

    public static function validatefeaturetyle20($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=300,height=317';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=300,height=449';
            $rules['image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=300,height=272';
        }
        return $rules;
    }


    public static function validatefeaturetyle21($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
            $rules['name'] = 'required|array';
            $rules['name.*'] = 'required';
            $rules['designation'] = 'required|array';
            $rules['designation.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle22($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'sub_title' => 'required',
            'step_text1' => 'required',
            'step_text2' => 'required',
            'step_text3' => 'required',
            'bottom_title' => 'required',
            'bottom_sub_title' => 'required',
            'description' => 'required',
            'bottom_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=574,height=690';
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=189,height=257';

            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_sub_title'] = 'required|array';
            $rules['step_sub_title.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle23($id = null)
    {
        $rules = [
            'title' => 'required',
            'step1_title' => 'required',
            'step1_description' => 'required',
            'step2_title' => 'required',
            'step2_description' => 'required',
            'step3_title' => 'required',
            'step3_description' => 'required',

        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=392,height=361';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=338,height=304';
            $rules['image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=328,height=225';
        }
        return $rules;
    }


    public static function validatefeaturetyle24($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'bottom_title' => 'required',
            'bottom_sub_title' => 'required',
            'bottom_description' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=514,height=503';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=240,height=248';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle25($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'video_url' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=570,height=588';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }
    public static function validatefeaturetyle26($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle27($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1280,height=965';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle28($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['link_text.*'] = 'required|array';
            $rules['link_text.*'] = 'required';
            $rules['link_url.*'] = 'required|array';
            $rules['link_url.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle29($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'video_url' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=570,height=588';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_subtitle.*'] = 'required|array';
            $rules['step_subtitle.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }



    public static function validatefeaturetyle31($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=797,height=454';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_subtitle.*'] = 'required|array';
            $rules['step_subtitle.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle32($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_description.*'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }


    public static function validatefeaturetyle33($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'button_text' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1917,height=560';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_description.*'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validatefeaturetyle34($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=120,height=120';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=692,height=409';
            $rules['image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=766,height=766';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_description.*'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }


    public static function validatefeaturetyle35($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=194,height=162';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=448,height=599';
            $rules['image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=197,height=201';
            $rules['image4'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=306,height=169';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['link_text'] = 'required|array';
            $rules['link_text.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_description.*'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }



    public static function validatefeaturetyle36($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['link_text'] = 'required|array';
            $rules['link_text.*'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_description.*'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }



      public static function validatefeaturetyle37($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=173,height=183';
            $rules['image2'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=662,height=632';
            $rules['image3'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=260,height=101';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_sub_title'] = 'required|array';
            $rules['step_sub_title.*'] = 'required';
          
        }
        return $rules;
    }

    
      public static function validatefeaturetyle38($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
          
        }
        return $rules;
    }

public static function validatefeaturetyle39($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['link_text'] = 'required|array';
            $rules['link_text.*'] = 'required';
            $rules['link_url'] = 'required|array';
            $rules['link_url.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
          
        }
        return $rules;
    }

      public static function validatefeaturetyle40($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_sub_title'] = 'required|array';
            $rules['step_sub_title.*'] = 'required';
          
        }
        return $rules;
    }




    public static function validateintigrationstyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['left_image_icon'] = 'required|array';
            $rules['left_image_icon.*'] = 'required';
            $rules['right_image_icon'] = 'required|array';
            $rules['right_image_icon.*'] = 'required';

            $rules['card_title'] = 'required|array';
            $rules['card_title.*'] = 'required';
            $rules['card_description'] = 'required|array';
            $rules['card_description.*'] = 'required';
            $rules['image_icon'] = 'required|array';
            $rules['image_icon.*'] = 'required';
        }
        return $rules;
    }

    public static function validateintigrationstyle2($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['card_title'] = 'required|array';
            $rules['card_title.*'] = 'required';
            $rules['image_icon'] = 'required|array';
            $rules['image_icon.*'] = 'required';
        }
        return $rules;
    }


    public static function validateintigrationstyle3($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['card_title'] = 'required|array';
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=452,height=348';
            $rules['banner_image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=220,height=261';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    public static function validateintigrationstyle4($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['card_title'] = 'required|array';
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=650,height=399';
            $rules['banner_image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=220,height=279';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }
    public static function validateintigrationstyle5($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['card_title'] = 'required|array';
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=596,height=643';
            $rules['banner_image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=374,height=375';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    public static function validateintigrationstyle6($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['short_description'] = 'required|array';
            $rules['short_description.*'] = 'required';
        }
        return $rules;
    }

    public static function validateintigrationstyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1021,height=338';
        }
        return $rules;
    }

    public static function validateintigrationstyle8($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'sub_title' => 'required',
            'step1_title' => 'required',
            'step1_sub_title' => 'required',
            'step2_title' => 'required',
            'step2_sub_title' => 'required',
            'step3_title' => 'required',
            'step3_sub_title' => 'required',

        ];
        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1920,height=1133';
        }
        return $rules;
    }

    public static function validateintigrationstyle9($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',

        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=642,height=550';

            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_title'] = 'required|array';
            $rules['step_title.*'] = 'required';
            $rules['step_description'] = 'required|array';
            $rules['step_description.*'] = 'required';
        }
        return $rules;
    }

     public static function validateintigrationstyle10($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',

        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=520,height=369';
        }
        return $rules;
    }

    public static function validateblogstyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];

        return $rules;
    }

    public static function validateblogstyle2($id = null)
    {
        $rules = [
            'title' => 'required',
        ];

        return $rules;
    }

    public static function validateblogstyle3($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];

        return $rules;
    }

    public static function validateblogstyle4($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'sub_title' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
            'description' => 'required',
        ];

        return $rules;
    }
    public static function validateblogstyle6($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];

        return $rules;
    }

    public static function validateblogstyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
            'description' => 'required',
        ];

        return $rules;
    }


    public static function validateblogstyle8($id = null)
    {
        $rules = [
            'title' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
            'description' => 'required',
        ];

        return $rules;
    }

    public static function validateblogstyle9($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
            'bottom_title' => 'required',
        ];

        return $rules;
    }


    public static function validateteamstyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];

        return $rules;
    }


    public static function validateteamstyle3($id = null)
    {
        $rules = [
            'title' => 'required',
        ];

        return $rules;
    }

    public static function validateteamstyle4($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'sub_title' => 'required',
            'link_text' => 'required',
            'link_url' => 'required',
            'description' => 'required',
        ];

        return $rules;
    }

     public static function validateteamstyle6($id = null)
    {
        $rules = [
            'title' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
            'description' => 'required',
        ];

        return $rules;
    }

     public static function validateteamstyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
        ];
         if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1920,height=468';
        }

        return $rules;
    }


     public static function validateteamstyle9($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
        ];
         if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=575,height=990';
        }

        return $rules;
    }

      public static function validateteamstyle10($id = null)
    {
        $rules = [
            'title' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
        ];
        
        return $rules;
    }


    public static function contactstyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1981,height=1528';
        }
        return $rules;
    }

    public static function contactstyle2($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['card_title'] = 'required|array';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    public static function contactstyle3($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'subtitle' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_title'] = 'required|array';
            $rules['step_sub_title'] = 'required|array';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

     public static function contactstyle4($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'sub_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1401,height=720';
        }
        return $rules;
    }

    public static function contactstyle5($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
        ];

        return $rules;
    }

      public static function contactstyle6($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'department1_name' => 'required',
            'department1_email' => 'required',
            'department1_phone' => 'required',
            'department1_open_close' => 'required',
            'department2_name' => 'required',
            'department2_email' => 'required',
            'department2_phone' => 'required',
            'department2_open_close' => 'required',
            'map_url' => 'required',
          
        ];

        return $rules;
    }

     public static function contactstyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'title1' => 'required',
            'sub_title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'time_open_close' => 'required',
            'description' => 'required',          
        ];

        return $rules;
    }

    
     public static function contactstyle8($id = null)
    {
        $rules = [
            'title' => 'required',
            'title1' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'time_open_close' => 'required',
            'map_url' => 'required',
        ];

        return $rules;
    }

     public static function contactstyle9($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'description' => 'required',
        ];

        return $rules;
    }

     public static function contactstyle10($id = null)
    {
        $rules = [
            'title' => 'required',
            'title1' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'description' => 'required',
        ];

        return $rules;
    }

    public static function helpCenterstyle1($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        return $rules;
    }

    


    public static function portfoliostyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'main_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    public static function portfoliostyle2($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'subtitle' => 'required',
            'main_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    public static function portfoliostyle3($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    public static function portfoliostyle4($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }


    public static function portfoliostyle9($id = null)
    {
        $rules = [
            'title' => 'required',
            'title2' => 'required',
            'highlighted_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    public static function portfoliostyle6($id = null)
    {
        $rules = [
            'title' => 'required',
            'title2' => 'required',
            'subtitle' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    
    public static function portfoliostyle7($id = null)
    {
        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['image1'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=648,height=433';
        }
        return $rules;
    }


    public static function portfoliostyle10($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'subtitle' => 'required',
            'main_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

    public static function portfoliostyle12($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'subtitle' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
        }
        return $rules;
    }

     public static function portfoliostyle13($id = null)
    {
        $rules = [
            'title' => 'required',
            'highlighted_title' => 'required',
            'button_text' => 'required',
            'button_url' => 'required',
            'main_description' => 'required',
        ];
         if (is_null($id) || $id === '') {
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['description'] = 'required';
            $rules['short_description'] = 'required|array';
            $rules['short_description'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

      public static function portfoliostyle14($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'highlighted_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1885,height=912';
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }


      public static function portfoliostyle15($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'highlighted_title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['banner_bg_image'] = 'required|image|mimes:webp,jpg,jpeg,png,gif,svg,webp|dimensions:width=1885,height=912';
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['description'] = 'required';
            $rules['short_description'] = 'required|array';
            $rules['short_description'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }


       public static function portfoliostyle16($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['description'] = 'required';
            $rules['short_description'] = 'required|array';
            $rules['short_description'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }


       public static function portfoliostyle17($id = null)
    {
        $rules = [
            'title' => 'required',
            'sub_title' => 'required',
            'main_description' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['description'] = 'required';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }

     public static function portfoliostyle18($id = null)
    {
        $rules = [
            'title' => 'required',
        ];
        if (is_null($id) || $id === '') {
            $rules['category'] = 'required|array';
            $rules['portfolio_title'] = 'required|array';
            $rules['detail_title'] = 'required|array';
            $rules['client'] = 'required|array';
            $rules['service'] = 'required|array';
            $rules['description'] = 'required|array';
            $rules['step_image_icon'] = 'required|array';
            $rules['step_image_icon.*'] = 'required';
            $rules['step_image'] = 'required|array';
            $rules['step_image.*'] = 'required';
        }
        return $rules;
    }



    public static function privacyTermsstyle1($id = null)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];

        return $rules;
    }


    public static function privacyTermsstyle2($id = null)
    {
        $rules = [
            'title' => 'required',
        ];

        return $rules;
    }

    
    public static function careerstyle1($id = null)
    {
        $rules= [
            'title' => 'required',
            'subtitle' => 'required',
        ];
        return $rules;
    }
  
    public static function validatedepartmentstyle1($id = null)
    {
        $rules= [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
        ];
      
        return $rules;
    }
  

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function sectionStyle()
    {
        return $this->belongsTo(SectionStyle::class, 'section_style_id', 'id');
    }
    public function menu()
    {
        return $this->hasOneThrough(Menu::class, Page::class, 'id', 'id', 'page_id', 'menu_id');
    }
}
